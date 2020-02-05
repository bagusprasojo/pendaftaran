
<div class="header">
	<div class="container_24">
    	<div class="menu-mobile">
        <div class="menu-mobile"><a href="#menumob"></a></div>
        	<nav id="menumob">
            	<ul>
                	
                <li class="<?php if($page_name === 'home'){echo "active";}?>"><a href='../index.php'><span>IPPAT</span></a></li>                    
                    <li class="<?php if($page_name === 'home'){echo "active";}?>"><a href='index.php'><span>Beranda</span></a></li>                    

                    <?php if(isset($_SESSION['id'])=='') {  ?>
                        <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_login.php'><span>Login</span></a></li>
                        
                	</li>
                    <?php } else { ?>                        
                        <li class="has-sub"><a href='#'><span>Peserta</span></a>
                            <ul>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_lengkap.php'><span>Update Data Pribadi</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=0'><span>Upload Dokumen Peserta</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=1'><span>Upload Dok. Pembayaran</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_id_card.php'><span>Cetak Kartu Peserta</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_certificate.php'><span>Cetak Certificate</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_module.php'><span>Download Materi</span></a></li>
                            </ul>
                        </li>
                        
                        <?php if($_SESSION['is_admin']=='1') {  ?>
                            <li class="has-sub"><a href='#'><span>Administrator</span></a>
                                <ul>
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_list.php'><span>Daftar Peserta</span></a></li>
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_list_konfirmasi.php'><span>Update Status Pembayaran Peserta</span></a></li>                                    
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=2'><span>Upload File Module</span></a></li>                                    
                                </ul>
                            </li>
                        <?php }?>


                        <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_logout.php'><span>Logout [<?php echo $_SESSION['name'] ?>]</span></a></li>
                    <?php } ?>

                </ul>
            </nav>
        </div>
        <?php $logo=$db_akses->OpenQueryArray("SELECT * FROM arf_logoadmin where id='1'");?>
    	<div class="logo"><a href="index.php"><img src="./data/foto_berita/<?php echo $logo['foto']; ?>"></a></div>
        
        
        
        
        <div class="login">
            	<div class="logo-log"><img src="images/logo-putih.png"></div>
                	<form action="keanggotaan-login-act.php" method="post">
                        <input type="text" name="email" class="input" placeholder=" Username">
                        <input type="password" name="password" class="input" placeholder=" Password">
                        <input type="submit" class="submit" value="MASUK">
                    </form>
                <div class="mask2"></div>
        </div>
        
        
        <div class="menu">
        	<div id='cssmenu'>
            	<ul>
                	<li class="<?php if($page_name === 'home'){echo "active";}?>"><a href='../index.php'><span>IPPAT</span></a></li>                    
                    <li class="<?php if($page_name === 'home'){echo "active";}?>"><a href='index.php'><span>Beranda</span></a></li>                    

                    <?php if(isset($_SESSION['id'])=='') {  ?>
                        <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_login.php'><span>Login</span></a></li>
                        
                	</li>
                    <?php } else { ?>                        
                        <li class="has-sub"><a href='#'><span>Peserta</span></a>
                            <ul>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_lengkap.php'><span>Update Data Pribadi</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=0'><span>Upload Dokumen Peserta</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=1'><span>Upload Dok. Pembayaran</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_id_card.php'><span>Cetak Kartu Peserta</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_certificate.php'><span>Cetak Certificate</span></a></li>
                                <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_module.php'><span>Download Materi</span></a></li>
                            </ul>
                        </li>
                        
                        <?php if($_SESSION['is_admin']=='1') {  ?>
                            <li class="has-sub"><a href='#'><span>Administrator</span></a>
                                <ul>
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_list.php'><span>Daftar Peserta</span></a></li>
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_list_konfirmasi.php'><span>Update Status Pembayaran Peserta</span></a></li>                                    
                                    <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_upload_file.php?bayar=2'><span>Upload File Module</span></a></li>                                    
                                </ul>
                            </li>
                        <?php }?>


                        <li class="<?php if($page_name === 'keanggotaan'){echo "active";}?>"><a href='pendaftaran_logout.php'><span>Logout [<?php echo $_SESSION['name'] ?>]</span></a></li>
                    <?php } ?>

                    
                    
                    
            	</ul>
        	</div>
        </div>
    </div>
</div>
