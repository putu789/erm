<?php 

include_once ('layout/header.php'); 
if(isset($_GET['id'])) {
    $id = $_GET['id']; 
	$cari = $_GET['kd_poli'];
	$cari1 = $_GET['kd_dokter'];
	$cari2 = $_GET['tgl'];
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur FROM reg_periksa a, pasien b WHERE a.no_rkm_medis = b.no_rkm_medis AND b.no_rkm_medis = {$id}";
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
	}
    } else {
	redirect ('pasien.php');
    }
}

?>
 
     <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PASIEN <?php echo $nmpoli; ?></h2>
            </div>

      <?php if(!$_GET['action']){  ?>                       
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
                            <table id="jadwal_dokter" class="table table-bordered" width="100%">
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
									if(isset($_GET['kd_poli']) && isset($_GET['kd_dokter']) && isset($_GET['tgl'])){
										$cari = $_GET['kd_poli'];
										$cari1 = $_GET['kd_dokter'];
										$cari2 = $_GET['tgl'];
										$data = query("SELECT  b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat FROM reg_periksa a, pasien b, dokter c,poliklinik d WHERE a.no_rkm_medis=b.no_rkm_medis AND a.kd_poli=d.kd_poli AND  a.kd_dokter = c.kd_dokter AND a.kd_poli ='".$cari."' AND a.kd_dokter ='".$cari1."' AND a.tgl_registrasi ='".$cari2."'");
										if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") {
											$_data .= " AND a.tgl_registrasi = '{$_POST['tanggal']}'";
										} else { 
											$_data .= " AND a.tgl_registrasi = '$date'";
										}
										$_data .= "  ORDER BY a.no_reg ASC";

										$no = 1;
										
										while($d = fetch_array($data)){
											$st = $d['5']; 
									if ($st === "Belum"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-asterisk'></span>Belum Diperiksa";
										$btn= "";
										$link ='<a style="color:hitam;" class="obst" href="pasien.php?action=view&tanggal='.$_POST['tanggal'].'&id='.$d['3'].'&idob='.$d['no_rawat'].'" class="title">'.ucwords(strtoupper($d['0'])).'</a>';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$d['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" idob="'.$no_rawat.'" href="'.$_SERVER['PHP_SELF'].'?action=view&tanggal='.$_POST['tanggal'].'&id='.$d['3'].'&idob='.$d['no_rawat'].'" class="title">'.ucwords(strtoupper($d['0'])).'</a>';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$d['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<p style="color:hitam;">'.ucwords(strtoupper($d['0'])).'</p>';
										$ases ='<a href="cetak_asesment.php?no_rawat='.$d['no_rawat'].'" target="_blank"><button type="button" class="btn btn-info btn-xs">Cetak Assesmen </button></a>';
										
									}
		    						echo '<tr '.$st.'>';
		    						echo '<td>'.$no.'</td>';
		    						echo '<td>';
		    						echo '<b>'.$link.'</b>';
		    						echo '</td>';
		    						echo '<td>'.$d['1'].'</td>';
		    						echo '<td>'.$d['2'].'</td>';
									echo '<td>'.$d['nm_poli'].'</td>';
									echo '<td>'.$ch.'';
									echo '<br>'.$btn.''.$ases.'</td>';
									
		    						echo '</tr>';
												$no++;
										}
									}
									else {
										echo "gagal";
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
                            
                            
                           

<?php include_once ('layout/footer.php'); ?>
