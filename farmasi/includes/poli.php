<?php

/***
* e-Dokter from version 0.1 Beta
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
*
* File : includes/select-diagnosa.php
* Description : Get ICD-X data from json encode by select2
* Licence under GPL
***/

ob_start();
session_start();

include_once('../config.php');
 
$q = $_GET['q'];

$sql = query("SELECT kd_poli AS id, nm_poli AS text FROM poliklinik WHERE (kd_poli LIKE '%".$q."%' OR nm_poli LIKE '%".$q."%')");
$json = [];

while($row = fetch_assoc($sql)){
     $json[] = ['id'=>$row['id'], 'text'=>$row['text']];
}
echo json_encode($json);

?>
