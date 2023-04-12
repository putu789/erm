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
            <div class="block-header">
                <h2>PASIEN <?php echo $nmpoli; ?></h2>
            </div>

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
                       
                                <dd>
                                <div class="table-responsive">
                               
                                          <table id="jadwal_dokter" class="table table-bordered data" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pasien</th>
                                        <th>Dokter Tujuan</th>
                                        <th>No. Antrian</th>
                                        <th>Poli Tujuan</th>
                                        <th>No CM</th>
                                        <th>Status Rawat</th>
                                        
                                    </tr>
                                </thead>
	    						<tbody>
	    						<?php
								
	    						$_sql = "SELECT b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat,e.stts_obat,e.stts_validasi FROM reg_periksa a, pasien b, dokter c,poliklinik d, pemeriksaan_ralan e WHERE  a.no_rkm_medis = b.no_rkm_medis AND  a.kd_poli=d.kd_poli AND a.kd_dokter = c.kd_dokter AND a.stts='Sudah'  AND a.status_bayar='Belum Bayar' AND e.no_rawat=a.no_rawat"; 
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
									$vd =$row['stts_validasi'];
									$ck = "";
									if($vd == '1'){
										$ck = "<span class='label label-success'>Selesai Dilayanai</span>";
									}else{
										$ck = "<span class='label label-danger'>Belum Dilayanai</span>";
									}
									
									$key="";

									if ($stt_obat == "no"){
										$key  = "<span class='label label-danger'>Tanpa Obat</span>";
									}else{
										$key  = "<span class='label label-success'>Dengan Obat</span>";
									}
									if ($st === "Belum"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-asterisk'></span>Belum Diperiksa";
										$btn= "";
										$link ='<a style="color:hitam;" class="obst" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" idob="'.$no_rawat.'" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" href="detail.php?id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										$ases ='<a href="cetak_asesment.php?no_rawat='.$row['no_rawat'].'" target="_blank"><button type="button" class="btn btn-info btn-xs">Cetak Assesmen </button></a>';
										
									}
		    						echo '<tr '.$st.'>';
		    						echo '<td>'.$no.'</td>';
		    						echo '<td>';
		    						echo '<b>'.$link.'</b>';
		    						echo '</td>';
		    						echo '<td>'.$row['1'].'</td>';
		    						echo '<td>'.$row['2'].'</td>';
									echo '<td>'.$row['nm_poli'].'</td>';
									echo '<td>'.$row['no_rkm_medis'].'</td>';
									echo '<td>'.$ch.'';
									echo '<br>'.$btn.''.$key.''.$ck.'</td>';
									
		    						echo '</tr>';
        							$no++;
	    						}
	    						?>
	    						</tbody>
                            </table>
                            </div>
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
      

 	
 	
 

<?php include_once ('layout/footer.php'); ?>
