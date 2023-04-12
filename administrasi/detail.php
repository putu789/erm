<?php 

/***
* e-Dokter from version 0.1 Beta
* Last modified: 02 Pebruari 2018
* Author : drg. Faisol Basoro
* Email : drg.faisol@basoro.org
*
* File : layout/header.php
* Description : Header layout
* Licence under GPL
***/

ob_start();
session_start();

require_once('config.php');

$data=fetch_array(query("SELECT AES_DECRYPT(a.id_user,'nur') as id_user, AES_DECRYPT(a.password,'windi') as password, b.nip as jbtn  from user a, petugas b where a.id_user = AES_ENCRYPT('{$_COOKIE[username]}','nur') and b.nip ='$_COOKIE[username]' and b.kd_jbtn = 'J011'  and a.password = AES_ENCRYPT('{$_COOKIE[password]}','windi') ")); 
$user = $data[0];
$pass = $data[1];

if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) { 
    redirect('login.php'); 
} else if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != $pass)) { 
    redirect('login.php?action=logout'); 
} else { 
    $_SESSION['username'] = $_COOKIE['username'];
	$_SESSION['jabatan'] = $data['kd_jbtn'];  
}
?>
﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $dataSettings['nama_instansi']; ?></title>
    <link rel="icon" href="LOG.ico">
     <link href="../asset/css/tab.css" rel="stylesheet">
    <link href="../asset/css/roboto.css" rel="stylesheet">
    <link href="../asset/css/material-icon.css" rel="stylesheet">
    <link href="../asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="../asset/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="../asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="../asset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="../asset/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../asset/css/select2.min.css">
    <link href="../asset/css/style.css" rel="stylesheet">
    <link href="../asset/css/all-themes.min.css" rel="stylesheet" />
    <script type="text/javascript" src="../asset/js/bootstrap-select.js" defer></script>
    <script type="text/javascript" src="../asset/js/select2.min.js" defer></script>
    <script type="text/javascript" src="../asset/plugins/ckeditor/ckeditor.js"></script>
    <script src="../asset/plugins/jquery/jquery.min.js"></script>
</head>

<body class="theme-red">
</body>
 <?php
    				$no_rawat = $_GET['idob']; 
					$no_rkm_medis = $_GET['id']; 
					if(isset($_GET['idob'])){
						?>

    <div class="overlay"></div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><?php echo $dataSettings['nama_instansi']; ?> - DOCTOR</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <?php $dataGet = fetch_array(query("SELECT nama, jk FROM petugas WHERE nip = '{$_SESSION['username']}'")); ?>
                <div class="image">
                <?php
                if ($dataGet['1'] == 'L') { 
                    echo '<img src="../asset/images/pria.png" width="48" height="48" alt="User" />';
                } else if ($dataGet['1'] == 'P') { 
                    echo '<img src="../asset/images/wanita.png" width="48" height="48" alt="User" />';
                }
                ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $dataGet['0']; ?></div>
                    <div class="email"><?php echo $_SESSION['username']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="login.php?action=logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                   
                    </li>
                    <li>
                        <a href="pasien.php">
                            <i class="material-icons">people</i>
                            <span>Data Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="rekam-medik.php">
                            <i class="material-icons">layers</i>
                            <span>Rekam Medik</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - <?php echo date('Y'); ?>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>


     <section class="content">
     <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="card" style="padding:30px;">
         <?php  $select = query("SELECT  a.no_rawat,a.umurdaftar,b.nm_pasien,b.agama,b.pnd,b.stts_nikah,b.pekerjaan,b.namakeluarga,b.keluarga,b.pekerjaanpj,b.no_rkm_medis,b.alamat,b.jk, b.tgl_lahir,c.nm_kec, d.nm_kab, e.png_jawab FROM reg_periksa a, pasien b,kecamatan c,kabupaten d,penjab e WHERE a.no_rawat ='".$no_rawat."' AND a.no_rkm_medis = b.no_rkm_medis AND b.kd_kec = c.kd_kec AND d.kd_kab = b.kd_kab And a.kd_pj = e.kd_pj");
		 while ($hasil = fetch_array($select)) {
			 ?>
             
             <dl class="dl-horizontal">
                                <dt>Nama Lengkap :</dt>
                                <dd><?php echo $hasil['nm_pasien']; ?></dd>
                                <dt>No. RM :</dt>
                                <dd><?php echo $hasil['no_rkm_medis']; ?></dd>
                                <dt>No. Rawat :</dt>
                                <dd><?php echo $hasil['no_rawat']; ?></dd>
                                <dt>Alamat :</dt>
                                <dd><?php echo $hasil['png_jawab']; ?></dd>
                            </dl>
             
             <?php }?>
           <div class="header">
                            <h2>Nota Poliklinik</h2>
                            </div>
                            <div class="row">
                            <?php
                                $e = query("SELECT a.no_rawat,a.tgl_rawat,a.gds, a.pptes, a.p_urin, a.hbsag, 
                                                         a.med_ringan, a.med_sedang, a.med_berat, a.ecg, a.rontgen,a.lab,a.lain
                                                  FROM nota_poli a
                                                  WHERE a.no_rawat = '{$no_rawat}'");
                            while ($s = fetch_array($e)) 
                            {?>
                              <div class="col-md-3"><input type="checkbox"  name="gds" value="GDS"  
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
                            
                            <div class="col-md-3"><table class="table table-hover">
                <tr>
                <td class="r d">Lainnya</td>
                <td class="r d"><?php echo $s['lain'];?></td>
                </tr>
                </table></div>
                           <?php }?>
                            </div>
            </dl>
    <br>
   
   <?php }?>
   <hr>
     <?php
                              
								 $query_vital = query("SELECT a.keluhan, a.pemeriksaan, a.tindakan_dr,a.tindakan_dr_lain, a.diagnosa_dr, a.kontrol_ul_tg ,a.suhu_tubuh, a.tensi,  a.berat, a.tinggi, a.nadi, a.gcs, a.respirasi,a.alergi, a.imun_ke, a.riwayat,a.stts_obat
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
                       	
                     
        
								
                                
						
                      <style>
						
								
							.r{
								background:#baadad;
								width:30%;
								color:#FFF;
							}
							</style>
                           
                               
				<table class="table table-hover">
                <tr>
                <td class="r d">Pemeriksaan Dokter</td>
	  <td class="d"><?php echo $data_vital['pemeriksaan'];?></td>
                    </tr>
                    <tr>
                              <td class="r d">Tindakan Dokter</td>
                    <td class="d"><?php echo $data_vital['tindakan_dr'];?><br>
                    <?php echo $data_vital['tindakan_dr_lain'];?></td>
                    </tr>
                    </table>
                            <?php }?>
 
</div>
</div>
</div>
    </body>


<?php include_once ('layout/footer.php'); ?>