<?php

	class Zebra_Pagination_Proses{
		
		public $dataPerHalaman = null;
		public $posisiHalaman = null;
		public $jumlahData = null;
		public $offset = null;
		public $render = null;
		
		//atribut database
		public $database = null;
		public $klausa = null;
		
		public function __construct($data=array()){
			if(isset($data['dataPerHalaman'])) $this->dataPerHalaman = (int) $data['dataPerHalaman'];
			if(isset($data['posisiHalaman'])) $this->posisiHalaman = (int) $data['posisiHalaman'];
			if(isset($data['jumlahData'])) $this->jumlahData = (int) $data['jumlahData'];
			if(isset($data['offset'])) $this->offset = (int) $data['offset'];
			if(isset($data['database'])) $this->database = $data['database'];
			if(isset($data['klausa'])) $this->klausa = $data['klausa'];
			if(isset($data['render'])) $this->render = $data['render'];
		}
		
		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}
		
		public static function zebra_pagination($database,$klausa = "", $dataPerHalaman = 10, $posisiHalaman = 1){
			
			$data = array();
			
			$data['database'] = $database;
			$data['klausa'] = $klausa;
			$data['posisiHalaman'] = $posisiHalaman;
			$data['dataPerHalaman'] = $dataPerHalaman;
						
			//hitung jumlah data dari query database
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT count(*) AS jumlahData FROM ".$database." ".$klausa;
			$st = $koneksi->prepare($sql);
			$st->execute();
			$jumlahData = $st->fetch();
			$data['jumlahData'] = $jumlahData['jumlahData'];
			$koneksi = null;
			
			
			$zebraPagination = new Zebra_Pagination();
			
			//total jumlah data dari database
			$zebraPagination->records($data['jumlahData']);
			
			//jumlah dataperhalaman
			$zebraPagination->records_per_page($data['dataPerHalaman']);

			$data['offset'] = ($zebraPagination->get_page()	 - 1) * $data['dataPerHalaman'];
			
			$data['render'] = $zebraPagination->render(TRUE);
			
			return new Zebra_Pagination_Proses($data);
			
		}
		
	}

?>