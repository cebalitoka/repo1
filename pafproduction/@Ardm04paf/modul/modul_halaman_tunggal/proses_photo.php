<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");	
	require_once ("../../../josys/class/Image_Processor.php");
	require_once ("../../../josys/class/Photo.php");
	require_once ("../../../josys/class/Anak_gallery.php");


$target_path="../../../joimg/halaman_tunggal/photo/";

if(isset($_POST['photo']) && $_POST['photo'] == "input"){
		if(empty($_FILES['gambar']['tmp_name']) || empty($_POST['keterangan'])){
				$hasil = "kosong";
				$jenis_konten = "photo";	
		}else{
							
						//mengambil gambar satu-persatu dari array yang berasal dari form
		  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
			  				$dataArray['name'] = $_FILES['gambar']['name'];
							$dataArray['tmp_name'] = $_FILES['gambar']['tmp_name'];
							$dataArray['size'] = $_FILES['gambar']['size'];
							$dataArray['type'] = $_FILES['gambar']['type'];
							$dataArray['namaObjek'] = $_POST['jenis_konten'];

			  			$uploadGambar = new Image_Processor;
			  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
			  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("album-".$_POST['keterangan'],"",700,100,$target_path);
			  			$hasilProsesUploadGambarKecil = $uploadGambar->uploadGambarFilter("album-".$_POST['keterangan'],"kecil",200,100,$target_path);
			  			$uploadGambar->bersihkantmp();

			  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
			  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
			  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];
			
			$halamanTunggal = new Photo;
			$halamanTunggal->simpanNilai($_POST);							
			$hasil = $halamanTunggal->buatPhoto();				
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];			
		}		
	}	
}elseif(isset($_POST['photo']) && $_POST['photo'] == "sunting"){		

		if(empty($_POST['keterangan'])){			
				$hasil = "kosong";								
				$jenis_konten = "home";				
		}else{
				
				$ambilAlbum = Photo::ambilPhotoById($_POST['id']);
						if(!empty($_FILES['gambar_baru']['tmp_name'])){
							Image_Processor::hapusGambar($target_path, $ambilAlbum->gambar);
							Image_Processor::hapusGambar($target_path."kecil-", $ambilAlbum->gambar);
							$_FILES['gambar_baru']['namaObjek'] = $_POST['jenis_konten'];

			  				//mengambil gambar satu-persatu dari array yang berasal dari form
			  				// lalu menyimpan masing-masing gambar ke dalam direktori yang sudah ditentukan
				  				$dataArray['name'] = $_FILES['gambar_baru']['name'];
								$dataArray['tmp_name'] = $_FILES['gambar_baru']['tmp_name'];
								$dataArray['size'] = $_FILES['gambar_baru']['size'];
								$dataArray['type'] = $_FILES['gambar_baru']['type'];
								$dataArray['namaObjek'] = $_FILES['gambar_contact_baru']['namaObjek'];

				  			$uploadGambar = new Image_Processor;
				  			$uploadGambar->simpanNilai($dataArray);  			  						  						  			
				  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("album-".$_POST['keterangan'],"",700,100,$target_path);
				  			$hasilProsesUploadGambarKecil = $uploadGambar->uploadGambarFilter("album-".$_POST['keterangan'],"kecil",200,100,$target_path);
				  			$uploadGambar->bersihkantmp();

				  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
				  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
				  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];				  				
				  			}
						}

			$halamanTunggal = new Photo;
			$halamanTunggal->simpanNilai($_POST);							
			$hasil = $halamanTunggal->suntingPhoto();				
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$jenis_konten = $_POST['jenis_konten'];
		}		

}elseif(isset($_GET['photo']) && $_GET['photo'] == "hapus"){
			$target_path_gambar="../../../joimg/halaman_tunggal/photo/";								
			$photo = Photo::ambilPhotoById($_GET['id']);

			$anakGallery = Anak_gallery::ambilAnakGalleryByIdParent($_GET['id']);

			foreach($anakGallery['hasilData'] as $baris){
				Image_Processor::hapusGambar($target_path_gambar,$baris->gambar);
				Image_Processor::hapusGambar($target_path_gambar,"kecil-".$baris->gambar);
				$hapusAnakGallery = Anak_gallery::ambilAnakGalleryById($baris->id);
				$hapusAnakGallery->hapusAnakGallery();											
			}

			Image_Processor::hapusGambar($target_path_gambar,$photo->gambar);
			Image_Processor::hapusGambar($target_path_gambar,"kecil-".$photo->gambar);			
			$hasil=$photo->hapusPhoto();
			$jenis_konten = "photo";						
		}	

	header("Location: ../../index.php?modul=halamanTunggal&aksi_modul=suntingHalamanTunggal&jenis_konten=photo&ho=$hasil");
	exit();


 ?>