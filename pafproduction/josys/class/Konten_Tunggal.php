<?php 

	class Konten_Tunggal{

		//variabel atribut
		public $id_konten = null;
		public $jenis_konten = null;
		public $tgl_buat = null;
		public $tgl_modifikasi = null;
		public $judul_konten = null;
		public $gambar_sampul_konten = null;
		public $isi = null;
		public $seo_deskripsi = null;
		public $seo_keywords = null;
		public $judul_slug = null;

		public function __construct($data=array()){
			if(isset($data['id_konten'])) $this->id_konten = (int) $data['id_konten'];
			if(isset($data['jenis_konten'])) $this->jenis_konten = $data['jenis_konten'];
			if(isset($data['tgl_buat'])) $this->tgl_buat = $data['tgl_buat'];
			if(isset($data['tgl_modifikasi'])) $this->tgl_modifikasi = $data['tgl_modifikasi'];
			if(isset($data['judul_konten'])) $this->judul_konten = $data['judul_konten'];
			if(isset($data['gambar_sampul_konten'])) $this->gambar_sampul_konten = $data['gambar_sampul_konten'];
			if(isset($data['isi'])) $this->isi = $data['isi'];
			if(isset($data['seo_deskripsi'])) $this->seo_deskripsi = $data['seo_deskripsi'];
			if(isset($data['seo_keywords'])) $this->seo_keywords = $data['seo_keywords'];
			if(isset($data['judul_slug'])) $this->judul_slug = $data['judul_slug'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
			$this->seo_keywords = "kosong";
			$this->seo_deskripsi = "kosong";
		}

		public static function ambilKontenById($id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from konten_tunggal WHERE id_konten = :id_konten LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_konten", $id, PDO::PARAM_INT);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Konten_Tunggal($hasil);			
		}

		public static function ambilKontenByJenisKonten($jenis_konten){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from konten_tunggal WHERE jenis_konten = :jenis_konten LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":jenis_konten", $jenis_konten, PDO::PARAM_STR);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Konten_Tunggal($hasil);			
		}

		public static function ambilSemuaKontenByJenisPaging($jenis, $limit = 0, $offset = 0){

			$stringLimit = $limit > 0 ? "LIMIT ".$limit." " : "";
			$stringOffset = $offset > 0 ? "OFFSET ".$offset." " : "";

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM konten_tunggal WHERE jenis_konten = :jenis_konten ORDER BY id_konten DESC ".$stringLimit.$stringOffset;
			$st = $koneksi->prepare($sql);
			$st->bindValue(":jenis_konten", $jenis_konten, PDO::PARAM_INT);
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Kategori_Ganda($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public static function ambilSemuaKontenByJenisNonPaging($jenis){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM konten_tunggal WHERE jenis_konten = :jenis_konten ORDER BY id_konten DESC ";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":jenis_konten", $jenis_konten, PDO::PARAM_INT);
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Kategori_Ganda($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}


		public function buatKontenGanda(){
			if(!is_null($this->id_konten)) trigger_error("Pesan error -> Konten_Tunggal::buatKontenGanda(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);

			//Memasukan data kedalam database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO konten_tunggal (jenis_konten,
											  tgl_buat,
											  tgl_modifikasi,
											  judul_konten,
											  gambar_sampul_konten,
											  isi,
											  seo_deskripsi,
											  seo_keywords) 
	                             VALUES( :jenis_konten,
										  :tgl_buat,
										  :tgl_modifikasi,
										  :judul_konten,
										  :gambar_sampul_konten,
										  :isi,
										  :seo_deskripsi,
										  :seo_keywords)";
		   $st = $koneksi->prepare($sql);		   		   		   
		   $st->bindValue(":tgl_dibuat", NULL, PDO::PARAM_STR);
		   $st->bindValue(":tgl_modifikasi", NULL, PDO::PARAM_STR);
		   $st->bindValue(":jenis_konten", $this->jenis_konten, PDO::PARAM_STR);
		   $st->bindValue(":judul_konten", $this->judul_konten, PDO::PARAM_STR);
		   $st->bindValue(":gambar_sampul_konten", $this->gambar_sampul_konten, PDO::PARAM_STR);
		   $st->bindValue(":isi", $this->isi, PDO::PARAM_STR);
		   $st->bindValue(":seo_deskripsi", $this->seo_deskripsi, PDO::PARAM_STR);
		   $st->bindValue(":seo_keywords", $this->seo_keywords, PDO::PARAM_STR);		   
		   $st->execute();
		   $this->id_konten = $koneksi->lastInsertId();		   
		   $koneksi = null;

		   return (array("hasilOperasi" => $this->id_konten));
		}

		public function suntingKontenTunggal(){
			//memeriksa apakah id sudah terisi atau belum
			if(is_null($this->id_konten)) trigger_error("Produk::suntingKontenTunggal(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);
			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE konten_tunggal SET judul_konten = :judul_konten,
		                               gambar_sampul_konten = :gambar_sampul_konten,
		                               isi = :isi,
									   seo_deskripsi = :seo_deskripsi,
									   seo_keywords = :seo_keywords									   									   
									   WHERE id_konten = :id_konten";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_konten", $this->id_konten, PDO::PARAM_INT);		   			
		    $st->bindValue(":judul_konten", $this->judul_konten, PDO::PARAM_STR);
		    $st->bindValue(":gambar_sampul_konten", $this->gambar_sampul_konten, PDO::PARAM_STR);
		    $st->bindValue(":isi", $this->isi, PDO::PARAM_STR);
		    $st->bindValue(":seo_deskripsi", $this->seo_deskripsi, PDO::PARAM_STR);
		    $st->bindValue(":seo_keywords", $this->seo_keywords, PDO::PARAM_STR);		   
			$st->execute();			
			$hasilDb = $st->rowCount();
			$koneksi = null;
			return $hasilDb;			
		}

		public function hapusKontenGanda(){
			if(is_null($this->id_konten)) trigger_error("Produk::hapusKontenGanda(): Mencoba untuk menghapus objek yang tidak memiliki ID.", E_USER_ERROR);

						$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
						$sql = "DELETE FROM konten_tunggal WHERE id_konten = :id_konten";
						$st = $koneksi->prepare($sql);
						$st->bindValue(":id_konten", $this->id_konten, PDO::PARAM_INT);
						$st->execute();
						$proses = $st->rowCount();						
						$koneksi=null;
						return $proses;
		}		

	}

 ?>