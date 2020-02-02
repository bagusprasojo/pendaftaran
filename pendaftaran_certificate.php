<?php
    include "dbconfig.php";
    include "pendaftaran_image_utils.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_certificate.php';

    if (isset($_SESSION['id']) == "") {    
        header('location: pendaftaran_login.php');    
    }
    
    
$page_name = 'pendaftaran';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IKATAN PEJABAT PEMBUAT AKTA TANAH JAWA TENGAH</title>



</head>
<body>
    <?php
        

        function WordWrap_BP($AKata){
            $text_new = trim($AKata);

            $isSudahTurun = 0;
            if (strlen($text_new) >= 29) {
                $text_a = explode(' ', trim($text_new));
                
                $text_new = '';
                foreach($text_a as $word){
                    #$text_new = $text_new .' '.$word;
                    if(strlen($text_new .' '.$word) > 29 and $isSudahTurun == 0){
                        $text_new .= "\n".$word;
                        $isSudahTurun = 1;
                    } else {
                        $text_new .= $word . " ";
                    }
                }
            }
            
            return $text_new;
        }

        $peserta = new peserta();

        $id_id_certificate = isset($_GET['id_id_certificate']) ? $_GET['id_id_certificate'] : '';
        if ($id_id_certificate == ''){
            $peserta->id = $_SESSION['id'];
        } else {
            $peserta->id = $id_id_certificate;
        }

        $db_akses = new db_akses();
        $db_akses->LoadByID($peserta);

        if ($peserta->img_photo != '') {
            $photo = $peserta->img_photo;
        } else {
            $photo = "icon/place_holder.png";
        }
            
        # If you know your originals are of type PNG.

        //

        
        include "./phpqrcode/qrlib.php";
       
        $nama_qrcode = 'generate/'.$peserta->id.'.png'; 
        QRcode::png("http://pengwilippatjateng.org/pendaftaran/pendaftaran_display.php?display_id=".$peserta->id,$nama_qrcode,"M",4,4);
                                        
        $image = imagecreatefrompng($nama_qrcode);

        $destination = imagecreatetruecolor(600, 600);
        imagecopyresampled($destination, $image, 0, 0, 0, 0, 600, 600, 212, 212);


        $frame = imagecreatefromfile('generate/sertifikat.jpg');

        $filename               =  'data/'.$photo;
        $pasphoto               = imagecreatefromfile($filename);
        list($width, $height)   = getimagesize($filename); 

        $pasphoto_dest = imagecreatetruecolor(600, 600);
        imagecopyresampled($pasphoto_dest, $pasphoto, 0, 0, 0, 0, 600, 600, $width, $height);
        
        $panjang_frame = imagesx($frame);

        #imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct ) : bool
        imagecopymerge(   $frame           , $pasphoto_dest      ,    600                      , 600        , 0          , 0          , 600        , 600       , 100);
        imagecopymerge(   $frame           , $destination        ,    $panjang_frame - 1200    , 600        , 0          , 0          , 600        , 600       , 100);

        $black = imagecolorallocate($frame, 0, 0, 0);
        $start_x = 200;
        $start_y = 1000;
        

        #$font = 'https://pengwilippatjateng.org/pendaftaran/font/arial.TTF';
        $font = dirname(__FILE__) . '/font/arial.TTF';
        
        #putenv('GDFONTPATH=' . realpath('.'));
        #$font = "arialbd.ttf";
        
        #echo $font;

        $font_size = 110;
        

        $txt        = $peserta->nama;
        $bbox       = imagettfbbox($font_size, 0, $font, $txt);

        $center1    = ($panjang_frame / 2) - (($bbox[2] - $bbox[0]) / 2);
        
        Imagettftext($frame, $font_size, 0, $center1, 1650, $black, $font, $txt);

        $txt        = $peserta->fungsi;
        $bbox       = imagettfbbox($font_size, 0, $font, $txt);
        $center1    = ($panjang_frame / 2) - (($bbox[2] - $bbox[0]) / 2);
        
        Imagettftext($frame, $font_size, 0, $center1, 1950, $black, $font, $txt);
        
        

        $nama_id_certificate = 'generate/'. $peserta->id . '_certificate.jpg';
        imagejpeg($frame, $nama_id_certificate);

        if ($id_id_certificate != '' or $peserta->is_datang == '1'){
          echo "<img src= $nama_id_certificate height='75%' width='75%'/>";
        } else {
            echo "Anda Belum Berhak Mencetak Sertifikat";
        }

        # Output straight to the browser.
        #imagepng($frame);

        imagedestroy($frame);
        imagedestroy($image);
        imagedestroy($destination);
        imagedestroy($pasphoto_dest);

        unset($db_akses);
        unset($peserta);
    ?>
</body>

</html>



