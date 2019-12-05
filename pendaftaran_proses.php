<?php

include "dbconfig.php";

date_default_timezone_set('Asia/jakarta');

$nama                   = $_POST['nama'];
$email                  = $_POST['email'];
$password               = $_POST['password'];
$konfirmasi_password    = $_POST['konfirmasi_password'];
$tgl_input              = date("Y-m-d H:i:s");
$tgl_waktu              = date('H:i');

if ($nama=='' or $email=='' or $password=='' or $konfirmasi_password=='')
{
    exit("<script>window.alert('Silahkan isi semua data terlebih dahulu');
    document.location.href='javascript:history.go(-1)';</script>");
} elseif ($password != $konfirmasi_password){
    exit("<script>window.alert('Password dan Konfirmasi Password Tidak Sama');
	document.location.href='javascript:history.go(-1)';</script>");
} else { 
    if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) 
    {
        exit("<script>window.alert('Maaf email anda kurang lengkap');
            document.location.href='javascript:history.go(-1)';</script>");
    } 
    else 
    {   
        $peserta = new peserta();
        $peserta->email = $email;        

        if ($db_akses->isEmailSudahAda($peserta)){
            exit("<script>window.alert('Email sudah dipakai');
            document.location.href='javascript:history.go(-1)';</script>");
        } else {

            $peserta->nama      = $nama;
            $peserta->tgl_input = $tgl_input;
            $peserta->is_admin  = 0;
            $peserta->passw     = md5($password);

            $result = $db_akses->SaveToDB($peserta);            
            if ($result)
            {										
                $isi_email  = '';												
                $isi_email .= "Terimakasih $nama<br>";
                $isi_email .= "Anda Telah mendaftar seminar online kami<br>";
                $isi_email .= "Silahkan klik url dibawah ini untuk konfirmasi pendaftaran anda : <br>";
                $isi_email .= "https://pengwilippatjateng.org/pendaftaran/pendaftaran_konfirmasi.php?id=$peserta->id";

                #echo $isi_email;

                $topik_email="Konfirmasi Pendaftaran Online IPPAT Jawa Tengah";
                $nama_penerima=$nama;
                $email_dari="ippat.jateng@pengwilippatjateng.org";
                $email_dari_nama = "Panitia Seminar IPPAT Jawa Tengah";
                $email_tujuan="$email";
                $email_cc="bagusprasojo@gmail.com";
                include 'mail-smtp.php';
                    
                if(!$mail->Send())
                {
                echo "Gagal mengirim data ke email, Silahkan ulangi kembali <p>";
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
                } else {            										
                    exit("<script>window.alert('Berhasil menyimpan data pendaftaran, silahkan cek email anda untuk melakukan konfirmasi');
                    window.location='index.php';</script>");
                }
            } else {            
                exit("<script>window.alert('Insert Failed, Please Try Again');
                document.location.href='javascript:history.go(-1)';</script>");												        
            }

            unset($peserta);
            unset($db_akses);
        }
    }
}
?>