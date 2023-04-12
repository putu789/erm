﻿
    <!-- Jquery Core Js -->
    
    <!-- Bootstrap Core Js -->
    <script src="../asset/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../asset/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../asset/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../asset/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../asset/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../asset/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../asset/plugins/node-waves/waves.js"></script>


    <!-- Jquery CountTo Plugin Js -->
    <script src="../asset/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Highcharts Plugin Js -->
	<script src="../asset/plugins/highcharts/highcharts.js"></script>
    <script src="../asset/plugins/highcharts/exporting.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../asset/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../asset/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    
    <script src="../asset/js/select2.min.js"></script>

    <!-- Custom Js -->
    <script src="../asset/js/admin.js"></script>
    
 

 
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
 
	  <script type="text/javascript">
	  
	  
      $(document).ready(function(){
       $('a#edit_data').click(function(){
        var url = $(this).attr('href');
        $.ajax({
         url : url,
         success:function(response){
          $('#modal_detail').html(response);
         }
        });
       });
       
      });
     </script>
     
     <script type="text/javascript">
  		$("input[name='resiko']:radio")
    	.change(function() {
      $("#resiko").toggle($(this).val() == "TIDAK"); });
	  $("#resiko").val()=="0"
	  
	  
</script>
<script type="text/javascript">
  		$("input[name='riwayatq']:checkbox")
    	.change(function() {
      $("#riwayatq").toggle($(this).val() == "s"); });
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
     
	<script>

        $(document).ready(function() {

            var url = window.location.pathname; //sets the variable "url" to the pathname of the current window
            var activePage = url.substring(url.lastIndexOf('/') + 1); //sets the variable "activePage" as the substring after the last "/" in the "url" variable
            if($('.active').length > 0){
                $('.active').removeClass('active');//remove current active element if there's
            }

            $('.menu li a').each(function () { //looks in each link item within the primary-nav list
                var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1); //sets the variable "linkPage" as the substring of the url path in each &lt;a&gt;
 
                if (activePage == linkPage) { //compares the path of the current window to the path of the linked page in the nav item
                    $(this).parent().addClass('active'); //if the above is true, add the "active" class to the parent of the &lt;a&gt; which is the &lt;li&gt; in the nav list
                }
            });


            //Textare auto growth
            autosize($('textarea.auto-growth'));

            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });
			 $('#datepicker2').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false
            });

            $('.count-to').countTo();
        	} );
		  $('.datepicker').datepicker({
                   format: 'yyyy-mm-dd',
					autoclose: true,
					todayHighlight: true,
					toggleActive: true
            });
		window.onload=function(){
            $('.datepicker').on('change', function() {
                var dob = new Date(this.value);
				var hpl = new Date();
                var today = new Date();
                var minggu = Math.floor((today-dob) / (365 * 24 * 60  * 1000));
				var pre =new Date("YYYY-DD-MM");
				$('#h').val(pre);
                $('#umur').val(minggu);
            });
        }
		
		
	</script>

	<script type="text/javascript">
        Highcharts.chart('kunjungan', {
		    chart: {
			    type: 'column'
			},
            exporting: { 
                enabled: false 
            },
		    title: {
			    text: 'Grafik Kunjungan'
			},
			subtitle: {
				text: <?=json_encode($dates);?>
			},
		    xAxis: {
		        categories: <?=json_encode($poli);?> ,
								
				title: {
				    enabled: false
				}
			},
			yAxis: {
				title: {
					text: 'Jumlah Pasien'
				},
				labels: {
					formatter: function () {
						return this.value;
					}
				}
			},
			tooltip: {
				split: true,
				valueSuffix: ''
			},
			plotOptions: {
				area: {
				stacking: 'normal',
				lineColor: '#666666',
				lineWidth: 1,
			    	marker: {
						lineWidth: 1,
						lineColor: '#666666'
					}
				}
			},
			series: [{
				name: 'Poliklinik dan Rawat Jalan',
				data: <?=json_encode($jumlah);?>
			}]
		});		
	</script>


<script type="text/javascript">


/*TINDAKAN */

    function formatData (data) {
        var $data = $(
            '<b>'+ data.id +'</b> - <i>'+ data.text +'</i>'
        );
        return $data;
    };
	

    function formatDataTEXT (data) {
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
      $('.kd_poli').select2({
        placeholder: 'Pilih poli',
        ajax: {
          url: 'includes/poli.php',
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
      minimumInputLength: 0
      });
	  
	   $('.kd_dokter').select2({
        placeholder: 'Pilih Dokter',
        ajax: {
          url: 'includes/select-dokter.php',
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
      minimumInputLength: 0
      });
	     $('.cara_bayar').select2({
        placeholder: 'Cara bayar',
        ajax: {
          url: 'includes/select-bayar.php',
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
      minimumInputLength: 0
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
		$(function(){
        $(".inputAngka").keydown(function(event){
            keys = event.keyCode;
                if (event.keyCode == 116 || event.keyCode == 46 || event.keyCode == 188 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
                   
                    (event.keyCode == 65 && event.ctrlKey === true) || 
                    (event.keyCode >= 35 && event.keyCode <= 39) || event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 188) {
        				return;
                }
                else {
                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                        event.preventDefault(); 
                    }   
                }
        });
});
		</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Data Riwayat</h4>
        <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Terakhir</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Seluruh Riwayat</a></li>
  </ul>
</div>

      </div>
      <div class="modal-body"><!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">DISINI RIWAYAT TERAKHIR.</div>
    <div role="tabpanel" class="tab-pane" id="profile">DISINI SELURUH RIWAYAT</div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- modal detail pemeriksaan -->
<div class="modal fade" id="data_modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Pemeriksaan</h4>
                </div>
                <div class="modal-body">
               <div class="modal-body" id="data_pem">
				</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    	<script>
	$(document).ready(function(){
		$('.view_data').click(function(){
			var id = $(this).attr("id");
			
			// memulai ajax
			$.ajax({
				url: 'includes/detail.php',
				method: 'post',	
				data: {id:id},		
				success:function(data){		
					$('#data_pem').html(data);	
					$('#data_modal').modal("show");	
				}
			});
		});
	});
	</script>
    
    <!-- modal detail pemeriksaan -->
<div class="modal fade" id="tindak" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tindakan yang diberikan</h4>
                </div>
               <div class="modal-body" id="data_tind">
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    	<script>
	$(document).ready(function(){
		$('.add-dat').click(function(){
			var id = $(this).attr("id");
			var id1 = $(this).attr("id1");
			
			// memulai ajax
			$.ajax({
				url: 'includes/tindakan.php',
				method: 'post',	
				data: {id:id, id1:id1},		
				success:function(data){		
					$('#data_tind').html(data);	
					$('#tindak').modal("show");	
				}
			});
		});
	});
	</script>
   
</body>

</html>
