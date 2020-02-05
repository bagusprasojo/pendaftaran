<?php
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pegawai". $pageno .".xls");
    

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



<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">                

            <?php
                

                $no_of_records_per_page = 25;
                $offset = ($pageno-1) * $no_of_records_per_page; 

                $total_pages_sql = "SELECT COUNT(*) FROM seminar_peserta";
                $result = $db_akses->OpenQuery($total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $q5 = "SELECT * FROM seminar_peserta  order by nama LIMIT $offset, $no_of_records_per_page";
                $r5 = $db_akses->OpenQuery($q5);

                #echo "Total Data : " . $total_rows . "<br>";
                echo '<div style="overflow-x:auto;">
                <table border = 1 class="flyer" cellpadding="20" cellspacing="0" align="left" width="100%">
                <tr>
                <th width="20">No</th>
                    <th>Nama</th>
                    <th>Email</th>                    
                    <th>Jabatan</th>
                    <th>Tanggal Lahir</th>
                    <th>No KTP</th>
                    <th>Alamat</th>                    
                    <th>No SK PPAT</th>
                    <th>Tanggal SK PPAT</th>                    
                    <th>No BAS PPAT </th>
                    <th>Tanggal BAS PPAT</th>
                    <th>No WA</th> 
                    <th>Telp Kantor</th>
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
                          <td>'.$Nomor.'</td>  
                          <td align="left">'.$row['nama'].'</td>
                          <td align="left">'.$row['email']. '</td>
                          <td align="left">'.$row['jabatan'].'</td>                          
                          <td align="left">'.$row['tgl_lahir'].'</td>
                          
                          <td align="left">'.$row['no_ktp'].'</td>
                          <td align="left">'.$row['alamat_rumah'].'</td>
                          <td align="left">'.$row['no_sk_ppat'].'</td>
                          <td align="left">'.$row['tgl_sk_ppat'].'</td>
                          <td align="left">'.$row['no_bas_ppat'].'</td>
                          <td align="left">'.$row['tgl_bas_ppat'].'</td>
                          <td align="left">'.$row['no_wa'].'</td>
                          <td align="left">'.$row['no_telp_kantor'].'</td>                        
                          
                          ';                    
                }
                echo '</table>'; 
                echo '</div>';

                
                ?>

                        
                
            </div>    
        </div>
    </div>
</div>
<?php 
    unset($db_akses);
?>
</body>
</html>