<?php 
    include "db_akses.php";
    #include "./model/peserta.php"

    
    $daftar = new peserta();
    $db_akses = new db_akses();
    
    $daftar->nama = 'Bagus Prasojo';
    $daftar->email = gen_uuid();
    $daftar->tgl_input = date("Y-m-d H:i:s");
    $daftar->tgl_lahir = date("Y-m-d");
    $daftar->tgl_konfirmasi = date("Y-m-d");
    $daftar->id = 0;

    if ($db_akses->SaveToDB($daftar)) {
        echo "berhasil simpan";
    } else {
        echo "Gagal simpan";
    }

    
    unset($daftar);
    unset($db_akses);

    
?>