<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");	
	require_once ("../../../josys/class/Image_Processor.php");
	require_once ("../../../josys/class/Icon_Home.php");


if(isset($_POST['icon_home']) && $_POST['icon_home'] == "input"){
		if(empty($_FILES['gambar']['tmp_name']) || empty($_FILES['file_upload']['tmp_name']) || empty($_POST['nama_icon'])){
				$hasil = "kosong";
				$jenis_konten = "home";					
			
		}else{
						$target_path="../../../joimg/halaman_tunggal/icon_home/";					

						//mengambil gambar satu-persatu dari array yang berasal dari form
		  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
			  				$dataArray['name'] = $_FILES['gambar']['name'];
							$dataArray['tmp_name'] = $_FILES['gambar']['tmp_name'];
							$dataArray['size'] = $_FILES['gambar']['size'];
							$dataArray['type'] = $_FILES['gambar']['type'];
							$dataArray['namaObjek'] = $_POST['jenis_konten'];

			  			$uploadGambar = new Image_Processor;
			  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
			  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("icon_home","",100,100,$target_path);
			  			$uploadGambar->bersihkantmp();

			  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
			  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
			  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];

			  		//mengambil informasi property file dan mengupload file
			  				$splitNama = explode(".",$_FILES['file_upload']['name']);
			  				$splitNama[0] = date("YmdHis");
			  				$namaFile = $splitNama[0].".".$splitNama[1];					
			  				move_uploaded_file($_FILES['file_upload']['tmp_name'], "../../../jofile/icon_home/".$namaFile);			  											
							$_POST['ukuran_file'] = $_FILES['file_upload']['size'];
							$_POST['jenis_file'] = $_FILES['file_upload']['type'];							
							$_POST['nama_file'] = $namaFile;
							$_POST['link_file'] = $namaFile;
			
			$halamanTunggal = new Icon_Home;
			$halamanTunggal->simpanNilai($_POST);							
			$hasil = $halamanTunggal->buatIconHome();				
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];			
		}		
	}	
}elseif(isset($_POST['icon_home']) && $_POST['icon_home'] == "sunting"){
		if(empty($_POST['nama_icon'])){			
				$hasil = "kosong";								
				$jenis_konten = "home";				
		}else{
				$target_path = "../../../joimg/halaman_tunggal/icon_home/";
				$ambilIconHome = Icon_Home::ambilIconHomeById($_POST['id']);
						if(!empty($_FILES['gambar']['tmp_name'])){
							Image_Processor::hapusGambar($target_path, $ambilIconHome->gambar);
							$_FILES['gambar']['namaObjek'] = $_POST['jenis_konten'];

			  				//mengambil gambar satu-persatu dari array yang berasal dari form
			  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
				  				$dataArray['name'] = $_FILES['gambar']['name'];
								$dataArray['tmp_name'] = $_FILES['gambar']['tmp_name'];
								$dataArray['size'] = $_FILES['gambar']['size'];
								$dataArray['type'] = $_FILES['gambar']['type'];
								$dataArray['namaObjek'] = $_FILES['gambar_contact']['namaObjek'];

				  			$uploadGambar = new Image_Processor;
				  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
				  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("icon_home","",100,100,$target_path);
				  			$uploadGambar->bersihkantmp();

				  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
				  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
				  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];				  				
				  			}
						}

						if(!empty($_FILES['file_upload']['tmp_name'])){
							$target_path_file="../../../jofile/icon_home/";					
							unlink($target_path_file.$ambilIconHome->link_file);
							$splitNama = explode(".",$_FILES['file_upload']['name']);
			  				$splitNama[0] = date("YmdHis");
			  				$namaFile = $splitNama[0].".".$splitNama[1];					
			  				move_uploaded_file($_FILES['file_upload']['tmp_name'], "../../../jofile/icon_home/".$namaFile);			  											
							$_POST['ukuran_file'] = $_FILES['file_upload']['size'];
							$_POST['jenis_file'] = $_FILES['file_upload']['type'];							
							$_POST['nama_file'] = $namaFile;
							$_POST['link_file'] = $namaFile;
						}

			$halamanTunggal = new Icon_Home;
			$halamanTunggal->simpanNilai($_POST);
			$hasil = $halamanTunggal->suntingIconHome();							
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];			
		
	}	
}elseif(isset($_GET['icon_home']) && $_GET['icon_home'] == "hapus"){
			$target_path_gambar_icon="../../../joimg/halaman_tunggal/icon_home/";
			$target_path_file="../../../jofile/icon_home/";					
			$iconHome = Icon_Home::ambilIconHomeById($_GET['id']);
			Image_Processor::hapusGambar($target_path_gambar_icon,$iconHome->gambar);
			unlink($target_path_file.$iconHome->link_file);
			$hasil=$iconHome->hapusIconHome();
			$jenis_konten = "home";						
		}		
	header("Location: ../../index.php?modul=halamanTunggal&aksi_modul=suntingHalamanTunggal&jenis_konten=home&ho=$hasil");
	exit();


 ?>