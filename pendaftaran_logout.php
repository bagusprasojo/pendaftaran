<?php
require "db_akses.php";
session_destroy();
header('location: pendaftaran_login.php');
?>
