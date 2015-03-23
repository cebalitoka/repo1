<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");		
	require_once ("../../../josys/class/Akun_User.php");


	if(empty($_POST['password_lama']) || empty($_POST['password_baru']) || empty($_POST['password_baru_lagi'])){
		$hasil="kosong";
	}elseif(empty($_POST['password_baru']) != empty($_POST['password_baru_lagi'])){
		$hasil="beda";
	}else{
		$user = new Akun_User;
		$_POST['password'] = $_POST['password_baru'];
		$user->simpanNilai($_POST);				
		$cek=$user->cekPasswordSunting();
		if($cek == FALSE){
			$hasil = "inValid";
		}else{			
			$hasil=$user->suntingAkun();	
		}		
	}

	header("Location: ../../index.php?modul=pengaturanWeb&ho=$hasil");

 ?>