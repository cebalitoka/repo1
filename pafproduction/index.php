<?php 

    include("josys/konfigurasi_global.php");
    include("josys/class/Konten_Tunggal.php");
    include("josys/class/Konten_Ganda.php");
    include("josys/class/Sosial_Media.php");
    include("josys/class/Icon_Home.php");
    include("josys/class/Photo.php");
    include("josys/class/Seo.php");

    //ambil konten tunggal
    $kontenTunggal['about'] = Konten_Tunggal::ambilKontenByJenisKonten("about");
    $kontenTunggal['paf'] = Konten_Tunggal::ambilKontenByJenisKonten("paf");
    $kontenTunggal['achievement'] = Konten_Tunggal::ambilKontenByJenisKonten("achievement");
    $kontenTunggal['companyprofile'] = Konten_Tunggal::ambilKontenByJenisKonten("companyprofile");
    $kontenTunggal['video'] = Konten_Tunggal::ambilKontenByJenisKonten("video");
    $kontenTunggal['portfolio'] = Konten_Tunggal::ambilKontenByJenisKonten("portfolio");
    $kontenTunggal['nomortelpon'] = Konten_Tunggal::ambilKontenByJenisKonten("nomortelpon");

    //ambil konten ganda
    $kontenGanda['artikel'] = Konten_Ganda::ambilSemuaKontenByJenisNonPaging("artikel");
    $kontenGanda['blog'] = Konten_Ganda::ambilSemuaKontenByJenisNonPaging("blog");
    $sosialMedia = Sosial_Media::ambilSemuaSosialMedia();
    $iconHome = Icon_Home::ambilSemuaIconHome();
    $photo = Photo::ambilSemuaPhoto();
    $seo = Seo::ambilSeo();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $seo->description; ?>">
    <meta name="author" content="<?php echo $seo->author; ?>">
    <meta name="keywords" content="<?php echo $seo->keywords; ?>">
    <link rel="shortcut icon" type="image/x-icon" href="favicon1.png" />

    <title>PAF Production</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <!-- <link href="css/agency-non-responsive.css" rel="stylesheet"> -->
    <link href="css/css-tambahan.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>


    <!-- script untuk ajax paginator -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#wrapperAjaxArtikel").load("josys/ajax_content/ajax_paginasi_konten.php?jenis_konten=artikel");  
    $(".paginasiAjaxArtikel").bootpag({

    <?php 
        $item_per_halaman = 10;
        $halaman = ceil($kontenGanda['artikel']['jumlahData']/$item_per_halaman);   
     ?>
       total: <?php echo $halaman; ?>,
       page: 1,
       maxVisible: 5 
    }).on("page", function(e, num){
        e.preventDefault();
        $("#wrapperAjaxArtikel").prepend('<div class="loading-indication"><img src="josys/ajax_content/ajax-loader.gif" /> Memuat Konten...</div>');
        setTimeout(
            $("#wrapperAjaxArtikel").load("josys/ajax_content/ajax_paginasi_konten.php?jenis_konten=artikel", {'page':num})
        ,50000);
    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#wrapperAjaxBlog").load("josys/ajax_content/ajax_paginasi_konten.php?jenis_konten=blog");  
    $(".paginasiAjaxBlog").bootpag({

    <?php 
        $item_per_halaman = 10;
        $halaman = ceil($kontenGanda['blog']['jumlahData']/$item_per_halaman);   
     ?>
       total: <?php echo $halaman; ?>,
       page: 1,
       maxVisible: 5 
    }).on("page", function(e, num){
        e.preventDefault();
        $("#wrapperAjaxBlog").prepend('<div class="loading-indication"><img src="josys/ajax_content/ajax-loader.gif" /> Memuat Konten...</div>');
        setTimeout(
            $("#wrapperAjaxBlog").load("josys/ajax_content/ajax_paginasi_konten.php?jenis_konten=blog", {'page':num})
        ,50000);
    });

});
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- FANCY BOX SCRIPT START -->
    <!-- FANCYBOXXX START -->
    <!-- Add jQuery library -->
        

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <!-- FANCYBOXXX END -->
<script type="text/javascript">
        $(document).ready(function() {
            /*
             *  Simple image gallery. Uses default settings
             */

            $('.fancybox').fancybox();

            /*
             *  Different effects
             */

            // Change title type, overlay closing speed
            $(".fancybox-effects-a").fancybox({
                helpers: {
                    title : {
                        type : 'outside'
                    },
                    overlay : {
                        speedOut : 0
                    }
                }
            });

            // Disable opening and closing animations, change title type
            $(".fancybox-effects-b").fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                helpers : {
                    title : {
                        type : 'over'
                    }
                }
            });

            // Set custom style, close if clicked, change title type and overlay color
            $(".fancybox-effects-c").fancybox({
                wrapCSS    : 'fancybox-custom',
                closeClick : true,

                openEffect : 'none',

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    overlay : {
                        css : {
                            'background' : 'rgba(238,238,238,0.85)'
                        }
                    }
                }
            });

            // Remove padding, set opening and closing animations, close if clicked and disable overlay
            $(".fancybox-effects-d").fancybox({
                padding: 0,

                openEffect : 'elastic',
                openSpeed  : 150,

                closeEffect : 'elastic',
                closeSpeed  : 150,

                closeClick : true,

                helpers : {
                    overlay : null
                }
            });

            /*
             *  Button helper. Disable animations, hide close button, change title type and content
             */

            $('.fancybox-buttons').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    buttons : {}
                },

                afterLoad : function() {
                    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                }
            });


            /*
             *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
             */

            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,
                arrows    : false,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });

            /*
             *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
            */
            $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    nextEffect : 'none',

                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    }
                });

            /*
             *  Open manually
             */

            $("#fancybox-manual-a").click(function() {
                $.fancybox.open('1_b.jpg');
            });

            $("#fancybox-manual-b").click(function() {
                $.fancybox.open({
                    href : 'iframe.html',
                    type : 'iframe',
                    padding : 5
                });
            });

            $("#fancybox-manual-c").click(function() {
                $.fancybox.open([
                    {
                        href : '1_b.jpg',
                        title : 'My title'
                    }, {
                        href : '2_b.jpg',
                        title : '2nd title'
                    }, {
                        href : '3_b.jpg'
                    }
                ], {
                    helpers : {
                        thumbs : {
                            width: 75,
                            height: 50
                        }
                    }
                });
            });


        });
