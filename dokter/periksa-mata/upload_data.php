<?php
require_once("config.php");
$upload_dir = "upload/";
$img = $_POST['hidden_data'];
$no_rawat =$_POST['rawat'];
$tgl = $_POST['tgl'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$file = $upload_dir . mktime() . ".png";
$gbr_db = mktime().".png";
$success = file_put_contents($file, $data);
$query =mysql_query("INSERT INTO p_mata (no_rawat,tgl_perawatan,pemeriksaan) VALUE ('$no_rawat','$tgl','$gbr_db')");
print $success ? $file : 'Unable to save the file.';
?>