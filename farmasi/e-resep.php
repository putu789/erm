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

$data=fetch_array(query("SELECT AES_DECRYPT(a.id_user,'nur') as id_user, AES_DECRYPT(a.password,'windi') as password, b.nip as jbtn  from user a, petugas b where a.id_user = AES_ENCRYPT('{$_COOKIE[username]}','nur') and b.nip ='$_COOKIE[username]' and b.kd_jbtn = 'J012'  and a.password = AES_ENCRYPT('{$_COOKIE[password]}','windi') ")); 
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
    <title><?php echo $dataSettings['nama_instansi']; ?> - DOCTOR</title>
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

<body class="theme-blue">
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
                <a class="navbar-brand" href="index.php"><?php echo $dataSettings['nama_instansi']; ?></a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
     <section class="content">
        <div class="container-fluid">
  			<div class="col-md-8"> 
           
            <form action="" method="post" class="form-obt">
                        <div class="header">
                            <h2>
                                Detail e-Resep
                            </h2>
                             </div>
                            <?php 
                            $query_vital = query("SELECT a.suhu_tubuh, a.tensi, a.nadi, a.respirasi, a.tinggi, a.berat, 													a.gcs, a.keluhan, a.pemeriksaan, a.alergi, a.imun_ke, a.rtl, a.diagnosa_dr, a.tindakan_dr
                                                  FROM pemeriksaan_ralan a, reg_periksa b, dokter c
                                                  WHERE a.no_rawat = '{$no_rawat}' and a.no_rawat = b.no_rawat
														and c.kd_dokter = '{$_SESSION['username']}'");
														while ($data_sip = fetch_array($query_vital))
														{
														?>	
                           <p style="font-size:16px; color:#F00;"><b>PERINGATAN!!!!!!!!<br>Pasien ini Alergi Terhadap: <u><?php echo $data_sip['alergi'] ; ?></u></b></p>
                       
<?php }?>
            			
                       
                        
                         <div class="body table-responsive">
                 <table class="table table-striped">
                <thead>
                    <tr>
                    	<th>#NO</th>
                    	<th>No. Resep</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>                    </tr>
                </thead>
                <tbody>
                <?php 
				$per = query("SELECT kd_dokter,no_rkm_medis FROM reg_periksa WHERE no_rawat = '".$no_rawat."'");
				 while ($dat = fetch_array($per)){
					$do = $dat['kd_dokter'];
					$no_rkm = $dat['no_rkm_medis'];
				

                $query_resep = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$no_rawat."' AND c.kd_dokter = '".$do."' ");
				$no =1;
                while ($data_resep = fetch_array($query_resep)) {?>
                          <tr> 
                          <td><?php echo $no;?></td>
                          <td><?php echo $data_resep['no_resep'];?></td>
                          <td><?php echo $data_resep['3']; ?></td>
                          <td><?php echo $data_resep['1']; ?></td>
                          <td><?php echo $data_resep['2']; ?></td>
                        
				   
                   </tr>
              
               <?php 
			   $no++;
			   } ?>
                
              		</tbody>
           			</table>

                    <?php 
					$query_re = query("SELECT a.kode_brng, a.jml,c.no_rawat, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$no_rawat."' AND c.kd_dokter = '".$do."' ");
               $sta = fetch_array($query_re);
			   echo '<div class="btn-group"><a href="includes/cetak_resep.php?no_resep='.$sta['no_resep'].'&rwt='.$sta['no_rawat'].'" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Cetak Resep</button></a> <div class="btn-group"><a href="includes/cetak_resep1.php?no_resep='.$sta['no_resep'].'&rwt='.$sta['no_rawat'].'" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Cetak Resep</button></a>'; 
					?>
                    
<?php }?>
          		  </div>
                    <a class="btn-warning btn" href="e-resep.php?aksi&no_rawat=<?php echo $no_rawat;?>">Sudah Selesai</a>
   					
   					<script>
   				 function close_window() {
  					if (confirm("Yakin Sudah Selesai?")) {
    			close();
 	 		}
			}
				</script>
                </div>
            </div>
            </dl>
		</div>
      
    </div>
    <br>
   
   <?php }?>
   <?php 
   if (isset($_GET['aksi'])){
    if(isset($_GET['no_rawat'])){
		$rawat = $_GET['no_rawat'];
		$hapus = "UPDATE pemeriksaan_ralan SET stts_validasi = '1' WHERE no_rawat = '".$rawat."'";
			$hasil = query($hapus);
        if (($hasil)) {
	    redirect("pasien.php");
	}

        
    }
    
}
?>

    </body>


<?php include_once ('layout/footer.php'); ?>