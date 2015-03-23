<?php 

	function tanggal_sekarang(){
		switch(date('n')){
			case 1: $bulan = "Januari";break;
			case 2: $bulan = "Februari";break;
			case 3: $bulan = "Maret";break;
			case 4: $bulan = "April";break;
			case 5: $bulan = "Mei";break;
			case 6: $bulan = "Juni";break;
			case 7: $bulan = "Juli";break;
			case 8: $bulan = "Agustus";break;
			case 9: $bulan = "September";break;
			case 10: $bulan = "Oktober";break;
			case 11: $bulan = "November";break;
			case 12: $bulan = "Desember";break;
		}
		switch(date('w')){
			case 0: $hari = "Minggu";break;
			case 1: $hari = "Senin";break;
			case 2: $hari = "Selasa";break;
			case 3: $hari = "Rabu";break;
			case 4: $hari = "Kamis";break;
			case 5: $hari = "Jumat";break;
			case 6: $hari = "Sabtu";break;			
		}

		echo $hari.", ".date('j')." - ".$bulan." - ".date('Y');
	}

 ?>