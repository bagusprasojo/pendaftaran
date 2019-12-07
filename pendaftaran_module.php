<?php
    include "dbconfig.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_module.php';

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
    	<div class="kiri">Download Materi Seminar</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>



<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">                
            <?php
                $q5 = "SELECT * FROM seminar_module where is_tampilkan= 1";
                $r5 = $db_akses->OpenQuery($q5);
                
                echo "<table>";
                echo "<tr><th>No</th><th>Judul</th></tr>";
                $iNomor = 0;
                while ($row = mysqli_fetch_array($r5, MYSQLI_ASSOC)) {                                        
                    $iNomor = $iNomor + 1;
                    echo "<tr>";
                    echo "<td width='30'>";
                    echo $iNomor;
                    echo "</td>";

                    echo "<td>";
                    echo "<a href='data/module/" .$row['nama']."' target=_blank>" . $row["nama"]. "</a>";
                    echo "</td>";
                    echo "</tr>";
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