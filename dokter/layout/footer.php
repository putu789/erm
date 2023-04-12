
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

    <!-- Jquery DataTable Plugin Js -->
    <script src="../asset/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../asset/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../asset/plugins/jquery-datatable/extensions/responsive/js/dataTables.responsive.min.js"></script>

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

    <script src="../asset/js/jquery-ui.min.js"></script>
    <script src="../asset/js/select2.min.js"></script>

    <!-- Custom Js -->
    <script src="../asset/js/admin.js"></script>
     <script src="../dokter/ajax.js"></script>
     
    
<script>
$(document).on('click', '.pilih', function (e) {
                document.getElementById("kode_obat").value = $(this).attr('data-kodeobat');
				document.getElementById("periksa").value = $(this).attr('pemer');
				document.getElementById("diagnosa_dr").value = $(this).attr('diagnosa_dr');
				document.getElementById("tindakan_dr_lain").value = $(this).attr('tindakan_dr_lain');
                $('#myModal').modal('hide');
            });
</script>
<script type="text/javascript">
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
        
     }
);
</script>
	

	<script type="text/javascript">
		$('.obt').click(function(){
			var idob = $(this).attr("idob");
			var idot = $(this).attr("idot");
			$.ajax({
					url: 'includes/vie-obat.php',
					method: 'POST',		
					data: {idob:idob,idot:idot},
					success:function(data){	
						$('.tampildata').html(data);
					}
			})
			 
		});
		
		
		$(document).ready(function(){
			$("#reset").hide();
			$("#tombol-simpan").click(function(){
				var data = $('.form-obt').serialize();
				var idob = $(this).attr("idob");
				var idot = $(this).attr("idot");
				$.ajax({
					type: 'POST',
					url: "includes/save-obat.php",
					data: data,
					success: function() {
						 $("#reset").click();
						$.ajax({
								url: 'includes/vie-obat.php',	
								method: 'POST',		
								data: {idob:idob,idot:idot},
								success:function(data){	
									$('.tampildata').html(data);
										
								}
							})
					}
				});
			});
			
			
			
		});
	</script>
    <script>
	$('.obt1').click(function(){
			var ido = $(this).attr("ido");
			$.ajax({
					url: 'includes/ob-racik.php',
					method: 'post',		
					data: {ido:ido},
					success:function(data){	
						$('.tampilracik').html(data);
					}
			})
			 
		});
    	$(document).ready(function(){
			
			$("#tombol-racik").click(function(){
				var data = $('.racik').serialize();
				var ido = $(this).attr("ido");
				$.ajax({
					type: 'POST',
					url: "includes/save-racik.php",
					data: data,
					success: function() {
						$.ajax({
								url: 'includes/ob-racik.php',	
								method: 'post',		
								data: {ido:ido},
								success:function(data){	
									$('.tampilracik').html(data);	
								}
							})
					}
				});
			});
		});
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

            $('.count-to').countTo();

        } );
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
			var no_raw = $(this).attr("no_raw");
			
			$.ajax({
				url: 'includes/riwayat.php',	
				method: 'post',	
				data: {id:id,tgl:tgl,dok:dok,no_raw:no_raw},		
				success:function(data){		
					$('#riwayat_pas').html(data);	
					$('#myModal').modal("show");
				}
			});
		});
	});
	</script>
    
   <div class="modal fade" id="meModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pemeriksaan Perawat</h4>
        </div>
      <div class="modal-body">
      <div class="modal-body" id="riwayat_pasie">
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
		$('.viewdta').click(function(){
			var id = $(this).attr("id");
			
			$.ajax({
				url: 'includes/pemeriksaan.php',	
				method: 'post',		
				data: {id:id},		
				success:function(data){		
					$('#riwayat_pasie').html(data);	
					$('#meModal').modal("show");
					
				}
			});
		});
	});
	</script>
    <div class="modal fade" id="meModal1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">PEMERIKSAAN MATA (Gambar)</h4>
        </div>
      <div class="modal-body">
      <div class="modal-body" id="p_mata">
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
		$('.cek').click(function(){
			var id = $(this).attr("id");
			
			$.ajax({
				url: 'includes/vie_pmata.php',	
				method: 'post',		
				data: {id:id},		
				success:function(data){		
					$('#p_mata').html(data);	
					$('#meModal1').modal("show");
					
				}
			});
		});
	});
	</script>
    
    
     <div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RIWAYAT PEMERIKSAAN MATA</h4>
        </div>
      <div class="modal-body">
      <div class="modal-body" id="r_mata">
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
		$('.v_mata').click(function(){
			var id = $(this).attr("id");
			
			$.ajax({
				url: 'includes/vie_rmata.php',	
				method: 'post',		
				data: {id:id},		
				success:function(data){		
					$('#r_mata').html(data);	
					$('#myModal2').modal("show");
					
				}
			});
		});
	});
	</script>
    <script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>
</div>
</body>

</html>
