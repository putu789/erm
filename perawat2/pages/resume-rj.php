 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resume	
        <small>Rawat Jalan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Resume Rawat Jalan</li>
      </ol>
    </section>    
    <br />
    <div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"> <i class="fa fa-list"></i> Resume Rawat Jalan</h3>
  
  </div>
  <!-- /.box-header -->
   <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                    <?php if (isset($_POST['proses'])) { ?>
                        <div class="header">
                            <h4>
                                Periode : <?php echo $_POST['tanggal_awal']; ?> s/d <?php echo $_POST['tanggal_akhir']; ?>
                            </h4>
                        </div>
                    <?php } ?>
                        <div class="body">

                        <?php
                        if (isset($_POST['proses'])) {
                            if (($_POST['tanggal_awal'] == "")||($_POST['tanggal_akhir'] == "")) {
        	                    redirect ('rekam-medik.php');
                            } else {  
                        ?>


                        <?php 
                        $q_pasien = query ("select * from pasien where no_rkm_medis = '$_POST[no_pasien]'");
                        $data_pasien = fetch_array($q_pasien); 
                        ?>
                            <dl class="dl-horizontal">
                                <dt>Nama Lengkap</dt>
                                <dd><?php echo $data_pasien['nm_pasien']; ?></dd>
                                <dt>No. RM</dt>
                                <dd><?php echo $data_pasien['no_rkm_medis']; ?></dd>
                                <dt>Jenis Kelamin</dt>
                                <dd><?php echo $data_pasien['jk']; ?></dd>
                                <dt>Umur</dt>
                                <dd><?php echo $data_pasien['umur']; ?></dd>
                            </dl>
			    			<div class="body table-responsive">
                           <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>No RM</th>
                                         <th>Nama Pasien</th>
                                        <th>Anamnesa</th>
                                        <th>Pemeriksaan</th>
                                        <th>Tindakan</th>
                                        <th>Diagnosa</th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php 
                                $q_kunj = query ("SELECT a.tgl_registrasi, b.nm_poli, c.keluhan, c.pemeriksaan, a.no_rawat,c.diagnosa_dr,a.no_rkm_medis,d.nm_pasien,c.tindakan_dr,c.tindakan_dr_lain FROM reg_periksa a, poliklinik b, pemeriksaan_ralan c, pasien d WHERE a.no_rkm_medis = '$_POST[no_pasien]' AND a.tgl_registrasi BETWEEN '$_POST[tanggal_awal]' AND '$_POST[tanggal_akhir]'  AND a.kd_poli = b.kd_poli AND a.no_rawat = c.no_rawat And a.no_rkm_medis = d.no_rkm_medis");
								//$q_kunj = query("SELECT a.tgl_registrasi, b.nm_poli, c.keluhan, c.pemeriksaan, a.no_rawat FROM reg_periksa a, poliklinik b, pemeriksaan_ralan c WHERE a.no_rkm_medis = '064829' AND a.tgl_registrasi BETWEEN '2018-02-02' AND '2018-02-02' AND a.kd_poli = b.kd_poli AND a.no_rawat = c.no_rawat");

                                if(num_rows($q_kunj) >= 1) {
                                    while ($data_kunj = fetch_array($q_kunj)) { 
                                        $tanggal   = $data_kunj[0];
                                        $nama_poli = $data_kunj[1];
                                        $keluhan = $data_kunj[2];
                                        $pemeriksaan = $data_kunj[3];
                                        $no_rawat = $data_kunj[4];
										 $diagnosa = $data_kunj[5];
										 $no_rkm = $data_kunj[6];
										 $nama_pasien = $data_kunj[7];
										  $tind = $data_kunj[8];
										  $tind2 = $data_kunj[9];
                                ?>
                                    <tr>
                                        <td><?php echo $tanggal; ?></td>
                                        <td><?php echo  $no_rkm; ?></td>
                                         <td><?php echo  $nama_pasien; ?></td>
                                        <td><?php echo $keluhan; ?></td>
                                        <td><?php echo $pemeriksaan; ?></td>
                                        <td><?php echo $tind, $tind2; ?></td>
                                         <td><?php echo  $diagnosa; ?></td>
										  <td>
                                         <a href="cetak_surat.php?no_rawat=<?php echo  $no_rawat ?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a><br> <a href="" target="_blank"><span class="glyphicon glyphicon-download"></span> Unduh</a></td>
                                        <td>
                                           
                                        </td>
                                    </tr>
                                <?php 
                                    }
                                } else { 
                                ?>
                                    <tr>
                                        <td>Belum ada riwayat pemeriksaan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                } 
                                ?>
                                </tbody>
                            </table>
			    </div>
                        </div>
                        <div class="body">
                        <?php
                            }
                        }
                        ?>

                        <form method="post" action="">
                            <dl class="dl-horizontal">
                                <dt>Pasien</dt>
                                <dd><select name="no_pasien" class="pasien" style="width:100%"></select></dd><br/>
                                <dt>Periode</dt>
                                <dd><input type="text" id="datepicker" class="datepicker form-control" name="tanggal_awal">
                                <dt></dt><dd>s/d</dd>
                                <dt></dt><dd><input type="text" id="datepicker1" class="datepicker form-control" name="tanggal_akhir"></dd><br/>
                                <dt></dt><dd><input type="submit" class="btn btn-primary waves-effect" name="proses" value="Proses"> <button type="reset" class="btn btn-red waves-effect" name="batal" style="background-color: #f7f7f7 !important; color: #555; border-color: #ccc; text-shadow: none; -webkit-appearance: none;">Batal</button></dd>
                            </dl>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
 
  </div>
  </div>
  </div>
  