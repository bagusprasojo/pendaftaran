<?php
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

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
                <div class="kanan">
                    <form action="pendaftaran_list.php" method="post">
                        <div class="area">
                            Nama / Kota / Email : <input type="text" name="keyword" class="input" placeholder=" Keyword">
                            <input type="submit" class="submit" value="Cari">
                        </div>
                    </form>
                </div>
            </div>
                   	
            <div class="bawah">                            

            <?php
                
                $keyword                = "";
                if (isset($_POST['keyword'])) {
                    $keyword    = $_POST['keyword'];
                }

                $no_of_records_per_page = 25;
                $SQLFilterSearch        = "";
                if ($keyword != "") {                

                    $SQLFilterSearch = "and (upper(nama) like upper('%" . $keyword . "%') or ";
                    $SQLFilterSearch = $SQLFilterSearch . " upper(email) like upper('%" . $keyword . "%') or ";
                    $SQLFilterSearch = $SQLFilterSearch . " upper(kabupaten) like upper('%" . $keyword . "%')) ";

                    $no_of_records_per_page = 2500;
                }
                
                $offset = ($pageno-1) * $no_of_records_per_page; 

                $total_pages_sql = "SELECT COUNT(*) FROM seminar_peserta";
                $result = $db_akses->OpenQuery($total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $q5 = "SELECT * FROM seminar_peserta where 1 = 1  " .
                      $SQLFilterSearch . 
                      " order by nama LIMIT $offset, $no_of_records_per_page";
                $r5 = $db_akses->OpenQuery($q5);

                #echo $q5  . "<br>";
                echo "Total Data : " . $total_rows . "<br>";



            ?>
                <a href="?pageno=1">First</a>|
                <?php if($pageno <= 1){ echo ''; } ?>
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"> Prev</a> |
                
                <?php if($pageno >= $total_pages){ echo ''; } ?>
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"> Next</a> |
                
                <a href="?pageno=<?php echo $total_pages; ?>">Last | </a>
                <a href="pendaftaran_list_export.php?pageno=<?php echo $pageno; ?>">Export Excel</a><br>
            <?php
                echo '<div style="overflow-x:auto;">
                <table border = 1 class="flyer" cellpadding="20" cellspacing="0" align="left" width="100%">
                <tr>
                <th width="20">No</th>
                    <th>Nama <br>Email</th>                    
                    <th>Jabatan</th>
                    <th>Tanggal Lahir</th>
                    <th>No KTP</th>
                    <th>No & <br>Tanggal SK PPAT</th>                    
                    <th>No & <br/>Tanggal BAS PPAT</th>
                    <th>No WA & Telp Kantor</th>
                </tr>';
                $Nomor = $offset;
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

                    $Nomor = $Nomor + 1;

                    echo '<tr>
                          <td rowspan=2>'.$Nomor.'</td>  
                          <td align="left">'.$row['nama'].'<br>' .$row['email']. '<br/><br/>
                            
                          </td>
                          <td align="left">'.$row['jabatan'].'</td>                          
                          <td align="left">'.$row['tgl_lahir'].'</td>
                          
                          <td align="left">'.$row['no_ktp'].'</td>
                          <td align="left">'.$row['no_sk_ppat'].'<br/>'.$row['tgl_sk_ppat'].'</td>
                          <td align="left">'.$row['no_bas_ppat'].'<br>'.$row['tgl_bas_ppat'].'</td>
                          <td align="left"><img src="data/icon/wa-icon.png">'.$row['no_wa'].'<br><img src="data/icon/phone-icon.png">'.$row['no_telp_kantor'].'</td>                        
                          
                          </tr>
                          <tr>
                          <td colspan=3 align="left"> '.$row['alamat_rumah'].'</td>
                          <td colspan=5 align="left"> 
                          <a href="pendaftaran_id_card.php?id_id_card='.$row['id'].'">ID Card</a> |
                          <a href="pendaftaran_certificate.php?id_id_certificate='.$row['id'].'">Certificate</a> |
                          <a href="pendaftaran_konfirmasi.php?id='.$row['id'].'">Konfirmasi</a> | 
                          <a href="pendaftaran_delete.php?id='.$row['id'].'">Hapus</a> | 
                          <a href="pendaftaran_set_as_admin.php?id='.$row['id'].'&status_admin='.$status_admin.'">'.$set_as_admin.'</a>
                          </td>
                          </tr>';                    
                }
                echo '</table>'; 
                echo '</div>';

                
                ?>

                        <a href="?pageno=1">First</a>|
                        <?php if($pageno <= 1){ echo ''; } ?>
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"> Prev</a> |
                        
                        <?php if($pageno >= $total_pages){ echo ''; } ?>
                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"> Next</a> |
                        
                        <a href="?pageno=<?php echo $total_pages; ?>">Last | </a>
                        <a href="pendaftaran_list_export.php?pageno=<?php echo $pageno; ?>">Export Excel</a>
                
            </div>    
        </div>
    </div>
</div>
<?php include "menu-footer.php";
    unset($db_akses);
?>
</body>
</html>