<?php
ob_start();
session_start();
require_once("../config.php");

$onhand = query("SELECT no_resep FROM resep_obat WHERE no_rawat = '{$_POST['no_rawat']}'");
                    			$dtonhand = fetch_array($onhand);

                    			$get_number = fetch_array(query("SELECT max(no_resep) FROM resep_obat"));
                    			$lastNumber = substr($get_number[0], 0, 10);
                    			$next_no_resep = sprintf('%010s', ($lastNumber + 1)); 

                    			if ($dtonhand['0'] > 1) {
                        			$insert = query("INSERT INTO resep_dokter VALUES ('{$dtonhand['0']}', '{$_POST['kode_obat']}', '{$_POST['jumlah']}', '{$_POST['aturan_pakai']}')");
								} else {
                        			$insert = query("INSERT INTO resep_obat VALUES ('{$next_no_resep}', '{$_POST['tgl']}', '{$_POST['jam']}', '{$_POST['no_rawat']}', '{$_POST['dokter']}', '{$_POST['tgl']}', '{$_POST['jam']}')");
                        			$insert2 = query("INSERT INTO resep_dokter VALUES ('{$next_no_resep}', '{$_POST['kode_obat']}', '{$_POST['jumlah']}', '{$_POST['aturan_pakai']}')");
                    			}
								
?>