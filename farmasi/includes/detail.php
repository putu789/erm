<?php
require_once("../config.php");
?>

 <div class="body table-responsive">
                 <table class="table table-striped">
                <thead>
                    <tr>
                    	<th>#NO</th>
                    	<th>No. Resep</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				if($_POST['id']){
				$idob = $_POST['id'];
				$per = query("SELECT kd_dokter,no_rkm_medis FROM reg_periksa WHERE no_rawat = '".$idob."'");
				 while ($dat = fetch_array($per)){
					$do = $dat['kd_dokter'];
					$no_rkm = $dat['no_rkm_medis'];
				 }

                $query_resep = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."'  ");
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
					$query_re = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."' AND c.kd_dokter = '".$do."' ");
               $sta = fetch_array($query_re);
			   echo '<a href="includes/cetak_resep.php?no_resep='.$sta['no_resep'].'" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Cetak Resep</button></a>'; 
					?>
<?php }?>
          		  </div>
                