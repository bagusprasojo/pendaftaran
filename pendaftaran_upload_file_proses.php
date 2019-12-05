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
			$img_photo = $_FILES['file']['name'];
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
                    } 

					if($db_akses->SaveToDB($peserta)){
						if($_POST['jenis_dokumen'] == 'img_kwitansi'){
                                
                        } else {                        
                            exit("<script>window.alert('Berhasil Upload Dokumen');
                            window.location='pendaftaran_upload_file.php';</script>");
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