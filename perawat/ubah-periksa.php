<?php 
include_once ('layout/header.php'); 

$id = $_GET['id'];
$idob = $_GET['idob'];
if(isset($_GET['id'])) {
    $id = $_GET['id']; 
	$idob = $_GET['idob'];
    $_sql = "SELECT a.no_rkm_medis, a.no_rawat, b.nm_pasien, b.umur,a.kd_dokter, f.nm_poli,b.alamat,b.namakeluarga,c.nm_kel,d.nm_kec,e.nm_kab,a.kd_poli,g.png_jawab FROM reg_periksa a, pasien b,kelurahan c, kecamatan d, kabupaten e, poliklinik f, penjab g WHERE a.no_rkm_medis = {$id} AND b.no_rkm_medis = a.no_rkm_medis AND b.kd_kel = c.kd_kel And b.kd_kec = d.kd_kec And b.kd_kab = e.kd_kab And a.kd_poli = f.kd_poli And a.kd_pj = g.kd_pj";
    

    $found_pasien = query($_sql);	
	while($row = fetch_array($found_pasien)) {
	    $no_rkm_medis  = $row['0']; 
	    $no_rawat	   = $row['1'];
	    $nm_pasien     = $row['2'];
	    $umur          = $row['3'];
		$dok          = $row['4'];
		$poli          = $row['kd_poli'];
		$alamat 		= "".$row['6'].",".$row['8'].",".$row['9'].",".$row['10']."";
		$bayar = $row['png_jawab'];
	}
    
} 

?>	
<style>
	tr{
		padding:5px;
		border:#CCC solid 1px;
								
								
								
		}
	td{
		padding:8px;
		border:#CCC solid 1px;
	}
	.g{
		border:none !important;
		
	}
	
		</style>
    
 <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                     <div class="header">
                            <h2>
                                Detail Pasien
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Nama Lengkap</dt>
                                <dd><?php echo $nm_pasien; ?></dd>
                                <dt>No. RM</dt>
                                <dd><?php echo $no_rkm_medis; ?></dd>
                                <dt>No. Rawat</dt>
                                <dd><?php echo $no_rawat; ?></dd>
                                <dt>Umur</dt>
                                <dd><?php echo $umur; ?></dd>
                                <dt>POLIKLINIK</dt>
                                <dd><?php echo $poli; ?></dd>
                                 <dt>Alamat</dt>
                                <dd><?php echo $alamat; ?></dd>
								  <dt>Cara Bayar</dt>
                                <dd><span class="label label-warning"><?php echo $bayar; ?></span></dd>
								
                            </dl>
                    <?php 
					if ($poli == "U0001") {
						include "includes/u_obg.php";
					}
						elseif ($poli == "U0027") {
						include "includes/u_obg_lain.php";
					}else{
						include "includes/u_lain.php";
					}
						?>
                    </div>
                </div>
            </div>
    	</div>
         <?php 
   if (isset($_GET['aksi'])){
    if(isset($_GET['id_obste'])){
        $id_obste = $_GET['id_obste'];
		$no_rkm = $_GET['no_rkm'];
		$rawat = $_GET['no_rawat'];
		$hapus = "DELETE FROM ro WHERE id_ob='$id_obste' ";
			$hasil = query($hapus);
        if (($hasil)) {
	    redirect("ubah-periksa.php?id=$id&idob=$idob");
	}

        
    }
    
}
?>
         
 </section>
                               
<?php 
include_once ('layout/footer.php'); 
?>