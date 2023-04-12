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

$sql = query("SELECT a.kd_jenis_prw AS id,a.material AS mtr,a.bhp AS bhp,a.tarif_tindakandr AS ttdr,a.kso AS kso, a.menejemen AS mnj,a.nm_perawatan AS text, a.total_byrdrpr AS biaya,b.png_jawab AS cr FROM jns_perawatan a, penjab b WHERE (kd_jenis_prw LIKE '%".$q."%' OR nm_perawatan LIKE '%".$q."%' OR total_byrdrpr LIKE '%".$q."%')");
$json = [];

while($row = fetch_assoc($sql)){
     $json[] = ['id'=>$row['id'], 'text'=>$row['text'],'mtr'=>$row['mtr'],'bhp'=>$row['bhp'],'ttdr'=>$row['ttdr'],'kso'=>$row['kso'],'mnj'=>$row['mnj'], 'biaya'=>$row['biaya'], 'cr'=>$row['cr']];
}
echo json_encode($json);

?>