</script>
<!-- FANCY BOX SCRIPT START -->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-fixed-top-modified-aryo">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><img src="jolibs/common-site/img/logo-top.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#page-top">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">About</a>
                    </li>
                    <li>                    
                        <a class="page-scroll" href="#portfolio">News</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">PAF</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>    
        <div class="container">
            <div class="intro-text">
                <div class="col-lg-12 bg-home">
                    <div class="row">
                        <div class="wrapper-content-home">
                            <!-- <img src="jolibs/common-site/img/stand-sing-support.png"> -->
                            <div class="gambar_motion_depan">
                                
                            </div>
                            <center><img class="paf-logo-page" src="jolibs/common-site/img/paf-logo.png"></center>                                                        
                                <ul class="wrapper-icon-home">
                                <?php foreach ($iconHome['hasilData'] as $baris): ?>
                                    <li><a href="jofile/icon_home/<?php echo $baris->link_file; ?>">
                                        <div class="wrapper-icon-home-single">
                                            <center><img src="joimg/halaman_tunggal/icon_home/<?php echo $baris->gambar; ?>"></center>
                                        </div><center><?php echo $baris->nama_icon; ?></center></a></li>
                                <?php endforeach; ?>                                
                                </ul>
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $kontenTunggal['about']->judul_konten; ?></h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch">
                    <img style="float:left;display:inline-block;" src="jolibs/common-site/img/header-about.png">
                    <ul class="nav-section-sketch">
                        <a href="#portfolio-popup" class="portfolio-link" data-toggle="modal"><li>Portfolio</li></a>
                        <a <a class="fancybox-media" href="<?php echo $kontenTunggal['companyprofile']->isi; ?>"><li>Company Profile</li></a>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 portfolio-item">
                        <img class="gambar-side" src="jolibs/common-site/img/sang-pemenang-sketch.png">
                </div>
                <div class="col-md-5 col-sm-6 portfolio-item">
                        <?php echo $kontenTunggal['about']->isi; ?>
                </div>
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <img src="jolibs/common-site/img/thunder-ball.png">
                </div>
            </div>

        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center ">
                    <h2 class="section-heading">News</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full" src="jolibs/common-site/img/header-berita-terbaru-gede.png">                    
                </div>
            </div>


            <div class="row margin-top-responsive100">
                <div class="col-md-5 col-sm-6 portfolio-item">
                        <img class="gambar-side" src="jolibs/common-site/img/icon-event-sketch.png">
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <div id="wrapperAjaxArtikel"></div>
                    <?php if($kontenGanda['artikel']['jumlahData'] > 5): ?>
                        <div class="paginasiAjaxArtikel col-md-12 col-sm-12 _teks_tengah"></div>
                    <?php endif; ?>
                </div>                
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <img class="gambar-side bagian-hilang767" src="jolibs/common-site/img/lapangan-bola-sketch.png">
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 col-sm-6 portfolio-item">
                    <img class="gambar-side" src="jolibs/common-site/img/icon-blog-sketch.png">
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">                    
                    <div id="wrapperAjaxBlog">
                        
                    </div>
                    <?php if($kontenGanda['blog']['jumlahData'] > 5): ?>
                        <div class="paginasiAjaxBlog col-md-12 col-sm-12 _teks_tengah"></div>
                    <?php endif; ?>
                </div>
               
                <div class="col-md-3 col-sm-6 portfolio-item">
                    <img class="gambar-side" src="jolibs/common-site/img/kick-thunder-sketch.png">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $kontenTunggal['paf']->judul_konten; ?></h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full" src="jolibs/common-site/img/header-paf.png">                    
                </div>
            </div>
            <div class="row margin-top-responsive100">
                <div class="col-md-3 col-sm-6 portfolio-item">
                        <img src="jolibs/common-site/img/thunder-shoe-sketch.png">
                </div>
                <div class="col-md-5 col-sm-6 portfolio-item">
                    <?php echo $kontenTunggal['paf']->isi; ?>
                </div>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <img src="jolibs/common-site/img/coach-gokil-sketch.png">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Gallery</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
            </div>
            <div class="row margin-top-responsive100">
                <div class="col-sm-4">
                    <div class="team-member">
                        <a target="_blank" href="<?php echo $kontenTunggal['video']->isi; ?>">
                        <img src="jolibs/common-site/img/icon-video-sketch.png"  alt="">
                        <h4>Video</h4>
                        </a>                        
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                    <div class="team-member">
                        <a href="#foto" data-toggle="modal"><img src="jolibs/common-site/img/icon-foto-sketch.png"  alt="">
                        <h4>Photo</h4></a>                                              
                    </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                    <div class="team-member">
                        <a href="#achievement" data-toggle="modal"><img src="jolibs/common-site/img/icon-achievement-sketch.png"  alt="">
                        <h4>Achievement</h4></a>                       
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full" src="jolibs/common-site/img/header-contact.png">                    
                </div>
            </div>
            <div class="row margin-top-responsive100">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-4">
                            <img src="jolibs/common-site/img/telpon-jadul-sketch.png"  alt="">
                            <h4><?php echo $kontenTunggal['nomortelpon']->isi; ?></h4>
                            </div>
                            <div class="col-md-8">
                                   <ul class="wrapper-icon-kontak">
                                   <?php foreach ($sosialMedia['hasilData'] as $baris): ?>
                                        <?php //if(preg_match("/twitter/i", $baris->link) && $baris->jenis == "link"): ?>
 <!--                                     <li><a data-toggle="modal" href="#popup-twitter12"><img src="joimg/halaman_tunggal/contact/<?php echo $baris->gambar; ?>">&nbsp;&nbsp;&nbsp;<p><?php echo $baris->nama_sosial_media; ?></p></a></li>
    
    <div class="portfolio-modal modal fade" id="popup-twitter12" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">

               <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Twitter</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
                            <div class="row konten-margin-responsive-pop-up991">
                                <center><?php echo $baris->link; ?></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div> -->

                                        <?php if($baris->jenis != "link"): ?>
                                            <li><img src="joimg/halaman_tunggal/contact/<?php echo $baris->gambar; ?>">&nbsp;&nbsp;&nbsp;<p><?php echo $baris->nama_sosial_media; ?></p></li>
                                        <?php elseif($baris->jenis == "link"): ?>
                                            
                                            <li><a href="<?php echo $baris->link; ?>" target="_blank"><img src="joimg/halaman_tunggal/contact/<?php echo $baris->gambar; ?>">&nbsp;&nbsp;&nbsp;<p><?php echo $baris->nama_sosial_media; ?></p></a></li>
                                            <!-- Pop up twitter -->

                                        <?php endif; ?>
                                   <?php endforeach; ?>                                       
                                   </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="copyright">Copyright 2015 &copy;pafproduction, Developed by <a href="http://www.jogjasite.com" target="_blank">jogjasite.com</a></span>
                </div>                                
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal -->
    <div class="portfolio-modal modal fade" id="portfolio-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
               <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $kontenTunggal['portfolio']->judul_konten; ?></h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
                        <div class="row konten-margin-responsive-pop-up991">
                        
                                <?php echo $kontenTunggal['portfolio']->isi; ?>
                            </div>                                                          
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

   <!-- Foto -->
    <div class="portfolio-modal modal fade" id="foto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
               <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Foto</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
                        <div class="row konten-margin-responsive-pop-up991">
                            <?php foreach($photo['hasilData'] as $baris): ?>

