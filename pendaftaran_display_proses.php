<?php

include "dbconfig.php";
if (isset($_SESSION['id']) == "") {    
    header('location: pendaftaran_login.php');    
}

date_default_timezone_set('Asia/jakarta');

$display_id         = $db_akses->mysqli_real_escape_string($_POST['display_id']);
$peserta            = new peserta();
$peserta->id        = $display_id;

$db_akses = new db_akses();        
$db_akses->LoadByID($peserta); 
$peserta->is_datang = $db_akses->mysqli_real_escape_string($_POST['kehadiran']); 

#echo "Nama : " . $peserta->nama . "<br>";
#echo "Nama : " . $display_id . "<br>";


$result = $db_akses->SaveToDB($peserta);            
if ($result){	
    //$_SESSION['name']       = $peserta->nama;
    
    exit("<script>window.alert('Berhasil mengupdate data kedatangan');
    window.location='pendaftaran_scan.php';</script>");
    
    header('location: pendaftaran_scan.php');
} else {     
    #echo $peserta->generateSQLUpdate;
    #exit;       
    exit("<script>window.alert('Insert Failed, Please Try Again');
    document.location.href='javascript:history.go(-1)';</script>");												        
}



unset($peserta);
unset($db_akses);
?>