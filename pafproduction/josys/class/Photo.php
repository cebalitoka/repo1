<?php 

	class Photo{
		//atribut
		public $id = null;
		public $keterangan = null;
		public $gambar = null;		

		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['keterangan'])) $this->keterangan = $data['keterangan'];
			if(isset($data['gambar'])) $this->gambar = $data['gambar'];
			
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public function buatPhoto(){
			if(!is_null($this->id)) trigger_error("Pesan error -> Photo::buatPhoto(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
					
			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO photo (gambar,
		                               	keterangan) 
									  VALUES (:gambar,
		                               		  :keterangan)";
		   $st = $koneksi->prepare($sql);		   		   		   		   
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_STR);		   
		   $st->execute();
		   $this->id_konten = $koneksi->lastInsertId();		   
		   $koneksi = null;

		   return $this->id_konten;
		}

		public static function ambilPhotoById($id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from photo WHERE id = :id LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $id, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Photo($hasil);
		}

		public static function ambilSemuaPhoto(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM photo ORDER BY id DESC ";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new photo($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public function suntingPhoto(){
			//memeriksa apakah objek yang akan diproses memiliki id
			if(is_null($this->id)) trigger_error("Pesan error -> Photo::suntingPhoto(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE photo SET keterangan = :keterangan,
									 gambar = :gambar		                               
									   WHERE id = :id";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $this->id, PDO::PARAM_INT);		   			
		    $st->bindValue(":keterangan", $this->keterangan, PDO::PARAM_STR);
		    $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);		   
			$st->execute();
			$hasilDb = $st->rowCount();
			$koneksi = null;
			return $hasilDb;			
		}

		public function hapusPhoto(){
			if(is_null($this->id)) trigger_error("Photo::hapusPhoto(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM photo WHERE id = :id";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id", $this->id, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}

	}

 ?>