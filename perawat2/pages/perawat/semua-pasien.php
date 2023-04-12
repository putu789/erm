	
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Keperawatan	
        <small>Asesmen Keperawatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="index.php?page=pilih-poli"> Poliklinik</a></li>
        <li class="active">Daftar Pasien</li>
      </ol>
    </section>    
    <br />
    <div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"> <i class="fa fa-list"></i> Daftar Pasien  Hari Ini</h3>
  <h4> Tanggal : <?php if(isset($_POST['tanggal']) && $_POST['tanggal'] !="") { echo $_POST['tanggal']; } else { echo $date; } ?></h4>
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
 
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
	    						$_sql = "SELECT b.nm_pasien, c.nm_dokter, a.no_reg, a.no_rkm_medis, d.nm_poli,a.stts, a.no_rawat ,a.no_rawat,b.alamat,b.namakeluarga,e.nm_kel,f.nm_kec,g.nm_kab,b.namakeluarga,h.png_jawab,a.status_lanjut FROM reg_periksa a, pasien b, dokter c,poliklinik d,kelurahan e, kecamatan f, kabupaten g, penjab h WHERE   a.no_rkm_medis = b.no_rkm_medis AND  a.kd_poli=d.kd_poli AND a.kd_dokter = c.kd_dokter AND b.kd_kel = e.kd_kel And b.kd_kec = f.kd_kec And b.kd_kab = g.kd_kab And a.kd_pj = h.kd_pj"; 
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
										$link ='<a style="color:hitam;" class="obst" href="index.php?page=input-asesmen&tanggal='.$_POST['tanggal'].'&id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Dirawat"){
										$st = "class='alert alert-warning'";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Diperiksa Perawat";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" idob="'.$no_rawat.'" href="index.php?page=input-asesmen&tanggal='.$_POST['tanggal'].'&id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
									}else if($st === "Sudah"){
										$st = "";
										$ch = "<span class='glyphicon glyphicon-ok'></span>Sudah Selesai Diperiksa";
										$btn ="<button type='button' class='view_data btn btn-primary btn-xs' data-toggle='modal' id='".$row['6']."' data-target='#data_modal'>Lihat data</button>";
										$link ='<a style="color:hitam;" class="obst" href="index.php?page=input-asesmen&tanggal='.$_POST['tanggal'].'&id='.$row['3'].'&idob='.$row['no_rawat'].'" class="title">'.ucwords(strtoupper($row['0'])).'</a>';
										
										
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
                            <form method="POST" action="">
                            <div class="col-xs-12 col-md-8">
                            	<div class="input-group date">
                             		 <div class="input-group-addon">
                   						 <i class="fa fa-calendar"></i>
                 					 </div>
                  
                 						 <input type="text" name="tanggal" class="form-control pull-right" id="datepicker"  placeholder="Pilih tanggal...">
               					</div>
                                </div>
                			<div class="col-xs-6 col-md-4">
                                     	<input type="submit" class="btn btn-primary btn-md m-l-15 " value="Submit">
                             </div>
              		</div>
                 </form>
                            
                              	
                            
  </div>
  </div>
  </div>
  