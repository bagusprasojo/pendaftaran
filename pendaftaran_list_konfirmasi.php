<?php
    include "dbconfig.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_list_konfirmasi.php';

    if (isset($_SESSION['id']) == "") {    
        header('location: pendaftaran_login.php');    
    }
    
    
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
    	<div class="kiri">Daftar Konfirmasi Pembayaran Peserta</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>



<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">                
                Daftar Peserta Sudah Bayar Belum Terkonfirmasi<br/><br/>
                <?php
                    $sSQL = "select * from seminar_peserta  where img_kwitansi <> '' and is_konfirmasi = 1 and is_pembayaran_ok = 0 order by nama";
                    $r5 = $db_akses->OpenQuery($sSQL);
                    
                    $iNomor = 0;
                    echo "<table border = 1 ><tr><td>No</td><td>Email<br/>Nama</td><td>Kwitansi</td><td>Aksi</td></tr>";
                    while ($row = mysqli_fetch_array($r5, MYSQLI_ASSOC)) {                    
                        $iNomor = $iNomor + 1;
                        echo "<tr>";
                        echo "<td>";
                        echo $iNomor;
                        echo "</td>";

                        echo "<td>";
                        echo $row['email']."<br/>" . $row['nama'];
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='data/$row[img_kwitansi]'>Photo</a>";
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='pendaftaran_list_konfirmasi_proses.php?id=" . $row['id']."&is_pembayaran_ok=1'>"."Konfirmasi</a>";
                        echo "</td>";    

                        echo "</tr>";
                    }
                    echo "</table>";
                ?>

                <br/>Daftar Peserta Sudah Bayar Sudah Terkonfirmasi</br><br/>

                <?php
                    $sSQL = "select * from seminar_peserta  where img_kwitansi <> '' and is_konfirmasi = 1 and is_pembayaran_ok = 1 order by nama";
                    $r5 = $db_akses->OpenQuery($sSQL);
                    
                    $iNomor = 0;
                    echo "<table border = 1 ><tr><td>No</td><td>Email<br/>Nama</td><td>Kwitansi</td><td>Aksi</td></tr>";
                    while ($row = mysqli_fetch_array($r5, MYSQLI_ASSOC)) {                    
                        $iNomor = $iNomor + 1;
                        echo "<tr>";
                        echo "<td>";
                        echo $iNomor;
                        echo "</td>";

                        echo "<td>";
                        echo $row['email']."<br/>" . $row['nama'];
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='data/$row[img_kwitansi]'>Photo</a>";
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='pendaftaran_list_konfirmasi_proses.php?id=" . $row['id']."&is_pembayaran_ok=0'>"."Batalkan</a>";
                        echo "</td>";    

                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
                

            </div>    
        </div>
    </div>
</div>
<?php 
    include "menu-footer.php";

    unset($db_akses);
?>

</body>
</html>