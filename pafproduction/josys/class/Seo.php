<?php 

	class Seo{

		public $author_lama = null;
		public $author = null;
		public $keywords = null;
		public $description = null;

		public function __construct($data=array()){			
			if(isset($data['author_lama'])) $this->author_lama = $data['author_lama'];
			if(isset($data['author'])) $this->author = $data['author'];
			if(isset($data['keywords'])) $this->keywords = $data['keywords'];
			if(isset($data['description'])) $this->description = $data['description'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public function suntingSeo(){
			//memeriksa apakah objek yang akan diproses memiliki id
			if(is_null($this->author)) trigger_error("Pesan error -> Seo::suntingSeo(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->author). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);

			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE seo SET author = :author,
                           		   keywords = :keywords,
                           		   description = :description		                               		  
						  		   WHERE author = :author_lama";
		    $st = $koneksi->prepare($sql);		   		   		   
		    $st->bindValue(":author", $this->author, PDO::PARAM_STR);
		    $st->bindValue(":author_lama", $this->author_lama, PDO::PARAM_STR);		   
		    $st->bindValue(":keywords", $this->keywords, PDO::PARAM_STR);
		    $st->bindValue(":description", $this->description, PDO::PARAM_STR);		    		    
			$st->execute();
			$hasilDb = $st->rowCount();
			$koneksi = null;
			return $hasilDb;
		}

		public static function ambilSeo(){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from seo LIMIT 1";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Seo($hasil);
		} 

	}

 ?>