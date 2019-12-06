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
        $module = new module();
		if($_POST['upload']){
            $ekstensi_diperbolehkan	= array('xls','xlsx','doc','docx','pdf');
            $nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];	
            
            #echo $file_tmp . "<br>";
            #echo $nama . "<br>";

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 1044070){			                
                    move_uploaded_file($file_tmp, 'data/module/'.$nama);
                    $module->nama           = $nama;                        
                    $module->is_tampilkan   = 1;
                } else {
                    exit("<script>window.alert('Ukuran File terlalu Besar');
                        document.location.href='javascript:history.go(-1)';</script>");
                }

                if($db_akses->SaveToDB($module)){
                    exit("<script>window.alert('Berhasil Upload Dokumen Module');
                        window.location='pendaftaran_upload_file.php?bayar=2';</script>");
                } else {                        
                    exit("<script>window.alert('Berhasil Upload Dokumen');
                    window.location='pendaftaran_upload_file.php?bayar=2';</script>");
                }                        
            } else {
                exit("<script>window.alert('Hanya boleh mengupload file PDF, Excel, atau Word');
                document.location.href='javascript:history.go(-1)';</script>");
            }
		}
		?>

        <?php 
            unset($db_akses);
            unset($module);
        ?>
	</body>
</html>