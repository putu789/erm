<?php
include "config.php";

 
if($_POST['id']){
	$id = $_POST['id'];
    $cet= query("SELECT kd_poli FROM reg_periksa WHERE no_rawat='{$id}'");
	while ($row = fetch_array($cet)){
	$set = $row['kd_poli'];

	if ($set === "U0001"){
	 		$q = query("SELECT a.keluhan, a.pemeriksaan, a.suhu_tubuh, a.tensi, 
                                                         a.berat, a.tinggi, a.nadi, a.gcs, a.respirasi,
                                                         a.alergi, a.imun_ke, a.riwayat, d.hpmt, d.hpl, d.usia_keh, d.par_g, d.par_p, d.par_a
                                                  FROM pemeriksaan_ralan a, reg_periksa b, pemeriksaan_obg_ralan
 d                                         
 WHERE a.no_rawat = '{$id}' and
                                                        a.no_rawat = b.no_rawat    and 
														b.no_rawat = d.no_rawat");
                            while ($d = fetch_array($q)) 
	
                            {
								$bb=$d['berat'];
								$tb=$d['tinggi']/100;
								$imt=$bb/($tb*$tb);
								$angka_format = number_format($imt,2);
								
								$st="";
								if($imt<18.5){
									$st="(Kurus)";
								}
								else if($imt>=18.5&&$imt<=24.9) {
									$st="(Normal)";
								}
							
								else if($imt>=25&&$imt<=29.9) {
									$st="(Overweight)";
								}
								else if($imt>=30) {
									$st="(Obesitas)";
								}
								?>
                            
                            <style>
						
						
							.r{
								background:#baadad;
								width:30%;
								
							}
							</style>
                            <?php
							if (empty($id)) 
							?>
                            <h2>Pemeriksaan Perawat</h2>
					<table class="table table-striped" border="1" style="padding:10px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <th width="20%" class="r d">Anamnesa</th>
                    <td colspan="7" class="d" align="center"><?php echo $d['keluhan'];?></td>
                    </tr>
                    <tr class="t">
                    <th class="r d">Pemeriksaan</th>
                    <td colspan="7" class="d" align="center"><?php echo $d['pemeriksaan'];?></td>
                    </tr>
                    <td colspan="7" class="t" align="center"></td>
                    <br><tr>
                    <th class="r d"  align="center">Tensi</th>
                    <th width="30%" class="r d">Nadi</th>
                    <th width="25%" class="r d">Respirasi</th>
                    <th width="25%" class="r d">Suhu Tubuh</th>
                    
                    <tr>
                    <td height="39" class="d"><?php echo $d['tensi'];?></td>
                    <td class="d"><?php echo $d['nadi'];?> </td>
                    
                    <td class="d"><?php echo $d['respirasi'];?></td>
                    <td class="d"><?php echo $d['suhu_tubuh'];?>&nbsp;&deg;C</td>
                    
                    
                    
                    <tr>
                    <th class="r d">BB</th>
                    <th class="r d">IMT</th>
                    <th class="r d">Alergi</th>
                    </tr>
                    <tr>
                    <td height="39" class="d"><?php echo $d['berat'];?>&nbsp;Kg</td>
                    <td class="d"><?php echo $angka_format ;?>&nbsp;<?php echo $st; ?></td>
                    <td class="d"><?php echo $d['alergi'];?></td>
                    
                    </tr>
                    <tr>
                    <th class="r d">HPMT</th>
                    <th class="r d">HPL</th>
                    <th class="r d">Usia Kehamilan</th>
                    </tr>
                    <tr>
                    
                     <td height="39" class="d"><?php echo $d['hpmt'];?> </td>
                    <td class="d"><?php echo $d['hpl']; ?></td>
                    <td class="d"><?php echo $d['usia_keh'];?>&nbsp;minggu</td>
                    </tr>
                    </table><br>
    
                    <h2>Obstetri</h2>
                   
                    <table class="table table-striped" width="103%" border="1" style="padding:10px; border:#333 solid 1px; width:100%">        
                    <tr class="t">
                    <th class="r d">No</th>
                      <th class="r d">UMUR</th>
                                <th class="r d">CARA PERSALINAN</th>
                                <th class="r d">BB</th>
                                <th class="r d">TEMPAT PERSALINAN</th>
                                <th class="r d">KEADAAN SEKARANG</th>
                                </tr>
                                <tbody>
                                 <?php
                         $s = query("SELECT umur, cara_persalinan,bb,tmpt_pers,keadaan_sekarang FROM ro WHERE no_rawat ='{$id}'");
	  $no=1;
	  while ($u = fetch_array($s)) {
?>     
                                 <tr>
                                 <td class="d"><?php echo $no; ?></td>
                                    <td class="d"><?php echo $u['umur']; ?></td>
                                    <td class="d"><?php echo $u['cara_persalinan']; ?></td>
                                    <td class="d"><?php echo $u['bb']; ?></td>
                                    <td class="d"><?php echo $u['tmpt_pers']; ?></td>
                                    <td class="d"><?php echo $u['keadaan_sekarang']; ?></td>
                    </tr>
                    </tbody>
                     <?php 
$no++;
} ?>
                    </table><br>

                    <h2>Paritas</h2>
                  
					<table class="table table-striped" border="1" style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <th class="r d">Gravida</td>
                    <th class="r d">Partus</td>
                    <th class="r d">Abortus</td>
                    <tbody>
                    <tr>
                    <td class="d"><?php echo $d['par_g'];?>&nbsp;X</td>
                    <td class="d"><?php echo $d['par_p'];?>&nbsp;X</td>
                    <td class="d"><?php echo $d['par_a'];?> &nbsp;X</th>
                    </tr>
                    </tbody>
                    </table><br>

                    <h2>Riwayat Penyakit terdahulu</h2>
                    
					<table class="table table-striped" border="1" style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <th valign="top" class="r d">Riwayat penyakit</th>
                    <td class="d"><?php echo $d['riwayat'];?></td>
                    </tr>
                    </table><br>
     

                    <?php }
						}else{?>
<?php $c = query("SELECT a.keluhan, a.pemeriksaan, a.suhu_tubuh, a.tensi, 
                                                         a.berat, a.tinggi, a.nadi, a.gcs, a.respirasi,
                                                         a.alergi, a.imun_ke, a.riwayat
                                                  FROM pemeriksaan_ralan a, reg_periksa b
 WHERE a.no_rawat = '{$id}' and
                                                        a.no_rawat = b.no_rawat");
                            while ($e = fetch_array($c)) 
	
                            {
								$bb=$e['berat'];
								$tb=$e['tinggi']/100;
								$imt=$bb/($tb*$tb);
								$angka_format = number_format($imt,2);
								
								$st="";
								if($imt<18.5){
									$st="(Kurus)";
								}
								else if($imt>=18.5&&$imt<=24.9) {
									$st="(Normal)";
								}
							
								else if($imt>=25&&$imt<=29.9) {
									$st="(Overweight)";
								}
								else if($imt>=30) {
									$st="(Obesitas)";
								}
								?>
                            
                            <style>
						
						
							.r{
								background:#baadad;
								width:30%;
								
							}
							</style>
                            <?php
							if (empty($id)) 
							?>
                            <h2>Pemeriksaan Perawat</h2>
					<table class="table table-striped" border="1" style="padding:10px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <th width="20%" class="r d">Anamnesa</th>
                    <td colspan="7" class="d" align="center"><?php echo $e['keluhan'];?></td>
                    </tr>
                    <tr class="t">
                    <th class="r d">Pemeriksaan</th>
                    <td colspan="7" class="d" align="center"><?php echo $e['pemeriksaan'];?></td>
                    </tr>
                    <td colspan="7" class="t" align="center"></td>
                    <br><tr>
                    <th class="r d"  align="center">Tensi</th>
                    <th width="30%" class="r d">Nadi</th>
                    <th width="25%" class="r d">Respirasi</th>
                    <th width="25%" class="r d">Suhu Tubuh</th>
                    
                    <tr>
                    <td height="39" class="d"><?php echo $e['tensi'];?></td>
                    <td class="d"><?php echo $e['nadi'];?> </td>
                    
                    <td class="d"><?php echo $e['respirasi'];?></td>
                    <td class="d"><?php echo $e['suhu_tubuh'];?>&nbsp;&deg;C</td>
                    
                    
                    
                    <tr>
                    <th class="r d">BB</th>
                    <th class="r d">IMT</th>
                    <th class="r d">Alergi</th>
                    </tr>
                    <tr>
                    <td height="39" class="d"><?php echo $e['berat'];?>&nbsp;Kg</td>
                    <td class="d"><?php echo $angka_format ;?>&nbsp;<?php echo $st; ?></td>
                    <td class="d"><?php echo $e['alergi'];?></td>
                    
                    </tr>
                    
                    </table>

                   

                    <h2>Riwayat Penyakit</h2>
                    
					<table class="table table-striped" border="1" style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <th valign="top" class="r d">Riwayat penyakit</th>
                    <td class="d"><?php echo $e['riwayat'];?></td>
                    </tr>
                    </table><br>
	
<?php }
}	}
}
					?>
				


