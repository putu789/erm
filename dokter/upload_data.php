<?php
require_once("config.php");
$upload_dir = "upload/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$file = $upload_dir . mktime() . ".png";
$query =mysql_query("INSERT INTO ttd (ttd) VALUE ($file)");
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>