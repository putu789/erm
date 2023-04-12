 <div class="header">
                            <h2>DATA SUBYEKTIF </h2>
                           
                        </div>
                         
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
                                $insert = query("INSERT INTO pemeriksaan_ralan 
                                                (no_rawat, tgl_perawatan,jam_rawat,pemer,
                                                 suhu_tubuh,tensi,nadi,respirasi,
                                                tinggi,berat,gcs,keluhan,pemeriksaan,nyeri,nutrisi,perencanaan,periksa_khusus,asesmen_fung,lila,alergi,imun_ke,riwayat,riwayat_lain,diag_per
                                                ) 
                                                 VALUES ('{$no_rawat}',
                                                         '{$_POST['tgl_perawatan']}',
                                                         '{$_POST['jam_rawat']}',
														 '{$_POST['pemer']}',
                                                         '{$_POST['suhu']}',
                                                         '{$_POST['tensi']}',
                                                         '{$_POST['nadi']}',
                                                         '{$_POST['respirasi']}',
                                                         '{$_POST['tinggi']}',
                                                         '{$_POST['berat']}',
                                                          '{$_POST['gcs']}',
                                                         '{$_POST['keluhan']}',
                                                         '{$_POST['pemeriksaan']}',
														 '{$_POST['nyeri']}',
														 '{$_POST['nutrisi']}',
														 '{$_POST['perencanaan']}',
														 '{$_POST['periksa_khusus']}',
														 '{$_POST['asesmen_fung']}',
														 '{$_POST['lila']}',
                                                          '{$_POST['alergi']}',
                                                         '{$_POST['imun']}',
                                                         '{$chk}',
														 '{$_POST['riwayat_lain']}',
														 '{$_POST['diag_per']}'
														 
														 
                                                     )");
													 
													 $insert = query("INSERT INTO resiko_jatuh (no_rawat,tgl_rawat,kondisi,r_jatuh,diag_sek,alat_bntu,infus,g_jalan,mental,skor,kategori) VALUES ('{$no_rawat}',
													 '{$_POST['tgl_perawatan']}',
													 '{$_POST['resiko']}',
													 '{$_POST['sk_']}',
													 '{$_POST['sk_1']}',
													 '{$_POST['sk_2']}',
													 '{$_POST['sk_3']}',
													 '{$_POST['sk_4']}',
													 '{$_POST['sk_5']}',
													 '{$_POST['tot']}',
													 '{$_POST['kategori']}')");
                                    
													 $insert = query("UPDATE reg_periksa SET stts='Dirawat' WHERE no_rawat='$no_rawat'"); 
													 
													 
                                if ($insert) {
                                    redirect("pasien.php?action=view&id={$id}");
									
                                }
								
							}
                        }
                        ?>
                        <div id="panel1">
								<input type="hidden" name="pemer" value="<?php echo $_SESSION['username'];?>" />
                          <label>Anamnesa</label>
                          <textarea name="keluhan" class="form-control ckeditor" style="width:100%" placeholder="anamnesa"></textarea>
                                <br/>
                          
                                    <label>Riwayat</label>
                                    <table width="100%">
                                <tr class="g">
                                 <td class="g"><input type="checkbox" name="riwayat[]" value="Diabetes Melitus"/> Diabetes Melitus </td>
                                 <td class="g"><input type="checkbox" name="riwayat[]" value="Hipertensi"/> Hipertensi</td>
                                 <td class="g">Lainnya..</td>
                                </tr>
                                </table>
										   <textarea name="riwayat_lain" class="form-control ckeditor" style="width:100%" placeholder="riwayat"></textarea>
                                     </div>
                                     <br />
                                      
                       
                                     <div class="header">
                            <h2>DATA OBYEKTIF </h2>
                        </div>
								<table width="100%" id="panel" >
                                	<tr>
                                    <td style="padding-right:5px;"> <label>Alergi :</label></td>
                                    <td style="padding-right:10px;"><input type="text" name="alergi" placeholder="Alergi " class="form-control" /></td>
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
                                    <td style="padding-right:10px;"><input type="text" class="form-control" name="tensi" required="required" /></td>
                                    <td style="background:#CCC;">&nbsp;mmHg</td>
                                    <td style="padding-right:5px;"><label>Pernapasan :</label></td>
                                    <td style="padding-right:10px;"><input type="text" class="form-control" required="required"  name="respirasi" /></td>
                                    <td style="background:#CCC;">x/menit</td>
                                    </tr>
                                    <tr>
                                	<td style="padding-right:5px;"><label>Nadi :</label></td>
                                    <td style="padding-right:10px;"><input type="text" required="required"  class="form-control" name="nadi" /></td>
                                    <td style="background:#CCC;">&nbsp;x/menit</td>
                                    <td style="padding-right:5px;"><label>Suhu Tubuh :</label></td>
                                    <td style="padding-right:10px;"><input type="text" required="required"  class="form-control" name="suhu"  id="hp" /></td>
                                    <td style="background:#CCC;">&deg;C</td>
                                    </tr>
                                    <tr>
                                	<td style="padding-right:5px;"><label>Berat Badan :</label></td>
                                    <td style="padding-right:10px;"><input type="text"  class="form-control inputAngka" name="berat" id="bert" onkeyup="sum();" /></td>
                                    <td style="background:#CCC;">&nbsp;KG</td>
                                    <td style="padding-right:5px;"><label>Tinggi Badan :</label></td>
                      <td style="padding-right:10px;"><input type="text" class="form-control inputAngka" name="tinggi" id="tng" onkeyup="sum();" /></td>
                                    <td style="background:#CCC;">&nbsp; Cm</td>
                                    </tr>
                                    <tr>
                                    <td style="padding-right:5px;"><label>Lingkar Lengan Atas :</label></td>
                                    <td style="padding-right:10px;"><input type="text" class="form-control" name="lila" /></td>
                                    <td style="background:#CCC;">&nbsp; Cm</td>
                                    <td style="padding-right:5px;"><label>IMT :</label></td>
                                    <td style="padding-right:10px;"><input type="text" class="form-control" name="imt" id="im" /></td>
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
                                <input type="radio" name="nyeri" value="TIDAK ADA NYERI"/> Tidak ada nyeri
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri" value="RINGAN"/> Ringan
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri"  value="SEDANG"/> Sedang
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="nyeri"  value="BERAT"/> Berat
                                </td>
                                </tr>
                                </table><br><br>
                                
                                <div class="header">
                                     
                            <h2>EDUKASI</h2>
                           
                      </div>
                    <p>
               <textarea name="nutrisi" class="form-control ckeditor" style="width:100%" placeholder="nutrisi"></textarea><br>
               
                          <br><br>
                                
                              <div class="header">
                                     
                                    <h2>RESIKO JATUH</h2>
                                    
                                </div>
                                <table width="100%">
                                <tr style="border:none">
                                <td style="border:none">
                                <input type="radio" name="resiko"  value="79" /> Usia > 79
                                </td>
                                <td style="border:none">
                                <input type="radio" name="resiko" value="HAMIL"  /> Hamil
                                </td>
                                <td style="border:none">
                                <input type="radio" name="resiko"  value="TIDAK" /> Tidak Hamil
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
                                        
                                        <input type="text" name="tot" id="total" class="tot" />
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
               <textarea name="periksa_khusus" class="form-control ckeditor" style="width:100%" placeholder="periksa_khusus"></textarea><br>
                 		 <div class="header">
                       <h2>Assesment Fungsional</h2>
                        </div>
                        <p>
                 <textarea name="asesmen_fung" class="form-control ckeditor" style="width:100%" placeholder="asesmen_fung"></textarea><br>              		<div class="header">         
                            <h2>DIAGNOSA KEBIDANAN/KEPERAWATAN DAN MASALAH</h2>
						</div>
                        <p>
                  <textarea name="diag_bid" class="form-control ckeditor" style="width:100%" ></textarea><br>
 				<div class="header">         
                            <h2>PERENCANAAN DAN KEBUTUHAN</h2>
                           
                      </div>
                    
                   <table width="60%">
                                <tr style="border:none;">
                                <td style="border:none;">
                                <input type="radio" name="perencanaan" value="KONTROL ULANG"/> Kontrol Ulang
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="perencanaan" value="TIDAK PERLU KONTROL"/> Tidak Perlu Kontrol
                                </td>
                                <td style="border:none;">
                                <input type="radio" name="perencanaan"  value="RAWAT INAP"/> Rawat Inap
                                </td>
                                </tr>
                                </table>    
                                <br />             
                                    <button type="submit" name="ok_vital" value="ok_vital" class="btn btn-success" onclick="this.value=\'ok_vital\'">Simpan</button></dd>
                   
                                </form>