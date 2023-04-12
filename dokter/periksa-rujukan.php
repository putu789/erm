<?php 
include_once ('layout/header.php'); 
if(isset($_GET['id'])) {
    $id = $_GET['id']; 
     $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur,c.png_jawab,b.alamat,b.namakeluarga,d.nm_kel,e.nm_kec,f.nm_kab FROM reg_periksa a, pasien b, penjab c,kelurahan d, kecamatan e, kabupaten f WHERE a.no_rkm_medis = b.no_rkm_medis AND a.kd_pj = c.kd_pj AND  d.kd_kel = b.kd_kel And b.kd_kec = e.kd_kec And b.kd_kab = f.kd_kab AND b.no_rkm_medis = {$id}";
    if(isset($_REQUEST['tanggal']) && $_REQUEST['tanggal'] !="") {
        $_sql .= " AND a.tgl_registrasi = '{$_REQUEST['tanggal']}'";
    } else { 
        $_sql .= " AND a.tgl_registrasi = '$date'";
    }

    $found_pasien = query($_sql);	
	while($row = fetch_array($found_pasien)) { 
	    $no_rkm_medis  = $row['0']; 
	    $no_rawat	   = $row['1'];
	    $nm_pasien     = $row['2'];
	    $umur          = $row['3'];
		$pj           = $row['4'];
		$alamat 		= "".$row['5'].",".$row['7'].",".$row['8'].",".$row['9']."";
	}
}

?>
<style>
	tr{
		padding:5px;
		border:#CCC solid 1px;
								
								
								
		}
	td{
		padding:8px;
		border:#CCC solid 1px;
	}
	.g{
		border:none !important;
		
	}
	
		</style>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PASIEN <?php echo $nmpoli; ?></h2>
            </div>

    

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Detail Pasien
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Nama Lengkap :</dt>
                                <dd><?php echo $nm_pasien; ?></dd>
                                <dt>No. RM :</dt>
                                <dd><?php echo $no_rkm_medis; ?></dd>
                                <dt>No. Rawat :</dt>
                                <dd><?php echo $no_rawat; ?></dd>
								<dt>Alamat :</dt>
                                <dd><?php echo $alamat; ?></dd>
                                <dt>Umur :</dt>
                                <dd><?php echo $umur; ?></dd>
								<dt>Cara Bayar :</dt>
                                <dd><?php echo $pj; ?></dd>
                            </dl>
                          



 <button type='button' class='view btn btn-primary' data-toggle='modal' id='<?php echo $no_rkm_medis; ?>' tgl='<?php echo $date;?>'  dok='<?php echo $_SESSION['username']; ?>' no_raw='<?php echo $no_rawat; ?>' data-target='#myModal'>Riwayat Pemeriksaan sebelumnya</button>
