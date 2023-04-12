<?php

ob_start();
session_start();


include_once('../set/config.php');
 
$q = $_GET['q'];
 
$sql = query("SELECT no_rkm_medis AS id, nm_pasien AS text FROM pasien WHERE (no_rkm_medis LIKE '%".$q."%' OR nm_pasien LIKE '%".$q."%')");
$num = num_rows($sql);
if($num > 0){
	while($data = fetch_assoc($sql)){
		$tmp[] = $data;
	}
} else $tmp = array();
 
echo json_encode($tmp);

?>
