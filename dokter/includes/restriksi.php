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
if($_POST['id']){
				$idob = $_POST['id'];
				$per = query("SELECT kd_pj,no_rawat FROM reg_periksa WHERE no_rawat = '".$idob."'");
				 while ($dat = fetch_array($per)){
					$do = $dat['kd_pj'];
					$no = $dat['no_rawat'];
				 }
}
			
 ?>
