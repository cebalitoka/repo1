<?php 

	ini_set( "display_errors", false );
	date_default_timezone_set( "Asia/Jakarta" );  // http://www.php.net/manual/en/timezones.php
	define( "DB_DSN", "mysql:host=localhost;dbname=chopin_pafproduction" );
	define( "DB_USERNAME", "root" );
	define( "DB_PASSWORD", "" );

	// nilai cost untuk hashing password, jangan mengubah nilai ini !!! jika anda belum mengetahui seluk beluk hasing (bukan cm sekedar memakai)
	define("HASH_COST_FACTOR", "10");

	function handleException( $exception ) {
	  echo "Maaf terjadi kesalahan teknis, harap hubungi Jogjasite";
	  error_log( $exception->getMessage() );
	}
 
	set_exception_handler( 'handleException' );

 ?>