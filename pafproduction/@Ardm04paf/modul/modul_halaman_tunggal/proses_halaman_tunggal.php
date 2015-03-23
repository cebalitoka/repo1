<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");
	require_once ("../../../josys/class/Konten_Tunggal.php");
	require_once ("../../../josys/class/Image_Processor.php");
	require_once ("../../../josys/class/Sosial_Media.php");

	if(isset($_POST['inputHalamanTunggal']) && $_POST['inputHalamanTunggal'] == "sunting"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{			
			$halamanTunggal = new Konten_Tunggal;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingKontenTunggal();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}
	}elseif(isset($_POST['suntingHalamanTunggal']) && $_POST['suntingHalamanTunggal'] == "sunting"){
		if(empty($_POST['judul_konten']) || empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{
			$halamanTunggal = new Konten_Tunggal;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingKontenTunggal();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;	
			$jenis_konten = $_POST['jenis_konten'];		
		}
	}elseif((isset($_POST['suntingHalamanTunggal']) && $_POST['suntingHalamanTunggal'] == "suntingVideo" || $_POST['suntingHalamanTunggal'] == "suntingCompanyProfile")){
	
			$_POST['judul_konten'] = isset($_POST['suntingVideo']) ? "Video" : "CompanyProfile";
			$_POST['gambar_sampul_konten'] = "kosong";
			$_POST['seo_deskripsi'] = "kosong";
			$_POST['seo_keywords'] = "kosong"; 			
			$halamanTunggal = new Konten_Tunggal;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingKontenTunggal();	
			$hasil = 1;
			$jenis_konten = $_POST["jenis_konten"];			

	}elseif(isset($_POST['suntingHalamanTunggal']) && $_POST['suntingHalamanTunggal'] == "suntingAchievement"){
		if(empty($_FILES['gambar_sampul_konten']['tmp_name'])){
			$hasil = "kosong";								
		}else{
					$target_path="../../../joimg/halaman_tunggal/achievement/";					
					$cekKontenGanda = Konten_Tunggal::ambilKontenById($_POST['id_konten']);

					if($cekKontenGanda->gambar_sampul_konten != "kosong" || !empty($cekKontenGanda->gambar_sampul_konten) || !is_null($cekKontenGanda->gambar_sampul_konten)){
						Image_Processor::hapusGambar($target_path,$cekKontenGanda->gambar_sampul_konten);						
					}

						$_FILES['gambar_sampul_konten']['namaObjek'] = $_POST['jenis_konten'];

		  				//mengambil gambar satu-persatu dari array yang berasal dari form
		  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
			  				$dataArray['name'] = $_FILES['gambar_sampul_konten']['name'];
							$dataArray['tmp_name'] = $_FILES['gambar_sampul_konten']['tmp_name'];
							$dataArray['size'] = $_FILES['gambar_sampul_konten']['size'];
							$dataArray['type'] = $_FILES['gambar_sampul_konten']['type'];
							$dataArray['namaObjek'] = $_FILES['gambar_sampul_konten']['namaObjek'];

			  			$uploadGambar = new Image_Processor;
			  			$uploadGambar->simpanNilai($dataArray);  			  						  			
			  			// $hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("achievement", "", 750, 80, $target_path);
			  			// $hasilProsesUploadGambarKecil = $uploadGambar->uploadGambarFilter("achievement", "kecil", 500, 80, $target_path);
			  			$hasilProsesUploadGambar = $uploadGambar->uploadMove("../../../joimg/halaman_tunggal/achievement/");
			  			// $uploadGambar->bersihkantmp();

			  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
			  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
			  				$_POST['gambar_sampul_konten'] = $hasilProsesUploadGambar['namaFileSimpan'];
			  				$_POST['judul_konten'] = "Achievement";
			  				$_POST['isi'] = "kosong";
			  				$_POST['seo_deskripsi'] = "kosong";
			  				$_POST['seo_keywords'] = "kosong";


			$halamanTunggal = new Konten_Tunggal;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingKontenTunggal();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;			
		}		
	}
}elseif(isset($_POST['contact']) && $_POST['contact'] == "input"){
		if(empty($_FILES['gambar_contact']['tmp_name']) || empty($_POST['nama_sosial_media'])){
			if(isset($_POST['jenis']) && empty($_POST['link'])){
				$hasil = "kosong";
				$jenis_konten = "contact";					
			}
				$hasil = "kosong";								
				$jenis_konten = "contact";				
		}else{
						$target_path="../../../joimg/halaman_tunggal/contact/";					

						$_FILES['gambar_contact']['namaObjek'] = $_POST['jenis_konten'];

		  				//mengambil gambar satu-persatu dari array yang berasal dari form
		  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
			  				$dataArray['name'] = $_FILES['gambar_contact']['name'];
							$dataArray['tmp_name'] = $_FILES['gambar_contact']['tmp_name'];
							$dataArray['size'] = $_FILES['gambar_contact']['size'];
							$dataArray['type'] = $_FILES['gambar_contact']['type'];
							$dataArray['namaObjek'] = $_FILES['gambar_contact']['namaObjek'];

			  			$uploadGambar = new Image_Processor;
			  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
			  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("contact","",100,100,$target_path);
			  			$uploadGambar->bersihkantmp();

			  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
			  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
			  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];
			  				$_POST['link'] = isset($_POST['jenis_form']) ?  $_POST['link']  : "non-link" ;
			  				$_POST['jenis'] = isset($_POST['jenis_form']) && $_POST['jenis_form'] == "dengan-link" ?  "link"  : "non-link" ;

			$halamanTunggal = new Sosial_Media;
			$halamanTunggal->simpanNilai($_POST);
					
			$hasil = $halamanTunggal->buatSosialMedia();	

			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];			
		}		
	}	
}elseif(isset($_POST['contact']) && $_POST['contact'] == "sunting"){
		if(empty($_POST['nama_sosial_media'])){
			if(isset($_POST['jenis']) && empty($_POST['link'])){
				$hasil = "kosong";
				$jenis_konten = "contact";					
			}
				$hasil = "kosong";								
				$jenis_konten = "contact";				
		}else{
				$target_path="../../../joimg/halaman_tunggal/contact/";
				$ambilContact = Sosial_Media::ambilSosialMediaById($_POST['id']);
						if(!empty($_FILES['gambar_contact']['tmp_name'])){
							Image_Processor::hapusGambar($target_path, $ambilContact->gambar);
							$_FILES['gambar_contact']['namaObjek'] = $_POST['jenis_konten'];

			  				//mengambil gambar satu-persatu dari array yang berasal dari form
			  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
				  				$dataArray['name'] = $_FILES['gambar_contact']['name'];
								$dataArray['tmp_name'] = $_FILES['gambar_contact']['tmp_name'];
								$dataArray['size'] = $_FILES['gambar_contact']['size'];
								$dataArray['type'] = $_FILES['gambar_contact']['type'];
								$dataArray['namaObjek'] = $_FILES['gambar_contact']['namaObjek'];

				  			$uploadGambar = new Image_Processor;
				  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
				  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("contact","",100,100,$target_path);
				  			$uploadGambar->bersihkantmp();

				  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
				  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
				  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];				  				
				  			}
						}

			$_POST['link'] = isset($_POST['jenis_form']) ?  $_POST['link']  : "non-link" ;
			$_POST['jenis'] = isset($_POST['jenis_form']) && $_POST['jenis_form'] == "dengan-link" ?  "link"  : "non-link" ;
			$halamanTunggal = new Sosial_Media;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingSosialMedia();	

			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];			
		
	}	
}elseif(isset($_POST['proses_telpon']) && $_POST['proses_telpon'] == "sunting_telpon"){
		if(empty($_POST['isi'])){
			$hasil = "kosong";		
		}else{
			$halamanTunggal = new Konten_Tunggal;
			$halamanTunggal->simpanNilai($_POST);			
			$hasil = $halamanTunggal->suntingKontenTunggal();	
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;	
			$jenis_konten = $_POST['jenis_konten'];		
		}
}elseif(isset($_GET['contact']) && $_GET['contact'] == "hapus"){
			$target_path="../../../joimg/halaman_tunggal/contact/";					
			$contact = Sosial_Media::ambilSosialMediaById($_GET['id']);
			Image_Processor::hapusGambar($target_path,$contact->gambar);
			$hasil=$contact->hapusSosialMedia();
			$jenis_konten = "contact";
						
		}		
	
	header("Location: ../../index.php?modul=halamanTunggal&aksi_modul=suntingHalamanTunggal&jenis_konten=$jenis_konten&ho=$hasil");
	exit();

 ?>