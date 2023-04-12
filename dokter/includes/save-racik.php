<?php
ob_start();
session_start();
require_once("../config.php");
$rawat = $_POST['no_rawat'];
$rm = $_POST['no_rkm_medis'];
$tgl = $_POST['tgl_input'];
$jam = $_POST['jam_input'];
$rc = $_POST['obat_racik'];
$insert = query("INSERT INTO racikan(no_rawat, no_rkm_medis, tgl_input, jam_input, obat_racik) VALUES ('$rawat', '$rm', '$tgl', '$jam', '$rc')");
                              
?>