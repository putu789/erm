
<?php include_once ('layout/header.php'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD PERAWAT</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box success hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">enhanced_encryption</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PASIEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo num_rows(query("SELECT no_rkm_medis FROM pasien"));?>" data-speed="5000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group_add</i>
                        </div>
                        <div class="content">
                            <div class="text">PASIEN BULAN INI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo num_rows(query("SELECT no_rkm_medis FROM pasien WHERE tgl_daftar LIKE '%$month%'"));?>" data-speed="2000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">PASIEN POLI BULAN INI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo num_rows(query("SELECT no_rawat FROM reg_periksa WHERE tgl_registrasi LIKE '%$month%'"));?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">PASIEN POLI HARI INI</div>
                            <div class="number count-to" data-from="0" data-to="<?php 
                            echo num_rows(query("SELECT no_rawat FROM reg_periksa WHERE tgl_registrasi LIKE '%$date%'"));?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>POLIKLINIK HARI INI</h2>
                                </div>
                            </div>
                        </div>
						<?php $dates = 'Tanggal : '.date("d-m-Y "); ?>
                        <?php
						$jumlah=array();
						$poli=array();
						$date = date("Y-m-d"); 
						$sql = "select poliklinik.nm_poli, count(*) as jumlah from reg_periksa INNER JOIN poliklinik on reg_periksa.kd_poli=poliklinik.kd_poli WHERE reg_periksa.tgl_registrasi='$date' and poliklinik.nm_poli !='-' group by reg_periksa.kd_poli  order by count(*) desc ";
						$hasil=query($sql);
						while ($data = fetch_array ($hasil)){
                            $jumlah[]=intval($data['jumlah']);
                            $poli[]= $data['nm_poli'];
                        }
						?>
                                <div id="kunjungan"></div>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- #END# CPU Usage -->
           
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>

<?php include_once ('layout/footer.php'); ?>
