$(document).ready(function(){

	$("#add_user_button").click(function(){

		add_user();

	});

	$('#addUserModal').on('hide.bs.modal', function (event) {
	  
		$("#add_user_alert").addClass("hide");

	});

	$('#deleteUserModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		$("#delete_button").attr("data-id",id);

	});

	$('#editUserModal').on('show.bs.modal', function (event) {
	  
	  	var button = $(event.relatedTarget);
  		var id = button.data('id');
  		var name = button.data('name');
  		var email = button.data('email');

  		$("#name_edit").val(name);
  		$("#email_edit").val(email);
  		$("#edit_user_button").attr("data-id",id);

	});

	$("#delete_button").click(function(){

		var id = $(this).attr('data-id');
		var token = $(this).attr('data-token');
		delete_user(id,token);

	});

	$("#edit_user_button").click(function(){

		var id = $(this).attr('data-id');
		var name = $("#name_edit").val();
		var email = $("#email_edit").val();
		var token = $(this).attr('data-token');
		put_user(id,name,email,token);

	});

});

function add_user(){

	var name = $("#name").val();
	var email = $("#email").val(); 
	var password = $("#password").val(); 
	var confirm = $("#password_confirm").val(); 	
	var token = $("#_token").val();	
	var url = route('addUser').template;
	var data = {
		name:name,
		email:email,
		password:password,
		confirm:confirm,
		_token:token,	
	};

	$.ajax({
            url:url,
            type: 'POST',
	        data: data,
	        contentType: 'application/x-www-form-urlencoded',     
            success: function(data){

            	if(data.status == 0){

            		$("#add_user_alert").removeClass("alert-success");
            		$("#add_user_alert").addClass("alert-danger");
            		$("#add_user_alert").html("<span>All fields are required.</span>");
            		$("#add_user_alert").removeClass("hide");

            	}else{

            		$("#add_user_alert").removeClass("alert-danger");
            		$("#add_user_alert").addClass("alert-success");
            		$("#add_user_alert").html("<span>User successfully created.</span>");
            		$("#add_user_alert").removeClass("hide");
            		$("#user_form").trigger("reset");

            		$("#tbody_users").empty();

            		fill_table();

            	}

        	}
	});

}

function delete_user(id,token){

	var url = route('deleteUser',{id:id,_token:token});

	$.ajax({
        url:url,
        type: 'DELETE',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	fill_table();
        	$("#deleteUserModal").modal("hide");
        	$("#userDeleted").modal();

    	}
	});

}

function put_user(id,name,email,token){

	var url = route('editUser',{id:id,_token:token});
	
	var data = {
		name:name,
		email:email
	};

	$.ajax({
        url:url,
        type: 'PUT',
        data:data,
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	fill_table();
        	$("#editUserModal").modal("hide");
        	$("#userUpdated").modal();

    	}
	});

}

function fill_table(){

	var url = route('getUsers').template;
	
	$.ajax({
        url:url,
        type: 'GET',
        contentType: 'application/x-www-form-urlencoded',     
        success: function(data){

        	var tbody = $("#tbody_users");
        	var html = "";
			tbody.empty();
			var i = 1;

        	$.each(data, function(key, value) {

        		html += "<tr>";
        				html += "<td>"+i+"</td>";
        				html += "<td>"+value.name+"</td>";
        				html += "<td>"+value.email+"</td>";
        				html += "<td><a href='#editUserModal' class='edit' data-toggle='modal' data-id='"+value.id+"' data-name='"+value.name+"' data-email='"+value.email+"'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>";
        				html += "<a href='#deleteUserModal' class='delete' data-toggle='modal' data-id='"+value.id+"'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a></td>";
        		html += "</tr>";

        		i++;

			});

			tbody.append(html);

    	}
	});

}