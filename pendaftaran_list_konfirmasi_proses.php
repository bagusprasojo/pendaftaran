<?php

include "dbconfig.php";
if (isset($_SESSION['id']) == "") {    
    header('location: pendaftaran_login.php');    
}

date_default_timezone_set('Asia/jakarta');
$id                 = $db_akses->mysqli_real_escape_string($_GET['id']);
$is_pembayaran_ok   = $db_akses->mysqli_real_escape_string($_GET['is_pembayaran_ok']);

$peserta        = new peserta();
$peserta->id    = $id;

$db_akses->LoadByID($peserta);
$peserta->is_pembayaran_ok = $is_pembayaran_ok;

if ($db_akses->SaveToDB($peserta)) {
    exit("<script>window.alert('Berhasil Update Status Pembayaran');
                                window.location='pendaftaran_list_konfirmasi.php';</script>");    
} else {
    exit("<script>window.alert('Berhasil Update Status Pembayaran');
                                window.location='pendaftaran_list_konfirmasi.php';</script>");    
}

?>