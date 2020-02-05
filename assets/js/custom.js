$(document).ready(function () {
    $('.mobile-nav-btn').on('click', function () {
        $('.hamburger-menu').toggleClass('open');
    });
});

$(document).ready(function () {

    $('.tab-pane-toggle').each(function (evt) {
        var id = this.id;
        var contentDiv = id.split('-tab')[0] + '-content';
        console.log('the id is', id, 'and the contentDiv is', contentDiv);
        document.getElementById(id).addEventListener('click', function () {
            console.log('clicked ', id);
        })
        $('#' + id).click(function () {
            console.log('clicking ', id);
            $('.tab-pane-content').hide();
            $('#' + contentDiv).show();
        });

    });
});


jQuery(document).ready(function () {
    $('.nav-link').attr('target', '_blank')
})

$(document).ready(function () {

    $("#scrollTop, .btn-slide").click(function () {
        // get the destination
        var destination = $(this).attr('href');

        $('html, body').stop().animate({
            scrollTop: $(destination).offset().top
        }, 700);

        // override the default link click behavior
        return false;
    });

});


/// the following controls the playing of podcasts


function initializePlayerForLatest(podcast) {

    dzsap_init(getDataSourceElementIdFor(podcast.uid), {
        autoplay: "off"
        , init_each: "on"
        , disable_volume: "on"
        , skinwave_mode: 'normal'
        , settings_backup_type: 'light' // == light or full
        , skinwave_: 'light' // == light or full
        , skinwave_enableSpectrum: "off"
        , embed_code: 'light' // == light or full
        , skinwave_wave_mode: "canvas"
        , skinwave_wave_mode_canvas_waves_number: "3"
        , skinwave_wave_mode_canvas_waves_padding: "1"
        , skinwave_wave_mode_canvas_reflection_size: '0' // == light or full
        , design_color_bg: '999999,ffffff' // --  light or full
        , skinwave_wave_mode_canvas_mode: 'reflecto' // --  light or full
        , preview_on_hover: 'off' // --  light or full
        , design_wave_color_progress: 'ff657a,ffffff' // -- light or full
        , pcm_data_try_to_generate: 'on'
        , skinwave_comments_enable: 'off' // -- enable the comments, publisher.php must be in the same folder as this html, also if you want the comments to automatically be taken from the database remember to set skinwave_comments_retrievefromajax to ON
        , skinwave_comments_retrievefromajax: 'off'// --- retrieve the comment form ajax
        , failsafe_repair_media_element: 500 // == light or full
    });

}


function getDataSourceElementIdFor(uid) {
    return 'data-source-' + uid + '-element';
}

function PodcastPlayerView(p) {


    function buildDataSourceForPodcast(podcast) {
        var html = "<span class=\"meta-artist\"><span class=\"the-artist\"> " + podcast.title + "</span></span>";
        var dataSourceElementId = getDataSourceElementIdFor(podcast.uid);
        var e = $("<span>" + html + "</span>");
        e.attr('data-source', podcast.uri);
        e.attr('id', dataSourceElementId);
        e.attr('data-type', 'audio');
        e.attr('data-scrubbg', 'assets/soundplugin/audioplayer/img/dzsplugins.png');
        e.attr('data-scrubprog', 'assets/soundplugin/audioplayer/img/bgminion.jpg');
        e.attr('data-thumb', podcast.episodePhotoUri);
        'aptest-with-play skin-wave-mode-small audioplayer-tobe skin-wave button-aspect-noir data-source-container'.split(' ').forEach(function (clz) {
            e.addClass(clz.trim());
        });
        return e;
    }

    const containerId = 'containerOfDataSources';
    this.container = jQuery('#' + containerId);
    this.podcast = p;
    this.uid = this.podcast.uid;
    this.dataSourceElement = buildDataSourceForPodcast(this.podcast);
    this.container.append(this.dataSourceElement);

    this.play = function () {
        console.log('playing (' + this.uid + ')');
        document.getElementById(getDataSourceElementIdFor(this.uid)).api_change_media(this.element, pargs);
    };

    this.show = function () {
        console.log('showing (' + this.uid + ')');
        this.container.show();
    };

}

function Podcast(id, uid, title, uri, photo) {
    this.uid = uid;
    this.title = title;
    this.uri = uri;
    this.id = id;
    this.episodePhotoUri = photo;
}

const bootiful = {
    podcasts: {}
};

// init the player
jQuery(document).ready(function () {

    function resetEpisodePlayStatus() {
        jQuery('.play-status').html('Listen Now');
    }

    fetch('/podcasts.json')
        .then((response) => {
            return response.json();
        })
        .then((podcasts) => {
            resetEpisodePlayStatus();

            podcasts.sort((a, b) => {
                return b.date - a.date;
            });

            podcasts.forEach((p) => {
                const podcast = new Podcast(p.id, p.uid, p.title, p.episodeUri, p.episodePhotoUri);
                const view = new PodcastPlayerView(podcast);
                const uid = podcast.uid;
                bootiful.podcasts[uid] = {podcast: podcast, view: view};

                const playFunction = (e) => {
                    const theViewForPodcast = bootiful.podcasts [uid].view;
                    theViewForPodcast.show();
                    theViewForPodcast.play();
                    resetEpisodePlayStatus();
                    jQuery('#episode-play-' + uid + '-status').html('Listening Now');
                    return false;
                };
                jQuery('#top3-play-' + uid).click(playFunction);
                jQuery('#episode-play-' + uid).click(playFunction);
            });

            if (podcasts.length > 0) {
                initializePlayerForLatest(podcasts[0]);
            }
        });
});
