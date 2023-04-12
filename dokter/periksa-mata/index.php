<?php
require_once("../config.php"); 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pemeriksaan Mata</title>
  <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="stylesheet" href="css/signature-pad.css">
  <link rel="stylesheet" href="../../asset/plugins/bootstrap/css/bootstrap.css">
<style>
.dep {
	width:100px;
	height:10px;
	background-color:#009;
	
}
</style>
  <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="css/ie9.css">
  <![endif]-->

 
</head>
<body onselectstart="return false">
<?php 
$rawat = $_GET['no_rawat'];
date_default_timezone_set('Asia/Jakarta');
$month      = date('Y-m');
$date       = date('Y-m-d');
$time       = date('H:i:s');
?>
  <div></div>
  <div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas class="sign-pad" id="sign-pad" value=""></canvas>
    </div>
    <div class="signature-pad--footer">
<p style="color:#000";></p>
      <div class="signature-pad--actions">
        <div>
          <button type="button" class="button clear btn btn-xs btn-danger" data-action="clear">Clear</button>
          <button type="button" class="button btn btn-xs btn-warning"  data-action="change-color">Ganti Warna</button>
          <button type="button" class="button  btn btn-xs btn-default" data-action="undo">Undo</button>

        </div>
        <div>
         <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
            <input type="hidden" name="rawat" id="rawat" value="<?php echo $rawat;?>">
            <input type="hidden" name="tgl" id="tgl" value="<?php echo $date;?>">
            
        </form>
        <?php 
		$has =num_rows(query("SELECT no_rawat FROM p_mata WHERE no_rawat = '{$rawat}'"));
		if ($has > 0){
			echo 'Data Telah Tersimpan <button class="btn btn-xs btn-success" disabled onClick="uploadEx()" value="Upload">Simpan Data</button>';
		}else {
			echo '<button class="btn btn-xs btn-success" onClick="uploadEx()" value="Upload">Simpan Data</button>';
		}
		?>
          <button type="button" class="button save btn btn-xs btn-default" data-action="save-png"><span class="glyphicon glyphicon-download"></span> PNG</button>
          <button type="button" class="button save btn btn-xs btn-default" data-action="save-jpg"><span class="glyphicon glyphicon-download"></span> JPG</button>
          <button type="button" class="button save btn btn-xs btn-default" data-action="save-svg"><span class="glyphicon glyphicon-download"></span>  SVG</button>
          <a href="#" class="btn btn-xs btn-danger" onclick="close_window();return false;">Selesai</a>
   					
   					<script>
   				 function close_window() {
  					
    			close();
			}
				</script>
        </div>
      </div>
    </div>
  </div>
<div class="sign-container">
		
		</div>
  <script src="js/signature_pad.umd.js"></script>
  <script src="js/app.js"></script>
  <script>
			$(document).ready(function() {
				$('#signature-pad').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});
			
            window.onload = function() {
                var canvas = document.getElementById("sign-pad");
                var context = canvas.getContext("2d");
               
            }
		  </script> 
          <script>
            function uploadEx() {
                var canvas = document.getElementById("sign-pad");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
						location.reload();
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>
</body>
</html>
