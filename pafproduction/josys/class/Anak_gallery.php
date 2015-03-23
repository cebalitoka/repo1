<?php 

	class Anak_gallery{

		public $id = null;
		public $id_album = null;
		public $gambar = null;
		public $keterangan = null;
		public $tgl_buat = null;
		public $tgl_modifikasi = null;

		public $tgl_buat_tgl = null;
		public $tgl_buat_hari = null;
		public $tgl_buat_jam = null;
		public $tgl_modifikasi_tgl = null;
		public $tgl_modifikasi_hari = null;
		public $tgl_modifikasi_jam = null;

		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['id_album'])) $this->id_album = (int) $data['id_album'];
			if(isset($data['gambar'])) $this->gambar = $data['gambar'];
			if(isset($data['keterangan'])) $this->keterangan = $data['keterangan'];
			if(isset($data['tgl_buat'])) $this->tgl_buat = $data['tgl_buat'];
			if(isset($data['tgl_modifikasi'])) $this->tgl_modifikasi = $data['tgl_modifikasi'];			

			if(isset($data['tgl_buat_tgl'])) $this->tgl_buat_tgl = $data['tgl_buat_tgl'];
			if(isset($data['tgl_buat_hari'])) $this->tgl_buat_hari = $data['tgl_buat_hari'];
			if(isset($data['tgl_buat_jam'])) $this->tgl_buat_jam = $data['tgl_buat_jam'];
			if(isset($data['tgl_modifikasi_tgl'])) $this->tgl_modifikasi_tgl = $data['tgl_modifikasi_tgl'];
			if(isset($data['tgl_modifikasi_hari'])) $this->tgl_modifikasi_hari = $data['tgl_modifikasi_hari'];
			if(isset($data['tgl_modifikasi_jam'])) $this->tgl_modifikasi_jam = $data['tgl_modifikasi_jam'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public function buatAnakGallery(){
			if(!is_null($this->id)) trigger_error("Pesan error -> Anak_gallery::buatAnakGallery(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO anak_gallery (id_album,
		                               		  gambar,
		                               		  keterangan,
		                               		  tgl_buat,
		                               		  tgl_modifikasi) 
									  VALUES (:id_album,
		                               		  :gambar,
		                               		  :keterangan,
		                               		  :tgl_buat,
		                               		  :tgl_modifikasi)";
		   $st = $koneksi->prepare($sql);		   		   		   
		   $st->bindValue(":id_album", $this->id_album, PDO::PARAM_INT);		   
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_STR);		   
		   $st->bindValue(":tgl_buat", NULL, PDO::PARAM_STR);		   
		   $st->bindValue(":tgl_modifikasi", NULL, PDO::PARAM_STR);		   		   
		   $st->execute();
		   $this->id = $koneksi->lastInsertId();		   
		   $koneksi = null;
		   return $this->id;
		}

		public static function ambilSemuaAnakGallery(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM anak_gallery ORDER BY id DESC ";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Anak_gallery($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}	

		public static function ambilAnakGalleryByIdParent($id_parent){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM anak_gallery WHERE id_album = :id_album ORDER BY id DESC ";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_album", $id_parent, PDO::PARAM_INT);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Anak_gallery($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public static function ambilAnakGalleryById($id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from anak_gallery WHERE id = :id LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $id, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Anak_gallery($hasil);
		}

		public function suntingAnakGallery(){
			if(is_null($this->id)) trigger_error("Pesan error -> Anak_gallery::suntingAnakGallery(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE anak_gallery SET gambar = :gambar,
		                               		keterangan = :keterangan
		                               	WHERE id = :id";
		   $st = $koneksi->prepare($sql);		   		   		   		   
		   $st->bindValue(":id", $this->id, PDO::PARAM_INT);		   		   
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_INT);		   		   
		   $st->execute();
		   $hasilDb = $st->rowCount();		   
		   $koneksi = null;
		   return $hasilDb;
		}

		public function hapusAnakGallery(){
			if(is_null($this->id)) trigger_error("Anak_gallery::hapusAnakGallery(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM anak_gallery WHERE id = :id";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id", $this->id, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}

		public function hapusAnakGalleryByIdParent($idParent){
			if(is_null($this->id)) trigger_error("Anak_gallery::hapusAnakGallery(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM anak_gallery WHERE id_parent = :id_parent";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id_parent", $idParent, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}			

	}

 ?>