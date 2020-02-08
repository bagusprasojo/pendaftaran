<?php
    include "dbconfig.php";
    $page_name = 'pendaftaran';
    $db_akses = new db_akses();
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

<?php
    if (isset($_POST['btn_reset'])) {?>
        <div class="konten">
            <div class="container_25">
                <div class="pendaftaran">        	
                    <div class="bawah">
                        <?php 
                            
                            $email = "";
                            if (isset($_POST['email'])){
                                $email = $_POST['email'];
                            }

                            if ($email != ''){
                                $peserta = new peserta();
                                $peserta->email = $email;

                                $db_akses->LoadByCode($peserta);
                                if ($peserta->id == ''){
                                    echo "Email <b>" . $email . "</b> Tidak Ditemukan !";
                                } else {
                                    $isi_email  = '';												
                                    $isi_email .= "Terimakasih $nama<br>";
                                    $isi_email .= "Anda telah mengajukan reset password<br>";
                                    $isi_email .= "Silahkan klik url dibawah ini untuk melakukan reset password : <br>";
                                    $isi_email .= "https://pengwilippatjateng.org/pendaftaran/pendaftaran_ubah_password.php?id=$peserta->id";

                                    #echo $isi_email;

                                    $topik_email="Reset Password Pendaftaran Online IPPAT Jawa Tengah";
                                    $nama_penerima=$nama;
                                    $email_dari="ippat.jateng@pengwilippatjateng.org";
                                    $email_dari_nama = "Admin Pendaftaran Online IPPAT Jawa Tengah";
                                    $email_tujuan="$email";
                                    $email_cc="bagusprasojo@gmail.com";
                                    include 'mail-smtp.php';
                                        
                                    if(!$mail->Send())
                                    {
                                    echo "Gagal mengirim data ke email, Silahkan ulangi kembali <p>";
                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                    exit;
                                    } else {            										
                                        exit("<script>window.alert('Berhasil , silahkan cek email anda untuk melakukan reset password');
                                        window.location='index.php';</script>");
                                    }

                                }
                            }
                        ?>
                    </div>	
                </div>    
            </div>
        </div>
    <?php } else {
?>
    <div class="atas-menu">
        <div class="container_25">
            <div class="kiri">Reset Password</div>
            <div class="kanan"><a href="index.php">Beranda</a> / Reset Password</div>
        </div>
    </div>

    <div class="konten">
        <div class="container_25">
            <div class="pendaftaran">        	
                <div class="bawah">
                    <div class="kiri">
                        <form action="" method="post" onSubmit="return validasi()">                    
                            <div class="area">                      
                                <input type="email" name="email" class="input" placeholder=" Email">
                            </div>
                            <div class="area">
                                <input type="submit" name = "btn_reset" class="submit" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>	
            </div>    
        </div>
    </div>

    <?php } ?>

<?php 
    include "menu-footer.php";

    unset($peserta);
    unset($db_akses);
?>

</body>

<script type="text/javascript">
	function validasi() {
		var email = document.getElementById("email").value;
        alert(email);

		if (email != "" ) {
			return true;
		}else{
			alert('Email harus di isi !');
			return false;
		}
	}
 
</script>

</html>
