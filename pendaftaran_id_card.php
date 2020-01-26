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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IKATAN PEJABAT PEMBUAT AKTA TANAH JAWA TENGAH</title>

<script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        //document.body.innerHTML = 
        //    "<html><head><title></title></head><body>" + 
        //    divElements + "</body></html>";

        //Print Page
        //alert(document.body.innerHTML);
        window.print();

        //Restore orignal HTML
        document.innerHTML = oldPage;

        
    }
</script>

<style>
  body{
  -webkit-print-color-adjust:exact;
}
 </style>

</head>
<body>
    <?php
        $peserta = new peserta();
        $peserta->id = $_SESSION['id'];

        $db_akses = new db_akses();
        $db_akses->LoadByID($peserta);

        if ($peserta->img_photo != '') {
            $photo = $peserta->img_photo;
        } else {
            $photo = "icon/place_holder.png";
        }
            
    ?>
    <form id="form1" runat="server">
    <div id="printablediv">
    <table style="background-color:#f1f6e0"  align="center">
                <tr><td><img src= "data/header.png" height="280" width="100%"></td></tr>
                <tr><td align="center">
                    <table style="font-weight:bold; font-size:20px" >                        
                        <tr><td><img src="<?php echo "data/" . $photo?>" height="148" width="131"></td><td></td>
                            <td>
                                <?php 
                                    include "phpqrcode/qrlib.php";
                                    QRcode::png("http://pengwilippatjateng.org/","qrcode.png","M",4,4);
                                    echo "<img src='qrcode.png'/>"

                                ?>
                            </td>
                        </tr>
                        <tr><td>Nama</td><td>:</td><td><?php echo $peserta->nama?></td></tr>
                        <tr><td>Provinsi</td><td>:</td><td><?php echo $peserta->propinsi?></td></tr>
                        <tr><td>Kabupaten</td><td>:</td><td><?php echo $peserta->kabupaten?></td></tr>
                        <tr><td>Jabatan</td><td>:</td><td><?php echo $peserta->jabatan?></td></tr>
                    </table>
                
                </td></tr>
                <tr><td><img src="data/footer.png"></td></tr>
            </table>
    </div>
    <div id="donotprintdiv" align="center">
        <br/>
        <input type="button" value="Cetak ID Card" onclick="javascript:printDiv('printablediv')" />
    </div>
    
    </form>

</html>