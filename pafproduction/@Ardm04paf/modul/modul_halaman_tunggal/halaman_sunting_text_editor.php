<?php 

    $jenisKontenTunggal = isset($_GET['jenis_konten']) ? $_GET['jenis_konten'] : "" ;  

    switch($jenisKontenTunggal){
        case 'about':
            $judulBox = "Sunting Halaman About";
            $notifikasi['jenis_konten'] = "About";
            $valueButton = "sunting";
            break;
        case 'companyprofile':
            $judulBox = "Sunting Halaman Company Profile";
            $judulKeteranganLink = "Company Profile";
            $notifikasi['jenis_konten'] = "Company Profile";
            $valueButton = "suntingCompanyProfile";
            break;
        case 'achievement':
            $judulBox = "Sunting Halaman Achievement";
            $notifikasi['jenis_konten'] = "Achievement";
            $valueButton = "suntingAchievement";
            break;
        case 'video':
            $judulBox = "Sunting Halaman Video";
            $notifikasi['jenis_konten'] = "Video";
            $valueButton = "suntingVideo";
            $judulKeteranganLink = "Video";
            break;
        case 'paf':
            $judulBox = "Sunting Halaman PAF";
            $notifikasi['jenis_konten'] = "PAF";
            $valueButton = "sunting";
            break;
        case 'portfolio':
            $judulBox = "Sunting Halaman Potfolio";
            $notifikasi['jenis_konten'] = "Portfolio";
            $valueButton = "sunting";
            break;
        default:
            $judulBox = "Sunting Halaman Tunggal";
            $notifikasi['jenis_konten'] = "Halaman Tunggal";
            $valueButton = "sunting";
            break;
    }    

        //status notifikasi
        $jenisAlert = isset($_GET['ho']) && $_GET['ho'] == 1 ? "alert-success" : "alert-danger" ;
        $stringNotifikasi = isset($_GET['ho']) && $_GET['ho'] == 1 ? "berhasil diperbaharui" : "gagal diperbaharui, hubungi jogjasite untuk tindak lebih lanjut" ; 

        
        $buttonString = "Simpan Perubahan Halaman";
        $sunting = Konten_Tunggal::ambilKontenByJenisKonten($_GET['jenis_konten']);
 ?>
<script type="text/javascript" src="../jolibs/tinymce/tinymce.min.js"></script>
    
    <script type="text/javascript">
    tinymce.init({
            selector: "textarea",
            plugins: "table",
            tools: "inserttable",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste jbimages",
                "textcolor",
                "autoresize",
                "pagebreak"
            ],

            //toolbar: "pagebreak save charmap advhr| insertfile undo redo | styleselect,formatselect,fontselect,fontsizeselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | jbimages | print preview media | forecolor backcolor emoticons | anchor",
            toolbar:"pagebreak save charmap| insertfile undo redo | styleselect formatselect fontselect fontsizeselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | jbimages | print preview media | forecolor backcolor emoticons | justifyleft justifycenter justifyright justifyfull | cut copy paste pastetext pasteword | search replace | blockquote |link unlink anchor image cleanup help code | insertdate inserttime preview | tablecontrols | hr removeformat visualaid | sub sup | iespell media advhr | print | ltr rtl | fullscreen | insertlayer moveforward movebackward absolute |styleprops spellchecker | cite abbr acronym del ins attribs | visualchars nonbreaking template | insertimage",
            relative_urls: false
     });
    </script>
<!-- /TinyMCE -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
<?php require_once("joinc/breadcumb.php"); ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?php echo $judulBox; ?></h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                <?php if(isset($_GET['ho'])): ?>
                    <div class="alert <?php echo $jenisAlert; ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            Halaman <?php echo "<b>".$notifikasi['jenis_konten']."</b> ".$stringNotifikasi; ?>     
                    </div>
                <?php endif; ?>

                <div class="page-header">
                    <h1>Halaman Tunggal <br>
                        <small>Halaman tunggal merupakan halaman utama yang dapat diakses pada menu utama di website anda, biasanya berisi tentang profil, info kontak dan informasi penting lainnya yang ditempatkan pada satu halaman.</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                    <form role="form" method="post" action="modul/modul_halaman_tunggal/proses_halaman_tunggal.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id_konten" value="<?php echo $sunting->id_konten; ?>" />
                                        <input type="hidden" name="jenis_konten" value="<?php echo $sunting->jenis_konten; ?>" />                                        
                                        <?php if($jenisKontenTunggal == "achievement"): ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Konten Achievement</label>
                                                    <?php if($sunting->gambar_sampul_konten == "kosong" || empty($sunting->gambar_sampul_konten) || is_null($sunting->gambar_sampul_konten)): ?>
                                                        <center><h4>Konten ini belum mempunyai gambar</h4></center>
                                            </div>
                                                    <?php else: ?>
                                                <div class="form-group">
                                                     <center><img src="../joimg/halaman_tunggal/achievement/<?php echo $sunting->gambar_sampul_konten; ?>"></center>
                                                </div>                                                  
                                                    <?php endif; ?>                                               

                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Upload Gambar</label>
                                                  <input name="gambar_sampul_konten" type="file" />
                                            </div>
                                        <?php elseif($jenisKontenTunggal == "video" || $jenisKontenTunggal == "companyprofile"): ?>
                                            <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1">
                                                        <div class="alert alert-success">                   
                                                            <i class="glyphicon glyphicon-flag"></i><strong>Link Eksternal</strong>
                                                        </div>
                                                    </label>
                                                      <input value="<?php echo $sunting->isi; ?>" name="isi" type="text" style="height:50px;" class="form-control" id="exampleInputEmail1" placeholder="Tulis judul halaman">                                                     
                                                        <p class="help-block">Isi dengan link menuju situs yang anda inginkan, link ini akan disisipkan pada menu "<strong><?php echo $judulKeteranganLink; ?></strong>" di website anda.</p>
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Judul Halaman</label>
                                                <input value="<?php echo $sunting->judul_konten; ?>" name="judul_konten" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tulis judul halaman">

                                            </div>
                                            <div class="form-group">
                                                <textarea name="isi"  cols="80" id="editor1" name="editor1" rows="10"><?php echo $sunting->isi; ?></textarea>
                                            </div>
                                        <?php endif; ?>
                                        <button name="suntingHalamanTunggal" value="<?php echo $valueButton; ?>" type="submit" class="btn btn-default"><?php echo $buttonString; ?></button>
                                    </form>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->