$(document).ready(function(){

	$("#add_route_button").click(function(){

		add_route();

	});

	$('#addRouteModal').on('hide.bs.modal', function (event) {
	  
		$("#add_route_alert").addClass("hide");

	});

	$('#editRouteModal').on('hide.bs.modal', function (event) {
	  
		$("#edit_route_alert").addClass("hide");

	});

	$('#deleteRouteModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		$("#delete_button").attr("data-id",id);

	});

	$('#editRouteModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		var route_name = button.data('route_name');
  		var origin = button.data('origin');
  		var destination = button.data('destination');
  		var bus = button.data('bus');
  		var price = button.data('price');

  		$("#route_name_edit").val(route_name);
  		$("#origin_edit").val(origin);
  		$("#destination_edit").val(destination);
  		$("#bus_edit").val(bus);
  		$("#price_edit").val(price);
  		$("#edit_route_button").attr("data-id",id);

	});

	$("#delete_button").click(function(){

		var id = $(this).attr('data-id');
		var token = $(this).attr('data-token');
		delete_route(id,token);

	});

	$("#edit_route_button").click(function(){

		var id = $(this).attr('data-id');
		var route_name = $("#route_name_edit").val();
		var origin = $("#origin_edit").val();
		var destination = $("#destination_edit").val();
		var bus = $("#bus_edit").val();
		var price = $("#price_edit").val();
		var token = $(this).attr('data-token');

		if(origin != destination){

			put_route(id,route_name,origin,destination,bus,price,token);

		}else{

			$("#edit_route_alert").removeClass("alert-success");
			$("#edit_route_alert").addClass("alert-danger");
			$("#edit_route_alert").html("<span>Origin and Destination can not be the same.</span>");
			$("#edit_route_alert").removeClass("hide");

		}	

	});

});

function add_route(){

	var route_name = $("#route_name").val();
	var origin = $("#origin").val(); 
	var destination = $("#destination").val(); 
	var bus = $("#bus").val(); 
	var price = $("#price").val(); 
	var token = $("#_token").val();	
	var url = route('addRoute').template;
	var data = {
		route_name:route_name,
		origin:origin,
		destination:destination,
		bus:bus,
		price:price,
		_token:token,	
	};

	if(origin != destination){

		$.ajax({
	            url:url,
	            type: 'POST',
		        data: data,
		        contentType: 'application/x-www-form-urlencoded',     
	            success: function(data){

	            	if(data.status == 0){

	            		$("#add_route_alert").removeClass("alert-success");
	            		$("#add_route_alert").addClass("alert-danger");
	            		var span = "<span>All fields are required.</span>";
	            		if(data.busAssigned == 1){
	            			span += "<br><span>Bus already assigned.</span>";
	            		}
	            		$("#add_route_alert").html(span);
	            		$("#add_route_alert").removeClass("hide");

	            	}else{

	            		$("#add_route_alert").removeClass("alert-danger");
	            		$("#add_route_alert").addClass("alert-success");
	            		$("#add_route_alert").html("<span>Route successfully created.</span>");
	            		$("#add_route_alert").removeClass("hide");
	            		$("#route_form").trigger("reset");

	            		$("#tbody_routes").empty();

	            		fill_table();

	            	}

	        	}
		});

	}else{

		$("#add_route_alert").removeClass("alert-success");
		$("#add_route_alert").addClass("alert-danger");
		$("#add_route_alert").html("<span>Origin and Destination can not be the same.</span>");
		$("#add_route_alert").removeClass("hide");

	}

}

function delete_route(id,token){

	var url = route('deleteRoute',{id:id,_token:token});

	$.ajax({
        url:url,
        type: 'DELETE',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	fill_table();
        	$("#deleteRouteModal").modal("hide");
        	$("#routeDeleted").modal();

    	}
	});

}

function put_route(id,route_name,origin,destination,bus,price,token){

	var url = route('editRoute',{id:id,_token:token});
	
	var data = {
		route_name:route_name,
		origin:origin,
		destination:destination,
		bus:bus,
		price:price,
	};

	if(origin != destination){

		$.ajax({
	        url:url,
	        type: 'PUT',
	        data:data,
	        contentType: 'application/x-www-form-urlencoded',     
	        success: function(data){

	        	fill_table();
	        	$("#editRouteModal").modal("hide");
	        	$("#routeUpdated").modal();

	    	}
		});

	}else{

		$("#add_route_alert").removeClass("alert-success");
		$("#add_route_alert").addClass("alert-danger");
		$("#add_route_alert").html("<span>Origin and Destination can not be the same.</span>");
		$("#add_route_alert").removeClass("hide");

	}

}

function fill_table(){

	var url = route('getRoute').template;
	
	$.ajax({
        url:url,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	var tbody = $("#tbody_routes");
        	var html = "";
			tbody.empty();
			var i = 1;

        	$.each(data, function(key, value) {

        		html += "<tr>";
        				html += "<td>"+i+"</td>";
        				html += "<td>"+value.route_name+"</td>";
        				html += "<td>"+value.origin+"</td>";
        				html += "<td>"+value.destination+"</td>";
        				html += "<td>"+value.bus_is+"</td>";
        				html += "<td>"+value.price+"</td>";
        				html += "<td><a href='#editRouteModal' class='edit' data-toggle='modal' data-id='"+value.id+"' data-route_name='"+value.route_name+"' data-origin='"+value.origin+"' data-destination='"+value.destination+"' data-bus='"+value.bus_is+"' data-price='"+value.price+"'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
        				html += "<a href='#deleteRouteModal' class='delete' data-toggle='modal' data-id='"+value.id+"'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a></td>";
        		html += "</tr>";

        		i++;

			});

			tbody.append(html);

    	}
	});

}