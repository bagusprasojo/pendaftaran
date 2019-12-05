<?php
    include "./model/peserta.php";

    session_start();

    class db_akses{
        private $link;
        
        function __construct(){
            $this->link = mysqli_connect('localhost', 'pengwili_ippat', 'F]I[uPmVvyQ3', 'pengwili_ippat');
        }
        
        function isEmailSudahAda(peserta $AObject){
            $sSQL = "SELECT * FROM peserta WHERE email = '$AObject->email' and id = <> '$AObject->id'";
            #echo $sSQL;
            $l_peserta = mysqli_fetch_array(mysqli_query($this->link,$sSQL));
            if ($l_peserta['id'] != ''){
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function mysqli_real_escape_string($AString){
            return mysqli_real_escape_string($this->link,$AString);
        }

        function OpenQuery($ASQL){
            return mysqli_query($this->link,$ASQL);    
        }

        function ExecuteQuery($ASQL){
            $query = mysqli_query($this->link,$ASQL);    
            if($query){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function OpenQueryArray($ASQL){
            return mysqli_fetch_array(mysqli_query($this->link,$ASQL));    
        }

        function LoadByID(peserta &$AObject){
            $sSQL = "SELECT * FROM " . $AObject->tablename . " WHERE id = '$AObject->id'";
            $l_peserta = $this->OpenQueryArray($sSQL);
            if ($l_peserta['id'] != ''){
                $AObject->id                = $l_peserta['id'];

                $AObject->is_admin          = $l_peserta['is_admin'];
                $AObject->nama              = $l_peserta['nama'];
                $AObject->email             = $l_peserta['email'];
                $AObject->tempat_lahir      = $l_peserta['tempat_lahir'];
                $AObject->tgl_lahir         = $l_peserta['tgl_lahir'];
                $AObject->alamat_rumah      = $l_peserta['alamat_rumah'];
                $AObject->no_ktp            = $l_peserta['no_ktp'];
                $AObject->no_sk_ppat        = $l_peserta['no_sk_ppat'];

                $AObject->tanggal_sk_ppat   = $l_peserta['tanggal_sk_ppat'];
                $AObject->no_bas_ppat       = $l_peserta['no_bas_ppat'];
                $AObject->tanggal_bas_ppat  = $l_peserta['tanggal_bas_ppat'];
                $AObject->no_wa             = $l_peserta['no_wa'];
                $AObject->no_telp_kantor    = $l_peserta['no_telp_kantor'];

                $AObject->img_photo         = $l_peserta['img_photo'];
                $AObject->img_ktp           = $l_peserta['img_ktp'];
                $AObject->img_sk_ppat       = $l_peserta['img_sk_ppat'];
                $AObject->img_bas           = $l_peserta['img_bas'];
                $AObject->img_kartu_nama    = $l_peserta['img_kartu_nama'];
                $AObject->img_kwitansi      = $l_peserta['img_kwitansi'];
                $AObject->is_pembayaran_ok  = $l_peserta['is_pembayaran_ok'];

            }
        }

        function SaveToDB(DAO $AObject ){
            if ($AObject->id == '') {
                $query = $AObject->generateSQLInsert();
            } else {
                $query = $AObject->generateSQLUpdate();
            }

            #echo $query;
    
            $result = mysqli_query($this->link,$query);
            if ($result){            
                return TRUE;
            } else {
                return FALSE;
            }
        
        }
    
        function DeleteFromDB(DAO $AObject ){           
    
            $query = $AObject->generateSQLDelete();
            $result = mysqli_query($link,$query);
            if ($result){
                return TRUE;
            } else {
                return FALSE;
            }        
        }
    }
    

    
     
?>