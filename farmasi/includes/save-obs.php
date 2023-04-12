<?php
require_once("../config.php");
query("INSERT INTO ro (no_rawat,no_rkm_medis,tgl_rawat,umur,cara_persalinan,bb,tmpt_pers,keadaan_sekarang) 
                 VALUES ('{$_POST['no_rawat']}',
				'{$_POST['no_rm']}',
				'{$_POST['tgl_rawat']}',
                 '{$_POST['umur']}',
                '{$_POST['cp']}',
                 '{$_POST['bb']}',
                 '{$_POST['tp']}',
                  '{$_POST['ks']}'
               )");
?>