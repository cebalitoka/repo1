<?php 

    $aksiModul = isset($_GET['aksi_modul']) ? $_GET['aksi_modul'] : "" ;
    $valueButton = "submit";
    $buttonString = "Kirim Blog";

    switch($aksiModul){
        case 'buatBlog':$judulBox = "Buat Blog";break;
        case 'editBlog':$judulBox = "Sunting Blog";break;
        default:$judulBox = "Blog";break;
    }    

        $id_konten = "";
        $sunting = "";
        $judul_konten = "";
        $isi = "";
        $seo_deskripsi = "";
        $seo_keywords = "" ; 

    if(isset($_GET['aksi_modul']) && $_GET['aksi_modul'] == "suntingBlog"){
        $valueButton = "sunting";
        $buttonString = "Simpan Perubahan Blog";

        $sunting = Konten_Ganda::ambilKontenById($_GET['id_konten']);
        $id_konten = !is_null($sunting->id_konten) ? $sunting->id_konten : "" ;
        $judul_konten = !is_null($sunting->judul_konten) ? $sunting->judul_konten : "" ;
        $isi = !is_null($sunting->isi) ? $sunting->isi : "" ;
        $seo_deskripsi = !is_null($sunting->seo_deskripsi) ? $sunting->seo_deskripsi : "" ;
        $seo_keywords = !is_null($sunting->seo_keywords) ? $sunting->seo_keywords : "" ; 
    }

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
                <div class="page-header">
                    <h1>Buat Blog
                        <small>tulis blog untuk website anda</small>
                    </h1>
                </div>
                <div class="row">
                                <div class="box-content">
                                    <form role="form" method="post" action="modul/modul_blog/proses_blog.php">
                                        <input type="hidden" name="jenis_konten" value="blog" />
                                        <?php if($_GET['aksi_modul'] == "suntingBlog"): ?>
                                            <input type="hidden" name="id_konten" value="<?php echo $id_konten; ?>" />    
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul artikel</label>
                                            <input value="<?php echo $judul_konten; ?>" name="judul_konten" type="text" class="form-control" id="exampleInputEmail1" placeholder="Tulis judul blog">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="isi" cols="80" id="editor1" name="editor1" rows="10"><?php echo $isi; ?></textarea>
                                        </div>
                                        <button name="inputBlog" value="<?php echo $valueButton; ?>" type="submit" class="btn btn-default"><?php echo $buttonString; ?></button>
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