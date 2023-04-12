<?php
require_once('config.php');
 $no_rawat = $_GET['no_rawat']; 
 if(isset($_GET['no_rawat'])){
	 $select = query("SELECT a.no_rawat,a.tgl_rawat,a.gds, a.pptes, a.p_urin, a.hbsag, 
                                                         a.med_ringan, a.med_sedang, a.med_berat, a.ecg, a.rontgen,a.lab,a.lain, c.nm_dokter
                                                  FROM nota_poli a, reg_periksa b, dokter c
                                                  WHERE a.no_rawat = '{$no_rawat}' AND a.no_rawat = b.no_rawat");
												  
	 while ($hasil = fetch_array($select)) { ?>
     
     <table style="width:140px;">
     <tr>
     <td><img src="../asset/images/PIN(blck).png" style="width:60px;height:60px"></td>
     <td>.....................</td>
     </tr>
     </table>
     
     
         <?php
	 }
 
 }
?>