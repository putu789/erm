$(document).ready(function(){
$("#loading-simpan, #salah, #load-simpan,#loading-ubah, #loading-hapus,#loading-del, #pesan-error, #pesan-sukses, #btn-reset,#btn-res,#ps-sukses").hide();
  
  $("#btn-tambah").click(function(){
    $("#btn-ubah").hide();
    $("#btn-simpan").show();     
    $("#modal-title").html("Tambahkan Obat");
  });
  
  $("#simpan").click(function(){
    var data = new FormData();
    
    data.append('usr_nama', $("#usr_nama").val());
	data.append('usr_username', $("#usr_username").val());
	data.append('usr_pl', $("#usr_pl").val());
	data.append('usr_email', $("#usr_email").val());
	data.append('usr_stts', $("#usr_stts").val());
    $("#load-simpan").show();
    
    $.ajax({
      url: 'add-usr-proses.php', 
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#load-simpan").hide(); 
        
        if(response.status == "sukses"){
          $("#myModal").modal('hide'); 
        }else{
          $("#salah").html(response.pesan).show();
		  $("#err-clo").html(response).show();
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
      }
    });
  });
  
  
  $("#btn-simpan").click(function(){
    var data = new FormData();
    
    data.append('kategori', $("#kategori").val());
	data.append('parent', $("#parent").val());
    $("#loading-simpan").show();
    
    $.ajax({
      url: 'save.php', 
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#loading-simpan").hide(); 
        
        if(response.status == "sukses"){
          $("#kat-view").html(response.html);
          $("#pesan-sukses").html(response.pesan).fadeIn().delay(5000).fadeOut();
          $("#tKat").modal('hide'); 
        }else{
          $("#pesan-error").html(response.pesan).show();
		  $("#err-clo").html(response).show();
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
      }
    });
  });
  
  $("#btn-ubah").click(function(){ 
    var data = new FormData();
    
    data.append('id-kategori', $("#id-kategori").val()); 
    data.append('kategori', $("#kategori").val()); 
	data.append('parent', $("#parent").val()); 
    
    $("#loading-ubah").show(); 
    
    $.ajax({
      url: 'ubah-kat-pros.php',
      type: 'POST', 
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#loading-ubah").hide();
        
        if(response.status == "sukses"){ 
          $("#kat-view").html(response.html);
          $("#pesan-sukses").html(response.pesan).fadeIn().delay(5000).fadeOut();
          
          $("#tKat").modal('hide'); 
        }else{ 
        
          $("#pesan-error").html(response.pesan).show();
        }
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert(xhr.responseText); 
      }
    });
  });
  
  $("#btn-hapus").click(function(){ 
    var data = new FormData();
    data.append('id-kat', $("#id-kat").val()); 
    $("#loading-hapus").show(); 
    $.ajax({
      url: 'delete-kat.php', 
      type: 'POST', 
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#loading-hapus").hide(); 
        $("#kat-view").html(response.html);
        $("#pesan-sukses").html(response.pesan).fadeIn().delay(5000).fadeOut();
        
        $("#delete-kat").modal('hide'); 
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });
  });
  
  $("#btn-del").click(function(){ 
    var data = new FormData();
    data.append('id-pro', $("#id-pro").val()); 
    
    $("#loading-del").show(); 
    
    $.ajax({
      url: 'hapus-pro.php', 
      type: 'POST', 
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#loading-hapus").hide();
        $("#view-produk").html(response.html);
        $("#ps-sukses").html(response.ps).fadeIn().delay(5000).fadeOut();
        
        $("#delete-pro").modal('hide'); 
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });
  });
  $('#myModal').on('hidden.bs.modal', function (e){ 
  $("#btn-res").click(); });
  
  $('#tKat').on('hidden.bs.modal', function (e){ 
  	$("#pesan-error").hide();
    $("#btn-reset").click(); 
	
    $("#id").removeAttr('readonly'); 
  });
});