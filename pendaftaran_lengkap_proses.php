<?php

include "dbconfig.php";
if (isset($_SESSION['id']) == "") {    
    header('location: pendaftaran_login.php');    
}

date_default_timezone_set('Asia/jakarta');

$nama               = $db_akses->mysqli_real_escape_string($_POST['nama']);
$tempat_lahir       = $db_akses->mysqli_real_escape_string($_POST['tempat_lahir']);
$alamat_rumah       = $db_akses->mysqli_real_escape_string($_POST['alamat_rumah']);
$no_ktp             = $db_akses->mysqli_real_escape_string($_POST['no_ktp']);
$no_sk_ppat         = $db_akses->mysqli_real_escape_string($_POST['no_sk_ppat']);

$no_bas_ppat        = $db_akses->mysqli_real_escape_string($_POST['no_bas_ppat']);
$no_wa              = $db_akses->mysqli_real_escape_string($_POST['no_wa']);
$no_telp_kantor     = $db_akses->mysqli_real_escape_string($_POST['no_telp_kantor']);

$time = strtotime($_POST['tgl_lahir']);
if ($time) {
  $tgl_lahir = date('Y-m-d', $time);  
} else {
    exit("<script>window.alert('Tanggal Lahir Masih Salah');
    document.location.href='javascript:history.go(-1)';</script>");
}

$time = strtotime($_POST['tgl_sk_ppat']);
if ($time) {
  $tgl_sk_ppat = date('Y-m-d', $time);  
} else {
    exit("<script>window.alert('Tanggal SK PPAT Masih Salah');
    document.location.href='javascript:history.go(-1)';</script>");
}


$time = strtotime($_POST['tgl_bas_ppat']);
if ($time) {
  $tgl_bas_ppat = date('Y-m-d', $time);  
} else {
    exit("<script>window.alert('Tanggal Berita Acara Sumpah Masih Salah');
    document.location.href='javascript:history.go(-1)';</script>");
}

if ($nama == '' or $tempat_lahir == '' or $tgl_lahir == '')
{
    exit("<script>window.alert('Silahkan isi semua data terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} else {        
    $peserta  = new peserta();
    $peserta->id = $_SESSION['id']; 

    $db_akses = new db_akses();        
    $db_akses->LoadByID($peserta);  

    $peserta->nama              = $nama;
    $peserta->tempat_lahir      = $tempat_lahir;    
    $peserta->tgl_lahir         = $tgl_lahir;    
    $peserta->alamat_rumah      = $alamat_rumah;
    $peserta->no_ktp            = $no_ktp;
    $peserta->no_sk_ppat        = $no_sk_ppat;
    $peserta->tgl_sk_ppat       = $tgl_sk_ppat;

    $peserta->no_bas_ppat       = $no_bas_ppat;
    $peserta->tgl_bas_ppat  = $tgl_bas_ppat;
    $peserta->no_wa             = $no_wa;
    $peserta->no_telp_kantor    = $no_telp_kantor;    

    $result = $db_akses->SaveToDB($peserta);            
    if ($result){	
        exit("<script>window.alert('Berhasil menyimpan data pendaftaran');
        window.location='pendaftaran_lengkap.php';</script>");
        
        header('location: pendaftaran_lengkap.php');
    } else {            
        exit("<script>window.alert('Insert Failed, Please Try Again');
        document.location.href='javascript:history.go(-1)';</script>");												        
    }
}


unset($peserta);
unset($db_akses);
?>