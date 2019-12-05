<?php
	ini_set('display_errors',false);
	date_default_timezone_set('Asia/jakarta');
	$link = mysqli_connect('localhost', 'pengwili_ippat', 'F]I[uPmVvyQ3', 'pengwili_ippat');
	if (!$link) {
		die ("<font color='#FF0000' size='+2'><b>Failed connect to database!</b></font>");
	}

	function rp($uang){
		$rp = "";
		$digit = strlen($uang);
		
		while($digit > 3)
		{
			$rp = "." . substr($uang,-3) . $rp;
			$lebar = strlen($uang) - 3;
			$uang  = substr($uang,0,$lebar);
			$digit = strlen($uang);  
		}
		$rp = "Rp ".$uang . $rp . " ,-";
		return $rp;
	}
	function potong_kata($kata,$jumlah_huruf){
		if(strlen($kata)>$jumlah_huruf){
			$kata=substr($kata,0,$jumlah_huruf)."...";
		}
		return $kata;
	}
	function cek_gambar($gambar){
		if($gambar==''){
			return "no-pic.jpg";
		}else{
			return $gambar;
		}
	}
	session_start();
	if( isset($_SESSION['lang']) ){
		$lang = $_SESSION['lang'];
	}else{
		$lang = 'id';
	}
	$page_name = '';
	$sql_text=mysqli_query($link,"SELECT * FROM `arf_text`");
	while($result=mysqli_fetch_array($sql_text)){
		$key=$result['nama'];
		$value_id=$result['isi_id'];
		$value_en=$result['isi_en'];
		$text_db_id[$key]=$value_id;
		$text_db_en[$key]=$value_en;
	}

?>