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

<?php
    $email = "";
    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if ($email != ""){?>
        <div class="konten">
            <div class="container_25">
                <div class="pendaftaran">        	
                    <div class="bawah">
                        <?php echo $email?>
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
                                <input type="submit" class="submit" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>	
            </div>    
        </div>
    </div>

    <?php } ?>

<?php include "menu-footer.php";?>
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
