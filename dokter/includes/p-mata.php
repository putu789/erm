<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pemeriksaan Mata</title>
  <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="stylesheet" href="../asset/mata/css/signature-pad.css">

  <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="css/ie9.css">
  <![endif]-->

  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39365077-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</head>
<body onselectstart="return false">
  
  <div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas class="sign-pad" id="sign-pad"></canvas>
    </div>
    <div class="signature-pad--footer">

      <div class="signature-pad--actions">
        <div>
          <button type="button" class="button clear" data-action="clear">Clear</button>
          <button type="button" class="button" data-action="change-color">Change color</button>
          <button type="button" class="button" data-action="undo">Undo</button>

        </div>
        <div>
         <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
        </form>
        	<button onClick="uploadEx()" value="Upload">Simpan Data</button>
          <button type="button" class="button save" data-action="save-png">Download PNG</button>
          <button type="button" class="button save" data-action="save-jpg">Download JPG</button>
          <button type="button" class="button save" data-action="save-svg">Download SVG</button>
        </div>
      </div>
    </div>
  </div>
<div class="sign-container">
		
		</div>
  <script src="../asset/mata/js/signature_pad.umd.js"></script>
  <script src="../asset/mata/js/app.js"></script>
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
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>
</body>
</html>
