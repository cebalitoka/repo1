<?php        
        $seo = Seo::ambilSeo();
 ?>
<script src="jolibs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script>
       $(document).ready(function(){
           $('textarea#defaultconfig').maxlength()
                     $('textarea#thresholdconfig').maxlength({
                            threshold: 20
                     });
                     $('textarea#moreoptions').maxlength({
                        alwaysShow: true,
            threshold: 10,
            warningClass: "label label-success",
            limitReachedClass: "label label-important"
                      });
                        $('textarea#alloptions').maxlength({
                            alwaysShow: true,
                            threshold: 10,
                            warningClass: "label label-success",
                            limitReachedClass: "label label-important",
                            separator: ' dari ',
                            preText: 'Anda dapat memasukan ',
                            postText: ' batas karakter maksimal.'
                      });
       });
       </script>
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Pengaturan SEO (Search Engine Optimation)</h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                <?php if(isset($_GET['ho'])): ?>
                    <?php $jenisAlert = is_numeric($_GET['ho']) || $_GET['ho'] != 0 || $_GET['ho'] != "kosong" || $_GET['ho'] != "beda" ? "alert-success" : "alert-danger" ; ?>
                    <?php $string = $_GET['ho'] == 0 || $_GET['ho'] == "kosong" ? "gagal melakukan pembaharuan data SEO" : "SEO anda berhasil diperbaharui" ; ?>
                    <div class="alert <?php echo $jenisAlert; ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $string; ?>     
                    </div>
                <?php endif; ?>

                <div class="page-header">
                    <h1>Pengaturan SEO <br>
                        <small>Anda dapat mengatur SEO website anda melalui halaman ini, dengan SEO website anda dapat lebih mudah untuk ditemukan oleh mesin pencari seperti Google.</small>
                    </h1>
                </div>
                <div class="row">
 <div class="well col-md-5 center login-box">
           <form class="form-horizontal" action="modul/modul_pengaturan_web/proses_seo.php" method="post">
           <input name="author_lama" value="<?php echo $seo->author; ?>" type="hidden">
                <fieldset>
                    <div class="input-group input-group-lg">                        
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="author" value="<?php echo $seo->author; ?>" type="text" class="form-control" placeholder="Isi dengan Author">
                    </div>
                    <div class="clearfix"></div><br>
                    <p class="help-block">Author dapat diisi dengan nama organisasi ataupun perseorangan pemilik website, namun direkomendasikan untuk mengisi dengan nama organisasi atau individu yang tertampil pada web anda.</p>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">                        
                        <span class="input-group-addon"><i class="glyphicon glyphicon-star red"></i></span>
                        <input name="keywords" value="<?php echo $seo->keywords; ?>" type="text" class="form-control" placeholder="Isi dengan Keywords">
                    </div>
                    <div class="clearfix"></div><br>
                    <p class="help-block">Keywords dapat diisi dengan kata-kata yang mencerminkan website anda. Keywords direkomendasikan tidak terlalu banyak namun berbobot dan tepat sasaran sesuai dengan konteks website anda.</p>
                    <div class="clearfix"></div><br>
                    
                        <textarea name="description" class="autogrow" style="width:100%!important;height:90px;" maxlength="160" name="alloptions" id="alloptions"><?php echo $seo->description; ?></textarea>                        
                    
                    <div class="clearfix"></div><br>
                    <p class="help-block">Description dapat diisi dengan deskripsi singkat yang menjelasakan secara singkat website maupun organisasi anda. Jumlah karakter untuk description tidak lebih dari 160 karakter</p>
                    <div class="clearfix"></div><br>
                    
                    <button class="btn btn-primary btn-sunting-akun">Simpan Perubahan</button>

                                    <div class="modal fade" id="myModal-sunting-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Konfirmasi</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda yakin akan mengubah SEO website anda ?</p>
                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
                                                        <button type="submit" name="suntingAkun" value="sunting" class="btn btn-primary">Simpan Perubahan</button>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal pop up konfirmasi penghapusan file -->   
                                        <script type="text/javascript">
                                            $('.btn-sunting-akun').click(function (e) {
                                                e.preventDefault();
                                                $('#myModal-sunting-akun').modal('show');
                                            });
                                        </script> 

                </fieldset>
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