<?php 

	$jenisHalamanTunggal = isset($_GET['jenis_halaman_tunggal']) ? $_GET['jenis_halaman_tunggal'] : "" ;

	switch ($jenisHalamanTunggal) {
		case 'home':home();break;
		case 'about':about();break;
		case 'paf':paf();break;
		case 'video':video();break;
		case 'photo':photo();break;
		case 'achievement':achievement();break;
		case 'contact':contact();break;		
	}

	function home(){

	}

	function about(){
		
	}

	function paf(){
		
	}

	function video(){
		
	}

	function photo(){
		
	}

	function achievement(){
		
	}

	function contact(){
		
	}

 ?>