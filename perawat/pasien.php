<?php 

include_once ('layout/header.php'); 

if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur,a.kd_dokter, f.nm_poli,b.alamat,b.namakeluarga,c.nm_kel,d.nm_kec,e.nm_kab,a.kd_poli,g.png_jawab ,a.no_reg FROM reg_periksa a, pasien b,kelurahan c, kecamatan d, kabupaten e, poliklinik f, penjab g WHERE  a.no_rawat = '".$id."' AND a.no_rkm_medis = b.no_rkm_medis And b.kd_kel = c.kd_kel And b.kd_kec = d.kd_kec And b.kd_kab = e.kd_kab And a.kd_poli = f.kd_poli And a.kd_pj = g.kd_pj";
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
		$dok          = $row['4'];
		$poli          = $row['kd_poli'];
		$nmpoli          = $row['nm_poli'];
		$alamat 		= "".$row['6'].",".$row['8'].",".$row['9'].",".$row['10']."";
		$bayar = $row['png_jawab'];
		$no_reg = $row['no_reg'];
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

    <?php if(!$_GET['action']){  ?> 

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tanggal : <?php if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") { echo $_POST['tanggal']; } else { echo $date; } ?>
                            </h2>
                        </div>
                        <div class="body">  
                        <dl class="dl-horizontal">
                   
                                <dd>
                               	
                                 <table id="jadwal_dokter" class="table table-bordered data" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pasien</th>
                                        <th>Dokter Tujuan</th>
                                        <th>No. Antrian</th>
                                        <th>Poli Tujuan</th>
                                        <th>Status Rawat</th>
                                        
                                    </tr>
                                </thead>
	    						<tbody>
	    						<?php
	    						$_sql = "SELECT b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat,b.alamat,b.namakeluarga,e.nm_kel,f.nm_kec,g.nm_kab,b.namakeluarga,h.png_jawab,a.status_lanjut FROM reg_periksa a, pasien b, dokter c,poliklinik d,kelurahan e, kecamatan f, kabupaten g, penjab h WHERE  a.no_rkm_medis = b.no_rkm_medis AND  a.kd_poli=d.kd_poli AND a.kd_dokter = c.kd_dokter AND b.kd_kel = e.kd_kel And b.kd_kec = f.kd_kec And b.kd_kab = g.kd_kab And a.kd_pj = h.kd_pj"; 
        						if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") {
            						$_sql .= " AND a.tgl_registrasi = '{$_POST['tanggal']}'";
        						} else { 
            						$_sql .= " AND a.tgl_registrasi = '$date'";
        						}
        						$_sql .= "  ORDER BY a.stts ASC , a.no_reg ASC";

        						$sql = query($_sql); 
        						$no = 1;
								while($row = fetch_array($sql)){

									$ranap = "";
									if($row['status_lanjut'] == "Ranap"){
										$ranap ='<span class="label label-success">Rawat Inap</span>';
									}else{
										$ranap = '';
									}

									$st = $row['5']; 
									if ($st === "Belum"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-asterisk'></span>Belum Diperiksa";
										$btn= "";
										$link ='<a style="color:hitam;" class="obst" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" idob="'.$no_rawat.'" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
										
									}
		    						echo '<tr '.$st.'>';
		    						echo '<td>'.$no.'</td>';
		    						echo '<td>';
		    						echo '<b>'.$link.'</b> <span class="label label-warning"><i>'.$row['png_jawab'].'</i></span> '.$ranap.'<br>
											<i>('.$row['namakeluarga'].')</i><br>
											'.$row['alamat'].','.$row['nm_kel'].','.$row['nm_kec'].','.$row['nm_kab'].'';
		    						echo '</td>';
		    						echo '<td>'.$row['1'].'</td>';
		    						echo '<td>'.$row['2'].'</td>';
									echo '<td>'.$row['nm_poli'].'</td>';
									echo '<td>'.$ch.'';
									echo '<br>'.$btn.''.$ases.'</td>';
									
		    						echo '</tr>';
        							$no++;
	    						}
	    						?>
	    						</tbody>
                            </table>
                        </div>
                      	<div class="body">
                        	<form method="POST" action="">
                              	<div class="row clearfix">
                                	<div class="col-xs-8 col-lg-10">
                                    	<div class="form-group">
                                        	<div class="form-line">
                                            	<input type="text" class="datepicker form-control" name="tanggal" placeholder="Pilih tanggal...">
                                        	</div>
                                    	</div>
                                	</div>
                                	<div class="col-xs-4 col-lg-2">
                                     	<input type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" value="Submit">
                                	</div>
                              	</div>
                            </form>
						</div>                
                                
                                
                           

    <?php } ?>
      

    <?php if($_GET['action'] == "view"){ ?>
   
    

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
                                <dt>Nama Lengkap</dt>
                                <dd><?php echo $nm_pasien; ?></dd>
                                <dt>No. RM</dt>
                                <dd><?php echo $no_rkm_medis; ?></dd>
                                <dt>No. Rawat</dt>
                                <dd><?php echo $no_rawat; ?></dd>
                                <dt>Umur</dt>
                                <dd><?php echo $umur; ?></dd>
                                <dt>POLIKLINIK</dt>
                                <dd><?php echo $nmpoli; ?></dd>
                                 <dt>Alamat</dt>
                                <dd><?php echo $alamat; ?></dd>
								 <dt>Cara Bayar</dt>
                                <dd><span class="label label-warning"><?php echo $bayar; ?></span></dd>
								<dt>No urut</dt>
								<dd><span class="label label-info"><?php echo $no_reg; ?></span></dd>
								
								
                            </dl>
							<button type='button' class='view btn btn-primary' data-toggle='modal' id='<?php echo $no_rkm_medis; ?>' tgl='<?php echo $date;?>'   no_raw='<?php echo $no_rawat; ?>' data-target='#myModal'>Riwayat Pemeriksaan</button>
                            
                            <main class="bg">
                        
                                <?php
                           $cet=num_rows(query("SELECT no_rawat FROM pemeriksaan_ralan WHERE no_rawat='{$no_rawat}'"));
							if ($cet > 0){?>
                            <br />
                             <div class="alert alert-danger" role="alert">Data Pemeriksaan Sudah Masuk Ke dokter<p align="right">
                             
                            <a href="ubah-periksa.php?id=<?php echo $no_rkm_medis; ?>&idob=<?php  echo $no_rawat;?>"><button type="button" class="btn btn-warning btn-xs">Ubah data</button></a>  <button type="button" class="view_data btn btn-primary btn-xs" data-toggle="modal" id="<?php echo $no_rawat;?>" data-target="#data_modal">Lihat data</button>
                             </p>
                             </div>
                      
                            	 <?php 
							}else{
								 
								 if ($poli == "U0001") {
									 include "includes/p_obg.php";
								 }elseif ($poli == "U0027") {
									include "includes/p_obg_lain.php";
									 
								 }else {
									 include "includes/p_lain.php";
									 }
							}
							?>  
                                  <?php
                                $cet=num_rows(query("SELECT no_rawat FROM pemeriksaan_ralan WHERE no_rawat='{$no_rawat}'"));
							if ($cet > 0){?>
                            
                            <p><button type="button" class="add-dat btn btn-warning" data-toggle="modal" id="<?php echo $no_rawat;?>" id1="<?php echo $dok;?>" data-target="#tindak" disabled="disabled">Nota Poli</button><a href="tindakan.php?id=<?php echo $no_rawat;?>&id1=<?php echo $dok;?>" target="_blank"><button class="btn btn-success" disabled="disabled">Input Tindakan</button></a></p>
                              
                             <?php 
							 $cet=num_rows(query("SELECT no_rawat FROM nota_poli WHERE no_rawat='{$no_rawat}'"));
							if ($cet > 0){?>
                             <?php
								 if ($_POST['nota_up']) {
								
								if (($_POST['nota_up'] <> "") and ($no_rawat <> "")) {
								
                                $insert = query("UPDATE nota_poli SET  no_rawat = '{$no_rawat}' , tgl_rawat = '{$_POST['tgl_perawatan']}',gds ='{$_POST['gds']}',pptes='{$_POST['pp']}',
                                                 p_urin='{$_POST['pu']}',hbsag='{$_POST['hbsag']}',med_ringan='{$_POST['medring']}',med_sedang='{$_POST['medsed']}',
                                                med_berat='{$_POST['medber']}',ecg='{$_POST['ecg']}',rontgen='{$_POST['rontgen']}',lab='{$_POST['lab']}',lain='{$_POST['lain']}' WHERE no_rawat='{$no_rawat}'");
													  
													 
													 
                                if ($insert) {
                                    redirect("pasien.php?action=view&id={$id}");
									
                                }
								
							}
                        }
                        ?>
                            <div class="header">
                            <h2>Nota Poliklinik Edit</h2>
                            </div>
                            <form action="" method="post">
                            <div class="row">
                            <?php
                                $e = query("SELECT a.no_rawat,a.tgl_rawat,a.gds, a.pptes, a.p_urin, a.hbsag, 
                                                         a.med_ringan, a.med_sedang, a.med_berat, a.ecg, a.rontgen,a.lab,a.lain
                                                  FROM nota_poli a
                                                  WHERE a.no_rawat = '{$no_rawat}'");
                            while ($s = fetch_array($e)) 
                            {?>
                            <input type="hidden" name="norawat" value="<?php echo $no_rawat;?>" />
                             <input name="tgl_perawatan" type="hidden" value="<? echo date ('Y-m-d'); ?>" >
                              <div class="col-md-3"><input type="checkbox" name="gds" value="GDS"  
							  <?php if ($s['gds']!== "GDS"){print ""; }else{ print "checked";};?> /> GDS</div>
                              <div class="col-md-3"><input type="checkbox" name="pp" value="PP TEST" 
							  <?php if ($s['pptes']!== "PP TEST"){print ""; }else{ print "checked";};?>/> PP TEST</div>
                              <div class="col-md-3"><input type="checkbox" name="pu" value="PROTEIN URINE" 
							  <?php if ($s['p_urine']!== "PROTEIN URINE"){print ""; }else{ print "checked";};?>  /> PROTEIN URINE</div>
                              <div class="col-md-3"><input type="checkbox" name="hbsag" value="HBSAG" 
                              <?php if ($s['hbsag']!== "HBSAG"){print ""; }else{ print "checked";};?>/> HbsAg</div>
                              <div class="col-md-3"><input type="checkbox" name="medring" value="MEDIKASI RINGAN" 
                               <?php if ($s['med_ringan']!== "MEDIKASI RINGAN"){print ""; }else{ print "checked";};?>/> Medikasi Ringan</div>
                              <div class="col-md-3"><input type="checkbox" name="medsed" value="MEDIKASI SEDANG" 
                              <?php if ($s['med_sedang']!== "MEDIKASI SEDANG"){print ""; }else{ print "checked";};?>/> Medikasi Sedang</div>
                              <div class="col-md-3"><input type="checkbox" name="medber" value="MEDIKASI BERAT" 
                              <?php if ($s['med_berat']!== "MEDIKASI BERAT"){print ""; }else{ print "checked";};?>/> Medikasi Berat</div>
                              <div class="col-md-3"><input type="checkbox" name="ecg" value="ECG" 
                              <?php if ($s['ecg']!== "ECG"){print ""; }else{ print "checked";};?>/> ECG</div>
                              <div class="col-md-3"><input type="checkbox" name="rontgen" value="RONTGEN" 
                               <?php if ($s['rontgen']!== "RONTGEN"){print ""; }else{ print "checked";};?>/> RONTGEN</div>
                              <div class="col-md-3"><input type="checkbox" name="lab" value="LABORATORIUM" 
                              <?php if ($s['lab']!== "LABORATORIUM"){print ""; }else{ print "checked";};?>/> LABORATORIUM</div>
                             
                            </div>
                            <div class="row">
                            <div class="col-md-3"><label> Lainnya</label></div>
                            <div class="col-md-12"><textarea class="form-control ckeditor" name="lain"><?php echo $s['lain'];?></textarea></div> <?php }?>
                            </div>
                            <br />
                            <p><button type="submit" name="nota_up" value="nota_up" onclick="this.value=\'nota_up\'" class="btn btn-success">Save</button> <a href="cetak_nota.php?id=<?php echo $no_rawat;?>" target="_blank"><button type="button" name="ctk_not" class="btn btn-warning">Cetak Nota</button></a></p>
                            </form>
                            <?php }else{?>
                            
                            
                            <?php
								 if ($_POST['nota']) {
								
								if (($_POST['nota'] <> "") and ($no_rawat <> "")) {
								
                                $insert = query("INSERT INTO nota_poli 
                                                (no_rawat, tgl_rawat,gds,pptes,
                                                 p_urin,hbsag,med_ringan,med_sedang,
                                                med_berat,ecg,rontgen,lab,lain
                                                ) 
                                                 VALUES ('{$no_rawat}',
                                                         '{$_POST['tgl_perawatan']}',
                                                         '{$_POST['gds']}',
														 '{$_POST['pp']}',
                                                         '{$_POST['pu']}',
                                                         '{$_POST['hbsag']}',
                                                         '{$_POST['medring']}',
                                                         '{$_POST['medsed']}',
                                                         '{$_POST['medber']}',
                                                         '{$_POST['ecg']}',
                                                          '{$_POST['rontgen']}',
                                                         '{$_POST['lab']}',
                                                         '{$_POST['lain']}'
														 
                                                     )");
													  
													 
													 
                                if ($insert) {
                                    redirect("pasien.php?action=view&id={$id}");
									
                                }
								
							}
                        }
                        ?>
                            <div class="header">
                            <h2>Nota Poliklinik</h2>
                            </div>
                            <form action="" method="post">
                            <div class="row">
                            <input type="hidden" name="norawat" value="<?php echo $no_rawat;?>" />
                             <input name="tgl_perawatan" type="hidden" value="<? echo date ('Y-m-d'); ?>" >
                              <div class="col-md-3"><input type="checkbox" name="gds" value="GDS" /> GDS</div>
                              <div class="col-md-3"><input type="checkbox" name="pp" value="PP TEST" /> PP TEST</div>
                              <div class="col-md-3"><input type="checkbox" name="pu" value="PROTEIN URINE" /> PROTEIN URINE</div>
                              <div class="col-md-3"><input type="checkbox" name="hbsag" value="HBSAG" /> HbsAg</div>
                              <div class="col-md-3"><input type="checkbox" name="medring" value="MEDIKASI RINGAN" /> Medikasi Ringan</div>
                              <div class="col-md-3"><input type="checkbox" name="medsed" value="MEDIKASI SEDANG" /> Medikasi Sedang</div>
                              <div class="col-md-3"><input type="checkbox" name="medber" value="MEDIKASI BERAT" /> Medikasi Berat</div>
                              <div class="col-md-3"><input type="checkbox" name="ecg" value="ECG" /> ECG</div>
                              <div class="col-md-3"><input type="checkbox" name="rontgen" value="RONTGEN" /> RONTGEN</div>
                              <div class="col-md-3"><input type="checkbox" name="lab" value="LABORATORIUM" /> LABORATORIUM</div>
                              
                            </div>
                            <div class="row">
                            <div class="col-md-3"><label> Lainnya</label></div>
                            <div class="col-md-12"><textarea class="form-control ckeditor" name="lain"></textarea></div>
                            </div>
                            <br />
                            <p><button type="submit" name="nota" value="nota" onclick="this.value=\'nota\'" class="btn btn-success">Save</button></p>
                            </form>
                            <?php }?>
                            <hr />
                                <?php 
								if ($poli == "U0001"){
									
									?>
                                 <br><a href="cetak_asesment.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Assesmen Perawat </button></a> 
                                  <a href="cetak_asesmendok.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button"  class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Assesmen Dokter </button></a> 
								  <?php  }elseif ($poli == "U0027") {?>
                                  <br><a href="cetak_asesment2.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Assesmen Perawat</button></a> 
								  <a href="cetak_asesmendok.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Assesmen Dokter </button></a> 
                                  <?php }else{?>
                                  <br><a href="cetak_asesmen1.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Assesmen Perawat </button></a> 
                                  <a href="cetak_asesmendok1.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Assesmen Dokter </button></a> 
                                  <?php }?>
                                  
                                  
                                   <a href="spri.php?no_rawat=<?php echo $no_rawat;?>" target="_blank"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> SPRI</button></a>
             		 <?php }else
						{
							echo "";
						}?>
</div>
                    
                 </main>

                              
                              
                  
    <?php } ?>
	
   
   
    <?php
	
	

	//cetak 
	
	
    //delete
    if($_GET['action'] == "delete_diagnosa"){ 

	$hapus = "DELETE FROM diagnosa_pasien WHERE no_rawat='{$_REQUEST['faktur']}' AND kd_penyakit = '{$_REQUEST['kode']}' AND prioritas = '{$_REQUEST['prioritas']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

    }

    //delete
  
	//delete obsteri
	if($_GET['action'] == "delete_obs"){ 

	$hapus = "DELETE FROM ro WHERE id_ob='{$_REQUEST['id_ob']}'";
	$hasil = query($hapus);
	if (($hasil)) {
	    redirect("pasien.php?action=view&id={$id}");
	}

    }

	//delete asess
	if($_GET['action'] == "delete_periksa"){ 

	$hapus = "DELETE FROM pemeriksaan_ralan WHERE no_rawat='{$_REQUEST['no_rawat']}'";
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

    }

    ?>

 

<?php include_once ('layout/footer.php'); ?>
