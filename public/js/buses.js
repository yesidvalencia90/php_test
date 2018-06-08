$(document).ready(function(){

	$("#add_bus_button").click(function(){

		add_bus();

	});

	$('#addBusModal').on('hide.bs.modal', function (event) {
	  
		$("#add_bus_alert").addClass("hide");

	});

	$('#deleteBusModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		$("#delete_button").attr("data-id",id);

	});

	$('#editBusModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		var model = button.data('model');
  		var driver = button.data('driver');

  		$("#model_edit").val(model);
  		$("#driver_edit").val(driver);
  		$("#edit_bus_button").attr("data-id",id);

	});

	$("#delete_button").click(function(){

		var id = $(this).attr('data-id');
		var token = $(this).attr('data-token');
		delete_bus(id,token);

	});

	$("#edit_bus_button").click(function(){

		var id = $(this).attr('data-id');
		var model = $("#model_edit").val();
		var driver = $("#driver_edit").val();
		var token = $(this).attr('data-token');
		put_bus(id,model,driver,token);

	});

});

function add_bus(){

	var model = $("#model").val();
	var driver = $("#driver").val(); 
	var token = $("#_token").val();	
	var url = route('addBus').template;
	var data = {
		model:model,
		driver:driver,
		_token:token,	
	};

	$.ajax({
            url:url,
            type: 'POST',
	        data: data,
	        contentType: 'application/x-www-form-urlencoded',     
            success: function(data){

            	if(data.status == 0){

            		$("#add_bus_alert").removeClass("alert-success");
            		$("#add_bus_alert").addClass("alert-danger");
            		$("#add_bus_alert").html("<span>All fields are required.</span>");
            		$("#add_bus_alert").removeClass("hide");

            	}else{

            		$("#add_bus_alert").removeClass("alert-danger");
            		$("#add_bus_alert").addClass("alert-success");
            		$("#add_bus_alert").html("<span>Bus successfully created.</span>");
            		$("#add_bus_alert").removeClass("hide");
            		$("#bus_form").trigger("reset");

            		$("#tbody_buses").empty();

            		fill_table();

            	}

        	}
	});

}

function delete_bus(id,token){

	var url = route('deleteBus',{id:id,_token:token});

	$.ajax({
        url:url,
        type: 'DELETE',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	fill_table();
        	$("#deleteBusModal").modal("hide");
        	$("#busDeleted").modal();

    	}
	});

}

function put_bus(id,model,driver,token){

	var url = route('editBus',{id:id,_token:token});
	
	var data = {
		model:model,
		driver:driver
	};

	$.ajax({
        url:url,
        type: 'PUT',
        data:data,
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	fill_table();
        	$("#editBusModal").modal("hide");
        	$("#busUpdated").modal();

    	}
	});

}

function fill_table(){

	var url = route('getBus').template;
	
	$.ajax({
        url:url,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	var tbody = $("#tbody_buses");
        	var html = "";
			tbody.empty();
			var i = 1;

        	$.each(data, function(key, value) {

        		html += "<tr>";
        				html += "<td>"+i+"</td>";
        				html += "<td>"+value.model+"</td>";
        				html += "<td style='width: 30%'>"+value.driver+"</td>";
        				html += "<td><a href='#editBusModal' class='edit' data-toggle='modal' data-id='"+value.id+"' data-model='"+value.model+"' data-driver='"+value.driver+"'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
        				html += "<a href='#deleteBusModal' class='delete' data-toggle='modal' data-id='"+value.id+"'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a></td>";
        		html += "</tr>";

        		i++;

			});

			tbody.append(html);

    	}
	});

}