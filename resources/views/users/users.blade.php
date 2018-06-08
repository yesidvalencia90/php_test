@extends('base')

@section('title')
	Usuarios
@endsection

@section('content-body')

<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
				<h2>Manage <b>Users</b></h2>
			</div>
			<div class="col-sm-6">
				<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>					
			</div>
        </div>
    </div>

    @if(count($users) > 0)

	    <table class="table table-striped table-hover">
	        <thead>
	            <tr>
					<th>#</th>
	                <th>Name</th>
	                <th>Email</th
	            </tr>
	        </thead>
	        <tbody id="tbody_users">
		        <?php
		        	$i = 1;
		        ?>
	        	@foreach($users as $user)

		            <tr>
						<td>
							<?php

								echo $i;
								$i++;

							?>
						</td>
		                <td>{{ $user->name }}</td>
		                <td>{{ $user->email }}</td>
		                <td>
		                    <a href="#editUserModal" class="edit" data-toggle="modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
		                    <a href="#deleteUserModal" class="delete" data-toggle="modal" data-id="{{ $user->id }}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
		                </td>
		            </tr>       		

	        	@endforeach

	        </tbody>
	    </table>

    @else

    	{{ 'no users' }}

    @endif

</div>

<!-- User modal create -->

<div id="addUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="user_form">				
				<div class="modal-header">						
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="add_user_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Name *</label>
						<input type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" class="form-control" id="email" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Password *</label>
						<input type="password" class="form-control" id="password" autocomplete="off">
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="add_user_button" value="Add">
				</div>
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="edit_user_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Name *</label>
						<input type="text" class="form-control" id="name_edit">
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" class="form-control" id="email_edit" autocomplete="off">
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="edit_user_button" data-token="{{ csrf_token() }}" value="Edit">
				</div>
				<input type="hidden" id="_tokenEdt" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteUserModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Record?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-danger" id="delete_button" data-token="{{ csrf_token() }}" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="userDeleted" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">User Deleted</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>User successfully deleted!</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Continue">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="userUpdated" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">User Updated</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>User successfully Updated!</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Continue">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	
	<script src="{{ asset('/js/users.js') }}"></script>

@endsection