<?php

require_once("./PHPMailer/class.smtp.php");
require_once("./PHPMailer/class.phpmailer.php");

$mail = new PHPMailer();

// setting
$mail->IsSMTP();  // send via SMTP
$mail->Host     = "mail.pengwilippatjateng.org"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "noreply@pengwilippatjateng.org";  // SMTP username
$mail->Password = "soloweb1234mmb."; // SMTP password

// pengirim
$mail->From     = $email_dari;
$mail->FromName = $email_dari_nama;

// penerima
$mail->AddAddress($email_tujuan);
$mail->AddCC($email_cc);

// kirim balik
/*$mail->AddReplyTo("noreplay@jendelabook.com","Aryo Sanjaya");*/

$mail->WordWrap = 50;                              // set word wrap
/*$mail->AddAttachment(getcwd() . "./images/logo.png")*/;      // attachment
/*$mail->AddAttachment(getcwd() . "./images/keranjang.png", "./images/keranjang.png");*/
$mail->IsHTML(true);                               // send as HTML

$mail->Subject  =  $topik_email;
$mail->Body     =  $isi_email;
/*$mail->AltBody  =  "Hai";*/


?>
