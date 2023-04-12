<?php
ob_start();
session_start();

require_once("../config.php");
if($_POST['id']){
				$id = $_POST['id'];
$hapus = "DELETE FROM resep_dokter WHERE no_resep='".$id."' ";
	$hasil = query($hapus);
}
	?>