<?php
include_once ('layout/header.php'); 

	?>

 <section class="content">
        <div class="container-fluid">
        	<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  
                    <div class="card">
                    <main class="bg">
                            <input class="ip" id="tab1" type="radio" name="tabs" checked>
                                <label class="lb" for="tab1">TINDAKAN</label>
          <input class="ip obt obt1 obt2" id="tab2" idob='<?php echo $no_rawat; ?>' ido='<?php echo $no_rawat; ?>' type="radio" name="tabs">
                                <label class="lb"  for="tab2">LAB</label>
          <input class="ip" id="tab3" type="radio" name="tabs">
                                <label class="lb" for="tab3">RADIOLOGI</label>

                          <section class="section" id="content1">
                         <div class="body">  
                        
                           <?php  
						   $id = $_GET['id'];
							$id1 = $_GET['id1'];
						   if($_GET['id']){
							   echo $id;
	
	?>
   
    <table class="table table-bordered table-hover data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Perawatan</th>
                                        <th>Tarif</th>
                                        
                                    </tr>
                                </thead>
	    						<tbody>
	 <?php
								 $q = query("SELECT b.kd_jenis_prw,b.nm_perawatan,b.material,b.bhp,b.tarif_tindakandr,b.bhp,b.tarif_tindakanpr,b.kso,b.menejemen,b.menejemen,b.total_byrdr,b.total_byrpr,b.total_byrdrpr,b.kd_pj
                                                  FROM reg_periksa a, jns_perawatan b
                                                  WHERE a.no_rawat ='$id' and a.kd_pj = b.kd_pj ");
                            while ($d = fetch_array($q)) 
                         	{?>
                         
                           <tr>
                            <td><input type="radio" name="tindakan" value="<?php echo $d['kd_jenis_prw'];?>"></td>
                            <td><?php echo $d['nm_perawatan'];?></td>
                            <td>Rp. <?php echo $d['total_byrdrpr'];?></td>
                            </tr>
                            
					<?php }?>
                     </tbody>
                    </table>
                    <button type="submit" class="btn btn-info">Tambah Tindakan</button>
                 
                 
                 
                         </div>
                          </section>
                          <section class="section" id="content3">
                         	<div class="body">
                             <table class="table table-bordered table-hover data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Perawatan</th>
                                        <th>Tarif</th>
                                        
                                    </tr>
                                </thead>
	    						<tbody>
	 <?php
								 $q = query("SELECT b.kd_jenis_prw,b.nm_perawatan,b.bagian_rs,b.bhp,b.tarif_perujuk,b.tarif_tindakan_dokter,b.tarif_tindakan_petugas,b.kso,b.menejemen,b.total_byr,b.status,b.kelas,b.kd_pj
                                                  FROM reg_periksa a, jns_perawatan_radiologi b
                                                  WHERE a.no_rawat ='$id' and a.kd_pj = b.kd_pj ");
                            while ($d = fetch_array($q)) 
                         	{?>
                         
                           <tr>
                            <td><input type="radio" name="tind_lab"></td>
                            <td><?php echo $d['nm_perawatan'];?></td>
                            <td>Rp. <?php echo $d['total_byr'];?></td>
                            </tr>
                            
					<?php }?>
                     </tbody>
                    </table>
                    <button type="submit" class="btn btn-info">Tambah Tindakan</button>
                
                            </div>
                         </section>  
                          <section class="section" id="content2">
                         	<div class="body">
                             <table class="table table-bordered table-hover data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Perawatan</th>
                                        <th>Tarif</th>
                                        
                                    </tr>
                                </thead>
	    						<tbody>
	 <?php
								 $q = query("SELECT b.kd_jenis_prw,b.nm_perawatan,b.bagian_rs,b.bhp,b.tarif_perujuk,b.tarif_tindakan_dokter,b.tarif_tindakan_petugas,b.kso,b.menejemen,b.total_byr,b.status,b.kelas,b.kd_pj
                                                  FROM reg_periksa a, jns_perawatan_lab b
                                                  WHERE a.no_rawat ='$id' and a.kd_pj = b.kd_pj ");
                            while ($d = fetch_array($q)) 
                         	{?>
                         
                           <tr>
                            <td><input type="radio" name="tind_lab"></td>
                            <td><?php echo $d['nm_perawatan'];?></td>
                            <td>Rp. <?php echo $d['total_byr'];?></td>
                            </tr>
                            
					<?php }?>
                     </tbody>
                    </table>
                    <button type="submit" class="btn btn-info">Tambah Tindakan</button>
                
                            </div>
                         </section>  
                     </main>
                     </div>
                    
                 </div>
         	</div>
        </div>
 </section>
 <?php }?>
<?

  include_once ('layout/footer.php'); 
?>