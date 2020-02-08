<?php
	include "dbconfig.php";
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
    	<div class="kiri">Update Password</div>
        <div class="kanan"><a href="index.php">Beranda</a> / Update Password</div>
    </div>
</div>

<?php
	$peserta = new peserta();
	if (isset($_GET['id'])){
		$peserta->id = $_GET['id'];
		$db_akses->LoadByID($peserta);

	}

	if (isset($_POST['btn_update'])){
		$nama                   = $_POST['nama'];
		$email                  = $_POST['email'];
		$password               = $_POST['password1'];
		$konfirmasi_password    = $_POST['password2'];

		if ($password == $konfirmasi_password && $konfirmasi_password != '')
		{
			$peserta->id = $_POST['id'];
			$db_akses->LoadByID($peserta);
			$peserta->passw 				= md5($password);
			
			$result = $db_akses->SaveToDB($peserta);            
			if ($result){	
				
				exit("<script>window.alert('Berhasil ubah password');</script>");
				
				#header('location: pendaftaran_lengkap.php');
			} else {     
				#echo $peserta->generateSQLUpdate;
				#exit;       
				exit("<script>window.alert('Gagal ubah password');</script>");	
				header('location: pendaftaran_lupa_password.php?id='.$peserta->id);									        
			}
		} else {
			exit("<script>window.alert('Password belum diisi atau password tidak sama dengan konfirmasi password');
			document.location.href='javascript:history.go(-1)';</script>");
			
		}
	} else {	
?>
<div class="konten">
	<div class="container_25">
	    <div class="pendaftaran">        	
            <div class="bawah">
				<div class="kiri" >
					<form action="" method="post" onSubmit="return validasi()">     
						<input type="hidden" id="id" name="id" value="<?php echo $peserta->id?>">
                            
						<div class="area">                      
							<input type="text" name="nama" class="input_read_only" value="<?php echo $peserta->nama?>" readonly>
						</div>

						<div class="area">                      
							<input type="email" name="email" class="input_read_only" value="<?php echo $peserta->email?>" readonly>
						</div>

						<div class="area">                      
							<input type="password" name="password1" class="input" placeholder=" Password">
						</div>
						<div class="area">
							<input type="password" name="password2" class="input" placeholder=" Konfirmasi Password">
						</div>                    
						<div class="area">
							<input type="submit" name="btn_update" class="submit" value="Update">
						</div>
					</form>
				</div>
            </div>	
        </div>    
    </div>
</div>

<?php 
	}
	include "menu-footer.php";
	unset($peserta);
	unset($db_akses);
?>
</body>

<script type="text/javascript">
	function validasi() {
		var password1 = document.getElementById("password1").value;
        alert(password1);

		var password2 = document.getElementById("password2").value;		
        alert(password2);
       
		if (password1 != "" && password2 != "" && password1 == password2) {
			return true;
		}else{
			alert('Password dan Konfirmasi Password harus sama !');
			return false;
		}
	}
 
</script>

</html>
