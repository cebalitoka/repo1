<?php 

	class Sosial_Media{
		//atribut
		public $id = null;
		public $link = null;
		public $gambar = null;
		public $nama_sosial_media = null;
		public $jenis = null;

		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['link'])) $this->link = $data['link'];
			if(isset($data['gambar'])) $this->gambar = $data['gambar'];
			if(isset($data['nama_sosial_media'])) $this->nama_sosial_media = $data['nama_sosial_media'];
			if(isset($data['jenis'])) $this->jenis = $data['jenis'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public function buatSosialMedia(){
			if(!is_null($this->id)) trigger_error("Pesan error -> Sosial_Media::buatSosialMedia(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			$this->link = $this->jenis == "non-link" ? "kosong" : $this->link;			

			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO sosial_media (link,
		                               		  gambar,
		                               		  nama_sosial_media,
		                               		  jenis) 
									  VALUES (:link,
		                               		  :gambar,
		                               		  :nama_sosial_media,
		                               		  :jenis)";
		   $st = $koneksi->prepare($sql);		   		   		   
		   $st->bindValue(":link", $this->link, PDO::PARAM_STR);		   
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":nama_sosial_media", $this->nama_sosial_media, PDO::PARAM_STR);
		   $st->bindValue(":jenis", $this->jenis, PDO::PARAM_STR);		   
		   $st->execute();
		   $this->id_konten = $koneksi->lastInsertId();		   
		   $koneksi = null;

		   return $this->id_konten;
		}

		public static function ambilSosialMediaById($id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from sosial_media WHERE id = :id LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $id, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Sosial_Media($hasil);
		}

		public static function ambilSemuaSosialMedia(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM sosial_media ORDER BY id DESC ";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Sosial_Media($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public function suntingSosialMedia(){
			//memeriksa apakah objek yang akan diproses memiliki id
			if(is_null($this->id)) trigger_error("Pesan error -> Sosial_Media::suntingSosialMedia(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			//memeriksa penggunaan link atau tidak
			$this->link = $this->jenis == "non-link" ? "kosong" : $this->link;

			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE sosial_media SET link = :link,
		                               gambar = :gambar,
		                               nama_sosial_media = :nama_sosial_media,
		                               jenis = :jenis									   
									   WHERE id = :id";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $this->id, PDO::PARAM_INT);		   			
		   $st->bindValue(":link", $this->link, PDO::PARAM_STR);
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":nama_sosial_media", $this->nama_sosial_media, PDO::PARAM_STR);
		   $st->bindValue(":jenis", $this->jenis, PDO::PARAM_STR);		   
			$st->execute();
			$hasilDb = $this->id;
			$koneksi = null;
			return $hasilDb;			
		}

		public function hapusSosialMedia(){
			if(is_null($this->id)) trigger_error("Sosial_Media::hapusSosialMedia(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM sosial_media WHERE id = :id";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id", $this->id, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}

	}

 ?>