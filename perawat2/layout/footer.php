</div><!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
     CKEDITOR.replace('myeditor',{
	width: "100%",
        height: "120px"
	
     }
);
CKEDITOR.replace('myeditor1',{
	width: "100%",
        height: "120px"
     }
);
CKEDITOR.replace('myeditor2',{
	width: "100%",
        height: "120px"
     }
);
CKEDITOR.replace('myeditor3',{
	width: "100%",
        height: "120px"
     }
);
CKEDITOR.replace('myeditor4',{
	width: "100%",
        height: "120px"
        
     }
);
CKEDITOR.replace('myeditor5',{
	width: "100%",
        height: "120px"
        
     }
);
  })
</script>
<script type="text/javascript">


/*TINDAKAN */

    function formatData (data) {
        var $data = $(
            '<b>'+ data.id +'</b> - <i>'+ data.text +'</i> - <i>'+ data.cr +'</i>'
        );
        return $data;
    };
	

    function formatDataTEXT (data) {
        var $data = $(
            '<b>'+ data.text +'</b>- <i>'+ data.cr +'</i>'
        );
        return $data;
    };
	
	
	/* OBAT */
	function formatDataob (data) {
        var $data = $(
            '<b>'+ data.id +'</b> - <i>'+ data.text +'</i> - STOK:<b>('+ data.stok +')</b>'
        );
        return $data;
    };
	

    function formatDataTEXTob (data) {
        var $data = $(
            '<b>'+ data.text +'</b>'
        );
        return $data;
    };
	
/*
      $('.kd_diagnosa').select2({
        placeholder: 'Pilih diagnosa',
        ajax: {
          url: 'includes/select-diagnosa.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatData,
    	minimumInputLength: 3
      });
*/
      $('.kd_prosedur').select2({
        placeholder: 'Pilih Tindakan',
        ajax: {
          url: 'includes/select-prosedur.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatData,
      minimumInputLength: 3
      });
/*
      $('.prioritas').select2({
          placeholder: 'Pilih prioritas diagnosa'
      });
*/
      $('.kd_obat').select2({
        placeholder: 'Pilih obat',
        ajax: {
          url: 'includes/select-obat.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatDataob,
    	minimumInputLength: 3
      });
	  
	  $('.kd_obano').select2({
        placeholder: 'Pilih obat',
        ajax: {
          url: 'includes/select-obat1.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatDataob,
    	minimumInputLength: 3
      });

      $('.aturan_pakai').select2({
          placeholder: 'Pilih aturan pakai'
      });

       $('.anamnesa').select2({
          placeholder: 'anamnesa'
      });

      $('.pasien').select2({
        placeholder: 'Pilih nama/no.RM pasien',
        ajax: {
          url: 'includes/select-pasien.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        },
        templateResult: formatData,
        minimumInputLength: 3
      });

</script>

 <script type="text/javascript">
  		$("input[name='resiko']:radio")
    	.change(function() {
      $("#resiko").toggle($(this).val() == "TIDAK"); });
	  $("#resiko").val()=="0"
	  
	  
</script>
<SCRIPT>
	    $(document).ready(function(){
		$("#sk").on("change", function(){
		  var value = $("#sk option:selected").attr("value");
		  $("#sk__").val(value);
		});
		$("#sk1").on("change", function(){
		  var value = $("#sk1 option:selected").attr("value");
		  $("#sk__1").val(value);
		});
		$("#sk2").on("change", function(){
		  var value = $("#sk2 option:selected").attr("value");
		  $("#sk__2").val(value);
		});
		$("#sk3").on("change", function(){
		  var value = $("#sk3 option:selected").attr("value");
		  $("#sk__3").val(value);
		});
		$("#sk4").on("change", function(){
		  var value = $("#sk4 option:selected").attr("value");
		  $("#sk__4").val(value);
		});
		$("#sk5").on("change", function(){
		  var value = $("#sk5 option:selected").attr("value");
		  $("#sk__5").val(value);
		});
		
		});
	
		</script>
        <script>
		function hitung(){
   	a= parseInt( $("#sk__").val() );     
	b= parseInt( $("#sk__1").val() );
	c= parseInt( $("#sk__2").val() );
	d= parseInt( $("#sk__3").val() );
	e= parseInt( $("#sk__4").val() );
	f= parseInt( $("#sk__5").val() );
    if(isNaN(a))a=0;     
	if(isNaN(b))b=0;
	if(isNaN(c))c=0;
	if(isNaN(d))d=0;
	if(isNaN(e))e=0;
	if(isNaN(f))f=0;
    total = a + b + c + d + e + f;
    $(".tot").empty().append("jumlah:");     
	$(".tot").append(total);
	$("#sk__, #sk__1,#sk__2,#sk__3,#sk__4,#sk__5").keyup(function(){     
	hitung(); });
		}
		</script>
         <script>
function sum() {
      var txtFirstNumberValue = document.getElementById('bert').value;
      var txtSecondNumberValue = document.getElementById('tng').value;
      var t =(txtSecondNumberValue/100);
	  var result = parseFloat(txtFirstNumberValue) / (t*t);
	  if (!isNaN(result)) {
         document.getElementById('im').value = result.toFixed(2);
      }
}
</script>
<script type="text/javascript">
  		$("input[name='riwayatq']:checkbox")
    	.change(function() {
      $("#riwayatq").toggle($(this).val() == "s"); });
</script>
<script type="text/javascript">
 	$('.obst').click(function(){
		var idob = $(this).attr("idob");
		$.ajax({
				url: 'includes/tampil-obs.php',	
				method: 'post',		
				data: {idob:idob},
				success:function(data){	
					$('.tampildata').html(data);	
					
				}
		})
		 
	});
	$(document).ready(function(){
		$('#reset').hide();
		$("#tombol-simpan").click(function(){
			var data = $('.form-obs').serialize();
			var idob = $(this).attr("idob");
			$.ajax({
				type: 'POST',
				url: "includes/save-obs.php",
				data: data,
				success: function() {
					$.ajax({
							url: 'includes/tampil-obs.php',	
							method: 'post',		
							data: {idob:idob},
							success:function(data){	
								$('.tampildata').html(data);	
								$('#reset').click();
							}
						})
				}
			});
		});
	});
	</script>
<script>
$('#datepicker').datepicker({
      autoclose: true,
	  format : "yyyy-mm-dd",
	  todayHighlight: true
	  
    })
	$('#datepicker1').datepicker({
      autoclose: true,
	  format : "yyyy-mm-dd",
	 todayHighlight: true
    })
	</script>
<script>
  $(function () {
    $('.data').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Riwayat</h4>
        </div>
      <div class="modal-body">
      <div class="modal-body" id="riwayat_pas">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
  </div>
 

   <script>
	$(document).ready(function(){
		$('.view').click(function(){
			var id = $(this).attr("id");
			var tgl = $(this).attr("tgl");
			var dok = $(this).attr("dok");
			
			$.ajax({
				url: 'includes/riwayat.php',	
				method: 'post',	
				data: {id:id,tgl:tgl,dok:dok},		
				success:function(data){		
					$('#riwayat_pas').html(data);	
					$('#myModal').modal("show");
				}
			});
		});
	});
	</script>
</body>
</html>
