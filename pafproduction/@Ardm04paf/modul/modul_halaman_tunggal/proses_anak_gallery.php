<?php 

	require_once ("../../../josys/konfigurasi_global.php");
	require_once ("../../../josys/fungsi_global.php");	
	require_once ("../../../josys/class/Image_Processor.php");
	require_once ("../../../josys/class/Photo.php");
	require_once ("../../../josys/class/Anak_gallery.php");


$target_path="../../../joimg/halaman_tunggal/photo/";
$jenis_konten = "anak_photo";

if(isset($_POST['photo']) && $_POST['photo'] == "input"){
		if(empty($_FILES['gambar']['tmp_name']) || empty($_POST['keterangan'])){
				$hasil = "kosong";
				$idAlbum = $_POST['id_album'];					
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
			  			$hasilProsesUploadGambar = $uploadGambar->uploadGambarFilter("foto-dari-album-".$_POST['nama_album'],"",700,100,$target_path);
			  			$hasilProsesUploadGambarKecil = $uploadGambar->uploadGambarFilter("foto-dari-album-".$_POST['nama_album'],"kecil",200,100,$target_path);
			  			$uploadGambar->bersihkantmp();

			  			if($hasilProsesUploadGambar['hasilOperasi'] == TRUE || $hasilProsesUploadGambarKecil['hasilOperasi'] == TRUE){
			  				//menyimpan informasi dari hasil penyimpanan gambar ke dalam array			  				
			  				$_POST['gambar'] = $hasilProsesUploadGambar['namaFileSimpan'];
			
			$halamanTunggal = new Anak_gallery;
			$halamanTunggal->simpanNilai($_POST);								
			$hasil = $halamanTunggal->buatAnakGallery();				
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$idAlbum = $halamanTunggal->id_album;						
		}		
	}	
}elseif(isset($_POST['photo']) && $_POST['photo'] == "sunting"){		

		if(empty($_POST['keterangan'])){			
				$hasil = "kosong";
				$idAlbum = $_POST['id_album'];															
		}else{

			$halamanTunggal = new Anak_gallery;
			$halamanTunggal->simpanNilai($_POST);							
			$hasil = $halamanTunggal->suntingAnakGallery();				
			$hasil = is_numeric($hasil) && $hasil > 0 ? 1 : 0 ;
			$idAlbum = $halamanTunggal->id_album;			
		}		

}elseif(isset($_GET['anak_gallery']) && $_GET['anak_gallery'] == "hapus"){
			$target_path_gambar="../../../joimg/halaman_tunggal/photo/";								
			$anakGallery = Anak_gallery::ambilAnakGalleryById($_GET['id']);
			Image_Processor::hapusGambar($target_path,$anakGallery->gambar);
			Image_Processor::hapusGambar($target_path,"kecil-".$anakGallery->gambar);			
			$hasil=$anakGallery->hapusAnakGallery();
			$idAlbum = $_GET['id_album'];								
		}	

	header("Location: ../../index.php?modul=halamanTunggal&aksi_modul=suntingHalamanTunggal&jenis_konten=buat_anak_photo&id_album=$idAlbum&ho=$hasil");
	exit();


 ?>