<?php

/***
* e-Dokter from version 0.1 Beta
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
*
* File : includes/select-pasien.php
* Description : Get pasien data from json encode by select2
* Licence under GPL
***/

ob_start();
session_start();


include_once('../config.php');
 
$q = $_GET['q'];
 
$sql = query("SELECT kd_pj AS id, png_jawab AS text FROM penjab WHERE (kd_pj LIKE '%".$q."%' OR png_jawab LIKE '%".$q."%')");
$num = num_rows($sql);
if($num > 0){
	while($data = fetch_assoc($sql)){
		$tmp[] = $data;
	}
} else $tmp = array();
 
echo json_encode($tmp);

?>
