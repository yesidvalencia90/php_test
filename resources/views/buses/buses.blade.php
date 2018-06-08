@extends('base')

@section('title')
	Buses
@endsection

@section('content-body')

<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
				<h2>Manage <b>Buses</b></h2>
			</div>
			<div class="col-sm-6">
				<a href="#addBusModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Bus</span></a>					
			</div>
        </div>
    </div>

    @if(count($buses) > 0)

	    <table class="table table-striped table-hover">
	        <thead>
	            <tr>
					<th>#</th>
	                <th>Model</th>
	                <th>Driver</th
	            </tr>
	        </thead>
	        <tbody id="tbody_buses">
		        <?php
		        	$i = 1;
		        ?>
	        	@foreach($buses as $bus)

		            <tr>
						<td>
							<?php

								echo $i;
								$i++;

							?>
						</td>
		                <td>{{ $bus->model }}</td>
		                <td style="width: 30%">{{ $bus->driver }}</td>
		                <td>
		                    <a href="#editBusModal" class="edit" data-toggle="modal" data-id="{{ $bus->id }}" data-model="{{ $bus->model }}" data-driver="{{ $bus->driver }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
		                    <a href="#deleteBusModal" class="delete" data-toggle="modal" data-id="{{ $bus->id }}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
		                </td>
		            </tr>       		

	        	@endforeach

	        </tbody>
	    </table>

    @else

    	{{ 'No buses have been added.' }}

    @endif

</div>

<!-- User modal create -->

<div id="addBusModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="bus_form">				
				<div class="modal-header">						
					<h4 class="modal-title">Add Bus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="add_bus_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Model</label>
						<input type="text" class="form-control" id="model">
					</div>
					<div class="form-group">
						<label>Driver</label>
						<input type="email" class="form-control" id="driver" autocomplete="off">
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="add_bus_button" value="Add">
				</div>
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editBusModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Bus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="edit_bus_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Model *</label>
						<input type="text" class="form-control" id="model_edit">
					</div>
					<div class="form-group">
						<label>Driver *</label>
						<input type="email" class="form-control" id="driver_edit" autocomplete="off">
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="edit_bus_button" data-token="{{ csrf_token() }}" value="Edit">
				</div>
				<input type="hidden" id="_tokenEdt" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteBusModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Bus</h4>
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

<div id="busDeleted" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Bus Deleted</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Bus successfully deleted!</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Continue">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="busUpdated" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Bus Updated</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Bus successfully Updated!</p>
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
	
	<script src="{{ asset('/js/buses.js') }}"></script>

@endsection