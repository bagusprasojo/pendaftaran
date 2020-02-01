<?php
    include "dbconfig.php";

    $_SESSION['halaman_terakhir'] = 'pendaftaran_id_card.php';

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
        function imagecreatefromfile( $filename ) {
            if (!file_exists($filename)) {
                throw new InvalidArgumentException('File "'.$filename.'" not found.');
            }
            switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
                case 'jpeg':
                case 'jpg':
                    return imagecreatefromjpeg($filename);
                break;
        
                case 'png':
                    return imagecreatefrompng($filename);
                break;
        
                case 'gif':
                    return imagecreatefromgif($filename);
                break;
        
                default:
                    throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
                break;
            }
        }

        function WordWrap_BP($AKata){
            $text_new = trim($AKata);

            $isSudahTurun = 0;
            if (strlen($text_new) >= 28) {
                $text_a = explode(' ', trim($text_new));
                
                $text_new = '';
                foreach($text_a as $word){
                    #$text_new = $text_new .' '.$word;
                    if(strlen($text_new .' '.$word) > 28 and $isSudahTurun == 0){
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

        $id_id_card = isset($_GET['id_id_card']) ? $_GET['id_id_card'] : '';
        if ($id_id_card == ''){
            $peserta->id = $_SESSION['id'];
        } else {
            $peserta->id = $id_id_card;
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

        $destination = imagecreatetruecolor(300, 300);
        imagecopyresampled($destination, $image, 0, 0, 0, 0, 300, 300, 212, 212);

        $frame = imagecreatefrompng('generate/id_card.png');

        $filename               =  'data/'.$photo;
        $pasphoto               = imagecreatefromfile($filename);
        list($width, $height)   = getimagesize($filename); 

        $pasphoto_dest = imagecreatetruecolor(300, 300);
        imagecopyresampled($pasphoto_dest, $pasphoto, 0, 0, 0, 0, 300, 300, $width, $height);
        
        #imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct ) : bool
        imagecopymerge(   $frame           , $pasphoto_dest      ,    200      , 650         , 0          , 0          , 300        , 300       , 100);
        imagecopymerge(   $frame           , $destination        ,    600      , 650         , 0          , 0          , 300        , 300       , 100);

        $black = imagecolorallocate($frame, 0, 0, 0);
        $start_x = 200;
        $start_y = 1000;
        

        #$font = 'https://pengwilippatjateng.org/pendaftaran/font/arial.TTF';
        $font = dirname(__FILE__) . '/font/arial.TTF';
        
        #putenv('GDFONTPATH=' . realpath('.'));
        #$font = "arialbd.ttf";
        
        #echo $font;

        $font_size = 26;

        
        Imagettftext($frame, $font_size, 0, $start_x, $start_y, $black, $font, "Nama");
        Imagettftext($frame, $font_size, 0, $start_x + 200, $start_y  , $black, $font, ":");
        
        // $text_new = $peserta->nama;

        // $isSudahTurun = 0;
        // if (strlen($peserta->nama) >= 29) {
        //     $text_a = explode(' ', trim($peserta->nama));
            
        //     $text_new = '';
        //     foreach($text_a as $word){
        //         #$text_new = $text_new .' '.$word;
        //         if(strlen($text_new .' '.$word) > 29 and $isSudahTurun == 0){
        //             $text_new .= "\n".$word;
        //             $isSudahTurun = 1;
        //         } else {
        //             $text_new .= " ".$word;
        //         }
        //     }
        // } 

        Imagettftext($frame, $font_size, 0, $start_x + 220, $start_y  , $black, $font, WordWrap_BP($peserta->nama));

        if (strlen(trim($peserta->nama)) >= 28) {
            $start_y = $start_y + 50;
        }
        
        $start_y = $start_y + 50;
        Imagettftext($frame, $font_size, 0, $start_x, $start_y, $black, $font, "Provinsi");
        Imagettftext($frame, $font_size, 0, $start_x + 200, $start_y, $black, $font, ":");
        Imagettftext($frame, $font_size, 0, $start_x + 220, $start_y, $black, $font, $peserta->propinsi);
        
        $start_y = $start_y + 50;
        Imagettftext($frame, $font_size, 0, $start_x, $start_y, $black, $font, "Kabupaten");
        Imagettftext($frame, $font_size, 0, $start_x + 200, $start_y, $black, $font, ":");
        Imagettftext($frame, $font_size, 0, $start_x + 220, $start_y, $black, $font, $peserta->kabupaten);

        $start_y = $start_y + 50;
        Imagettftext($frame, $font_size, 0, $start_x, $start_y, $black, $font, "Jabatan");
        Imagettftext($frame, $font_size, 0, $start_x + 200, $start_y, $black, $font, ":");
        Imagettftext($frame, $font_size, 0, $start_x + 220, $start_y, $black, $font, WordWrap_BP($peserta->jabatan));

        # Save the image to a file

        $nama_id_card = 'generate/'. $peserta->id . '_idcard.png';
        imagepng($frame, $nama_id_card);
        echo "<img src= $nama_id_card />";

        # Output straight to the browser.
        #imagepng($frame);

        imagedestroy($frame);
        imagedestroy($image);

        unset($db_akses);
        unset($peserta);
    ?>
</body>

</html>



