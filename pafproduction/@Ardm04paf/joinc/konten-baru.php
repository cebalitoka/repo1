<?php 

	$aksi = isset($_GET['modul']) ? $_GET['modul'] : "" ;

	switch ($aksi) {
		case 'blog':blog();break;
		case 'artikel':artikel();break;
		case 'halamanTunggal':halamanTunggal();	break;
		case 'pengaturanWeb':pengaturanWeb();break;
		case 'pengaturanSeo':seo();break;
		// case 'login':login();break;		
		default:berandaWeb();break;
	}

	function berandaWeb(){
		include ("modul/modul_beranda/beranda.php");
	}

	function blog(){
		if($_GET['aksi_modul'] == "buatBlog" || $_GET['aksi_modul'] == "suntingBlog"){include("modul/modul_blog/halaman_blog.php");}
		elseif($_GET['aksi_modul'] == "kelolaBlog"){include("modul/modul_blog/kelola_blog.php");}
		elseif($_GET['aksi_modul'] == "inputBlog"){include("modul/modul_blog/proses_blog.php");}
	}

	function artikel(){
		if($_GET['aksi_modul'] == "buatArtikel" || $_GET['aksi_modul'] == "suntingArtikel"){include("modul/modul_artikel/halaman_artikel.php");}
		elseif($_GET['aksi_modul'] == "kelolaArtikel"){include("modul/modul_artikel/kelola_artikel.php");}		
		elseif($_GET['aksi_modul'] == "inputArtikel"){include("modul/modul_artikel/proses_artikel.php");}
	}

	function halamanTunggal(){

		if(isset($_GET['aksi_modul']) && $_GET['aksi_modul'] == "suntingHalamanTunggal"){				
				if(isset($_GET['jenis_konten']) 
					&& ($_GET['jenis_konten'] == "about" ||
						$_GET['jenis_konten'] == "companyprofile" ||
						$_GET['jenis_konten'] == "achievement" ||
						$_GET['jenis_konten'] == "video" ||
						$_GET['jenis_konten'] == "portfolio" ||						
						$_GET['jenis_konten'] == "paf")){
					include("modul/modul_halaman_tunggal/halaman_sunting_text_editor.php");
				}elseif(isset($_GET['jenis_konten']) && $_GET['jenis_konten'] == "photo"){	
					include("modul/modul_halaman_tunggal/halaman_sunting_photo.php");
				}elseif(isset($_GET['jenis_konten']) && $_GET['jenis_konten'] == "home"){	
					include("modul/modul_halaman_tunggal/halaman_sunting_home.php");
				}elseif(isset($_GET['jenis_konten']) && $_GET['jenis_konten'] == "contact"){	
					include("modul/modul_halaman_tunggal/halaman_sunting_contact.php");
				}elseif(isset($_GET['jenis_konten']) && $_GET['jenis_konten'] == "photo"){	
					include("modul/modul_halaman_tunggal/halaman_sunting_photo.php");
				}elseif(isset($_GET['jenis_konten']) && $_GET['jenis_konten'] == "buat_anak_photo"){
					include("modul/modul_halaman_tunggal/halaman_buat_anak_gallery.php");
				}
		}
	}

	function pengaturanWeb(){
		include("modul/modul_pengaturan_web/halaman_pengaturan_web.php");
	}

	function seo(){
		include("modul/modul_pengaturan_web/halaman_seo.php");
	}
 ?>