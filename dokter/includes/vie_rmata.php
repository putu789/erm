<?php
include "config.php";
if($_POST['id']){
	$id = $_POST['id'];
	$tgl = $_POST['tgl'];
	$dok = $_POST['dok'];
	$no_raw = $_POST['no_raw'];
?>
<?php
 $que = query("SELECT nm_pasien , no_rkm_medis FROM pasien  WHERE no_rkm_medis = '".$id."'");
                            while ($e = fetch_array($que)) 
				
					
                            {?> 

								<label><?php echo $e['nm_pasien'];?></label><br>
								<label><?php echo $e['no_rkm_medis'];?></label>
                                
							<?php } ?>
                           
                            <?php
							
	$query = query("SELECT b.no_rawat , b.tgl_registrasi, a.diagnosa_dr, a.tindakan_dr, a.tindakan_dr_lain,a.pemeriksaan,a.keluhan,a.riwayat,a.riwayat_lain,c.nm_dokter,b.kd_poli FROM pemeriksaan_ralan a, reg_periksa b, dokter c WHERE b.no_rkm_medis = '".$id."' AND b.no_rawat = a.no_rawat AND b.kd_dokter = c.kd_dokter AND b.tgl_registrasi != '".$tgl."' AND a.tgl_perawatan != '".$tgl."' AND b.kd_poli = 'U0005' ORDER BY b.tgl_registrasi DESC ");
                            while ($d = fetch_array($query)) 
							
					
                            {
								$tanggal = $d['tgl_registrasi'];
								$format = date('d-m-Y', strtotime($tanggal));
								?>
 								<div class="panel panel-info" style="margin-bottom:2px; margin-top:2px;">
                                <div class="panel-heading">
                                Tanggal Periksa : <?php echo $format;?> | Dokter : <?php echo $d['nm_dokter'];?>
                                </div>
                                <div class="panel-body" style="padding:0px;">
                                <div class="table table-responsive">
                                <form action="" method="post" class="form-riwayat">
 									<table class="data" style="width:100%;">
                                     <thead >
                                        <th class="alert-info">Keluhan
                                        </th>
                                        <th class="alert-info">diagnosa
                                        </th>
                                        <th class="alert-info">tindakan
                                        </th>
                                        <th class="alert-info">Pemeriksaan
                                        </th>
                                        <th class="alert-info">riwayat Penyakit
                                        </th>
                                        <th class="alert-info">Tools
                                        </th>
                                        </thead>
                                        <tbody >
                        
							 <td><?php echo $d['keluhan'];?></td>
                            <td><?php echo $d['diagnosa_dr'];?></td>
                            <td><?php echo $d['tindakan_dr'],$d['tindakan_dr_lain'];?></td>
                            <td ><?php echo $d['pemeriksaan'];?><br><a href="pem_gambar.php?id=<?php echo $d['no_rawat'];?>" id="<?php echo $d['no_rawat'];?>" target="_blank">Pemeriksaan Gambar</a></td>
                            <td><?php echo $d['riwayat'];?>,<?php echo $d['riwayat_lain'];?></td>
                            <input type="hidden" name="keluhan" value="<?php echo $d['keluhan'];?>" />
                            <input type="hidden" name="diagnosa_dr" value="<?php echo $d['diagnosa_dr'];?>" />
                            <input type="hidden" name="tindakan_dr" value="<?php echo $d['tindakan_dr'];?>" />
                            <input type="hidden" name="tindakan_dr_lain" value="<?php echo $d['tindakan_dr_lain'];?>" />
                            <input type="hidden" name="pemeriksaan" value="<?php echo $d['pemeriksaan'];?>" />
                            <input type="hidden" name="no_rawat" value="<?php echo $no_raw;?>" />
                            <td>
                            <input disabled="disabled" type="submit" class="btn btn-xs btn-success" name="btn_copy" value="Copy"></td>
                           
                            </tbody>
                                    </table>
                                      </form>
                                    </div>
                                </div>
                                </div>
                                 <?php 
							}?>
                              
							
                            
							<?php 
                            
                         
}?>
					