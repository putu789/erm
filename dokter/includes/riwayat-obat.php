<?php
include "config.php";

$id = $_POST['id'];
$idol = $_POST['idol'];
$dok = $_POST['dok'];
$tgl = $_POST['tgl'];

?>
<?php $e = query("SELECT c.no_resep,c.tgl_peresepan,d.nm_dokter FROM reg_periksa a, resep_obat c,dokter d WHERE a.no_rkm_medis = '".$id."'  And c.no_rawat = a.no_rawat And c.kd_dokter = d.kd_dokter And c.tgl_peresepan != '".$tgl."' ORDER BY c.tgl_peresepan DESC LIMIT 5 ");
                while ($c = fetch_array($e)) {
					$tanggal = $c['tgl_peresepan'];
					$format = date('d-m-Y', strtotime($tanggal));
					$no_resep = $c['no_resep'];
 
 ?>
 <form action="" method="post" class="form-obt">
 <div class="panel panel-success">
 <div class="panel-heading">No Resep : <?php echo $no_resep;?>  | Tanggal Beri : <?php echo $format; ?><br /> Dokter : <?php echo $c['nm_dokter']; ?>
 <input type="hidden"  name="no_rwt" value="<?php echo $idol;?>" />
 <input type="hidden" name="tgl" value="<?php echo $date;?>" />
 <input type="hidden" name="jam" value="<?php echo $time;?>" />
  <input type="hidden" name="dokter" value="<?php echo $dok;?>" />
 </div>
  <div class="panel-body" style="padding:0px;">
  <div class="table table-responsive">
 <table style="width:100%;">
                <thead >
                <th class="alert-success">
                Nama Obat
                </th>
                 <th class="alert-success">
                Jumlah Beri
                </th>
                <th class="alert-success">
                Dosis
                </th>
                </thead>
<?php $res = query("SELECT b.kode_brng,b.jml,d.nama_brng,b.aturan_pakai FROM  resep_dokter b, databarang d WHERE  b.no_resep = '".$no_resep."' And b.kode_brng = d.kode_brng ");
                while ($resep = fetch_array($res)) {

 
 ?>
 <tbody>
				<td>
                <?php echo $resep['nama_brng'];?>  
                 </td>
                  <td>
                <?php echo $resep['jml'];?>  
                 </td>
                 <td>
                <?php echo $resep['aturan_pakai'];?>  
                 </td>
				 </tbody>
                 <input type="hidden" value="<?php echo $resep['kode_brng'];?>" name="kode_obat[]" />
                 <input type="hidden" value="<?php echo $resep['jml'];?>" name="jumlah[]"/>
                 <input type="hidden" value="<?php echo $resep['aturan_pakai'];?>" name="aturan[]"/>
                 
                <?php }?>
               
                
                </table>
               <input type="submit" class="btn btn-success" style="margin-left:80%;" name="btn_copy" value="Copy Resep"/>
                </div>
				 </div>
				  </div>
                </form>
                 <?php }?>
               