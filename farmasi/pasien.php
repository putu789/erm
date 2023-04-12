<?php 

include_once ('layout/header.php'); 

if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur,a.kd_dokter, a.kd_poli FROM reg_periksa a, pasien b WHERE a.no_rkm_medis = b.no_rkm_medis AND b.no_rkm_medis = {$id}";
    if(isset($_REQUEST['tanggal']) && $_REQUEST['tanggal'] !="") {
        $_sql .= " AND a.tgl_registrasi = '{$_REQUEST['tanggal']}'";
    } else { 
        $_sql .= " AND a.tgl_registrasi = '$date'";
    }

    $found_pasien = query($_sql);	
    if(num_rows($found_pasien) == 1) {
	while($row = fetch_array($found_pasien)) { 
	    $no_rkm_medis  = $row['0']; 
	    $no_rawat	   = $row['1'];
	    $nm_pasien     = $row['2'];
	    $umur          = $row['3'];
		$dok          = $row['4'];
		$poli          = $row['5'];
	}
    } else {
	redirect ('pasien.php');
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
                       <main class="bg">
                            <input class="ip" id="tab1" type="radio" name="tabs" checked>
                                <label class="lb" for="tab1">Belum Dilayani</label>
                              <input class="ip" id="tab2" type="radio" name="tabs">
                                <label class="lb" for="tab2">Sudah Dilayani</label>
                             
                              <section class="section" id="content1">
                                <dd>
                               	<div class="table-responsive">
                                          <table id="jadwal_dokter" class="table table-bordered data " width="100%">
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
	    						$_sql = "SELECT b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat,e.stts_obat FROM reg_periksa a, pasien b, dokter c,poliklinik d, pemeriksaan_ralan e WHERE  a.no_rkm_medis = b.no_rkm_medis AND  a.kd_poli=d.kd_poli AND a.stts='Sudah' AND a.no_rawat = e.no_rawat AND a.kd_dokter = c.kd_dokter  AND a.stts='Sudah' And e.stts_validasi='0'"; 
        						if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") {
            						$_sql .= " AND a.tgl_registrasi = '{$_POST['tanggal']}'";
        						} else { 
            						$_sql .= " AND a.tgl_registrasi = '$date'";
        						}
        						$_sql .= "  ORDER BY a.stts ASC , a.no_reg ASC";

        						$sql = query($_sql); 
        						$no = 1;
								while($row = fetch_array($sql)){
									$st = $row['5']; 
									$stt_obat = $row['stts_obat'];
									$key="";
									$cey ="";
									if ($stt_obat == "no"){
										$key  = "<span class='label label-danger'>Tanpa Obat</span>";
										$cey  = "";
									}else{
										$key  = "<span class='label label-success'>Dengan Obat</span>";
										$cey  = "<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
									}
									if ($st === "Belum"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-asterisk'></span>Belum Diperiksa";
										$btn= "";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
										
									}
		    						echo '<tr '.$st.'>';
		    						echo '<td>'.$no.'</td>';
		    						echo '<td>';
		    						echo '<b>'.$link.'</b><br>
									'.$row['no_rkm_medis'].'';
		    						echo '</td>';
		    						echo '<td>'.$row['1'].'</td>';
		    						echo '<td>'.$row['2'].'</td>';
									echo '<td>'.$row['nm_poli'].'</td>';
									echo '<td>'.$ch.'';
									echo '<br>'.$cey.''.$key.'</td>';
									
		    						echo '</tr>';
        							$no++;
	    						}
	    						?>
	    						</tbody>
                            </table>
							</section>
                         <section class="section" id="content2">
						 <div class="table-responsive">
                                          <table id="jadwal_dokter" class="table table-bordered data " width="100%">
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
	    						$_sql = "SELECT b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat,e.stts_obat FROM reg_periksa a, pasien b, dokter c,poliklinik d, pemeriksaan_ralan e WHERE  a.no_rkm_medis = b.no_rkm_medis AND  a.kd_poli=d.kd_poli AND a.stts='Sudah' AND a.no_rawat = e.no_rawat AND a.kd_dokter = c.kd_dokter  AND a.stts='Sudah' And e.stts_validasi='1'"; 
        						if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") {
            						$_sql .= " AND a.tgl_registrasi = '{$_POST['tanggal']}'";
        						} else { 
            						$_sql .= " AND a.tgl_registrasi = '$date'";
        						}
        						$_sql .= "  ORDER BY a.stts ASC , a.no_reg ASC";

        						$sql = query($_sql); 
        						$no = 1;
								while($row = fetch_array($sql)){
									$st = $row['5']; 
									$stt_obat = $row['stts_obat'];
									$key="";
									$cey ="";
									if ($stt_obat == "no"){
										$key  = "<span class='label label-danger'>Tanpa Obat</span>";
										$cey  = "";
									}else{
										$key  = "<span class='label label-success'>Dengan Obat</span>";
										$cey  = "<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
									}
									if ($st === "Belum"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-asterisk'></span>Belum Diperiksa";
										$btn= "";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<a href='e-resep.php?id=".$row['no_rkm_medis']."&idob=".$row['no_rawat']."' target='_blank'><button type='button'  class='btn btn-info btn-xs'>Resep Obat</button></a><br /><br />";
										$link =''.ucwords(strtoupper($row['0'])).'';
										
										
									}
		    						echo '<tr '.$st.'>';
		    						echo '<td>'.$no.'</td>';
		    						echo '<td>';
		    						echo '<b>'.$link.'</b><br>
									'.$row['no_rkm_medis'].'';
		    						echo '</td>';
		    						echo '<td>'.$row['1'].'</td>';
		    						echo '<td>'.$row['2'].'</td>';
									echo '<td>'.$row['nm_poli'].'</td>';
									echo '<td>'.$ch.'';
									echo '<br>'.$cey.''.$key.'</td>';
									
		    						echo '</tr>';
        							$no++;
	    						}
	    						?>
	    						</tbody>
                            </table>
							</section>
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
      

   
<?php include_once ('layout/footer.php'); ?>
