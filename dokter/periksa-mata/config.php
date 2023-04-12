<?php
$server = "localhost";
$username = "root";
$password = "asysyifa";
$db = "sik_sink";

//konek ke db
mysql_connect($server, $username,$password,$db) or die("koneksi gagal");
mysql_select_db($db) or die("Database Tidak Ada/tidak bisa dibuka");
?>
