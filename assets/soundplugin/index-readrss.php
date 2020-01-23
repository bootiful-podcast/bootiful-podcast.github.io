<?php
function ag_read_rss($arg, $str_opts){
    $fout = '';
    $entries = simplexml_load_file($arg);
    $namespaces = $entries->getNamespaces(true);
//        print_r($entries);
//        $data = $entries->xpath ('channel/item');



//    print_r($entries);

    $fout.='<div class="audiogallery auto-init" style="opacity:0; margin-top: 70px;" data-options="'.$str_opts.'"><div class="items">';

foreach ($entries->channel->item as $item) {
//    print_r($item);

    //  data-thumb_link="img/adg3.jpg" data-bgimage="img/bgminion.jpg"
    $fout.=' <div class="audioplayer-tobe " data-thumb="'.$item->image->url.'" style="width:100%; " data-scrubbg="waves/scrubbg.png" data-scrubprog="waves/scrubprog.png" data-videoTitle="'.$item->title.'" data-type="audio" data-source="';
    foreach($item->enclosure->attributes() as $lab => $val){
        if($lab==='url'){
            $fout.=($val);
        }
    }

    $fout.='">';

    $fout.='<div class="meta-artist">
<span class="the-artist">'.$item->title.'</span>
</div>';
    $fout.='<div class="menu-description">
<div class="menu-item-thumb-con"><div class="menu-item-thumb" style="background-image: url('.$item->image->url.')"></div></div>
<span class="the-artist">'.$item->title.'</span>
<span class="the-name">'.$item->description.'</span>
</div>';

    $fout.='</div>';
}

    $fout.='</div></div>';


    return $fout;
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=EDGE">
    <title>Audio Player Preview</title>
    <script src="js/jquery.js"></script>
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
    <link href="./bootstrap/bootstrap-responsive.css" rel="stylesheet">
    <link rel='stylesheet' type="text/css" href="style/style.css"/>
    <link rel='stylesheet' type="text/css" href="audioplayer/audioplayer.css"/>
    <script src="audioplayer/audioplayer.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="content-wrapper">

    <section class="mcon-mainmenu" style="position: absolute; z-index: 5; width:100%;">

        <!--
        -->
        <div class="container">
            <div class="row">
                <div class="logo-con col-md-3">
                    <img src="img/dzsplugins.png" alt="wordpress video gallery" style="margin:0 auto"/>
                </div>
                <div class="main-menu-con col-md-9">
                    <ul id="menu-main-menu" class="menu sf-menu" style="top: 9px;">
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <div class="con-maindemo" id="a-demo">
        <div class="ap-wrapper center-ap" style="width:100%;">
            <div class="the-bg" style=" background-image: url(img/bg.jpg);"></div>
            <?php echo ag_read_rss('demorss.xml', "{
            'transition':'fade'
            ,'cueFirstMedia' : 'off'
            ,'autoplay' : 'on'
            ,'autoplayNext' : 'on'
            ,design_menu_position:'bottom'
            ,'settings_ap':{
                disable_volume: 'off'
                ,disable_scrub: 'default'
                ,design_skin: 'skin-wave'
                ,skinwave_dynamicwaves:'off'
                ,skinwave_enableSpectrum:'off'
                ,settings_backup_type:'full'
                ,skinwave_enableReflect:'on'
                ,skinwave_comments_enable:'on'
                ,skinwave_timer_static:'off'
                ,disable_player_navigation: 'on'
//            ,skinwave_mode: 'small'
                ,skinwave_comments_retrievefromajax:'on'
                ,soundcloud_apikey:'be48604d903aebd628b5bac968ffd14d'//insert api key here https://soundcloud.com/you/apps/
                ,settings_extrahtml:''
            }
            ,design_menu_state:'open'
            ,design_menu_show_player_state_button: 'off'
            ,embedded: 'off'

        }");
?>
        </div>

    </div>
    <div class="con-otherdemos">
        <div class="container">
            <div class="separator"></div>
            <div class="row">
                <div class="col-md-12">

                    <h1 class="hero-heading">The Audio Player. Reinvented.</h1>
                    <h2 class="row-title">Choose a demo.</h2>
                    <div class="simple-hr mb10"></div>
                    <br/>
                </div>
                <div class="col-md-4">
                    <a href="index.html" target=""><img class="example-button active" src="img/e1.jpg" style="width:100%;"/></a>
                </div>
                <div class="col-md-4">
                    <a href="index-minion.html" target=""><img class="example-button " src="img/e2.jpg" style="width:100%;"/>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="index-player.html" target=""><img class="example-button " src="img/e3.jpg" style="width:100%;"/>
                    </a>
                </div>
                <div class="clear"></div><br/>
            </div>
        </div>
    </div>


    <div class="mcon-otherdemos">

        <div class="container">
            <div class="row">
                <a href="#" onclick='document.getElementById("ap1").api_set_playback_speed(0.5); return false;'>Reduce speed to 0.5</a>,
                <a href="#" onclick='document.getElementById("ap1").api_set_playback_speed(2); return false;'>Reduce speed to 2</a>
            </div>
        </div>
    </div>



    <section class="mcon-features">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="bigfeature"><i class="icon-thumbs-up"></i></div>
                    <h4>Easy Install</h4>
                    <p style="text-align: center">Install ZoomSounds in just a couple of minutes. <a href="http://digitalzoomstudio.net/docs/zoomsounds/" target="_blank">Docs</a> are also there.</p>
                </div>
                <div class="col-md-3">
                    <div class="bigfeature"><i class="icon-desktop"></i></div>
                    <h4>Responsive</h4>
                    <p style="text-align: center">From mobile to HD, this gallery is ultra responsive. Also has retina graphics.</p>
                </div>
                <div class="col-md-3">
                    <div class="bigfeature"><i class="icon-pencil"></i></div>
                    <h4>Customizable</h4>
                    <p style="text-align: center">Customize ZoomSounds to your needs. The possibilities are endless.</p>
                </div>
                <div class="col-md-3">
                    <div class="bigfeature"><i class="icon-briefcase"></i></div>
                    <h4>SEO Friendly</h4>
                    <p style="text-align: center">Built with SEO in mind, ZoomSounds parses html content into working magic.</p>
                </div>
            </div>
        </div>
    </section>





    <div class="con-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    &copy; copyright <a href="http://bit.ly/nM4R6u">ZoomIt</a> 2013

                </div>
                <div class="col-md-6" style="text-align: right">

                </div>
            </div>
        </div>
    </div>




</div>
<script>
    jQuery(document).ready(function ($) {
        var playerid = 'ag1';
        var settings_ap = {
            disable_volume: 'off'
            ,disable_scrub: 'default'
            ,design_skin: 'skin-wave'
            ,skinwave_dynamicwaves:'off'
            ,skinwave_enableSpectrum:'off'
            ,settings_backup_type:'full'
            ,skinwave_enableReflect:'on'
            ,skinwave_comments_enable:'on'
            ,skinwave_timer_static:'off'
            ,disable_player_navigation: 'on'
//            ,skinwave_mode: 'small'
            ,skinwave_comments_retrievefromajax:'on'
            ,soundcloud_apikey:"be48604d903aebd628b5bac968ffd14d"//insert api key here https://soundcloud.com/you/apps/
            ,settings_extrahtml:'<div class="btn-like"><span class="the-icon"></span>Like</div><div class="star-rating-con"><div class="star-rating-bg"></div><div class="star-rating-set-clip" style="width: 96.6px;"><div class="star-rating-prog"></div></div><div class="star-rating-prog-clip"><div class="star-rating-prog"></div></div></div><a class="wave-download" href="#"><span class="center-it">&#x25BC;</span></a><div class="counter-hits"><span class="the-number">{{get_plays}}</span> plays</div><div class="counter-likes"><span class="the-number">{{get_likes}}</span> likes</div><div class="counter-rates"><span class="the-number">{{get_rates}}</span> rates</div>'
        };
        dzsag_init('#'+playerid,{
            'transition':'fade'
            ,'cueFirstMedia' : 'off'
            ,'autoplay' : 'on'
            ,'autoplayNext' : 'on'
            ,design_menu_position:'bottom'
            ,'settings_ap':{
                disable_volume: 'off'
                ,disable_scrub: 'default'
                ,design_skin: 'skin-wave'
                ,skinwave_dynamicwaves:'off'
                ,skinwave_enableSpectrum:'off'
                ,settings_backup_type:'full'
                ,skinwave_enableReflect:'on'
                ,skinwave_comments_enable:'on'
                ,skinwave_timer_static:'off'
                ,disable_player_navigation: 'on'
//            ,skinwave_mode: 'small'
                ,skinwave_comments_retrievefromajax:'on'
                ,soundcloud_apikey:'be48604d903aebd628b5bac968ffd14d'//insert api key here https://soundcloud.com/you/apps/
                ,settings_extrahtml:'<div class=\'btn-like\'><span class=\'the-icon\'></span>Like</div><div class=\'star-rating-con\'><div class=\'star-rating-bg\'></div><div class=\'star-rating-set-clip\' style=\'width: 96.6px;\'><div class=\'star-rating-prog\'></div></div><div class=\'star-rating-prog-clip\'><div class=\'star-rating-prog\'></div></div></div><a class=\'wave-download\' href=\'#\'><span class=\'center-it\'>&#x25BC;</span></a><div class=\'counter-hits\'><span class=\'the-number\'>{{get_plays}}</span> plays</div><div class=\'counter-likes\'><span class=\'the-number\'>{{get_likes}}</span> likes</div><div class=\'counter-rates\'><span class=\'the-number\'>{{get_rates}}</span> rates</div>'
            }
            ,design_menu_state:'open'
            ,design_menu_show_player_state_button: 'off'
            ,embedded: 'off'

        });


//        setTimeout(function(){
//            document.getElementById('ap1').api_destroy();
//        }, 3000);
    });
</script>
<link rel="stylesheet" href="fontawesome/font-awesome.min.css">
</body>
</html>