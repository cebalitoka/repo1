<?php 

	class Modul_Admin{
		public $id = null;
		public $id_parent = null;
		public $nama_modul = null;
		public $link = null;
		public $aktif = null;

		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['id_parent'])) $this->id_parent = $data['id_parent'];
			if(isset($data['nama_modul'])) $this->nama_modul = $data['nama_modul'];
			if(isset($data['link'])) $this->link = $data['link'];
			if(isset($data['aktif'])) $this->aktif = $data['aktif'];			
		}

		public static function ambilSemuaModulAdminAktifInduk(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM modul_admin WHERE aktif = 'Y' ORDER BY id DESC";
			$st = $koneksi->prepare($sql);			
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Modul_Admin($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}

		public static function ambilSemuaModulAdminAktifAnak($id_parent){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM modul_admin WHERE aktif = 'Y' AND id_parent = : :id_parent ORDER BY id DESC";
			$st = $koneksi->prepare($sql);	
			$st->bindValue(":id_parent", $id_parent, PDO::PARAM_INT);		
			$st->execute();
			$data = array();
			$jumlahData = 0;

			while($hasil = $st->fetch()){
				$hasilFetch = new Modul_Admin($hasil);
				$data[] = $hasilFetch;
				$jumlahData++;
			}
			$koneksi = null;
			return(array("hasilData" => $data, "jumlahData" => $jumlahData));
		}			

	}

 ?>