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
                        <?php 
                            if ($peserta->img_photo != '') {
                                $photo = $peserta->img_photo;
                            } else {
                                $photo = "icon/place_holder.png";
                            }
                        ?>
                        <img src="<?php echo "data/" . $photo?>" height="472" width="100%">
                        <div>
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
                        
                        <div>
                            <br>

                            <?php 
                                $sSQL = $peserta->generateSQLDaftarSeminar();
                                $rs = $db_akses->OpenQuery($sSQL);

                                echo '<div style="overflow-x:auto;">
                                <table border = 1 class="flyer" cellpadding="20" cellspacing="0" align="left" width="100%">
                                <tr>
                                <th width="20">No</th>
                                    <th>Seminar / Kegiatan</th> 
                                </tr>';

                                $Nomor = 0;
                                while ($row = mysqli_fetch_array ($rs, MYSQLI_ASSOC)) {
                                    $Nomor = $Nomor + 1;
                
                                    echo '<tr>
                                        <td>'.$Nomor.'</td>  
                                        <td align="left">'.$row['Seminar'].'</td>                          
                                        </tr>';                    
                                }
                                echo '</table>'; 
                                echo '</div>';
                            ?>
                        </div>
                    </div>
                    
                    <div class="kiri">
                        <form action="pendaftaran_lengkap_proses.php" method="post">
                            Nama Lengkap Dengan Gelar Akademik : <br>
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
                                Propinsi Jabatan PPAT: <br>    
                                <input type="text" value="<?php echo $peserta->propinsi?>" name="propinsi" class="input" placeholder=" Propinsi">
                            </div>

                            <div class="area">
                                Kabupaten / Kota Jabatan PPAT: <br>    
                                <input type="text" value="<?php echo $peserta->kabupaten?>" name="kabupaten" class="input" placeholder=" Kabupaten / Kota">
                            </div>

                            <div class="area">
                                Alamat Kantor : <br>
                                <textarea  name = "alamat_kantor" rows="3" cols="20"><?php echo $peserta->alamat_kantor?></textarea>
                            </div>

                            <div class="area">
                                Alamat Rumah : <br>
                                <textarea  name = "alamat_rumah" rows="3" cols="20"><?php echo $peserta->alamat_rumah?></textarea>
                            </div>
                            
                            <div class="area">
                                Peserta / Panitia : <br>    
                                <select class="input" name="fungsi">
                                    <option value="Peserta" <?php if ($peserta->fungsi == "Peserta") {echo "selected";} ?>>Peserta</option>
                                    <option value="Panitia" <?php if ($peserta->fungsi == "Panitia") {echo "selected";} ?>>Panitia</option>                                    
                                </select>
                            </div>

                            <div class="area">
                                Jabatan : <a href='https://pengwilippatjateng.org/pendaftaran/data/module/004%2021%2012%2019%20Penyusunan%20ProKer%20Pengwil%20IPPAT%20Jateng%20v%2003022020.pdf' target="_blank"> Lihat Daftar Jabatan</a><br>    
                                <input type="text" value="<?php echo $peserta->jabatan?>" name="jabatan" class="input" placeholder=" Jabatan">
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
                                <input type="date"  value="<?php echo $peserta->tgl_sk_ppat?>" name="tgl_sk_ppat" class="input" >
                            </div>
                            
                            <div class="area">                            
                                No Berita Acara Sumpah PPAT : <br>
                                <input type="text" value="<?php echo $peserta->no_bas_ppat?>" name="no_bas_ppat" class="input" placeholder=" No Berita Acara Sumpah PPAT">
                            </div>
                            
                            <div class="area">                            
                                Tanggal Berita Acara Sumpah PPAT :<br>
                                <input type="date" value="<?php echo $peserta->tgl_bas_ppat?>" name="tgl_bas_ppat" class="input" >
                            </div>                       

                            <div class="area">                            
                                No WA : <br>
                                <input type="text" value="<?php echo $peserta->no_wa?>" name="no_wa" class="input" placeholder=" No Whatsapp">
                            </div>

                            <div class="area">                            
                                No Telp Kantor : <br>
                                <input type="text" value="<?php echo $peserta->no_telp_kantor?>" name="no_telp_kantor" class="input" placeholder=" No Telp Kantor">
                            </div>

                            Dimohon mengisi data dengan benar, kesalahan data bukan tanggung jawab panitia<br/><br/>
                            

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
