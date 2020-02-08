<?php
    include "./model/peserta.php";

    session_start();

    class db_akses{
        private $link;
        
        function __construct(){
            $this->link = mysqli_connect('localhost', 'pengwili_ippat', 'F]I[uPmVvyQ3', 'pengwili_ippat');
        }

        function __destruct() {
            mysqli_close($this->link);
        }
        
        function isEmailSudahAda(peserta $AObject){
            $sSQL = "SELECT * FROM peserta WHERE UPPER(email) = '. strtoupper($AObject->email) . ' and id = <> '$AObject->id'";
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

        function ExecuteQuery($ASQL){
            #echo $ASQL;
            $query = mysqli_query($this->link,$ASQL);    
            if($query){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        function OpenQuery($ASQL){
            return mysqli_query($this->link,$ASQL);    
        }

        
        function OpenQueryArray($ASQL){
            return mysqli_fetch_array(mysqli_query($this->link,$ASQL));    
        }

        function LoadByID(peserta &$AObject){
            $sSQL = "SELECT * FROM " . $AObject->tablename . " WHERE id = '$AObject->id'";
            $l_ObjectArray = $this->OpenQueryArray($sSQL);
            $AObject->LoadObject($l_ObjectArray);            
        }

        function LoadByCode(peserta &$AObject){
            $sSQL = "SELECT * FROM " . $AObject->tablename . " WHERE upper(" . $AObject->getCodeFieldName() . ") = upper('" . $AObject->getCode(). "')";
            $l_ObjectArray = $this->OpenQueryArray($sSQL);
            $AObject->LoadObject($l_ObjectArray);            
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