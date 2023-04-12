<?php
include "config.php";
if($_POST['id']){
	$id = $_POST['id'];
	$que = query("SELECT pemeriksaan  FROM  p_mata  WHERE no_rawat = ".$id."");
                            while ($e = fetch_array($que)) 
				
					
                            {
?>
<img src="periksa-mata/upload/<?php echo $e['pemeriksaan'];?>" width="600px" height="450px">

<?php }
}
?>