<script type="text/javascript">

$(document).ready(function() {
    $("#list-foto-<?php echo $baris->id; ?>").click(function(){
        $("#ajaxKontenIsiAnakFoto").load("josys/ajax_content/ajax_content_anak_foto.php?id_album=<?php echo $baris->id; ?>");  
        $(".paginasiKontenFoto").bootpag({

        <?php 
            $item_per_halaman = 10;
            $halaman = ceil(10/$item_per_halaman);   
         ?>
           total: <?php echo $halaman; ?>,
           page: 1,
           maxVisible: 5 
        }).on("page", function(e, num){
            e.preventDefault();
            $("#ajaxKontenIsiAnakFoto").prepend('<div class="loading-indication"><img src="josys/ajax_content/ajax-loader.gif" /> Memuat Konten...</div>');

                $("#ajaxKontenIsiAnakFoto").load("josys/ajax_content/ajax_content_anak_foto.php?id_album=<?php echo $baris->id; ?>", {'page':num})
 
        });

    });
});
</script>

                                <div class="col-md-4 col-sm-6 portfolio-item">
                                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                    <div class="wrapper_gambar">                                        
                                        <center>
                                            <a id="list-foto-<?php echo $baris->id; ?>" href="#anak-foto" data-toggle="modal" title="<?php echo $baris->keterangan; ?>">
                                                <img src="joimg/halaman_tunggal/photo/kecil-<?php echo $baris->gambar; ?>" alt="" />                                            
                                        </center>                                                                     
                                    </div>
                                    <div class="portfolio-caption">                                        
                                        <h4 class="text-muted text-center"><?php echo $baris->keterangan; ?></h4></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>

                                                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <!-- Anak Gallery / Anak Foto -->
    <div class="portfolio-modal modal fade" id="anak-foto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
               <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Foto</h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
                        <div class="row konten-margin-responsive-pop-up991">
                                <div id="ajaxKontenIsiAnakFoto"></div>
                            </div>                                                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Achievement -->
    
    <div class="portfolio-modal modal fade" id="achievement" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
               <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $kontenTunggal['achievement']->judul_konten; ?></h2>                    
                </div>
                <div class="col-lg-12 header-section-sketch-full">
                    <img class="gambar-header-section-sketch-full-modal" src="jolibs/common-site/img/header-gallery.png">                    
                </div>
                            <div class="row konten-margin-responsive-pop-up991">
                                <p><img style="width:100%;" src="joimg/halaman_tunggal/achievement/<?php echo $kontenTunggal['achievement']->gambar_sampul_konten; ?> "></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
 
    <!-- blog dan artikel -->
    <div class="portfolio-modal modal fade" id="ajax-pop-up-konten" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                        <img src="jolibs/common-site/img/silang.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div id="ajaxKontenIsi"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="ajax-modal" class="modal hide fade" tabindex="-1"></div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>
</body>

</html>
