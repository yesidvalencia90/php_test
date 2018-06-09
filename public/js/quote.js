$(document).ready(function(){

	$("#price_button").click(function(){

		price_it();

	});

	$('#priceQuoteModal').on('hide.bs.modal', function (event) {
	  
		$("#price_alert").addClass("hide");

	});

});

function price_it(){

	var origin = $("#origin").val();
	var destination = $("#destination").val(); 
	var token = $("#_token").val();	
	var url = route('priceQuote').template;
	var data = {
		origin:origin,
		destination:destination,
		_token:token,	
	};

	if(origin != destination){

		$.ajax({
	            url:url,
	            type: 'POST',
		        data: data,
		        contentType: 'application/x-www-form-urlencoded',     
	            success: function(data){	            		

	            	var total = 0;
	            	var html = "<table  class='table table-striped table-hover'>"
	            		html += "<thead>";
	            			html += "<tr>";
	            				html += "<th>Stop</th>";
	            				html += "<th>Route Name</th>";
	            				html += "<th>Bus Number</th>";
	            				html += "<th>Origin</th>";
	            				html += "<th>Destination</th>";
	            				html += "<th>Price</th>";
	            			html += "</tr>";
	            		html += "</thead>";

	            	$.each(data, function(key, val) {

	            		total = total + val.price;

	            		html += "<tr>";
					    	html += "<td>"+(key+1)+"</td>";
					    	html += "<td>"+val.route_name+"</td>";
					    	html += "<td>"+val.bus_is+"</td>";
					    	html += "<td>"+val.origin+"</td>";
					    	html += "<td>"+val.destination+"</td>";
					    	html += "<td> $ "+val.price+"</td>";
				    	html += "</tr>";

					});

	            	html += "<tr>";
	            	html += "<th colspan='5' class='text-right'>Total</th>";
	            	html += "<th> $ "+total+"</th>";
	            	html += "</tr>";

					html += "</table>";

					$("#route_response").html(html);
					$("#priceQuoteModal").modal("hide");

	        	}
		});

	}else{

		$("#price_alert").removeClass("alert-success");
		$("#price_alert").addClass("alert-danger");
		$("#price_alert").html("<span>Origin and Destination can not be the same.</span>");
		$("#price_alert").removeClass("hide");

	}

}