<?php 
session_start();

	class Akun_User{
		//atribut user (database)
		public $id = null;
		public $username = null;
		public $password = null;
		public $password_lama = null;
		public $tgl_buat = null;
		public $tgl_modifikasi = null;
		public $id_session = null;

		//variabel operasional
		public $status_login = null;
		public $jumlah_login = null;
		public $hasil_registrasi = null;


		public function __construct($data=array()){
			if(isset($data['id'])) $this->id = (int) $data['id'];
			if(isset($data['username'])) $this->username = $data['username'];
			if(isset($data['password'])) $this->password = $data['password'];
			if(isset($data['password_lama'])) $this->password_lama = $data['password_lama'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}

		public static function cekStatusLogin(){
			
			$cekLogin=FALSE;
				if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == TRUE){
					$sessionId = session_id();

					$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
					$sql = "SELECT * from user WHERE username = :username AND id_session = :id_session LIMIT 1";
					$st = $koneksi->prepare($sql);
					$st->bindValue(":username", $_SESSION['username'], PDO::PARAM_STR);
					$st->bindValue(":id_session", $sessionId , PDO::PARAM_STR);
					$st->execute();
					$hasil = $st->fetch();
					$koneksi = null;
					$cekLogin = isset($hasil['id']) && !is_null($hasil['id']) && !empty($hasil['id']) ? TRUE : FALSE ;					
				}
				else{
					$cekLogin = FALSE;
				}
			return $cekLogin;
		}

		public static function ambilAkunUserBySessionId($session_id){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from user WHERE id_session = :id_session LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_session", $session_id, PDO::PARAM_STR);
			$st->execute();
			$hasil = $st->fetch();
			$koneksi = null;
			if($hasil) return new Akun_User($hasil);			
		}

		public function cekPasswordSunting(){
			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from user WHERE id = :id LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $this->id, PDO::PARAM_INT);			
			$st->execute();
			$cekDb = $st->fetch();
			$cekPassword = FALSE;			

			if(crypt($this->password_lama, $cekDb['password']) == $cekDb['password']){
				$cekPassword = TRUE;			
			}else{
				$cekPassword = FALSE;			
			}
			return $cekPassword;
		}

		public function suntingAkun(){
			//memeriksa apakah objek yang akan diproses memiliki id
			if(is_null($this->id)) trigger_error("Pesan error -> Akun_User::suntingAkun(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id_produk). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);
			
			$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        	$this->password = crypt($this->password, $salt);

			//Menyunting kategori kedalam database
			$koneksi = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$sql = "UPDATE user SET password = :password		                               
									   WHERE id = :id";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id", $this->id, PDO::PARAM_INT);		   			
		    $st->bindValue(":password", $this->password, PDO::PARAM_STR);		   
			$st->execute();
			$hasilDb = $st->rowCount();
			$koneksi = null;
			return $hasilDb;			
		}

	 	public function login(){

			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * from user WHERE username = :username LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":username", $this->username, PDO::PARAM_STR);			
			$st->execute();
			$cekDb = $st->fetch();

			if(crypt($this->password, $cekDb['password']) != $cekDb['password']){
				$this->status_login = FALSE;
			}else{
				$this->status_login = TRUE;

				session_regenerate_id();
				$this->id_session = session_id();

				//mengisi session				
				$_SESSION['username'] = $this->username;
				$_SESSION['login_status'] = TRUE;

				$sql = "UPDATE user SET id_session = :id_session WHERE id = :id LIMIT 1";
				$st = $koneksi->prepare($sql);
				$st->bindValue(":id", $cekDb['id'], PDO::PARAM_INT);			
				$st->bindValue(":id_session", $this->id_session, PDO::PARAM_STR);			
				$st->execute();
				$koneksi = null;
			}
			return $this->status_login;
	 	}

	 	public function logout(){
	 		$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE user SET id_session = :id_session WHERE username = :username LIMIT 1";
			$st = $koneksi->prepare($sql);
			$st->bindValue(":id_session", "OFF", PDO::PARAM_STR);			
			$st->bindValue(":username", $_SESSION['username'], PDO::PARAM_STR);			
			$st->execute();
			$koneksi = null;
			session_destroy();
	 	}

	 	public function registerUser(){
	 		if(!is_null($this->id)) trigger_error("Pesan error -> Akun_User::registerUser(): Mencoba untuk menambah objek kedalam database namun sudah memiliki ID (to $this->id). <br> Harap sampaikan pesan error ini kepada Jogjasite untuk tindak lebih lanjut", E_USER_ERROR);

	 		//menghilangkan extra space
	 		$this->username = trim($this->username);

	 		//memeriksa username
	 			$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
				$sql = "SELECT * from user WHERE username = :username";
				$st = $koneksi->prepare($sql);
				$st->bindValue(":username", $this->username, PDO::PARAM_STR);				
				$st->execute();
				$cekUsername = $st->fetchAll();
				$koneksi = null;

			if(count($cekUsername) > 0){
				$this->hasil_registrasi = FALSE;
			}else{
 					$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        			$this->password = crypt($this->password, $salt);		

			//Memasukan data kedalam database
				$koneksi = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
				$sql = "INSERT INTO user (username,
												  password,
												  tgl_buat,
												  tgl_modifikasi)												  
		                             VALUES( :username,
											  :password,
											  :tgl_buat,
											  :tgl_modifikasi)";
			   $st = $koneksi->prepare($sql);		   		   		   
			   $st->bindValue(":username", $this->username, PDO::PARAM_STR);
			   $st->bindValue(":password", $this->password, PDO::PARAM_STR);			   
			   $st->bindValue(":tgl_buat", NULL, PDO::PARAM_STR);
			   $st->bindValue(":tgl_modifikasi", NULL, PDO::PARAM_STR);
			   $st->execute();
			   $this->id = $koneksi->lastInsertId();		   
			   $koneksi = null;

			   return (array("hasilOperasi" => $this->id));
			}
	 	}



	}

 ?>