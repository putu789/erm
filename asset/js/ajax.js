// JavaScript Document
$( document ).ready(function() {

	/* Get Page Data*/

function getPageData() {

	$.ajax({

    	dataType: 'json',

    	url: url+'includes/getData.php',

    	data: {page:page}

	}).done(function(data){

		manageRow(data.data);

	});

}
function manageRow(data) {

	var	rows = '';

	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

	  	rows = rows + '<td>'+value.title+'</td>';

	  	rows = rows + '<td>'+value.description+'</td>';

	  	rows = rows + '<td data-id="'+value.id+'">';

        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';

        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';

        rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}
$("body").on("click",".remove-item",function(){

    var id = $(this).parent("td").data('id');

    var c_obj = $(this).parents("tr");


    $.ajax({

        dataType: 'json',

        type:'POST',

        url: url + 'includes/delete.php',

        data:{id:id}

    }).done(function(data){

        c_obj.remove();

        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});

        getPageData();

    });


});





});