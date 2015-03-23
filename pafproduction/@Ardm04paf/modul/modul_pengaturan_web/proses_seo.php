<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");		
	require_once ("../../../josys/class/Seo.php");


	if(empty($_POST['author']) || empty($_POST['description']) || empty($_POST['keywords'])){
		$hasil="kosong";
	}else{
		$seo = new Seo;		
		$seo->simpanNilai($_POST);	
		$hasil=$seo->suntingSeo();		
	}

	header("Location: ../../index.php?modul=pengaturanSeo&hop=seo&ho=$hasil");

 ?>