<?php
include "dbconfig.php";
$page_name = 'pendaftaran';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IKATAN PEJABAT PEMBUAT AKTA TANAH JAWA TENGAH</title>
<?php include "script.html";?>
</head>
<body>
<?php include "menu-header.php";?>

<div class="atas-menu">
	<div class="container_25">
    	<div class="kiri">Update Status Admin</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>

<?php
date_default_timezone_set('Asia/jakarta');
$id = $db_akses->mysqli_real_escape_string($_GET['id']);
$status_admin = $db_akses->mysqli_real_escape_string($_GET['status_admin']);

$tgl_konfirmasi= date("Y-m-d H:i:s");

$query = "update seminar_peserta set is_admin = '$status_admin' 
         where id = '$id'";   

echo "SQL : $query";

?>
<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">
                <?php
                    $result = $db_akses->ExecuteQuery($query);
                    if ($result){
                        
                        echo "Selamat, anda telah berhasil merubah status admin<br>";
                        echo "Kembali ke halaman<a href='pendaftaran_list.php'> Daftar Peserta</a>";
                    } else {
                        exit("<script>window.alert('Gagal merubah status admin peserta seminar');
                            document.location.href='javascript:history.go(-1)';</script>");
                    }
                ?>
            </div>	
        </div>    
    </div>
</div>

<?php include "menu-footer.php";?>
</body>
</html>
