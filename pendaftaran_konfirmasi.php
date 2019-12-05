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
    	<div class="kiri">Konfirmasi Pendaftaran</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>

<?php
date_default_timezone_set('Asia/jakarta');
$id = $db_akses->mysqli_real_escape_string($_GET['id']);
$tgl_konfirmasi= date("Y-m-d H:i:s");

$query = "update seminar_peserta set is_konfirmasi = 1,  tgl_konfirmasi = '$tgl_konfirmasi' 
         where id = '$id'";   

#echo "SQL : $query";

?>
<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">
                <?php
                    $result = $db_akses->ExecuteQuery($query);
                    if ($result){
                        echo "Selamat, anda telah berhasil mengkonfirmasi pendaftaran seminar<br>";
                        echo "Selanjutnya silahkan <a href='pendaftaran_login.php?id=". $id ."'>login</a> untuk  melengkapi data-data anda<br/><br/>";

                        include "info_pembayaran.php";
                    } else {
                        #echo "SQL : $query";
                    }
                ?>
            </div>	
        </div>    
    </div>
</div>

<?php include "menu-footer.php";?>
</body>
</html>
