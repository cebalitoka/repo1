<?php 

	class Gallery{
		//atribut gallery
		public $id_gallery = null;
		public $judul = null;
		public $keterangan = null;
		public $jenis = null;
		public $tgl_buat = null;
		public $tgl_modifikasi = null;

		public function __construct($data=array()){
			if(isset($data['id_gallery'])) $this->id_gallery = (int) $data['id_gallery'];
			if(isset($data['judul'])) $this->judul = $data['judul'];
			if(isset($data['keterangan'])) $this->keterangan = $data['keterangan'];
			if(isset($data['jenis'])) $this->jenis = $data['jenis'];
			if(isset($data['tgl_buat'])) $this->tgl_buat = $data['tgl_buat'];
			if(isset($data['tgl_modifikasi'])) $this->tgl_modifikasi = $data['tgl_modifikasi'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public static function ambilGalleryById($id_gallery){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from gallery WHERE id_gallery = :id_gallery LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_gallery", $id_gallery, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Gallery($hasil);
		}

		public static function ambilGalleryByJenisPaging($id_gallery, $limit = 0, $offset = 0){

			$stringLimit = $limit > 0 ? "LIMIT ".$limit." " : "";
			$stringOffset = $offset > 0 ? "OFFSET ".$offset." " : "";

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM gallery WHERE jenis = :jenis ORDER BY id_gallery DESC ".$stringLimit.$stringOffset;
			$st = $koneksi->prepare($sql);
			$st->bindValue(":jenis", $jenis, PDO::PARAM_INT);
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Gallery($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}	

		public static function ambilGalleryByJenisNonPaging($id_gallery){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM gallery WHERE jenis = :jenis ORDER BY id_gallery DESC";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":jenis", $jenis, PDO::PARAM_INT);
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Gallery($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public function buatGallery(){
			if(!is_null($this->id_gallery)) trigger_error("Pesan error -> Gallery::buatGallery(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);

			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO gallery (judul,
										  keterangan,
										  jenis,
										  tgl_buat,
										  tgl_modifikasi) 
	                             VALUES( :judul,
										  :keterangan,
										  :jenis,
										  :tgl_buat,
										  :tgl_modifikasi)";
		   $st = $koneksi->prepare($sql);		   		   		   
		   $st->bindValue(":tgl_dibuat", NULL, PDO::PARAM_STR);
		   $st->bindValue(":tgl_modifikasi", NULL, PDO::PARAM_STR);
		   $st->bindValue(":judul", $this->judul, PDO::PARAM_STR);
		   $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_STR);
		   $st->bindValue(":jenis", $this->jenis, PDO::PARAM_STR);		   
		   $st->execute();
		   $this->id_gallery = $koneksi->lastInsertId();		   
		   $koneksi = null;
		   return (array("hasilOperasi" => $this->id_konten));
		}

		public function suntingGallery($id_gallery){
			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE gallery SET judul = :judul, 
									   keterangan = :keterangan, 		                               		                               
									   WHERE id_gallery = :id_gallery";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_gallery", $id_gallery, PDO::PARAM_INT);		   
			$st->bindValue(":judul", $this->judul, PDO::PARAM_STR);
		    $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_STR);	   
			$st->execute();
			$this->id_konten = $id_konten;
			$hasilDb = $this->id_konten;
			$koneksi = null;
			return $hasilDb;			
		}		

	}

 ?>