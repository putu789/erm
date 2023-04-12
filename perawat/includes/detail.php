<?php
include "config.php";

 
if($_POST['id']){
	$id = $_POST['id'];
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
                            <label>Obyektif</label>
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
                    <td class="r d">Suhu</td>
                    <td class="d"><?php echo $d['suhu_tubuh'];?> &nbsp;&deg;C</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Tensi</td>
                    <td class="d"><?php echo $d['tensi'];?> &nbsp;mmHg</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Berat</td>
                    <td class="d"><?php echo $d['berat'];?> &nbsp;KG</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Tinggi</td>
                    <td class="d"><?php echo $d['tinggi'];?> &nbsp;Cm</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Nadi</td>
                    <td class="d"><?php echo $d['nadi'];?> &nbsp; x/menit</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Respirasi</td>
                    <td class="d"><?php echo $d['respirasi'];?> &nbsp; x/menit</td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Riwayat</td>
                    <td class="d"><?php echo $d['riwayat'];?></td>
                    </tr>
                    <tr class="t">
                    <td class="r d">Tindakan</td>
                    <td class="d"><?php echo $d['tindakan_dr'];?></td>
                    </tr>
                    
                    </table>
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
                    <td class="d"><?php echo $s['usia_keh'];?> Minggu</td>
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