<?php 

ob_start();
session_start();

require_once('config.php');

$data=fetch_array(query("SELECT AES_DECRYPT(a.id_user,'nur') as id_user, AES_DECRYPT(a.password,'windi') as password,  b.kd_poli as kd_poli from user a, jadwal b where a.id_user = AES_ENCRYPT('{$_COOKIE[username]}','nur') and b.kd_dokter = '$_COOKIE[username]' and a.password = AES_ENCRYPT('{$_COOKIE[password]}','windi')")); 

$user = $data[0];
$pass = $data[1];

if (!isset($_COOKIE['username']) && !isset($_COOKIE['password'])) { 
    redirect('login.php'); 
} else if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != $pass)) { 
    redirect('login.php?action=logout'); 
} else { 
    $_SESSION['username'] = $_COOKIE['username']; 
    $_SESSION['jenis_poli'] = $data[2];   
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
    <link href="../asset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link rel="stylesheet" href="../asset/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../asset/css/select2.min.css">
    <link href="../asset/css/style.css" rel="stylesheet">
    <link href="../asset/css/all-themes.min.css" rel="stylesheet" />
    <script type="text/javascript" src="../asset/js/bootstrap-select.js" defer></script>
    <script type="text/javascript" src="../asset/js/select2.min.js" defer></script>
    <script type="text/javascript" src="../asset/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../asset/plugins/jquery/jquery.min.js"></script>
	<style>
	input[type=checkbox] {
	transform: scale(1.5);
	margin-right:2px ;
	margin-left:2px ;
	}
	input[type=radio] {
	transform: scale(1.5);
	margin-right:2px ;
	margin-left:2px ;
	}
	</style>
</head>

<body class="theme-green">
 <?php
    				$no_rawat = $_GET['idob']; 
					$no_rkm_medis = $_GET['id']; 
					$dok = $_SESSION['username'];
					if(isset($_GET['idob'])){
						?>
                        
 <?php
    if (isset($_POST['btn_copy'])){
		$obat = $_POST['kode_obat'];
		$jumlah = $_POST['jumlah'];
		$aturan = $_POST['aturan'];
 		$count = count($obat);
		if(!empty($obat)  && !empty($jumlah)){
			$onhand = query("SELECT no_resep FROM resep_obat WHERE no_rawat = '{$_POST['no_rwt']}'");
                    			$dtonhand = fetch_array($onhand);
                    			$get_number = fetch_array(query("SELECT max(no_resep) FROM resep_obat"));
                    			$lastNumber = substr($get_number[0], 0, 10);
                    			$next_no_resep = sprintf('%010s', ($lastNumber + 1)); 

								
                    			if ($dtonhand['0'] > 1) {
								for( $i=0; $i < $count; $i++ ){
                        		$insert = query("INSERT INTO resep_dokter (no_resep,kode_brng,jml,aturan_pakai) VALUES ('{$dtonhand['0']}', '{$obat[$i]}', '{$jumlah[$i]}', '{$aturan[$i]}')");
									}
								} else {
                        			$insert = query("INSERT INTO resep_obat VALUES ('{$next_no_resep}', '{$_POST['tgl']}', '{$_POST['jam']}', '{$_POST['no_rwt']}', '{$_POST['dokter']}', '{$_POST['tgl']}', '{$_POST['jam']}')");
									for( $i=0; $i < $count; $i++ ){
                        			$insert2 = query("INSERT INTO resep_dokter (no_resep,kode_brng,jml,aturan_pakai) VALUES ('{$next_no_resep}', '{$obat[$i]}', '{$jumlah[$i]}', '{$aturan[$i]}')");
                    					}
								}
                
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}

		
		?>
<?php
    if (isset($_POST['btn_simpan'])){
        $kode_obat = $_POST['kode_obat'];
        $jumlah = $_POST['jumlah'];
		$aturan = $_POST['aturan'];
								$chk="";
								foreach($aturan as $chk1)
								{
								$chk.= $chk1." ";
								} 
        
        if(!empty($kode_obat)  && !empty($jumlah)){
            $onhand = query("SELECT no_resep FROM resep_obat WHERE no_rawat = '{$_POST['no_rawat']}'");
                    			$dtonhand = fetch_array($onhand);

                    			$get_number = fetch_array(query("SELECT max(no_resep) FROM resep_obat"));
                    			$lastNumber = substr($get_number[0], 0, 10);
                    			$next_no_resep = sprintf('%010s', ($lastNumber + 1)); 

                    			if ($dtonhand['0'] > 1) {
                        			$insert = query("INSERT INTO resep_dokter VALUES ('{$dtonhand['0']}', '{$_POST['kode_obat']}', '{$_POST['jumlah']}', '{$chk}')");
								} else {
                        			$insert = query("INSERT INTO resep_obat VALUES ('{$next_no_resep}', '{$_POST['tgl']}', '{$_POST['jam']}', '{$_POST['no_rawat']}', '{$_POST['dokter']}', '{$_POST['tgl']}', '{$_POST['jam']}')");
                        			$insert2 = query("INSERT INTO resep_dokter VALUES ('{$next_no_resep}', '{$_POST['kode_obat']}', '{$_POST['jumlah']}', '{$chk}')");
                    			}
                
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    
    ?> 
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php"><?php echo $dataSettings['nama_instansi']; ?> - DOCTOR</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
     <section class="content">
        <div class="container-fluid">
  			<div class="col-md-8"> 
            <div class="card" style="padding:10px;">
          
            
                        <div class="header">
                            <h2>
                                Detail e-Resep
                            </h2>
                            </div>
                             <button type="button" class="viewobat btn btn-primary" data-toggle="modal" id='<?php echo $no_rkm_medis; ?>' idol='<?php echo $no_rawat;?>' dok='<?php echo $dok;?>' tgl='<?php echo $date;?>'>Obat Sebelum</button>
							 
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
            			 <main class="bg">
                            <input class="ip" id="tab1" idow='<?php echo $no_rawat; ?>' type="radio" name="tabs" checked>
                                <label class="lb" for="tab1">Non Racik</label>
          <input class="ip" id="tab3" type="radio" name="tabs">
                                <label class="lb" for="tab2">Racik</label>
                            <section class="section" id="content1">     
                        <form action="" method="post" class="form-obt">
                        <table style="width:100%;">
                             
                              </table>
                        <div class="body">
                       
                            <table style="width:100%;" >
                            <tr>
                            <td style="width:25%;">
                               Nama Obat
                             </td>
                                <?php 
								if ($pj == "A65"){
									?>
                                <td><select name="kode_obat" class="kd_obat form-control" style="width:100%"></select></td>
                                 <?php }elseif ($pj == "N65"){
									?>
                                <td><select name="kode_obat" class="kd_obat form-control" style="width:100%"></select></td>
                              
                                  <?php }else{
									?>
                               <td><select name="kode_obat" class="kd_obano form-control" style="width:100%"></select></td>
                                <?php }?>
                                </tr>
                                <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                </tr>
                                <tr>
                                <td>
                                Jumlah Obat
                                </td>
                                <td style="margin-left:0px;"><input type="number" name="jumlah"   class="form-control" max="200" min="1"></td>
                                </tr>
                                </table>
                                <label>Aturan Pakai</label>
                                <br>
                                
                                <div class="col-md-2 "><input type="text" name="aturan[]" class="form-control"></div><div class="col-md-2" style="width:5px; padding-top:2px;"><input type="hidden" value="X" name="aturan[]">X</div> <div class="col-md-4"><input type="text" name="aturan[]" class="form-control"></div></div>
                                <br>
                                <table style="width:100%;">
                                <tr>
                                <th class="alert alert-info">
                                <input type="checkbox" name="aturan[]" value="Pagi" > Pagi 
								<input type="checkbox" name="aturan[]" value="Siang"> Siang <br>
								<input type="checkbox" name="aturan[]" value="Sore" > Sore 
								<input type="checkbox" name="aturan[]" value="Malam" > Malam 
                                </th>
                                <th class="alert alert-warning">
                                <input type="checkbox" name="aturan[]" value="Sebelum Makan"> Sebelum Makan 
								<input type="checkbox" name="aturan[]" value="Sesudah Makan"> Sesudah Makan
								<input type="checkbox" name="aturan[]" value="Kalau Perlu"> Kalau Perlu<br>
								<input type="checkbox" name="aturan[]" value="Bersama Dengan Makan"> Bersama Dengan Makan
                                </th>
                                </tr>
                                </table>
                                  
                              <div class="col-md-3"></div>
                               
                                <input type="hidden"  name="no_rawat" value="<?php echo $no_rawat;?>" />
                                <input type="hidden" name="tgl" value="<?php echo $date;?>" />
                                 <input type="hidden" name="jam" value="<?php echo $time;?>" />
                                 <input type="hidden" name="dokter" value="<?php echo $_SESSION['username'];?>" />
                              <br>
                              <table style="width:100%;">
                              <th class="alert alert-success" style="padding:5px;">Racikan</th>
                              </table>
                              <br>
                              
                               <br>
                               <div class="btn-group">
                               <input type="submit" class="btn btn-success" name="btn_simpan" value="Tambah Obat"/>
                               
                              </div>

                        </form>
                        </section>
                         <section class="section" id="content1">  
                            <form action="" method="post" class="form-obt">
                          <textarea name="keluhan" id="myeditor" class="form-control ckeditor" style="width:100%"></textarea></section>   
                      
                                <input type="hidden"  name="no_rawat" value="<?php echo $no_rawat;?>" />
                                <input type="hidden" name="tgl" value="<?php echo $date;?>" />
                                 <input type="hidden" name="jam" value="<?php echo $time;?>" />
                                 <input type="hidden" name="dokter" value="<?php echo $_SESSION['username'];?>" />
                                 <div class="btn-group">
                               <input type="submit" class="btn btn-success" name="btn_simpan" value="Tambah Obat"/>
                               
                              </div>
                                 </form>
                         <div class="table-responsive">
                 <table class="table table-striped">
                <thead>
                    <tr>
                    	<th>#NO</th>
                    	<th>No. Resep</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                        <th>Tools</th>
                    </tr>
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
                 <form method="post" action="">
                         <?php 
                        if ($_POST['ubah']) {
							
                            if ($_POST['ubah'] <> "")  {
							 $norkm = $_POST['no_rm'];
							 $norwt = $_POST['no_rwt'];
                                 $insert = query("UPDATE resep_dokter  SET 
						   	jml='{$_POST['jml']}',aturan_pakai = '{$_POST['dosis']}'
						  
						   WHERE no_resep='{$_POST['no_resep']}' AND kode_brng='{$_POST['kode_brng']}'");
													
													 
													 
                                if ($insert) {
                                      redirect("e-resep.php?id=".$norkm."&idob=".$norwt."");
									
                                }
								
							}
                        }
                        ?>
                          <tr> 
                          <input type="hidden" value="<?php echo $data_resep['no_resep'];?>" name="no_resep">
                          <input type="hidden" value="<?php echo $data_resep['kode_brng'];?>" name="kode_brng">
                          <input type="hidden" value="<?php echo $no_rkm_medis;?>" name="no_rm">
                          <input type="hidden" value="<?php echo $no_rawat;?>" name="no_rwt">
                          <td><?php echo $no;?></td>
                          <td><?php echo $data_resep['no_resep'];?></td>
                          <td><?php echo $data_resep['3']; ?></td>
                          <td><input type="number" name="jml" value="<?php echo $data_resep['1']; ?>" max="200" min="1"  ></td>
                          <td><textarea name="dosis"><?php echo $data_resep['2']; ?></textarea></td>
    	           			<td>
                             <button type="submit" name="ubah" value="ubah" class="btn btn-xs btn-warning" onclick="this.value=\'ubah\'">ubah</button>  
                             
                            <a class="btn-danger btn-xs" href="e-resep.php?aksi&no_resep=<?php echo $data_resep['no_resep']; ?>&kode_brng=<?php echo $data_resep['0'];?>&no_rkm=<?php echo $no_rkm_medis;?>&no_rawat=<?php echo $no_rawat;?>">Hapus</a>
                            </td>
				 </form>
                   </tr>
              
               <?php 
			   $no++;
			   } ?>
                
              		</tbody>
           			</table>
 </div>
                    <?php 
					$query_re = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$no_rawat."' AND c.kd_dokter = '".$do."' ");
               $sta = fetch_array($query_re);
			   echo '<div class="btn-group"><a href="includes/cetak_resep.php?no_resep='.$sta['no_resep'].'" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Cetak Resep</button></a>'; 
					?>
                    
<?php }?>
          		 
                    <a href="#" class="btn btn-danger" onclick="close_window();return false;">Selesai</a>
   					
   					<script>
   				 function close_window() {
  					if (confirm("Yakin Sudah Selesai?")) {
    			close();
 	 		}
			}
				</script>
                </div>
            </div>
            </div>
    </section>
   
   <?php }?>
   <?php 
   if (isset($_GET['aksi'])){
    if(isset($_GET['no_resep'])){
        $no_resep = $_GET['no_resep'];
		$barang = $_GET['kode_brng'];
		$no_rkm1 = $_GET['no_rkm'];
		$rawat = $_GET['no_rawat'];
		$hapus = "DELETE FROM resep_dokter WHERE no_resep='$no_resep' AND kode_brng='$barang'";
			$hasil = query($hapus);
        if (($hasil)) {
	    redirect("e-resep.php?id=$no_rkm1&idob=$rawat");
	}

        
    }
    
}
/*if (isset($_POST['ubah'])){
    if(isset($_POST['no_resep'])){
        $no_resep = $_POST['no_resep'];
		$barang = $_POST['kode_brng'];
		$jmlah = $_POST['jml'];
		$no_rkm1 = $_POST['no_rkm'];
		$rawat = $_POST['no_rawat'];
		$ubah = "UPDATE resep_dokter SET jml='{$jmlah}' WHERE no_resep='$no_resep' AND kode_brng='$barang'";
			$hasil = query($ubah);
        if (($hasil)) {
	    redirect("e-resep.php?id=".$no_rkm1."&idob=".$rawat."");
	}

        
    }
    
}*/
?>


  <script src="../asset/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="../asset/plugins/bootstrap-select/js/bootstrap-select.js"></script>
  <script src="../asset/js/jquery-ui.min.js"></script>
  <script src="../asset/js/select2.min.js"></script>

    







	<script type="text/javascript">
  CKEDITOR.replace('myeditor',{
	width: "100%",
        height: "120px"
     }
);

/*TINDAKAN */

    function formatData (data) {
        var $data = $(
            '<b>'+ data.id +'</b> - <i>'+ data.text +'</i> - <i>'+ data.cr +'</i>'
        );
        return $data;
    };
	

    function formatDataTEXT (data) {
        var $data = $(
            '<b>'+ data.text +'</b>- <i>'+ data.cr +'</i>'
        );
        return $data;
    };
	
	
	/* OBAT */
	function formatDataob (data) {
        var $data = $(
            '<b>'+ data.id +'</b> - <i>'+ data.text +'</i> - STOK:<b>('+ data.stok +')</b>'
        );
        return $data;
    };
	

    function formatDataTEXTob (data) {
        var $data = $(
            '<b>'+ data.text +'</b>'
        );
        return $data;
    };
	
/*
      $('.kd_diagnosa').select2({
        placeholder: 'Pilih diagnosa',
        ajax: {
          url: 'includes/select-diagnosa.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatData,
    	minimumInputLength: 3
      });
*/
     
/*
      $('.prioritas').select2({
          placeholder: 'Pilih prioritas diagnosa'
      });
*/
      $('.kd_obat').select2({
        placeholder: 'Pilih obat',
        ajax: {
          url: 'includes/select-obat.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatDataob,
    	minimumInputLength: 3
      });
	  
	  $('.kd_obano').select2({
        placeholder: 'Pilih obat',
        ajax: {
          url: 'includes/select-obat1.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatDataob,
    	minimumInputLength: 3
      });

</script>
<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Riwayat Pemberian Obat</h4>
      </div>
      <div class="modal-body">
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
   </div>
   <script>
$(document).ready(function(){

 $('.viewobat').click(function(){
   var id = $(this).attr("id");
   var idol = $(this).attr("idol");
   var dok = $(this).attr("dok");
   var tgl = $(this).attr("tgl");
   

   // AJAX request
   $.ajax({
    url: 'includes/riwayat-obat.php',
    type: 'post',
    data: {id:id,idol:idol,dok:dok,tgl:tgl},
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);
      $('#empModal').modal('show'); 
    }
  });
 });
});
</script>

</body>

</html>
