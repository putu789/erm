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
 if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur FROM reg_periksa a, pasien b WHERE a.no_rkm_medis = b.no_rkm_medis AND a.kd_poli = '{$_SESSION['jenis_poli']}'AND b.no_rkm_medis = {$id}";
    if(isset($_REQUEST['tanggal']) && $_REQUEST['tanggal'] !="") {
        $_sql .= " AND a.tgl_registrasi = '{$_REQUEST['tanggal']}'";
    } else { 
        $_sql .= " AND a.tgl_registrasi = '$date'";
    }

    $found_pasien = query($_sql);	
    if(num_rows($found_pasien) == 1) {
	while($row = fetch_array($found_pasien)) { 
	    $no_rkm_medis  = $row['0']; 
	    $no_rawat	   = $row['1'];
	    $nm_pasien     = $row['2'];
	    $umur          = $row['3'];
	}
    } else {
	redirect ('pasien.php');
    }
}
$q = $_GET['q'];

$sql = query("SELECT a.kd_jenis_prw AS id,a.material AS mtr,a.bhp AS bhp,a.tarif_tindakandr AS ttdr,a.kso AS kso, a.menejemen AS mnj,a.nm_perawatan AS text, a.total_byrdrpr AS biaya,b.png_jawab AS cr FROM jns_perawatan a, penjab b, reg_periksa c WHERE (kd_jenis_prw LIKE '%".$q."%' OR nm_perawatan LIKE '%".$q."%' AND c.no_rawat ={$no_rawat} AND c.kd_pj=b.kd_pj )");
$json = [];

while($row = fetch_assoc($sql)){
     $json[] = ['id'=>$row['id'], 'text'=>$row['text'],'mtr'=>$row['mtr'],'bhp'=>$row['bhp'],'ttdr'=>$row['ttdr'],'kso'=>$row['kso'],'mnj'=>$row['mnj'], 'biaya'=>$row['biaya'],'cr'=>$row['cr']];
}
echo json_encode($json);

?>
