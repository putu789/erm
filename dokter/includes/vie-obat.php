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
                    	<th>No. Resep</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				if($_POST['idob']){
				$idob = $_POST['idob'];
				$idot = $_POST['idot'];
				$per = query("SELECT kd_dokter,no_rkm_medis FROM reg_periksa WHERE no_rawat = '".$idob."'");
				 while ($dat = fetch_array($per)){
					$do = $dat['kd_dokter'];
					$no_rkm = $dat['no_rkm_medis'];
				 }

                $query_resep = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."' AND c.kd_dokter = '".$do."' ");
				$no =1;
                while ($data_resep = fetch_array($query_resep)) {?>
                          <tr> 
                          <td><?php echo $no;?></td>
                          <td><?php echo $data_resep['no_resep'];?></td>
                          <td><?php echo $data_resep['3']; ?></td>
                          <td><?php echo $data_resep['1']; ?></td>
                          <td><?php echo $data_resep['2']; ?></td>
                        
    	           			<td>
                            <a  class="btn-warning btn-xs" href="<?php $_SERVER['PHP_SELF']; ?>?action=delete_obat&kode_obat=<?php echo $data_resep['no_resep']; ?>&no_resep=<?php echo $data_resep['kode_brng']; ?>&id=<?php echo $$no_rkm; ?>">Hapus</a> 
                            <a class="btn btn-danger btn-xs delete" id="del_<?php echo $data_resep['no_resep']; ?>" id1="del1_<?php $data_resep['kode_brng']; ?>" idob="<?php echo $idob; ?>" idot="<?php echo $idot; ?>">Hapus</a>
                            </td>
				   
                   </tr>
               
               <?php 
			   $no++;
			   } ?>
                
              		</tbody>
           			</table>
                    <script>
			$(document).ready(function(){

 // Delete 
 $('.delete').click(function(){
  var el = this;
  var id = this.id;
  var splitid = id.split("_");

  // Delete id
  var deleteid = splitid[1];
 
  // AJAX Request
  $.ajax({
   url: 'includes/del-obat.php',
   type: 'POST',
   data: {id:deleteid},
   success: function(response){

    // Removing row from HTML Table
    $(el).closest('tr').css('background','tomato');
    $(el).closest('tr').fadeOut(800, function(){ 
     $(this).remove();
    });

   }
  });

 });

});


			
</script>
                    <?php 
					$query_re = query("SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."' AND c.kd_dokter = '".$do."' ");
               $sta = fetch_array($query_re);
			   echo '<a href="includes/cetak_resep.php?no_resep='.$sta['no_resep'].'" target="_blank"><button type="button" class="btn btn-info waves-effect waves-light"><span class="glyphicon glyphicon-print"></span>Cetak Resep</button></a>'; 
					?>
<?php }?>
          		  </div>
    
                 