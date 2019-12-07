<?php 
    include "dbconfig.php";    
 
    $_SESSION['halaman_terakhir'] = 'pendaftaran_upload_file.php';

    if (isset($_SESSION['id']) == "") {    
        header('location: pendaftaran_login.php');    
    }
    
    $page_name = 'pendaftaran';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload File Seminar</title>
	</head>
	<body>	    

		<?php        

        #$db_akses = new db_akses();
        $peserta = new peserta();
		if($_POST['upload']){
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
            $nama = $_FILES['file']['name'];			
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
                    $nama = $_SESSION['id'] . "_" . $nama;
                    
                    $peserta->id = $_SESSION['id'];
                    $db_akses->LoadByID($peserta);

                    move_uploaded_file($file_tmp, 'data/'.$nama);

                    $jenisbayar=0;
                    
                    if ($_POST['jenis_dokumen'] == 'img_photo'){
                        $peserta->img_photo = $nama;
                    } elseif($_POST['jenis_dokumen'] == 'img_ktp'){
                        $peserta->img_ktp = $nama;
                    } elseif($_POST['jenis_dokumen'] == 'img_sk_ppat'){
                        $peserta->img_sk_ppat = $nama;
                    } elseif($_POST['jenis_dokumen'] == 'img_bas'){
                        $peserta->img_bas = $nama;
                    } elseif($_POST['jenis_dokumen'] == 'img_kartu_nama'){
                        $peserta->img_kartu_nama = $nama;
                    } elseif($_POST['jenis_dokumen'] == 'img_kwitansi'){
                        $peserta->img_kwitansi = $nama;
                        $jenisbayar=1;
                    } 

					if($db_akses->SaveToDB($peserta)){
						if($_POST['jenis_dokumen'] == 'img_kwitansi'){
                            $isi_email  = '';												
                            $isi_email .= "$nama Telah melakukan konfirmasi pembayaran<br/>";
                            $isi_email .= "Silahkan klik url dibawah ini untuk konfirmasi update pembayaran a.n. $nama <br>";
                            $isi_email .= "https://pengwilippatjateng.org/pendaftaran/pendaftaran_konfirmasi_pembayaran.php?id=$peserta->id";

                            #echo $isi_email;

                            $topik_email="Silahkan Update Status Pembayaran Peserta Seminar";
                            $nama_penerima=$nama;
                            $email_dari="ippat.jateng@pengwilippatjateng.org";
                            $email_dari_nama = "Panitia Seminar IPPAT Jawa Tengah";
                            $email_tujuan="bagusprasojo@gmail.com";
                            $email_cc="bagusprasojo@gmail.com";
                            include 'mail-smtp.php';
                                
                            if(!$mail->Send())
                            {
                            echo "Gagal mengirim data ke email, Silahkan ulangi kembali <p>";
                            echo "Mailer Error: " . $mail->ErrorInfo;                            
                            exit;
                            } else {            										
                                exit("<script>window.alert('Berhasil menyimpan data konfirmasi pembayaran, admin kami akan menindaklanjutinya, mohon ditunggu');
                                window.location='pendaftaran_upload_file.php?bayar=1';</script>");
                            }    
                        } else {                        
                            exit("<script>window.alert('Berhasil Upload Dokumen');
                            window.location='pendaftaran_upload_file.php?bayar=$jenisbayar';</script>");
                        }                        
					}else{
						exit("<script>window.alert('Gagal Upload Dokumen');
                            document.location.href='javascript:history.go(-1)';</script>");
					}
				}else{
					exit("<script>window.alert('Ukuran File terlalu Besar');
                        document.location.href='javascript:history.go(-1)';</script>");
				}
			}else{                
				exit("<script>window.alert('Ekstensi File Harus PNG / JPG');
                document.location.href='javascript:history.go(-1)';</script>");
			}
		}
		?>

        <?php 
            unset($db_akses);
            unset($peserta);
        ?>
	</body>
</html>