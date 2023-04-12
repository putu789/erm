 <div class="header">
                            <h2>DATA SUBYEKTIF </h2>
                           
                        </div>
                          
                            <br />
                            
                            	
								<label>Pemeriksaan Obstetri</label>
								<table class="table table-hover">
								<thead>
								<th>Tanggal Periksa</th>
								<th>Umur</th>
                                <th>Cara Persalinan</th>
                                <th>BERAT LAHIR (gr)</th>
                                <th>Tempat Persalinan</th>
                                <th>Keadaan Sekarang</th>
                                <th>Aksi</th>
								</thead>
								<?php 
				 $rep = query("SELECT no_rawat,no_rkm_medis,id_ob,tgl_rawat,umur,cara_persalinan,bb,tmpt_pers,keadaan_sekarang FROM ro  WHERE no_rawat = '".$no_rawat."'");
				 while ($tad = fetch_array($rep)){
 					

                ?>
								<tbody>
								 
								<td><?php echo $tad['tgl_rawat'];?></td>
								<td><?php echo $tad['umur'];?></td>
								<td><?php echo $tad['cara_persalinan'];?></td>
								<td><?php echo $tad['bb'];?></td>
								<td><?php echo $tad['tmpt_pers'];?></td>
								<td><?php echo $tad['keadaan_sekarang'];?></td>
                                <td><a href="ubah-periksa.php?aksi&id_obste=<?php echo $tad['id_ob']; ?>&id=<?php echo $tad['no_rkm_medis']; ?>&idob=<?php echo $tad['no_rawat']; ?>">Hapus</a></td>
								
								<tbody>
								<?php } ?>
								</table>


                                    <form method="post" class="form-obs">
                                <div class="header">  
                                <h2>Riwayat Obstetri</h2> 
                                </div>   
                               
             			<div class="body table-responsive">
                            <dl class="dl-horizontal">
                                <table>
                                <thead style="text-align:center; font-weight:bold;">
                                <tr>
                                <td>Umur</td>
                                <td>Cara Persalinan</td>
                                <td>BERAT LAHIR (gr)</td>
                                <td>Tempat Persalinan</td>
                                <td>Keadaan Sekarang</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <input type="hidden" name="no_rawat"  value="<? echo $no_rawat; ?>"  />
                                <input type="hidden" name="tgl_rawat"  value="<? echo date ('Y-m-d'); ?>"  />
                                <td><input type="text" name="umur" class="form-control" /></td>
                                <td><input type="text" name="cp" class="form-control" /></td>
                                <td><input type="text" name="bb" class="form-control" /></td>
                                <td><input type="text" name="tp" class="form-control" /></td>
                                <td><input type="text" name="ks" class="form-control" /></td>
                                <input type="hidden" value="<?php echo $no_rkm_medis?>" name="no_rm"/>
                                </tr>
                                </tbody>
                                </table>
                                 <a class="btn btn-success view-ob" idob='<?php echo $no_rawat; ?>' id="tombol-simpan">Simpan</a> <button type="reset" id="reset" />
                            </dl>
                         </div>
                   	    </form>
                              
                        
                        <div class="body">
                        <div class="tampildata"></div>
                         <div id="tampildata"></div> 
                              <form method="post" action="">
                         <?php 
                        if ($_POST['ok_vital']) {
							
                            if (($_POST['ok_vital'] <> "") and ($no_rawat <> "")) {
								$rwt = $_POST['riwayat'];
								$chk="";
								foreach($rwt as $chk1)
								{
								$chk.= $chk1.",";
								} 
                                $insert = query("UPDATE pemeriksaan_ralan  SET 
						   	suhu_tubuh='{$_POST['suhu']}'
						   ,tensi='{$_POST['tensi']}'
						   ,nadi='{$_POST['nadi']}'
						   ,respirasi='{$_POST['respirasi']}'
						   ,tinggi = '{$_POST['tinggi']}'
						   ,berat='{$_POST['berat']}' 
						   ,gcs='{$_POST['gcs']}'  
						   ,keluhan='{$_POST['keluhan']}'  
						   ,pemeriksaan='{$_POST['pemeriksaan']}'  
						   ,nyeri='{$_POST['nyeri']}'  
						   ,nutrisi='{$_POST['nutrisi']}'  
						   ,perencanaan='{$_POST['perencanaan']}' 
						   ,periksa_khusus='{$_POST['periksa_khusus']}' 
						   ,asesmen_fung='{$_POST['asesmen_fung']}' 
						   ,lila='{$_POST['lila']}' 
						   ,alergi='{$_POST['alergi']}' 
						   ,imun_ke='{$_POST['imun_ke']}' 
						   ,riwayat='{$chk}' 
						   ,riwayat_lain='{$_POST['riwayat_lain']}'   
						   WHERE no_rawat='{$no_rawat}'");
						   
							$insert = query("UPDATE pemeriksaan_obg_ralan SET 
								mens_pertama='{$_POST['mens_pertama']}'
						  		,siklus='{$_POST['siklus']}'
								,lama='{$_POST['lama']}'
								,par_g='{$_POST['G']}'
								,par_p='{$_POST['P']}'
								,par_a='{$_POST['A']}'
								,anak_hidup='{$_POST['anak_hidup']}'
								,hpmt='{$_POST['hpmt']}'
								,hpl='{$_POST['hpl']}'
								,diag_bid='{$_POST['diag_bid']}'
								,usia_keh='{$_POST['usia_keh']}'
								WHERE no_rawat='{$no_rawat}'");
														
													 $insert = query("UPDATE resiko_jatuh  SET  
													 kondisi='{$_POST['resiko']}'
													 ,r_jatuh='{$_POST['r_jatuh']}'
													  ,diag_sek='{$_POST['diag_sek']}'
													   ,alat_bntu='{$_POST['alat_bntu']}'
													    ,infus='{$_POST['infus']}'
														 ,g_jalan='{$_POST['g_jalan']}'
														  ,mental='{$_POST['mental']}'
														   ,kategori='{$_POST['kategori']}'	
														   WHERE no_rawat='{$no_rawat}'");												 
													 
													 
                                if ($insert) {
                                     redirect("ubah-periksa.php?id=".$id."&idob=".$idob."");
									
                                }
								
							}
                        }
                        ?>
                        
                        <?php
						$select = query("SELECT  e.alergi ,e.keluhan,e.suhu_tubuh,e.tensi,e.nadi,e.respirasi,e.tinggi,e.berat,e.gcs,e.periksa_khusus, e.asesmen_fung,e.nyeri,e.nutrisi,e.perencanaan,e.lila, e.riwayat,e.riwayat_lain,e.pemer,f.mens_pertama,f.siklus,f.hpmt,f.hpl,f.usia_keh,f.lama,f.par_g,f.par_p,f.par_a,f.anak_hidup,f.diag_bid, h.no_rawat, h.kondisi,h.skor,h.kategori FROM reg_periksa a,pemeriksaan_ralan e, pemeriksaan_obg_ralan f, ro g ,resiko_jatuh h WHERE  a.no_rawat ='".$no_rawat."' AND e.no_rawat = '".$no_rawat."' AND f.no_rawat = '".$no_rawat."' AND h.no_rawat = '".$no_rawat."' ");
						while ($hasil = fetch_array($select)) {
							$checked = explode(",",$hasil['riwayat']);
							
							$alergi = $hasil['alergi'];
							$keluhan = $hasil['keluhan'];
							$suhu_tubuh = $hasil['suhu_tubuh'];
							$tensi = $hasil['tensi'];
							$nadi = $hasil['nadi'];
							$respirasi = $hasil['respirasi'];
							$tinggi = $hasil['tinggi'];
							$berat = $hasil['berat'];
							$gcs = $hasil['gcs'];
							$periksa_khusus = $hasil['periksa_khusus'];
							$asesmen_fung = $hasil['asesmen_fung'];
							$nyeri = $hasil['nyeri'];
							$nutrisi = $hasil['nutrisi'];
							$perencanaan = $hasil['perencanaan'];
							$riwayat = $hasil['riwayat'];
							$riwayat_lain = $hasil['riwayat_lain'];
							$mens_pertama = $hasil['mens_pertama'];
							$siklus = $hasil['siklus'];
							$lama = $hasil['lama'];
							$par_g = $hasil['par_g'];
							$par_p = $hasil['par_p'];
							$par_a = $hasil['par_a'];
							$anak_hidup = $hasil['anak_hidup'];
							$hpmt = $hasil['hpmt'];
							$hpl = $hasil['hpl'];
							$usia_keh = $hasil['usia_keh'];
							$suhu_tubuh = $hasil['suhu_tubuh'];
							$tensi = $hasil['tensi'];
							$nadi = $hasil['nadi'];
							$respirasi = $hasil['respirasi'];
							$tinggi = $hasil['tinggi'];
							$berat = $hasil['berat'];
							$gcs = $hasil['gcs'];
							$alergi = $hasil['alergi'];
							$nyeri = $hasil['nyeri'];
							$nutrisi = $hasil['nutrisi'];
							$kondisi = $hasil['kondisi'];
							$skor = $hasil['skor'];
							$periksa_khusus = $hasil['periksa_khusus'];
							$diag_bid = $hasil['diag_bid'];
							$asesmen_fung = $hasil['asesmen_fung'];
							$perencanaan = $hasil['perencanaan'];
							
						}?>
                        <div id="panel1">
								<input type="hidden" name="pemer" value="<?php echo $_SESSION['username'];?>" />
                          <label>Anamnesa</label>
                          <textarea name="keluhan" class="form-control ckeditor" style="width:100%" placeholder="anamnesa"><?php echo $keluhan; ?></textarea>
                                <br/>
                                     <label>Riwayat</label>
                                     
                          <table width="100%">
                                <tr class="g">
                             	 <td class="g"><input type="checkbox" name="riwayat[]"  value="Sectio caesaria" <?php in_array ('Sectio caesaria', $checked) ? print "checked" : ""; ?>  /> Sectio caesaria</td>
                                 <td class="g"><input type="checkbox" name="riwayat[]" value="Diabetes Melitus" <?php in_array ('Diabetes Melitus', $checked) ? print "checked" : ""; ?>/> Diabetes Melitus </td>
                                 <td class="g"><input type="checkbox" name="riwayat[]" value="Hipertensi" <?php in_array ('Hipertensi', $checked) ? print "checked" : ""; ?>/> Hipertensi</td>
                                 <td class="g">Lainnya..</td>
                                </tr>
                                </table>
                          <textarea name="riwayat_lain" class="form-control ckeditor" style="width:100%" placeholder="riwayat"><?php echo $riwayat_lain;?></textarea>
                                     <br/>
                                <table width="100%" >
                                <tr> 
                                <td colspan="2"><label>Menarche Pertama</label></td>
                                <td><label>Siklus Menarche</label></td>
                                <td><label>Lama / Jumlah</label></td>
                                </tr>
                                <tr> 
                                <td><input type="text" name="mens_pertama" class="form-control inputAngka" value="<?php echo $mens_pertama;?>"  /></td>
                                <td style="background:#CCC;">Tahun</td>
                                <td><p align="center"><input  type="radio" value="TERATUR" <? if($siklus=='TERATUR'){echo 'checked';}?> name="siklus" />Teratur &nbsp;&nbsp;<input type="radio" value="TIDAK TERATUR" name="siklus" <? if($siklus=='TIDAK TERATUR'){echo 'checked';}?> />Tidak</p></td>
                                <td><input type="text" name="lama" class="form-control" value="<? echo $lama;?>"  /></td>
                                </tr>
                                </table>
                                <br />
                                <table width="100%" >
                                <tr>
                               <td colspan="3"> <label>Paritas</label>
                                <p style="font-size:11px; color:#F00;">*Pasien OBG</p></td>
                                 <td colspan="3"> <label>Anak Hidup</label>
                                <p style="font-size:11px; color:#F00;">*Pasien OBG</p></td>
                                </tr>
                                <tr>
                                            <td><input type="text" name="G" value="<? echo $par_g;?>"  placeholder="G" class="form-control" style="width:100%"></td>
                                            <td><input type="text" name="P" value="<? echo $par_p;?>"   placeholder="P" class="form-control" style="width:100%"></td>
                                            <td><input type="text" name="A"  value="<? echo $par_a;?>"  placeholder="A" class="form-control" style="width:100%"></td><td style="padding-right:10px;"><input type="text" value="<? echo $anak_hidup;?>" class="form-control inputAngka" name="anak_hidup" /></td>
                                    <td style="background:#CCC;">&nbsp;Orang</td>   
                                            </tr>
                                 </table>
                                  
                                      <br />  
                       
                                <table width="100%" >
                               		<tr>
                                    <td><label>HPMT</label>
                                <p style="font-size:11px; color:#F00;">*Pasien OBG</p></td>
                                    </td>
                                    <td><label>HPL</label>
                                <p style="font-size:11px; color:#F00;">otomatis</p></td>
                                <td colspan="2"> <label>Usia Kehamilan </label><p style="font-size:11px; color:#F00;">otomatis</p></td>
                                    </tr>
                                    <tr>
                                    <td style="padding-right:10px;"><input value="<? echo $hpmt ;?>" type="text" class="datepicker form-control" name="hpmt" placeholder="Pilih tanggal..."></td>  
                                    <td style="padding-right:10px;"><input  value="<? echo $hpl ;?>" type="text" id="datepicker2" class="form-control" name="hpl" placeholder="Pilih tanggal..."></td>   
                                    <td style="padding-right:10px;"><input type="text" value="<? echo $usia_keh ;?>" name="usia_keh" id="umur"  placeholder="Usia Kehamilan" class="form-control" /></td>
                                    <td style="background:#CCC;">Minggu</td>                               
                                     </tr>
                                     </table>
                                   
                                     </div>
                                     <br />
                                      
                       
                                     <div class="header">
                            <h2>DATA OBYEKTIF </h2>
                        </div>
								<table width="100%" id="panel" >
                                	<tr>
                                    <td style="padding-right:5px;"> <label>Alergi :</label></td>
                                    <td style="padding-right:10px;"><input type="text" name="alergi" value="<?php echo $alergi;?>" placeholder="Alergi " class="form-control" /></td>
                                    <td></td>
                                    <td style="padding-right:5px;"> <label>Imun ke :</label></td>
                                    <td style="padding-right:10px;"><select name="imun" class="form-control">
                                     <option value="-">-</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                     <option value="6" >6</option>
                                     <option value="7">7</option>
                                     <option value="8">8</option>
                                     <option value="9">9</option>
                                     <option value="10">10</option>
                                     <option value="11">11</option>
                                     <option value="12">12</option>
                                     <option value="13">13</option>
                                     </select>
                                     </td>
                                	</tr>
                               		<tr>
                                	<td style="padding-right:5px;"><label>Tekanan Darah :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $tensi;?>" type="text" class="form-control" name="tensi" required="required" /></td>
                                    <td style="background:#CCC;">&nbsp;mmHg</td>
                                    <td style="padding-right:5px;"><label>Pernapasan :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $respirasi;?>" type="text" class="form-control" required="required"  name="respirasi" /></td>
                                    <td style="background:#CCC;">x/menit</td>
                                    </tr>
                                    <tr>
                                	<td style="padding-right:5px;"><label>Nadi :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $nadi;?>" type="text" required="required"  class="form-control" name="nadi" /></td>
                                    <td style="background:#CCC;">&nbsp;x/menit</td>
                                    <td style="padding-right:5px;"><label>Suhu Tubuh :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $suhu_tubuh;?>" type="text" required="required"  class="form-control" name="suhu"  id="hp" /></td>
                                    <td style="background:#CCC;">&deg;C</td>
                                    </tr>
                                    <tr>
                                	<td style="padding-right:5px;"><label>Berat Badan :</label></td>
                                    <td style="padding-right:10px;"><input  value="<?php echo $berat;?>" type="text"  class="form-control inputAngka" name="berat" id="bert" onkeyup="sum();" /></td>
                                    <td style="background:#CCC;">&nbsp;KG</td>
                                    <td style="padding-right:5px;"><label>Tinggi Badan :</label></td>
                      <td style="padding-right:10px;"><input type="text" value="<?php echo $tinggi;?>" class="form-control inputAngka" name="tinggi" id="tng" onkeyup="sum();" /></td>
                                    <td style="background:#CCC;">&nbsp; Cm</td>
                                    </tr>
                                    <tr>
                                    <td style="padding-right:5px;"><label>Lingkar Lengan Atas :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $respirasi;?>" type="text" class="form-control" name="lila" /></td>
                                    <td style="background:#CCC;">&nbsp; Cm</td>
                                    <td style="padding-right:5px;"><label>IMT :</label></td>
                                    <td style="padding-right:10px;"><input value="<?php echo $respirasi;?>" type="text" class="form-control" name="imt" id="im" /></td>
                                    <td style="background:#CCC;">&nbsp;</td>
                                    </tr>
                                    </table>
                                    
								<br />
                                 <div class="header">
                                     
                            <h2>PEMERIKSAAN NYERI</h2>
                           
                      </div>
                     <table width="60%">
                     
                                <tr style="border:none;">
                                <td style="border:none;">
                                <input type="radio" name="nyeri" value="TIDAK ADA NYERI" <? if($nyeri=='TIDAK ADA NYERI'){echo 'checked';}?>/> Tidak ada nyeri
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri" value="RINGAN" <? if($nyeri=='RINGAN'){echo 'checked';}?>/> Ringan
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri"  value="SEDANG" <? if($nyeri=='SEDANG'){echo 'checked';}?>/> Sedang
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri"  value="BERAT" <? if($nyeri=='BERAT'){echo 'checked';}?>/> Berat
                                </td>
                                </tr>
                                </table><br><br>
                                
                                <div class="header">
                                     
                            <h2>EDUKASI</h2>
                           
                      </div>
                    <p>
                 <textarea name="nutrisi" class="form-control ckeditor" style="width:100%" placeholder="nutrisi"><?php echo $nutrisi;?></textarea><br>
               
                          <br><br>
                                
                              <div class="header">
                                     
                                    <h2>RESIKO JATUH</h2>
                                    
                                </div>
                                <table width="100%">
                                <tr style="border:none">
                                <td style="border:none">
                                <input type="radio" name="resiko"  value="79" <? if($kondisi=='79'){echo 'checked';}?>/> Usia > 79
                                </td>
                                <td style="border:none">
                                <input type="radio" name="resiko" value="HAMIL" <? if($kondisi=='HAMIL'){echo 'checked';}?> /> Hamil
                                </td>
                                <td style="border:none">
                                <input type="radio" name="resiko"  value="TIDAK" <? if($kondisi=='TIDAK'){echo 'checked';}?> /> Tidak Hamil
                                </td>
                                </tr>
                                
                                </table>
                                 <div id="resiko" style="display:none">
  								<table id="res" width="100%">
                                        <tr>
                                        <td colspan="2">Asesmen Faktor Resiko Jatuh Dewasa</td>
                                        <td>Skor</td>
                                        </tr>
                                        <tr>
                                        <td>Riwayat Jatuh : (Tidak termasuk kecelakaan kerja dan lalu lintas)</td>
                                        <td>
                                        <select name="riw" id="sk">
                                        <option value="0">Tidak</option>
                                        <option value="25">Ya</option>
                                        </select>
                                        <td>
                                        <input  type="text" name="sk_" id="sk__" />
                                        </td>
                                        <tr>
                                        <td>Diagnosa Sekunder : Apakah pasien memiliki lebih dari satu penyakit?</td>
                                        <td>
                                        <select name="diag" id="sk1">
                                        <option value="0">Tidak</option>
                                        <option value="15">Ya</option>
                                        </select>
                                        <td>
                                        <input type="text" name="sk_1" id="sk__1" />
                                        </td>
                                        <tr>
                                        <td>Menggunakan alat bantu</td>
                                        <td>
                                        <select name="alat" id="sk2">
                                        <option value="0">Tidak ada/Bedrest/Dibantu Perawat</option>
                                        <option value="15">Kruk/Tongkat</option>
                                        <option value="30">Alat</option>
                                        </select>
                                        <td>
                                        <input  type="text" name="sk_2" id="sk__2" />
                                        </td>
                                        <tr>
                                        <td>Terpasang infus</td>
                                        <td>
                                        <select name="inf" id="sk3">
                                        <option value="0">Tidak</option>
                                        <option value="20">Ya</option>
                                        </select>
                                        <td>
                                        <input type="text" name="sk_3" id="sk__3" />
                                        </td>
                                        <tr>
                                        <td>Gaya berjalan</td>
                                        <td>
                                        <select name="gb" id="sk4">
                                        <option value="0">Normal/bedrest/dibantu perawat</option>
                                        <option value="10">Lemah</option>
                                        <option value="20">Terganggu</option>
                                        </select>
                                        <td>
                                        <input  type="text" name="sk_4" id="sk__4" />
                                        </td>
                                        <tr>
                                        <td>Status mental</td>
                                        <td>
                                        <select name="sm" id="sk5">
                                        <option value="0">Menyadari kemampuan</option>
                                        <option value="15">Dimensi(Lupa)/agitasi/konfius(gelisah)</option>
                                        </select>
                                        <td>
                                        <input  type="text" name="sk_5" id="sk__5" />
                                        </td>
                                        
                                        
                                        
                                        </table>
								</div>
                                <table>
                               			<tr>
                                        <td>Score Total</td>
                                        <td>
                                        
                                        <input type="text" name="tot" value="<?php echo $skor;?>" id="total" class="tot" />
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>Kategori</td>
                                        <td>
                                        <select name="kategori">
                                        <option value="TINGGI">TINGGI</option>
                                        <option value="SEDANG">SEDANG</option>
                                        <option value="RENDAH">RENDAH</option>
                                        </select>
                                        </td>
                                        </tr>
                                        </table>
                                                                       
                                        
										<input type="hidden" name="kd_dokter" value="<?php echo $dok;?>" />
                                        <input name="tgl_perawatan" type="hidden" 
                                                value="<? echo date ('Y-m-d'); ?>" >
                                         <input name="jam_rawat" type="hidden" 
                                                value="<? echo date ('H:i:s'); ?>" >
                                                <br>
                                                
                                                 <div class="header">
                            <h2>PEMERIKSAAN KHUSUS</h2>
                      </div>
                    <p>
               <textarea name="periksa_khusus" class="form-control ckeditor" style="width:100%" placeholder="periksa_khusus"><?php echo $periksa_khusus;?></textarea><br>
                 		 <div class="header">
                       <h2>Assesment Fungsional</h2>
                        </div>
                        <p>
                 <textarea name="asesmen_fung" class="form-control ckeditor" style="width:100%" placeholder="asesmen_fung"><?php echo $asesmen_fung;?></textarea></textarea><br>              		<div class="header">         
                            <h2>DIAGNOSA KEBIDANAN/KEPERAWATAN DAN MASALAH</h2>
						</div>
                        <p>
                  <textarea name="diag_bid" class="form-control ckeditor" style="width:100%" ><?php echo $diag_bid;?></textarea><br>
 				<div class="header">         
                            <h2>PERENCANAAN DAN KEBUTUHAN</h2>
                           
                      </div>
                    
                   <table width="60%">
                                <tr style="border:none;">
                                <td style="border:none;">
                                <input type="radio" name="perencanaan" value="KONTROL ULANG" <? if($perencanaan=='KONTROL ULANG'){echo 'checked';}?>/> Kontrol Ulang
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="perencanaan" value="TIDAK PERLU KONTROL" <? if($perencanaan=='TIDAK PERLU KONTROL'){echo 'checked';}?>/> Tidak Perlu Kontrol
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="perencanaan"  value="RAWAT INAP" <? if($perencanaan=='RAWAT INAP'){echo 'checked';}?>/> Rawat Inap
                                </td>
                                </tr>
                                </table>       
                                <br />             
                                    <button  type="submit" name="ok_vital" value="ok_vital" class="btn btn-success" onclick="this.value=\'ok_vital\'">Ubah</button></dd>
                   
                                </form>

                             