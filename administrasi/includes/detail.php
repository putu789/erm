<?php
include "config.php";

 
if($_POST['id']){
	$id = $_POST['id'];
	$h = query ("SELECT a.no_rkm_medis, c.nm_pasien, b.png_jawab FROM reg_periksa a, penjab b, pasien c WHERE a.no_rawat = '{$id}' AND a.no_rkm_medis = c.no_rkm_medis AND a.kd_pj = b.kd_pj");
	while ($s = fetch_array($h)){
		echo '<label>'.$s['nm_pasien'].'</label><i>'.$s['no_rkm_medis'].'</i><br>
		<label>'.$s['png_jawab'].'</label><span class="label label-warning">Cara Bayar</span><br>';
	}
	
	 $q = query("SELECT a.keluhan,a.tgl_perawatan, a.pemeriksaan, a.suhu_tubuh, a.tensi, 
                                                         a.berat, a.tinggi, a.nadi, a.gcs, a.respirasi,
                                                         a.alergi, a.imun_ke,a.riwayat,a.tindakan_dr
                                                  FROM pemeriksaan_ralan a, reg_periksa b, dokter c
                                                  WHERE a.no_rawat = '{$id}' and
                                                        a.no_rawat = b.no_rawat and
                                                        c.kd_dokter = b.kd_dokter");
                            while ($d = fetch_array($q)) 
                            {?>
                            <style>
						
								
							.r{
								background:#baadad;
								width:30%;
								color:#FFF;
							}
							</style>
                            <?php
							if (empty($id)) 
							?>
                            <label><?php echo $d['tgl_perawatan'];?></label><br />
                          
					<table style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <td class="r d">Anamnesa</td>
                    <td class="d"><?php echo $d['keluhan'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Pemeriksaan</td>
                    <td class="d"><?php echo $d['pemeriksaan'];?></td>
                    </tr>
                    
                    <tr class="t">
                    <td class="r d">Riwayat</td>
                    <td class="d"><?php echo $d['riwayat'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Tindakan Dokter</td>
                    <td class="d"><?php echo $d['tindakan_dr'];?></td>
                    </tr>
                    
                    </table>
                    <?php
                     $y = query("SELECT a.no_rawat, a.tgl_rawat,a.gds,a.pptes,
                                                 a.p_urin,a.hbsag,a.med_ringan,a.med_sedang,
                                                a.med_berat,a.ecg,a.rontgen,a.lab,a.lain,a.nebu, a.fisio, a.endoskopi_dalam, a.usg, 
                                                         a.imunisasi, a.endoskopi_tht, a.slit_lamp, a.refraksi_mata
                                                  FROM nota_poli a, reg_periksa b, dokter c
                                                  WHERE a.no_rawat = '{$id}' and
                                                        a.no_rawat = b.no_rawat and
                                                        c.kd_dokter = b.kd_dokter");
                            while ($t = fetch_array($y)) 
                            {
							
                    	echo '<table style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <td class="r d">NOTA </td>
                    <td class="d">'.$t['gds'].'<br>'.$t['pptes'].'<br>'.$t['p_urin'].'<br>'.$t['hbsag'].'<br>'.$t['med_ringan'].'<br>'.$t['med_sedang'].'<br>'.$t['med_berat'].'<br>'.$t['ecg'].'<br>'.$t['rontgen'].'<br>'.$t['lab'].'<br>'.$t['nebu'].'<br>'.$t['fisio'].'<br>'.$t['endoskopi_dalam'].'<br>'.$t['usg'].'<br>'.$t['imunisasi'].'<br>'.$t['endoskopi_tht'].'<br>'.$t['slit_lamp'].'<br>'.$t['refraksi_mata'].'<br>'.$t['lain'].'</td>
                    </tr>
                    
                    </table>'; }?>
                    <?php
                     $e = query("SELECT a.no_rawat,a.mens_pertama,a.siklus, a.lama, a.lama, a.par_g, 
                                                         a.par_p, a.par_a, a.hpmt, a.hpl, a.usia_keh
                                                  FROM pemeriksaan_obg_ralan a, reg_periksa b, dokter c
                                                  WHERE a.no_rawat = '{$id}' and
                                                        a.no_rawat = b.no_rawat and
                                                        c.kd_dokter = b.kd_dokter");
                            while ($s = fetch_array($e)) 
                            {
								if ($s['no_rawat']>0){
								
								?>
                    <label>SUBYEKTIF OBGYN</label>
                    	<table style="padding:5px; border:#333 solid 1px; width:100%">
                    <tr class="t">
                    <td class="r d">Menarche Pertama</td>
                    <td class="d"><?php echo $s['mens_pertama'];?> &nbsp;Tahun</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Siklus Menarche</td>
                    <td class="d"><?php echo $s['siklus'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Lama</td>
                    <td class="d"><?php echo $s['lama'];?> </td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Paritas</td>
                    <td class="d"><?php echo $s['par_g'];?><?php echo $s['par_p'];?><?php echo $s['par_a'];?></td>
                    </tr>
                    
                    <tr class="t">
                    <td class="r d">HPMT</td>
                    <td class="d"><?php echo $s['hpmt'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">HPL</td>
                    <td class="d"><?php echo $s['hpl'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Usia Kehamilan</td>
                    <td class="d"><?php echo $s['usia_keh'];?></td>
                    </tr>
                    
                    </table>
                     
                    <?php }else{
						 echo '<label>SUBYEKTIF OBGYN</label>
						 <div class="alert alert-warning">KOSONG</div>
						 ';
						
					}
						?>
                    <?php } ?>
                    <?php } ?>
					<?php }?>