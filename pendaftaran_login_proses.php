<?php
include "db_akses.php";
$db_akses = new db_akses();

date_default_timezone_set('Asia/jakarta');

$email                  = $db_akses->mysqli_real_escape_string($_POST['email']);
$password               = $db_akses->mysqli_real_escape_string($_POST['password']);

$tgl_input              = date("Y-m-d H:i:s");
$tgl_waktu              = date('H:i');


if ($email=='' or $password=='' )
{
    exit("<script>window.alert('Silahkan isi semua data terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} else
{ 
    if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) 
    {
        exit("<script>window.alert('Maaf email anda kurang lengkap');
            document.location.href='javascript:history.go(-1)';</script>");
    } 
    else 
    {   $l_login = $db_akses->OpenQueryArray("SELECT * FROM seminar_peserta WHERE is_konfirmasi = 1 and email = '$email'");
        #echo $l_login['passw'] ." vs ". md5($password) . " vs " . $password;
        #exit;

        if ($l_login['passw'] != md5($password)){
            exit("<script>window.alert('Login Gagal, Coba Lagi !');
            document.location.href='javascript:history.go(-1)';</script>");
        } else {
            $_SESSION['imail'] = $l_login['email'];
            $_SESSION['name'] = $l_login['nama'];
            $_SESSION['password'] = $l_login['passw'];
            $_SESSION['id'] = $l_login['id'];            

            #echo "ID = " . $l_login['id'] . " sessin.id = " . $_SESSION['id'] . "<br>";
            $_SESSION['is_admin'] = $l_login['is_admin'];   
            #header('location: test.php');            
        }

        if ($_SESSION['id'] != '') {
            if (isset($_SESSION['halaman_terakhir'])) {
                header('location: ' . $_SESSION['halaman_terakhir']);                
                echo "1<br>";
            } else {
                header('location: pendaftaran_lengkap.php');
                echo "2<br>";
            }
        }
    }
}

unset($db_akses);
?>