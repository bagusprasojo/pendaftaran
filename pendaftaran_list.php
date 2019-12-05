<?php
    include "dbconfig.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_list.php';

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
    	<div class="kiri">Daftar Peserta</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>



<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">                
            <?php
                $q5 = "SELECT * FROM seminar_peserta";
                $r5 = $db_akses->OpenQuery($q5);
                echo '<P>
                <h1>Daftar Peserta</h1>
                <table border = 1 class="flyer" cellpadding="20" cellspacing="0" align="left" width="100%">
                <tr>
                    <th>Nama <br>Email</th>                    
                    <th>Tempat <br>Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>No KTP</th>
                    <th>No & <br>Tanggal SK PPAT</th>
                    
                    <th>No & <br/>Tanggal BAS PPAT</th>
                    <th>No WA & Telp Kantor</th>
                    <th>Administrator</th>
                    <th>Operasi</th>
                </tr>';

                while ($row = mysqli_fetch_array ($r5, MYSQLI_ASSOC)) {
                    if ($row['is_admin'] == 1) {
                        $is_admin = 'Ya';
                        $set_as_admin = 'Set Sebagai Peserta';
                        $status_admin = '0';
                    } else {
                        $is_admin = 'Tidak';
                        $set_as_admin = 'Set Sebagai Admin';
                        $status_admin = '1';
                    }

                    echo '<tr>
                          <td align="left">'.$row['nama'].'<br>' .$row['email']. '</td>                          
                          <td align="left">'.$row['tempat_lahir'].'<br/>'.$row['tgl_lahir'].'</td>
                          <td align="left">'.$row['alamat_rumah'].'</td>
                          <td align="left">'.$row['no_ktp'].'</td>
                          <td align="left">'.$row['no_sk_ppat'].'<br/>'.$row['tgl_sk_ppat'].'</td>
                          <td align="left">'.$row['no_bas_ppat'].'<br>'.$row['tgl_bas_ppat'].'</td>
                          <td align="left">'.$row['no_wa'].'<br>'.$row['no_telp_kantor'].'</td>
                          <td align="left">'.$is_admin.'</td>
                          <td align="left">
                          <a href="pendaftaran_konfirmasi.php?id='.$row['id'].'">Konfirmasi</a> |
                          <a href="pendaftaran_delete.php?id='.$row['id'].'">Hapus</a> |
                          <a href="pendaftaran_set_as_admin.php?id='.$row['id'].'&status_admin='.$status_admin.'">'.$set_as_admin.'</a>
                          </td>
                          </tr>';                    
                }
                echo '</table>'; 
                ?>
            </div>    
        </div>
    </div>
</div>
<?php include "menu-footer.php";?>
</body>
</html>