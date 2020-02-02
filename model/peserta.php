<?php

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

interface DAO{
    public function generateSQLInsert();
    public function generateSQLUpdate();
    public function generateSQLDelete();
    public function LoadObject($AObjectSQLArray);
    
 }
   
class module implements DAO{
    public $id;
    public $nama;
    public $is_tampilkan;

    public $tablename = 'seminar_module';

    public function generateSQLInsert() {
        $this->id = gen_uuid();

        $sSQL = "insert into   $this->tablename  (id        ,    nama     ,   is_tampilkan)";
        $sSQL = $sSQL .                 " values('$this->id','$this->nama',$this->is_tampilkan";
        $sSQL = $sSQL . ")";

        return $sSQL;
    }

    public function generateSQLUpdate() {
        $sSQL = "update " . $this->tablename;
        $sSQL = $sSQL . " set nama = '" . $this->nama . "'";
        $sSQL = $sSQL . " , is_tampilkan = '" . $this->is_tampilkan . "'";
        $sSQL = $sSQL . " where id = '" . $this->id . "'";

        return $sSQL;
    }

    public function generateSQLDelete(){
        $sSQL = "delete from " . $this->tablename;
        $sSQL = $sSQL . "where id = '" . $this->id ."'";
        return $sSQL;
    }

    public function LoadObject($AObjectSQLArray){
        if ($AObjectSQLArray['id'] != ''){
            $this->id                = $AObjectSQLArray['id'];
            $this->is_tampilkan      = $AObjectSQLArray['is_tampilkan'];
            $this->nama              = $AObjectSQLArray['nama'];
        }    
    }
}

class peserta implements DAO{
    public $id;
    public $nama;
    public $email;
    public $tgl_input;
    public $is_konfirmasi;
    public $tgl_konfirmasi;
    public $passw;
    public $is_admin = 0;
    public $tempat_lahir;
    public $tgl_lahir;

    public $propinsi;
    public $kabupaten;

    public $alamat_rumah;
    public $alamat_kantor;
    public $no_ktp;

    public $fungsi;
    public $jabatan;

    public $no_sk_ppat;
	public $tgl_sk_ppat;
	public $no_bas_ppat;
	public $tgl_bas_ppat;
	public $no_wa;
    public $no_telp_kantor;    
    public $img_photo;
    public $img_ktp;
    public $img_sk_ppat;
    public $img_bas;
    public $img_kartu_nama;
    public $img_kwitansi;    
    public $is_pembayaran_ok;
    public $is_datang;

    public $tablename = 'seminar_peserta';
    
    public function generateSQLInsert() {
        $this->id = gen_uuid();

        $sSQL = "insert into   $this->tablename  (id        ,    nama     ,    email     ,    tgl_input     , is_konfirmasi,    tgl_konfirmasi     ,    passw     ,    is_admin     ,    tempat_lahir     ,    tgl_lahir     , alamat_rumah         , no_ktp		, no_sk_ppat		, tgl_sk_ppat			, no_bas_ppat			, tgl_bas_ppat			, no_wa			, no_telp_kantor)";
        $sSQL = $sSQL .                 " values('$this->id','$this->nama','$this->email','$this->tgl_input',0             ,'$this->tgl_konfirmasi','$this->passw','$this->is_admin','$this->tempat_lahir','$this->tgl_lahir','$this->alamat_rumah' ,'$this->no_ktp','$this->no_sk_ppat','$this->tgl_sk_ppat'	,'$this->no_bas_ppat'	,'$this->tgl_bas_ppat'	,'$this->no_wa'	,'$this->no_telp_kantor'";
        $sSQL = $sSQL . ")";

        return $sSQL;
    }

