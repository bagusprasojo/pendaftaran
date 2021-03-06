<?php
    function getCoordinateForCenter(resource $image,float $size , float $angle , string $fontfile , string $text){
        $bbox       = imagettfbbox($size, $angle, $fontfile, $text);
        $center     = (imagesx($image) / 2) - (($bbox[2] - $bbox[0]) / 2);

        return $center;
    }

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
?>