 <?php
require_once("../config.php");


if(isset($_GET['id'])) {
    $id = $_GET['id']; 
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur,a.kd_dokter FROM reg_periksa a, pasien b WHERE a.no_rkm_medis = b.no_rkm_medis AND b.no_rkm_medis = {$id}";
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
	}
    } else {
	redirect ('pasien.php');
    }
}

?>	
 <div class="body table-responsive">
                 <table class="table table-striped">
                <thead>
                    <tr>
                    	<th>#NO</th>
                    	<th>Tanggal Input</th>
                        <th>Obat Racikan</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				if($_POST['ido']){
				$ido = $_POST['ido'];
				$per = query("SELECT tgl_input,jam_input,obat_racik FROM racikan WHERE no_rawat = '".$ido."'");
				 $nor = 1;
				 while ($dat = fetch_array($per)){
					
				?>
                          <tr> 
                          <td><?php echo $nor;?></td>
                          <td><?php echo $dat['tgl_input'];?></td>
                          <td><?php echo $dat['obat_racik']; ?></td>
    	           			<td><a href="<?php echo $_SERVER['PHP_SELF'];?>?action=delete_obat&kode_obat=<?php echo $data_resep['0'];?>&no_resep=<?php echo $data_resep['4']; ?>&id=<?php echo $no_rkm;?>">Hapus</a>
                            
                            </td>
				   
                   </tr>
               
               <?php 
			   $nor++;
				 }
			   } ?>
                
              		</tbody>
           			</table>
					

                    
          		  </div>
                