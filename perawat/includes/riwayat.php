<?php
include "config.php";
if($_POST['id']){
	$id = $_POST['id'];
	$tgl = $_POST['tgl'];
	$dok = $_POST['dok'];
?>
<?php
 $que = query("SELECT nm_pasien , no_rkm_medis FROM pasien  WHERE no_rkm_medis = '".$id."'");
                            while ($e = fetch_array($que)) 
				
					
                            {?>

								<label><?php echo $e['nm_pasien'];?></label><br>
								<label><?php echo $e['no_rkm_medis'];?></label>
							<?php } ?>
						
                         <div>


  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Terakhir</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Seluruh Riwayat</a></li>
  </ul>
</div>

      </div>
      <div class="modal-body">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home"> <?php
							
	$query = query("SELECT b.no_rawat , b.tgl_registrasi, a.suhu_tubuh, a.tensi, a.nadi,a.respirasi,a.tinggi,a.berat,a.keluhan,a.periksa_khusus,a.asesmen_fung,a.nyeri,a.alergi,a.imun_ke,a.riwayat,a.riwayat_lain,a.nutrisi,a.perencanaan,c.nm_dokter FROM pemeriksaan_ralan a, reg_periksa b, dokter c WHERE b.no_rkm_medis = '".$id."' AND b.no_rawat = a.no_rawat AND b.kd_dokter = c.kd_dokter AND b.tgl_registrasi != '".$tgl."' AND a.tgl_perawatan != '".$tgl."' ORDER BY b.tgl_registrasi DESC LIMIT 1");
                            while ($d = fetch_array($query)) 
							
					
                            {
								$tanggal = $d['tgl_registrasi'];
								$format = date('d-m-Y', strtotime($tanggal));
								?>
							<div class="table table-responsive"	>
                            <p>Tgl Periksa : <b><?php echo $format;?></b></p>
                            <p>Anamnesa : <b><?php echo $d['keluhan'];?></b></p>
                            <p>Riwayat : <b><?php echo $d['riwayat'];?>,<?php echo $d['riwayat_lain'];?></b></p>
                            <p>Alergi : <b><?php echo $d['alergi'];?></b></p>
                            <p>Tekanan Darah : <b><?php echo $d['tensi'];?> mmHg</b></p>
                            <p>Nadi : <b><?php echo $d['nadi'];?> X/Menit</b></p>
                            <p>Berat Badan : <b><?php echo $d['berat'];?> Kg</b></p>
                            <p>Imun ke : <b><?php echo $d['imun_ke'];?></b></p>
                            <p>Pernapasan : <b><?php echo $d['respirasi'];?> x/menit</b></p>
                            <p>Suhu Tubuh : <b><?php echo $d['suhu_tubuh'];?> °C</b></p>
                            <p>Tinggi Badan : <b><?php echo $d['tinggi'];?></b></p>
                            <p>	IMT : <b><?php echo $d[''];?></b></p>
                            <p>PEMERIKSAAN NYERI : <b><?php echo $d['nyeri'];?></b></p>
                            <p>EDUKASI : <b><?php echo $d['nutrisi'];?></b></p>
                            <p>PEMERIKSAAN KHUSUS : <b><?php echo $d['periksa_khusus'];?></b></p>
                            <p>Assesment Fungsional : <b><?php echo $d['asesmen_fung'];?></b></p>
                            <p>DIAGNOSA KEBIDANAN/KEPERAWATAN DAN MASALAH : <b><?php echo $d[''];?></b></p>
                            <p>PERENCANAAN DAN KEBUTUHAN : <b><?php echo $d['perencanaan'];?></b></p>
                           
                             </div>
                             <?php 
							}?></div>
    <div role="tabpanel" class="tab-pane" id="profile">
    <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                            <th>
                            Tgl Periksa
                            </th>
							<th>
                            Keluhan
                            </th>
                            <th>
                            Subyektif
                            </th>
                            <th>
                            riwayat Penyakit
                            </th>
                            <th>
                            Pilihan
                            </th>
                            </thead>
    <?php
							
	$query = query("SELECT b.no_rawat , b.tgl_registrasi, a.suhu_tubuh, a.tensi, a.nadi,a.respirasi,a.tinggi,a.berat,a.keluhan,a.periksa_khusus,a.asesmen_fung,a.nyeri,a.alergi,a.imun_ke,a.riwayat,a.riwayat_lain,a.nutrisi,a.perencanaan,c.nm_dokter FROM pemeriksaan_ralan a, reg_periksa b, dokter c WHERE b.no_rkm_medis = '".$id."' AND b.no_rawat = a.no_rawat AND b.kd_dokter = c.kd_dokter AND b.tgl_registrasi != '".$tgl."' AND a.tgl_perawatan != '".$tgl."' ORDER BY b.tgl_registrasi DESC ");
                            while ($d = fetch_array($query)) 
							
					
                            {
								$tanggal = $d['tgl_registrasi'];
								$format = date('d-m-Y', strtotime($tanggal));
								?>
                                 <tbody>
                             <td><?php echo $format;?></td>
							 <td><?php echo $d['keluhan'];?></td>
                            <td>tensi :<b><?php echo $d['tensi'];?> mmHg</b> Nadi :<b><?php echo $d['nadi'];?> X/Menit</b><br>
                            Tinggi :<b><?php echo $d['tinggi'];?> cm</b> Berat :<b><?php echo $d['berat'];?> Kg</b>
                            </td>
                            <td><?php echo $d['riwayat'];?>,<?php echo $d['riwayat_lain'];?></td>
                            <td>
                            <a href="">Detail</a></td>
                           
                             
                            </tbody>
                                 <?php 
							}?>
    </div>
  </div>
                        
                           
							<?php 
                            
                         
}?>
					