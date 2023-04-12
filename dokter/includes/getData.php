<?php

require '../config.php';

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
if($_POST['idob']){
				$idob = $_POST['idob'];
				$per = query("SELECT kd_dokter,no_rkm_medis FROM reg_periksa WHERE no_rawat = '".$idob."'");
				 while ($dat = fetch_array($per)){
					$do = $dat['kd_dokter'];
					$no_rkm = $dat['no_rkm_medis'];
				 }

$num_rec_per_page = 5;


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };


$start_from = ($page-1) * $num_rec_per_page;


$sqlTotal = "SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."' AND c.kd_dokter = '".$do."' ";

$sql = "SELECT a.kode_brng, a.jml, a.aturan_pakai, b.nama_brng, a.no_resep FROM resep_dokter a, databarang b, resep_obat c WHERE a.kode_brng = b.kode_brng AND a.no_resep = c.no_resep AND c.no_rawat = '".$idob."' AND c.kd_dokter = '".$do."'  Order By nama_brng desc LIMIT $start_from, $num_rec_per_page"; 


$result = $mysqli->query($sql);


  while($row = $result->fetch_assoc()){


     $json[] = $row;


  }


  $data['data'] = $json;


$result =  mysqli_query($mysqli,$sqlTotal);


$data['total'] = mysqli_num_rows($result);

}
echo json_encode($data);


?>