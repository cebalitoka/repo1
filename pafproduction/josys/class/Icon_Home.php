<?php 

	class Icon_Home{
		//atribut
		public $id = null;
		public $nama_icon = null;
		public $gambar = null;
		public $ukuran_file = null;
		public $nama_file = null;
		public $link_file = null;
		public $jenis_file = null;

		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['nama_icon'])) $this->nama_icon = $data['nama_icon'];
			if(isset($data['gambar'])) $this->gambar = $data['gambar'];
			if(isset($data['ukuran_file'])) $this->ukuran_file = (int) $data['ukuran_file'];
			if(isset($data['nama_file'])) $this->nama_file = $data['nama_file'];
			if(isset($data['link_file'])) $this->link_file = $data['link_file'];
			if(isset($data['jenis_file'])) $this->jenis_file = $data['jenis_file'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public function buatIconHome(){
			if(!is_null($this->id)) trigger_error("Pesan error -> Icon_Home::buatIconHome(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO icon_home (nama_icon,
		                               		  gambar,
		                               		  ukuran_file,
		                               		  nama_file,
		                               		  link_file,
		                               		  jenis_file) 
									  VALUES (:nama_icon,
		                               		  :gambar,
		                               		  :ukuran_file,
		                               		  :nama_file,
		                               		  :link_file,
		                               		  :jenis_file)";
		   $st = $koneksi->prepare($sql);		   		   		   
		   $st->bindValue(":nama_icon", $this->nama_icon, PDO::PARAM_STR);		   
		   $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		   $st->bindValue(":ukuran_file", $this->ukuran_file, PDO::PARAM_INT);		   
		   $st->bindValue(":nama_file", $this->nama_file, PDO::PARAM_STR);		   
		   $st->bindValue(":link_file", $this->link_file, PDO::PARAM_STR);		   
		   $st->bindValue(":jenis_file", $this->jenis_file, PDO::PARAM_STR);		   
		   $st->execute();
		   $this->id = $koneksi->lastInsertId();		   
		   $koneksi = null;
		   return $this->id;
		}

		public static function ambilIconHomeById($id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from icon_home WHERE id = :id LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $id, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Icon_Home($hasil);
		}

		public static function ambilSemuaIconHome(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM icon_home ORDER BY id DESC ";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Icon_Home($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public function suntingIconHome(){
			//memeriksa apakah objek yang akan diproses memiliki id
			if(is_null($this->id)) trigger_error("Pesan error -> Icon_Home::suntingIconHome(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);

			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);

			$sql = "UPDATE icon_home SET nama_icon = :nama_icon,
		                               		  gambar = :gambar,
		                               		  ukuran_file = :ukuran_file,
		                               		  nama_file = :nama_file,
		                               		  link_file = :link_file,
		                               		  jenis_file = :jenis_file 
									  WHERE id = :id";

		    $st = $koneksi->prepare($sql);		   		   		   
		    $st->bindValue(":nama_icon", $this->nama_icon, PDO::PARAM_STR);		   
		    $st->bindValue(":gambar", $this->gambar, PDO::PARAM_STR);
		    $st->bindValue(":ukuran_file", $this->ukuran_file, PDO::PARAM_INT);
		    $st->bindValue(":nama_file", $this->nama_file, PDO::PARAM_STR);
		    $st->bindValue(":link_file", $this->link_file, PDO::PARAM_STR);		   
		    $st->bindValue(":jenis_file", $this->jenis_file, PDO::PARAM_STR);
		    $st->bindValue(":id", $this->id, PDO::PARAM_INT);			
			$st->execute();
			$hasilDb = $this->id;
			$koneksi = null;
			return $hasilDb;			
		}

		public function hapusIconHome(){
			if(is_null($this->id)) trigger_error("Icon_Home::hapusIconHome(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM icon_home WHERE id = :id";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id", $this->id, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}

	}

 ?>