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
    public $alamat_rumah;
    public $no_ktp;
    public $no_sk_ppat;
	public $tanggal_sk_ppat;
	public $no_bas_ppat;
	public $tanggal_bas_ppat;
	public $no_wa;
    public $no_telp_kantor;    
    public $img_photo;
    public $img_ktp;
    public $img_sk_ppat;
    public $img_bas;
    public $img_kartu_nama;
    public $img_kwitansi;    
	public $is_pembayaran_ok;

    public $tablename = 'seminar_peserta';
    
    public function generateSQLInsert() {
        $this->id = gen_uuid();

        $sSQL = "insert into   $this->tablename  (id        ,    nama     ,    email     ,    tgl_input     , is_konfirmasi,    tgl_konfirmasi     ,    passw     ,    is_admin     ,    tempat_lahir     ,    tgl_lahir     , alamat_rumah         , no_ktp		, no_sk_ppat		, tanggal_sk_ppat			, no_bas_ppat			, tanggal_bas_ppat			, no_wa			, no_telp_kantor)";
        $sSQL = $sSQL .                 " values('$this->id','$this->nama','$this->email','$this->tgl_input',0             ,'$this->tgl_konfirmasi','$this->passw','$this->is_admin','$this->tempat_lahir','$this->tgl_lahir','$this->alamat_rumah' ,'$this->no_ktp','$this->no_sk_ppat','$this->tanggal_sk_ppat'	,'$this->no_bas_ppat'	,'$this->tanggal_bas_ppat'	,'$this->no_wa'	,'$this->no_telp_kantor'";
        $sSQL = $sSQL . ")";

        return $sSQL;
    }

    public function generateSQLUpdate() {
        $sSQL = "update " . $this->tablename;
        $sSQL = $sSQL . " set tempat_lahir = '" . $this->tempat_lahir . "'";
        $sSQL = $sSQL . " , tgl_lahir = '" . $this->tgl_lahir . "'";
        $sSQL = $sSQL . " , alamat_rumah = '" . $this->alamat_rumah . "'";
        $sSQL = $sSQL . " , no_ktp = '" . $this->no_ktp . "'";
        $sSQL = $sSQL . " , no_sk_ppat = '" . $this->no_sk_ppat . "'";		
		$sSQL = $sSQL . " , tanggal_sk_ppat = '" . $this->tanggal_sk_ppat . "'";
		$sSQL = $sSQL . " , no_bas_ppat = '" . $this->no_bas_ppat . "'";
		$sSQL = $sSQL . " , tanggal_bas_ppat = '" . $this->tanggal_bas_ppat . "'";
		$sSQL = $sSQL . " , no_wa = '" . $this->no_wa . "'";
        $sSQL = $sSQL . " , no_telp_kantor = '" . $this->no_telp_kantor . "'";
        
        $sSQL = $sSQL . " , img_photo = '" . $this->img_photo . "'";
        $sSQL = $sSQL . " , img_ktp = '" . $this->img_ktp . "'";
        $sSQL = $sSQL . " , img_sk_ppat = '" . $this->img_sk_ppat . "'";
        $sSQL = $sSQL . " , img_bas = '" . $this->img_bas . "'";
        $sSQL = $sSQL . " , img_kartu_nama = '" . $this->img_kartu_nama . "'";
        $sSQL = $sSQL . " , img_kwitansi = '" . $this->img_kwitansi . "'";
		$sSQL = $sSQL . " , is_pembayaran_ok = '" . $this->is_pembayaran_ok . "'";
		
        $sSQL = $sSQL . " where id = '" . $this->id . "'";

        return $sSQL;
    }

    public function generateSQLDelete(){
        $sSQL = "delete from " . $this->tablename;
        $sSQL = $sSQL . "where id = '" . $this->id ."'";
        return $sSQL;
    }
 }

 
?>