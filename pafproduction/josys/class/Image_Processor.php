<?php 

/* Class Image_Processor plus plus , by : Aryo
/* class ini selain untuk upload gambar
/* bisa juga untuk mengecilkan dimensi pixel gambar (proporsional tentunya)
/* dan juga bisa untuk mengurangi kualitas gambar (compress) untuk mengecilkan ukuran byte gambar,
/* supaya hemat drive space di hosting :)
/* silahkan digunakan, ilmu untuk berbagi, bukan untuk keuntungan sendiri :)
	menudukung format file : jpg, jpeg, bmp, gif, png
*/
	class Image_Processor{
		public $name = null;
		public $tmp_name = null;
		public $size = null;
		public $type = null;
		public $direktoriPenyimpanan = null;
		public $sizeRequest = null;
		public $qualityRequest = null;

		public $width = null;
		public $height = null;

		public $namaKonteks = null;
		public $namaObjek = null;
		public $atributTambahan = null;
		public $namaFileSimpan = null;
		public $date = null;

		public $simpanFile = null;
		public $hasilOperasi = null;

		public $namaFileHapus = null;
		public $posisiFileHapus = null;
		public $direktoriHapus = null;		

		public function __construct($data=array()){
			if(isset($data['name'])) $this->name = $data['name'];
			if(isset($data['tmp_name'])) $this->tmp_name = $data['tmp_name'];
			if(isset($data['size'])) $this->size = (int) $data['size'];
			if(isset($data['type'])) $this->type = $data['type'];
			if(isset($data['direktoriPenyimpanan'])) $this->direktoriPenyimpanan = $data['direktoriPenyimpanan'];
			if(isset($data['sizeRequest'])) $this->sizeRequest = (int) $data['sizeRequest'];
			if(isset($data['qualityRequest'])) $this->qualityRequest = (int) $data['qualityRequest'];

			if(isset($data['width'])) $this->width = (int) $data['width'];
			if(isset($data['height'])) $this->height = (int) $data['height'];

			if(isset($data['namaKonteks'])) $this->namaKonteks = $data['namaKonteks'];
			if(isset($data['namaObjek'])) $this->namaObjek = $data['namaObjek'];
			if(isset($data['atributTambahan'])) $this->atributTambahan = $data['atributTambahan'];
			if(isset($data['namaFileSimpan'])) $this->namaFileSimpan = $data['namaFileSimpan'];
			if(isset($data['date'])) $this->date = $data['date'];
			if(isset($data['simpanFile'])) $this->simpanFile = $data['simpanFile'];
			if(isset($data['hasilOperasi'])) $this->hasilOperasi = $data['hasilOperasi'];

			if(isset($data['namaFileHapus'])) $this->namaFileHapus = $data['namaFileHapus'];
			if(isset($data['posisi'])) $this->posisi = $data['posisi'];
			if(isset($data['direktoriHapus'])) $this->direktoriHapus = $data['direktoriHapus'];
		}

		public function simpanNilai($parameter){
			$this->__construct($parameter);
		}				

		public function uploadGambarFilter($namaKonteks="noname", $atributTambahan = NULL, $ukuran, $kualitas, $direktoriPenyimpanan){
			$this->namaKonteks = $namaKonteks;
			$this->sizeRequest = $ukuran;
			$this->qualityRequest = $kualitas;
			$this->direktoriPenyimpanan = $direktoriPenyimpanan;
			$atributTambahan = $atributTambahan == NULL ? "" : $atributTambahan.'-';
			$namaObjek = $this->namaObjek == null ? "" : "-".$this->namaObjek ;
			$tipeGambar = "";
			$tampung_tmp_name = $this->tmp_name;

			//cek nama unik file
			$this->date = $this->date == NULL ? date("YmdHis") : $this->date ;

			// menyiapkan nama file sesuai dengan formatnya dan direktori file penyimpanan gambar
			// supaya penyimpanan gambar langsung bisa dilaksanakan dengan menggunakan objek direktory penyimpanan file
				switch($this->type){
					case 'image/gif':
						$tipeGambar = "gif";
						break;
					case 'image/jpeg':
						$tipeGambar = "jpg";
						break;
					case 'image/jpg':
						$tipeGambar = "jpg";
						break;
					case 'image/png':
						$tipeGambar = "png";
						break;
					case 'image/bmp':
						$tipeGambar = "bmp";
						break;
				}
				$this->namaFileSimpan = $atributTambahan.$this->namaKonteks.$namaObjek.'-'.$this->date.'.'.$tipeGambar;
				$this->direktoriPenyimpanan = $this->direktoriPenyimpanan.$this->namaFileSimpan;

				//menghitung ukuran proporsional berdasarkan permintaan pengecilan ukuran dimensi gambar
				list($width, $height, $image_type) = getimagesize($this->tmp_name);

					if($width > $this->sizeRequest || $height > $this->sizeRequest){
							if($width > $height){
								$newWidth = $this->sizeRequest;
								$newHeight = ($height * $this->sizeRequest)/$width;
							}elseif($width < $height){
								$newHeight = $this->sizeRequest;
								$newWidth = ($width/$height)*$this->sizeRequest;
							}elseif($width = $height){
								$newHeight = $this->sizeRequest;
								$newWidth = $this->sizeRequest;								
							}

							$this->width = $newWidth;
							$this->height = $newHeight;

							switch($image_type){
								case IMAGETYPE_GIF:
									$src = imagecreatefromgif($this->tmp_name);
									break;
								case IMAGETYPE_JPEG:
									$src = imagecreatefromjpeg($this->tmp_name);
									break;
								case IMAGETYPE_JPEG2000:
									$src = imagecreatefromjpeg($this->tmp_name);
									break;
								case IMAGETYPE_PNG:
									$src = imagecreatefrompng($this->tmp_name);
									break;
								case IMAGETYPE_BMP:
									$src = imagecreatefromwbmp($this->tmp_name);
									break;
							}
							if($image_type != '3'){
								$tmp = imagecreatetruecolor($newWidth, $newHeight);
								$imageCopy = imagecopyresampled($tmp,$src,0,0,0,0,$newWidth,$newHeight,$width,$height);
							}else{
								$tmp = $src;
							}

							            switch ($image_type) {
                                            case IMAGETYPE_GIF:
                                                $imageCreate = imagegif($tmp,$this->direktoriPenyimpanan,$this->qualityRequest);
                                                $this->simpanFile = $imageCreate;
                                                break;
                                            case IMAGETYPE_JPEG:
                                                $imageCreate = imagejpeg($tmp,$this->direktoriPenyimpanan,$this->qualityRequest);
                                                $this->simpanFile = $imageCreate;
                                                break;
                                            case IMAGETYPE_JPEG2000:
                                                $imageCreate = imagejpeg($tmp,$this->direktoriPenyimpanan,$this->qualityRequest);
                                                $this->simpanFile = $imageCreate;
                                                break;
                                            case IMAGETYPE_PNG:
                                            	imagealphablending($tmp, false);
												imagesavealpha($tmp, true);
                                                $imageCreate = imagepng($tmp,$this->direktoriPenyimpanan,$this->qualityRequest);
                                                $this->simpanFile = $imageCreate;
                                                break;
                                            case IMAGETYPE_BMP:
                                                $imageCreate = imagewbmp($tmp,$this->direktoriPenyimpanan,$this->qualityRequest);
                                                $this->simpanFile = $imageCreate;
                                                break;
                                            default:
                                                return false;
                                        }

                                    //membersihkan file gambar pada memory server
                                    imagedestroy($src);                                                                       
                                    imagedestroy($tmp);
					}else{
						list($newWidth, $newHeight, $image_type) = getimagesize($this->tmp_name);
						$this->simpanFile = copy($this->tmp_name, $this->direktoriPenyimpanan);						 
					}
				return (array("hasilOperasi" => $this->simpanFile, "namaFileSimpan" => $this->namaFileSimpan,
					    "width" => $newWidth, "height" => $newHeight));	
		}

		public function uploadMove($direktoriPenyimpanan){

			$splitNama = explode(".",$this->name);			
			$splitNama[0] = date("YmdHis");
			$this->simpanFile = move_uploaded_file($this->tmp_name, $direktoriPenyimpanan.$splitNama[0].".".$splitNama[1]);			
			return (array("namaFileSimpan" => $this->name, "hasilOperasi" => $this->simpanFile));		
		}

		public function bersihkantmp(){
			imagedestroy($this->tmp_name); 
		}

		public function uploadGambar($namaKonteks="noname", $atributTambahan = "", $direktoriPenyimpanan){
			$this->namaKonteks = $namaKonteks;
			$$this->direktoriPenyimpanan = $direktoriPenyimpanan;
			$this->atributTambahan = $atributTambahan;


			// menyiapkan nama file sesuai dengan formatnya dan direktori file penyimpanan gambar
			// supaya penyimpanan gambar langsung bisa dilaksanakan dengan menggunakan objek direktory penyimpanan file
			if($this->tmp_name){
				switch($this->type){
					case 'image/gif':
						$tipeGambar = "gif";
						break;
					case 'image/jpeg':
						$tipeGambar = "jpg";
						break;
					case 'image/jpg':
						$tipeGambar = "jpg";
						break;
					case 'image/png':
						$tipeGambar = "png";
						break;
					case 'image/bmp':
						$tipeGambar = "bmp";
						break;
				}
				$this->namaFileSimpan = $this->atributTambahan.'-'.$this->namaKategori.'-'.date("YmdHis").$tipeGambar;
				$this->direktoriPenyimpanan = $this->direktoriPenyimpanan.$this->namaFileSimpan;
				$this->simpanFile = move_uploaded_file($this->tmp_name, $this->direktoriPenyimpanan);
				return (array("hasilOperasi" => $this->simpanFile, "namaFileSimpan" => $this->namaFileSimpan,
							  "width" => $newWidth, "height" => $newHeight));
			}
		}

		public function hapusGambar($direktoriHapus, $namaFile){
			$hasilHapus = unlink($direktoriHapus.$namaFile);
			return $hasilHapus;
		}
	}

 ?>