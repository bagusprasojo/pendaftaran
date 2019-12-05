<?php $agenda_satu  = $db_akses->OpenQueryArray("SELECT * FROM arf_berita where publish='yes' ORDER BY tgl_input DESC LIMIT 1");?>
<?php $agenda_dua   = $db_akses->OpenQueryArray("SELECT * FROM arf_berita where id!='$agenda_satu[id]' and publish='yes' ORDER BY tgl_input DESC LIMIT 1");?>
<?php $kontak   = $db_akses->OpenQueryArray("SELECT * FROM arf_kontak");?>

<div class="alamat-bawah">
	<div class="container_24">
    	<div class="box">
        	<div class="atas">ALAMAT</div>
            <div class="bawah"><?php echo $kontak['alamat_bawah'];?></div>
        </div>
        <div class="box">
        	<div class="atas">TELEPON</div>
            <div class="bawah"><?php echo $kontak['notelp'];?></div>
        </div>
        <div class="box">
        	<div class="atas">WEBSITE</div>
            <div class="bawah"><?php echo $kontak['website'];?></div>
            <a href="https://www.facebook.com/profile.php?id=100013593810022&fref=ts" target="_blank"/><div class="sosmed"><img src="./images/ico-fb.png"></div></a>
        </div>
    </div>
</div>


<div class="link-terkait">
	<?php
        $link_sql = $db_akses->OpenQuery("select * from arf_linkterkait where publish='yes' order by id ASC");
        while($link=mysqli_fetch_array($link_sql)){	     
    ?>
    <a href="<?php echo $link['url_http'];?>" target="_blank"><img src="data/foto_berita/<?php echo $link['foto']; ?>" title="<? echo $link['nama']; ?>"></a>
    <?php } ?>
</div>

<div class="footer">
	<div class="container_24">
    	<div class="menu">
        	<a href="index.php" class="<?php if($page_name === 'home'){echo "active";}?>">Beranda</a>
            <a href="profil-2-Sambutan.Ketua.Pengwil.IPPAT.Jateng.html" class="<?php if($page_name === 'profil'){echo "active";}?>">Profil</a>
            <a href='keanggotaan.php'>Keanggotaan</a>
            <a href='agendaevent.php' class="<?php if($page_name === 'agendaevent'){echo "active";}?>">Agenda & Event</a>
            <a href='galeri.php' class="<?php if($page_name === 'galeri'){echo "active";}?>">Galeri</a>
            <a href='news.php' class="<?php if($page_name === 'news'){echo "active";}?>">News</a>
            <a href='kontak.php' class="<?php if($page_name === 'kontak'){echo "active";}?>">Kontak</a>
        </div>
        <div class="foot">
        	Copyright 2017 © Ikatan Pejabat Pembuat Akta Tanah Jawa Tengah. All rights reserved. This design is created by Soloweb   
        </div>
    </div>
</div>

<!--<div class="run-info">
	<marquee scrollamount="6" behavior="scroll" direction="left" onmouseover="this.setAttribute('scrollamount', 4, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);">
    	<p style="float:left; margin-right:250px;">Segenap jajaran Pengurus Wilayah Ikatan Pejabat Pembuat Akta Tanah Jawa Tengah Mengucapkan "SELAMAT IDUL FITRI" 1 Syawal 1439 H Minal Aidin Walfaidzin Mohon Maaf Lahir dan Batin</p>
        <p style="float:left; margin-right:250px;">Segenap jajaran Pengurus Wilayah Ikatan Pejabat Pembuat Akta Tanah Jawa Tengah Mengucapkan "SELAMAT IDUL FITRI" 1 Syawal 1439 H Minal Aidin Walfaidzin Mohon Maaf Lahir dan Batin</p>
        <p style="float:left; margin-right:250px;">Segenap jajaran Pengurus Wilayah Ikatan Pejabat Pembuat Akta Tanah Jawa Tengah Mengucapkan "SELAMAT IDUL FITRI" 1 Syawal 1439 H Minal Aidin Walfaidzin Mohon Maaf Lahir dan Batin</p>
	</marquee>
</div>-->