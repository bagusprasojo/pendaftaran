<?php 
    include "dbconfig.php";    
 
    $_SESSION['halaman_terakhir'] = 'pendaftaran_lengkap.php';

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
    	<div class="kiri">Data Pribadi Peserta</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Pendaftaran</div>
    </div>
</div>

<?php 
    $peserta = new peserta();
    $peserta->id = $_SESSION['id'];

    $db_akses = new db_akses();
    $db_akses->LoadByID($peserta);
    #echo 'Nama' . $peserta->nama;
    #Exit;

    #$sql = "SELECT * FROM seminar_peserta WHERE is_konfirmasi = 1 and id = '".$_SESSION['id'] . "'";
    #$l_peserta = mysqli_fetch_array(mysqli_query($link,$sql));
?>
    <div class="konten">
        <div class="container_25">
            <div class="pendaftaran">        	
                <div class="bawah">
                    <?php
                        if ($peserta->is_admin != '1' and $peserta->is_pembayaran_ok != '1'){
                            include "info_pembayaran.php";
                        }
                    ?>
                    <div class="kanan">
                        <img src="<?php echo "data/" . $peserta->img_photo?>" height="472" width="100%">
                        
                        <table >
                            <?php if ($peserta->img_ktp != ''){ ?>
                                <tr><td><a href="<?php echo "data/" . $peserta->img_ktp?>">KTP</a></td><td> : </td><td><img src="data/icon/ok-icon.png"></td></tr>
                            <?php } else { ?>
                                <tr><td>KTP</td><td> : </td><td><img src="data/icon/nok-icon.png"></td></tr>
                            <?php } ?>    

                            <?php if ($peserta->img_sk_ppat != ''){ ?>
                                <tr><td><a href="<?php echo "data/" . $peserta->img_sk_ppat?>">SK PPAT</a></td><td> : </td><td><img src="data/icon/ok-icon.png"></td></tr>
                            <?php } else { ?>
                                <tr><td>SK PPAT</td><td> : </td><td><img src="data/icon/nok-icon.png"></td></tr>
                            <?php } ?>    

                            <?php if ($peserta->img_bas != ''){ ?>
                                <tr><td><a href="<?php echo "data/" . $peserta->img_bas?>">BAS PPAT</a></td><td> : </td><td><img src="data/icon/ok-icon.png"></td></tr>
                            <?php } else { ?>
                                <tr><td>BAS PPAT</td><td> : </td><td><img src="data/icon/nok-icon.png"></td></tr>
                            <?php } ?>    
                            <?php if ($peserta->img_kartu_nama != ''){ ?>
                                <tr><td><a href="<?php echo "data/" . $peserta->img_kartu_nama?>">Kartu Nama</a></td><td> : </td><td><img src="data/icon/ok-icon.png"></td></tr>
                            <?php } else { ?>
                                <tr><td>Kartu Nama</td><td> : </td><td><img src="data/icon/nok-icon.png"></td></tr>
                            <?php } ?>    
                            <?php if ($peserta->img_kwitansi != ''){ ?>
                                <tr><td><a href="<?php echo "data/" . $peserta->img_kwitansi?>">Kwitansi Pembayaran</a></td><td> : </td><td><img src="data/icon/ok-icon.png"></td></tr>
                            <?php } else { ?>
                                <tr><td>Kwitansi Pembayaran</td><td> : </td><td><img src="data/icon/nok-icon.png"></td></tr>
                                <tr><td></td><td></td></tr>
                            <?php } ?>    
                        </table>
                    </div>
                    <div class="kiri">
                        <form action="pendaftaran_lengkap_proses.php" method="post">
                            Nama : <br>
                            <div class="area">                            
                                <input type="text" value="<?php echo $peserta->nama?>" name="nama" class="input" placeholder=" Nama Lengkap Sesuai KTP & Gelar">
                            </div>

                            Tempat Lahir :<br>
                            <div class="area">
                                <input type="text" value="<?php echo $peserta->tempat_lahir?>" name="tempat_lahir" class="input" placeholder=" Tempat Lahir">
                            </div>

                            Tanggal Lahir :<br>
                            <div class="area">
                                <input type="date" value="<?php echo $peserta->tgl_lahir?>" name="tgl_lahir" class="input" placeholder=" Tanggal Lahir">
                            </div>
                
                            <div class="area">
                                Alamat Rumah : <br>
                                <textarea  name = "alamat_rumah" rows="3" cols="20"><?php echo $peserta->alamat_rumah?></textarea>
                            </div>
                            
                            <div class="area">
                                No KTP : <br>    
                                <input type="text" value="<?php echo $peserta->no_ktp?>" name="no_ktp" class="input" placeholder=" No KTP">
                            </div>

                            <div class="area">                            
                                NO SK PPAT : <br>
                                <input type="text" value="<?php echo $peserta->no_sk_ppat?>" name="no_sk_ppat" class="input" placeholder=" No SK PPAT">
                            </div>
                            
                            <div class="area">                            
                                Tanggal SK PPAT :<br>
                                <input type="date"  value="<?php echo $peserta->tanggal_sk_ppat?>" name="tanggal_sk_ppat" class="input" >
                            </div>
                            
                            <div class="area">                            
                                No Berita Acara Sumpah PPAT : <br>
                                <input type="text" value="<?php echo $peserta->no_bas_ppat?>" name="no_bas_ppat" class="input" placeholder=" No Berita Acara Sumpah PPAT">
                            </div>
                            
                            <div class="area">                            
                                Tanggal Berita Acara Sumpah PPAT :<br>
                                <input type="date" value="<?php echo $peserta->tanggal_bas_ppat?>" name="tanggal_bas_ppat" class="input" >
                            </div>                       

                            <div class="area">                            
                                No WA : <br>
                                <input type="text" value="<?php echo $peserta->no_wa?>" name="no_wa" class="input" placeholder=" No Whatsapp">
                            </div>

                            <div class="area">                            
                                No Telp Kantor : <br>
                                <input type="text" value="<?php echo $peserta->no_telp_kantor?>" name="no_telp_kantor" class="input" placeholder=" No Telp Kantor">
                            </div>

                            <div class="area">
                                <input type="submit" class="submit" value="UPDATE">
                            </div>
                        </form>
                    </div>
                </div>	
            </div>    
        </div>
    </div>
<?php include "menu-footer.php";?>
<?php
  unset($db_akses);
  unset($peserta);
?>

</body>
</html>
