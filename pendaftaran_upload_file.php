<?php
    include "dbconfig.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_upload_file.php';

    if (isset($_SESSION['id']) == "") {    
        header('location: pendaftaran_login.php');    
    }

    $peserta = new peserta();
    $peserta->id = $_SESSION['id'];
    $db_akses->LoadByID($peserta);

    $page_name = 'pendaftaran';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IKATAN PEJABAT PEMBUAT AKTA TANAH JAWA TENGAH</title>
<?php include "script.html";?>
</head>
<body>
<?php include "menu-header.php";?>

<div class="atas-menu">
	<div class="container_25">
    	<div class="kiri">Upload Dokumen</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Upload File</div>
    </div>
</div>

<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">
                    <?php
                        if ($peserta->is_admin != '1' and $peserta->is_pembayaran_ok != '1'){
                            include "info_pembayaran.php";
                        }
                    ?>

                <div class="kiri">
                    <?php
                        $bayar = $db_akses->mysqli_real_escape_string($_GET['bayar']); 
                        $FileProsesUpload = "pendaftaran_upload_file_proses.php";
                        if ($bayar == '2'){
                            $FileProsesUpload = "pendaftaran_upload_file_module_proses.php";
                        }
                    ?>
                    <form action="<?php echo $FileProsesUpload?>" method="post" enctype="multipart/form-data">
                        Jenis Dokumen : <br>
                        <div class="area">                            
                            <select class="input" name="jenis_dokumen">
                                <?php                                    
                                    if ($bayar == '0') {
                                ?>
                                    <option value="img_photo">Pas Photo</option>
                                    <option value="img_ktp">KTP</option>
                                    <option value="img_sk_ppat">SK PPAT</option>
                                    <option value="img_bas">BA PPAT</option>
                                    <option value="img_kartu_nama">Kartu Nama</option>
                                <?php
                                    } elseif ($bayar == '1'){
                                ?>
                                    <option value="img_kwitansi">Kwitansi Pembayaran</option>

                                <?php
                                    } elseif ($bayar == '2' and $peserta->is_admin == '1'){
                                        ?>
                                            <option value="img_module">Module Seminar</option>
        
                                        <?php
                                            }                                        
                                        ?>                                        
                                ?>
                                
                            </select> 
                        </div>

                        <div class="area">                            
                            <input type="file" name="file">
                        </div>

                        <div class="area">
                            <input type="submit" name="upload" value="Upload">
                        </div>                
                    </form>
                </div>
            </div>	
        </div>    
    </div>
</div>

<?php include "menu-footer.php";?>
</body>

</html>
