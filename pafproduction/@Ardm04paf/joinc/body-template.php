<!-- <body> -->
	<?php 

		$cek_sistem['status_login'] = Akun_User::cekStatusLogin();

		if($cek_sistem['status_login'] == FALSE){
			include "modul/modul_user/login.php";
		}else{
			$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : "" ;
			switch($aksi){
				default:
					beranda();
					break;				
			}
		}

	 ?>
<!-- </body>
</html> -->