    public function generateSQLUpdate() {
        $sSQL = "update " . $this->tablename;
        $sSQL = $sSQL . " set tempat_lahir = '" . $this->tempat_lahir . "'";
        $sSQL = $sSQL . " , nama = '" . $this->nama . "'";
        $sSQL = $sSQL . " , email = '" . $this->email . "'";
        $sSQL = $sSQL . " , tgl_lahir = '" . $this->tgl_lahir . "'";
        $sSQL = $sSQL . " , alamat_rumah = '" . $this->alamat_rumah . "'";
        $sSQL = $sSQL . " , alamat_kantor = '" . $this->alamat_kantor . "'";

        $sSQL = $sSQL . " , propinsi = '" . $this->propinsi . "'";
        $sSQL = $sSQL . " , kabupaten = '" . $this->kabupaten . "'";

        $sSQL = $sSQL . " , fungsi = '" . $this->fungsi . "'";
        $sSQL = $sSQL . " , jabatan = '" . $this->jabatan . "'";

        $sSQL = $sSQL . " , no_ktp = '" . $this->no_ktp . "'";
        $sSQL = $sSQL . " , no_sk_ppat = '" . $this->no_sk_ppat . "'";		
		$sSQL = $sSQL . " , tgl_sk_ppat = '" . $this->tgl_sk_ppat . "'";
		$sSQL = $sSQL . " , no_bas_ppat = '" . $this->no_bas_ppat . "'";
		$sSQL = $sSQL . " , tgl_bas_ppat = '" . $this->tgl_bas_ppat . "'";
		$sSQL = $sSQL . " , no_wa = '" . $this->no_wa . "'";
        $sSQL = $sSQL . " , no_telp_kantor = '" . $this->no_telp_kantor . "'";
        
        $sSQL = $sSQL . " , img_photo = '" . $this->img_photo . "'";
        $sSQL = $sSQL . " , img_ktp = '" . $this->img_ktp . "'";
        $sSQL = $sSQL . " , img_sk_ppat = '" . $this->img_sk_ppat . "'";
        $sSQL = $sSQL . " , img_bas = '" . $this->img_bas . "'";
        $sSQL = $sSQL . " , img_kartu_nama = '" . $this->img_kartu_nama . "'";
        $sSQL = $sSQL . " , img_kwitansi = '" . $this->img_kwitansi . "'";
		$sSQL = $sSQL . " , is_pembayaran_ok = '" . $this->is_pembayaran_ok . "'";
		$sSQL = $sSQL . " , is_datang = '" . $this->is_datang . "'";
		
        $sSQL = $sSQL . " where id = '" . $this->id . "'";

        return $sSQL;
    }

    public function generateSQLDelete(){
        $sSQL = "delete from " . $this->tablename;
        $sSQL = $sSQL . "where id = '" . $this->id ."'";
        return $sSQL;
    }

    public function LoadObject($AObjectSQLArray){
        if ($AObjectSQLArray['id'] != ''){
            $this->id                = $AObjectSQLArray['id'];
            $this->is_admin          = $AObjectSQLArray['is_admin'];
            $this->nama              = $AObjectSQLArray['nama'];
            $this->email             = $AObjectSQLArray['email'];
            $this->tempat_lahir      = $AObjectSQLArray['tempat_lahir'];
            $this->tgl_lahir         = $AObjectSQLArray['tgl_lahir'];
            $this->alamat_rumah      = $AObjectSQLArray['alamat_rumah'];

            $this->alamat_kantor     = $AObjectSQLArray['alamat_kantor'];

            $this->propinsi          = $AObjectSQLArray['propinsi'];
            $this->kabupaten         = $AObjectSQLArray['kabupaten'];

            $this->fungsi            = $AObjectSQLArray['fungsi'];
            $this->jabatan           = $AObjectSQLArray['jabatan'];
            
            $this->no_ktp            = $AObjectSQLArray['no_ktp'];
            $this->no_sk_ppat        = $AObjectSQLArray['no_sk_ppat'];

            $this->tgl_sk_ppat       = $AObjectSQLArray['tgl_sk_ppat'];
            $this->no_bas_ppat       = $AObjectSQLArray['no_bas_ppat'];
            $this->tgl_bas_ppat      = $AObjectSQLArray['tgl_bas_ppat'];
            $this->no_wa             = $AObjectSQLArray['no_wa'];
            $this->no_telp_kantor    = $AObjectSQLArray['no_telp_kantor'];

            $this->img_photo         = $AObjectSQLArray['img_photo'];
            $this->img_ktp           = $AObjectSQLArray['img_ktp'];
            $this->img_sk_ppat       = $AObjectSQLArray['img_sk_ppat'];
            $this->img_bas           = $AObjectSQLArray['img_bas'];
            $this->img_kartu_nama    = $AObjectSQLArray['img_kartu_nama'];
            $this->img_kwitansi      = $AObjectSQLArray['img_kwitansi'];
            $this->is_pembayaran_ok  = $AObjectSQLArray['is_pembayaran_ok'];
            $this->is_datang         = $AObjectSQLArray['is_datang'];

        }    
    }
 }

 
?>