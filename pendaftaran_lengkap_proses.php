<?php

include "dbconfig.php";
if (isset($_SESSION['id']) == "") {    
    header('location: pendaftaran_login.php');    
}

date_default_timezone_set('Asia/jakarta');

$nama               = $db_akses->mysqli_real_escape_string($_POST['nama']);
$tempat_lahir       = $db_akses->mysqli_real_escape_string($_POST['tempat_lahir']);

$propinsi           = $db_akses->mysqli_real_escape_string($_POST['propinsi']);
$kabupaten          = $db_akses->mysqli_real_escape_string($_POST['kabupaten']);

$alamat_rumah       = $db_akses->mysqli_real_escape_string($_POST['alamat_rumah']);
$no_ktp             = $db_akses->mysqli_real_escape_string($_POST['no_ktp']);
$no_sk_ppat         = $db_akses->mysqli_real_escape_string($_POST['no_sk_ppat']);

$no_bas_ppat        = $db_akses->mysqli_real_escape_string($_POST['no_bas_ppat']);
$no_wa              = $db_akses->mysqli_real_escape_string($_POST['no_wa']);
$no_telp_kantor     = $db_akses->mysqli_real_escape_string($_POST['no_telp_kantor']);

if ($nama == '')
{
    exit("<script>window.alert('Nama belum disi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} 

if ($tempat_lahir == '')
{
    exit("<script>window.alert('Tempat Lahir belum disi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
}

$time = strtotime($_POST['tgl_lahir']);
if ($time) {
  $tgl_lahir = date('Y-m-d', $time);  
} else {
    exit("<script>window.alert('Tanggal Lahir Masih Salah');
    document.location.href='javascript:history.go(-1)';</script>");
}

if ($propinsi == '')
{
    exit("<script>window.alert('Propinsi belum diisi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} 

if ($kabupaten == '')
{
    exit("<script>window.alert('Kabupaten belum diisi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} 

if ($alamat_rumah == '')
{
    exit("<script>window.alert('Alamat Rumah belum diisi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} 

if ($no_ktp  == '')
{
    exit("<script>window.alert('No KTP Rumah belum diisi, mohon dilengkapi terlebih dahulu');
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

if ($no_wa  == '')
{
    exit("<script>window.alert('No WA belum disi, mohon dilengkapi terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
}

if ($no_telp_kantor == '')
{
    exit("<script>window.alert('No Telp Kantor belum disi, mohon dilengkapi terlebih dahulu');
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

    $peserta->propinsi          = $propinsi;
    $peserta->kabupaten         = $kabupaten;

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
        $_SESSION['name']       = $peserta->nama;
        exit("<script>window.alert('Berhasil menyimpan data pendaftaran');
        window.location='pendaftaran_lengkap.php';</script>");
        
        header('location: pendaftaran_lengkap.php');
    } else {     
        #echo $peserta->generateSQLUpdate;
        #exit;       
        exit("<script>window.alert('Insert Failed, Please Try Again');
        document.location.href='javascript:history.go(-1)';</script>");												        
    }
}


unset($peserta);
unset($db_akses);
?>