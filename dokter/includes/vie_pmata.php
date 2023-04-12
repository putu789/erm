<?php
include "config.php";
if($_POST['id']){
	$id = $_POST['id'];
	$query = query ("SELECT * FROM p_mata WHERE no_rawat = '".$id."'");
	while ($hasil = fetch_array($query)){
?>
	<p><?php echo $hasil['no_rawat'];?></p>
   <div class="table-responsive">
  <img src="periksa-mata/upload/<?php echo $hasil['pemeriksaan'] ?>">
  </div>
<?php 
	}
}
?>