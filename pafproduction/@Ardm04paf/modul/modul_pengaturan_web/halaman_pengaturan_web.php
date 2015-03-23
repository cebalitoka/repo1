<?php 
        $session_id = session_id();
        $user = Akun_User::ambilAkunUserBySessionId($session_id);


 ?>


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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Pengaturan Web</h2>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">

                <?php if(isset($_GET['ho'])): ?>
                    <?php $jenisAlert = is_numeric($_GET['ho']) || $_GET['ho'] != 0 || $_GET['ho'] != "kosong" || $_GET['ho'] != "beda" ? "alert-success" : "alert-danger" ; ?>
                    <?php $string = $_GET['ho'] == 0 || $_GET['ho'] == "kosong" || $_GET['ho'] == "beda" ? "gagal melakukan pembaharuan data" : "data akun berhasil diperbaharui" ; ?>
                    <div class="alert <?php echo $jenisAlert; ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $string; ?>     
                    </div>
                <?php endif; ?>

                <div class="page-header">
                    <h1>Pengaturan <br>
                        <small>Anda dapat mengatur akun admin anda mulai dengan mengganti password anda.</small>
                    </h1>
                </div>
                <div class="row">
 <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Jika anda ingin mengubah password, silahkan isi form dibawah dengan memasukan password lama dan memasukan dua kali password baru.
            </div>
           <form class="form-horizontal" action="modul/modul_pengaturan_web/proses_pengaturan_web.php" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input name="username" value="<?php echo $user->username; ?>" type="text" class="form-control" placeholder="Username" disabled>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password_lama" class="form-control" placeholder="ketik password lama">
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password_baru" class="form-control" placeholder="ketik password baru">
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password_baru_lagi" class="form-control" placeholder="ketik password sekali lagi">
                    </div>
                    <button class="btn btn-primary btn-sunting-akun">Simpan Perubahan</button>

                                    <div class="modal fade" id="myModal-sunting-akun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h3>Konfirmasi</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda yakin akan mengubah password anda ?</p>
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