<button type='button' class='viewdta btn btn-warning' data-toggle='modal' id='<?php echo $no_rawat; ?>' data-target='#meModal'>Pemeriksaan Perawat</button>
							
          
				                   

                             
                            <main class="bg">
                            <input class="ip" id="tab1" idow='<?php echo $no_rawat; ?>' type="radio" name="tabs" checked>
                                <label class="lb" for="tab1">ASESMEN</label>
          <input class="ip" id="tab3" type="radio" name="tabs">
                                <label class="lb" for="tab3">E-LAB</label>

                          <section class="section" id="content1">
                          <form method="post" action="">

                         <?php 
                        if ($_POST['ok_vital']) {
														
                            if (($_POST['ok_vital'] <> "") and ($no_rawat <> "")) {
								$rwt = $_POST['tindakan'];
								$chk="";
								foreach($rwt as $chk1)
								{
								$chk.= $chk1.",";
								} 
                           $insert = query("UPDATE pemeriksaan_ralan SET 
						   	keluhan='{$_POST['keluhan']}'
						   ,pemeriksaan='{$_POST['pemeriksaan']}'
						   ,diagnosa_dr='{$_POST['diagnosa_dr']}'
						   ,tindakan_dr='{$chk}'
						   ,tindakan_dr_lain = '{$_POST['lain']}'
						   ,kontrol_ul_tg='{$_POST['kontrol_ul_tg']}' 
						   ,stts_obat='{$_POST['tnpa_obt']}'
						   ,lanjutan = '{$_POST['lanjutan']}'  
						   ,intervensi = '{$_POST['intervensi']}'  
						   WHERE no_rawat='{$no_rawat}'");     
						   
						   $insert = query("UPDATE reg_periksa SET stts='Sudah' WHERE no_rawat='$no_rawat'");
							  if (isset($_POST['lanjutan'])) {
								 $insert = query("UPDATE reg_periksa SET status_lanjut='Ranap' WHERE no_rawat='$no_rawat'"); 
							  }else{
								   $insert = query("UPDATE reg_periksa SET status_lanjut='Ralan' WHERE no_rawat='$no_rawat'"); 
							  }
                                if ($insert) {
                                    redirect("pasien.php");
                                }
                            }
                        }
                        ?>
                        
                        <?php 
                       if (isset($_POST['btn_copy'])){
						   $keluhan = $_POST['keluhan'];
						   $diagnosa_dr = $_POST['diagnosa_dr'];
						   $tindakan_dr = $_POST['tindakan_dr'];
						   $pemeriksaan = $_POST['pemeriksaan'];
						   $tindakan_dr_lain = $_POST['tindakan_dr_lain'];
						   $no_rawat = $_POST['no_rawat'];
						 
						   $insert = query("UPDATE pemeriksaan_ralan SET 
						   	keluhan='{$keluhan}'
						   ,pemeriksaan='{$pemeriksaan}'
						   ,diagnosa_dr='{$diagnosa_dr}'
						   ,tindakan_dr='{$tindakan_dr}'
						   ,tindakan_dr_lain = '{$tindakan_dr_lain}'
						   WHERE no_rawat='{$no_rawat}'");     
					   } else {
            			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
						}
					   ?>
                        <div class="body" >
                       
								
                                <?php if ($_SESSION['jenis_poli'] == "U0001"){
									$u = query("SELECT d.hpmt, d.hpl, d.usia_keh, d.par_g, d.par_p, par_a
                                                  FROM  pemeriksaan_obg_ralan
 d
                                                  WHERE  d.no_rawat = '{$no_rawat}'");														
                            while ($x = fetch_array($u)) 
                            {
								$tanggal = $x['hpmt'];
								$format = date('d-m-Y', strtotime($tanggal));
								$tanggal1 = $x['hpl'];
								$format1 = date('d-m-Y', strtotime($tanggal1));
									?>
       					<div class="table-responsive">
                      <label>Paritas</label>
                      <table class="table">
                      <thead style="background:#0CC;">
                      <th>Gravida </th>
                      <th>Partus</th>
                      <th>Abortus</th>
                      </thead>
                      <tbody>
                      <td><?php echo $x['par_g'];?></td>
                      <td><?php echo $x['par_p'];?> </td>
                      <td><?php echo $x['par_a'];?> </td>
                      
                      </tbody>
                      </table>
                      </div>  		
                      <div class="table-responsive">
                      <table class="table">
                      <thead style="background:#0CC;">
                      <th>HPMT </th>
                      <th>HPL</th>
                      <th>Usia Kehamilan</th>
                      </thead>
                      <tbody>
                      <td><?php echo $format;?> </td>
                      <td><?php echo $format1;?></td>
                      <td><?php echo $x['usia_keh'];?> Minggu</td>
                      
                      </tbody>
                      </table>
                     
                      </div>  	
                       <?php }
					   ?>
                            <div class="table table-responsive table-hover">
                       <table class="table">
                      <thead style="background:#0CC;">
                      <th>No </th>
                      <th>UMUR</th>
                      <th>CARA PERSALINAN</th>
                      <th>BB</th>
                      <th>TEMPAT PERSALINAN</th>
                      <th>KEADAAN SEKARANG</th>
                      </thead>
                      <tbody>
                      <?php
                      $qu = query("SELECT * FROM  ro  WHERE  no_rkm_medis = '{$no_rkm_medis}'");
					    		$no=1;												
                            while ($ro = fetch_array($qu)) 
								
                            {
								$tanggal = $x['hpmt'];
								$format = date('d-m-Y', strtotime($tanggal));
								$tanggal1 = $x['hpl'];
								$format1 = date('d-m-Y', strtotime($tanggal1));
							?>
                            <tr>
                      <td class="d"><?php echo $no; ?></td>
                      <td class="d"><?php echo $ro['umur']; ?></td>
                      <td class="d"><?php echo $ro['cara_persalinan']; ?></td>
                      <td class="d"><?php echo $ro['bb']; ?></td>
                      <td class="d"><?php echo $ro['tmpt_pers']; ?></td>
                      <td class="d"><?php echo $ro['keadaan_sekarang']; ?></td>
                      </tr>
                      <?php  
								$no++ ;
								} 
							?>
                      </tbody>
                      </table>
                      </div>
					   <?php
					   }else{ echo "";}?>
                      <?php
                              
								 $query_vital = query("SELECT a.keluhan, a.pemeriksaan, a.tindakan_dr,a.tindakan_dr_lain, a.diagnosa_dr, a.kontrol_ul_tg ,a.suhu_tubuh, a.tensi,  a.berat, a.tinggi, a.nadi, a.gcs, a.respirasi,a.alergi, a.imun_ke, a.riwayat,a.stts_obat,a.lanjutan,a.intervensi
                                                  FROM pemeriksaan_ralan a
                                                  WHERE a.no_rawat ='{$no_rawat}'");														
                            while ($data_vital = fetch_array($query_vital)) 
                            {
								$checked = explode(",",$data_vital['tindakan_dr']);
								
								$bb=$data_vital['berat'];
								$tb=$data_vital['tinggi']/100;
								$imt=$bb/($tb*$tb);
								$angka_format = number_format($imt,2);
								
								$st="";
								if($imt<18.5){
									$st="<span class='label label-warning'>(Kurus)</span>";
								}
								else if($imt>=18.5&&$imt<=24.9) {
									$st="<span class='label label-success'>(Normal)</span>";
								}
							
								else if($imt>=25&&$imt<=29.9) {
									$st="<span class='label label-danger'>(Overweight)</span>";
								}
								else if($imt>=30) {
									$st="<span class='label label-danger'>(Obesitas)</span>";
								}
								?>	
                                 
                                 <label>Anamnesa</label>
                        <textarea name="keluhan" id="myeditor" placeholder="anamnesa" class="form-control ckeditor" style="width:100%"><?php echo $data_vital['keluhan']; ?></textarea><br/>
                      <div class="table-responsive">
                      <label>Vital Sign</label>
                      <table class="table">
                      <thead style="background:#0CC;">
                      <th>Suhu Tubuh</th>
                      <th>Tensi</th>
                      <th>Berat / Tinggi</th>
                      <th>Nadi</th>
                      <th>Respirasi</th>
                      <th>Alergi</th>
                      <th>Imun</th>
                      <th>riwayat</th>
                      </thead>
                      <tbody>
                      <td><div class="label label-success"><?php echo $data_vital['suhu_tubuh'];?> &deg;C</div></td>
                      <td><?php echo $data_vital['tensi'];?> mmHg</td>
                      <td><?php echo $data_vital['berat'];?> Kg / <?php echo $data_vital['tinggi'];?> Cm<br />
                      <?php echo $angka_format ;?>&nbsp;<?php echo $st; ?></td>
                       <td><?php echo $data_vital['nadi'];?> x/Menit</td>
                       <td><?php echo $data_vital['respirasi'];?> x/Menit</td>
                       <td><?php echo $data_vital['alergi'];?></td>
                       <td><?php echo $data_vital['imun_ke'];?></td>
                       <td><?php echo $data_vital['riwayat'];?></td>
                      
                      </tbody>
                      </table>
                      </div>  		
                      <label>Pemeriksaan</label>
          <textarea name="pemeriksaan" id="myeditor1" placeholder="pemeriksaan" class="form-control ckeditor" style="width:100%;"><?php echo $data_vital['pemeriksaan']; ?></textarea>
        
                                <br />
								
                                
                                        <input name="tgl_perawatan" type="hidden" 
                                                value="<? echo date ('Y-m-d'); ?>" >
                                         <input name="jam_rawat" type="hidden" 
                                                value="<? echo date ('H:i:s'); ?>" >
                                                <br />
						
                     
                           
                                <label>Diagnosis</label>
                    
                 <textarea name="diagnosa_dr" id="myeditor2" class="form-control ckeditor"  style="width:100%;"><?php echo $data_vital['diagnosa_dr']; ?></textarea><br/>
   </div>

	 
                        <div class="body">
                                <label>Tindakan</label>
                                         <div class="row">
                                         
                         <?php if ($_SESSION['jenis_poli'] == "U0001"){
							include "includes/tind_obg.php";
						}else if(($_SESSION['jenis_poli'] == "U0011")){
							include "includes/tind_tht.php";
						}else if(($_SESSION['jenis_poli'] == "U0016")){
							include "includes/tind_ortho.php";
							}else if(($_SESSION['jenis_poli'] == "U0007")){
							include "includes/tind_syaraf.php";
						}else{?>
							<div class="col-md-3"><input type="checkbox" name="tindakan[]" value="USG" <?php in_array ('USG', $checked) ? print "checked" : ""; ?>  /> USG</div>
                              <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="ECG" <?php in_array ('ECG', $checked) ? print "checked" : ""; ?>/> ECG</div>
                              <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="NEBULIZER" <?php in_array ('NEBULIZER', $checked) ? print "checked" : ""; ?>/> NEBULIZER</div>
                              <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="REFRAKSI" <?php in_array ('REFRAKSI', $checked) ? print "checked" : ""; ?>/> REFRAKSI</div>
                              <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="SLIT LAMP" <?php in_array ('SLIT LAMP', $checked) ? print "checked" : ""; ?> /> SLIT LAMP</div>
                              <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="IMUNISASI" <?php in_array ('IMUNISASI', $checked) ? print "checked" : ""; ?> /> IMUNISASI</div>
                               <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="INJEKSI INTRA ARTIKULAR" <?php in_array ('INJEKSI INTRA ARTIKULAR', $checked) ? print "checked" : ""; ?> /> INJEKSI INTRA ARTIKULAR</div>
							    <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="MEDIKASI SEDANG" <?php in_array ('MEDIKASI SEDANG', $checked) ? print "checked" : ""; ?> /> MEDIKASI SEDANG</div>
                                <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="RO" <?php in_array ('RO', $checked) ? print "checked" : ""; ?> /> RO</div>
                                <div class="col-md-3"><input type="checkbox" name="tindakan[]" value="EEG" <?php in_array ('EEG', $checked) ? print "checked" : ""; ?> /> EEG</div>
						<?php }
						
							?>
                                               </div>
                       		
                               </div>
                            <div class="row">
                            <div class="col-md-3"><label> Tindakan Lainnya</label></div>
                            <div class="col-md-12"><textarea  id="myeditor3" class="form-control ckeditor" name="lain"><?php echo $data_vital['tindakan_dr_lain'];?></textarea></div>
                            </div>
               
                
                                    <dt>Tanggal Kontrol ulang</dt>
                                <p style="font-size:11px; color:#F00;">*Jika perlu kontrol ulang</p>
                                   <input  type="text" class="datepicker form-control" name="kontrol_ul_tg" placeholder="Pilih tanggal..."/>
                
                                
                              
                              
                          <br>
                          <p style="color:#F00; font-size:11px;">* Centang bagian tanpa obat jika pasien tidak dengan obat, tekan tombol resep jika pasien dengan obat</p>
                          <span class="alert alert-warning" style="padding:10px;"><input type="checkbox" name="tnpa_obt" value="no" <?php if ($data_vital['stts_obat']!== "no"){print ""; }else{ print "checked";};?> /> <b>Tanpa Obat</b> </span>
                          
                          <a href="e-resep.php?id=<?php echo $no_rkm_medis;?>&idob=<?php echo $no_rawat;?>" target="_blank"><button type="button"  class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>Resep Obat</button></a><br /><br />
                          <p style="font-size:11px; color:#F00;">*Jika pasien akan rawat inap</p>
                <div>
                  <span class="alert alert-danger" style="padding:10px;"><input type='checkbox' name="lanjutan" value="Ranap" data-toggle='collapse' data-target='#collapsediv1' <?php if ($data_vital['lanjutan']!== "Ranap"){print ""; }else{ print "checked";};?>> <label data-toggle='collapse' data-target='#collapsediv1'>Rawat Inap</label></span>
                  </input>
                </div>
                <div id='collapsediv1' class='collapse div1'>
                    <label>Intervensi / terapi</label>
          <textarea name="intervensi" id="myeditor4" placeholder="intervensi" class="form-control ckeditor" style="width:100%;"><?php echo $data_vital['intervensi']; ?></textarea>
                </div>
                <br />
 <?php }?>
                                        <button type="submit" name="ok_vital" value="ok_vital" class="btn btn-success" onclick="this.value=\'ok_vital\'">Simpan Dan Selesai Pemeriksaan</button></dd>
                                        </form>
                                        <hr />
                                       
                                        
                                         
                                              
								    	 <?php
                                $cet=num_rows(query("SELECT no_rawat FROM pemeriksaan_ralan WHERE no_rawat='{$no_rawat}'"));
							if ($cet > 0){?>
                                <?php 
								if ($poli == "U0001"){
									
									?>
                                  <br><a href="cetak_asesment.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-info ">Cetak Assesmen </button></a> 
                                  <?php }else{?>
                                  <br><a href="cetak_asesment_.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-info ">Cetak Assesmen </button></a> 
                                  <?php }?>
             		 <?php }else
						{
							echo "";
						}?>
                                        
                                <?php 
								if ($poli == "U0001"){
									
									?>
                                         <a href="ringkasan.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Ringkasan pelayanan(untuk Pasien)</button></a>
                                         <?php }else {?>
                                         <a href="ringkasan1.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Ringkasan pelayanan(untuk Pasien)</button></a>
                                         <?php }?>
                                        
                                       </td>
                                       
                                       <td>                                 
                                        
                                              
                                                
												
										 </td>
										 </dd>
										 </div>
                                 
      

                               
                                
                 
                 <!--  <div class="header">
                  
                            <h2>
                                Resep Obat Racik
                             </h2>
                                </div>
                                <dd>
                                 <form method="post" class="racik">
                                <textarea name="obat_racik" class="ckeditor"></textarea>
                                <input type="hidden" name="tgl_input" value="<?php //echo date("Y-m-d")?>" />
                                <input type="hidden" name="jam_input" value="<?php //echo date("h:i:s")?>" />
                                <input type="hidden" name="no_rawat" value="<?php //echo $no_rawat ?>" />
                                <input type="hidden" name="no_rkm_medis" value="<?php //echo $no_rkm_medis?>" />
                                 <dt></dt>
                                <dd> <a class="btn btn-success view-rac" ido='<?php //echo $no_rawat; ?>' id="tombol-racik">Simpan</a></dd><br>
                            </form>
                                <div class="tampilracik"></div>
                   				<div id="tampilracik"></div> -->
                                    
             <section class="section" id="content3">
                <div class="body table-responsive">
                     <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tgl Periksa</th>
                            <th>Jam</th>
                            <th>Pemeriksaan</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $query_lab = query("SELECT a.tgl_periksa, a.jam, b.nm_perawatan, a.biaya
                                          FROM periksa_lab a, jns_perawatan_lab b, reg_periksa c 
                                          WHERE a.no_rawat = c.no_rawat AND a.kd_jenis_prw = b.kd_jenis_prw 
                                          AND a.no_rawat = '{$no_rawat}' AND
                                          a.dokter_perujuk = '{$_SESSION['username']}' AND a.status = 'Ralan'");
                    while ($data_lab = fetch_array($query_lab)) {
                    ?>
                        <tr>
                            <td><?php echo $data_lab['0']; ?></td>
                            <td><?php echo $data_lab['1']; ?></td>
                            <td><?php echo $data_lab['2']; ?></td>
                            <td><?php echo $data_lab['3']; ?></td>
                            <td><a href="<?php $_SERVER['PHP_SELF']; ?>?action=delete_obat&kode_obat=<?php echo $data_resep['0']; ?>&no_resep=<?php echo $data_resep['4']; ?>&id=<?php echo $id; ?>">Hapus</a></td>
                        </tr>
                    <?php 
                    }
                    ?>
                    </tbody>
                </table>
           	 </div>
                              </section>
                              



    <?php
	//Update status
	if($_GET['action'] == "update_stts"){
		
	$sql=("UPDATE reg_periksa SET stts='$stts' WHERE no_rawat='$no_rawat'");
  $result=mysql_query($sql);
  if (($result)) {
	    redirect("pasien.php");
  }
	}
	//cetak 
	
	
    //delete
    if($_GET['action'] == "delete_diagnosa"){ 

	$hapus = "DELETE FROM diagnosa_dokter WHERE id_diag_dok='{$_REQUEST['no']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

    }

    //delete
    if($_GET['action'] == "delete_tindakan"){ 

    $hapus = "DELETE FROM pemeriksaan_ralan WHERE tindakan_dr='{$_REQUEST['kode']}' ";				
   
   var_dump($hapus); 
    $hasil = query($hapus);
    
    
    if (($hasil)) {
        redirect("pasien.php?action=view&id={$id}");
    }
    
    

    }
	//delete obsteri
	if($_GET['action'] == "delete_obs"){ 

	$hapus = "DELETE FROM ro WHERE id='{$_REQUEST['id']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

    }

	//delete periksa
	if($_GET['action'] == "delete_periksa"){ 

	$hapus = "DELETE FROM pemeriksaan_ralan WHERE jam_rawat='{$_REQUEST['no_rawat']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

    }
    //delete
    if($_GET['action'] == "delete_obat"){ 

	$hapus = "DELETE FROM resep_dokter WHERE no_resep='{$_REQUEST['no_resep']}' AND kode_brng='{$_REQUEST['kode_obat']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

   
 	//copy
	if($_GET['action'] == "copy_obat"){ 		
		 $copy = "COPY FROM resep_dokter WHERE no_resep='{$_REQUEST['no_resep']}' AND kode_brng='{$_REQUEST['kode_obat']}'";
	$hasil = query($copy);
	if (($hasil)) {
		redirect("pasien.php?action=view&id={$id}");
        
	}
	}
	}
    ?>
    

  

<?php include_once ('layout/footer.php'); ?>
