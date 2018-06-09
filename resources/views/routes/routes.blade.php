@extends('base')

@section('title')
	Routes
@endsection

@section('content-body')

<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
				<h2>Manage <b>Routes</b></h2>
			</div>
			<div class="col-sm-6">
				<a href="#addRouteModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Route</span></a>					
			</div>
        </div>
    </div>

    @if(count($routes) > 0)

	    <table class="table table-striped table-hover">
	        <thead>
	            <tr>
					<th>#</th>
	                <th>Route Name</th>
	                <th>Origin</th>
	                <th>Destination</th>
	                <th>Bus</th>
	                <th>Price</th>
	            </tr>
	        </thead>
	        <tbody id="tbody_routes">
		        <?php
		        	$i = 1;
		        ?>
	        	@foreach($routes as $route)

		            <tr>
						<td>
							<?php

								echo $i;
								$i++;

							?>
						</td>
		                <td>{{ $route->route_name }}</td>
		                <td>{{ $route->origin }}</td>
		                <td>{{ $route->destination }}</td>
		                <td>{{ $route->bus_is }}</td>
		                <td>{{ $route->price }}</td>
		                <td>
		                    <a href="#editRouteModal" class="edit" data-toggle="modal" data-id="{{ $route->id }}" data-route_name="{{ $route->route_name }}" data-origin="{{ $route->origin }}" data-destination="{{ $route->destination }}" data-bus="{{ $route->bus_is }}" data-price="{{ $route->price }}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
		                    <a href="#deleteRouteModal" class="delete" data-toggle="modal" data-id="{{ $route->id }}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
		                    <!--<a href="#vieweRouteModal" class="view" data-toggle="modal" data-id="{{ $route->id }}"><i class="material-icons" data-toggle="tooltip" title="View">pageview</i></a>-->
		                </td>
		            </tr>       		

	        	@endforeach

	        </tbody>
	    </table>

    @else

    	{{ 'No routes have been added.' }}

    @endif

</div>

<!-- User modal create -->

<?php

	$selectBuses = "";
	foreach ($buses as $bus) {
		$selectBuses .= "<option value='".$bus->id."'>".$bus->id."-".$bus->model."-".$bus->driver."</option>";
	}

	$selectCities  = "<option value='Ibague'>Ibague</option>";
	$selectCities .= "<option value='Bogota'>Bogota</option>";
	$selectCities .= "<option value='Paipa'>Paipa</option>";
	$selectCities .= "<option value='Tunja'>Tunja</option>";

?>

<div id="addRouteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="route_form">				
				<div class="modal-header">						
					<h4 class="modal-title">Add Route</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="add_route_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Route Name *</label>
						<input type="text" class="form-control" id="route_name">
					</div>
					<div class="form-group">
						<label>Origin *</label>
						<select class="form-control" id="origin" >
							{!! $selectCities !!}
						</select>
					</div>	
					<div class="form-group">
						<label>Destination *</label>
						<select class="form-control" id="destination" >
							{!! $selectCities !!}
						</select>
					</div>							
					<div class="form-group">
						<label>Bus *</label>
						<select class="form-control" id="bus" >
							{!! $selectBuses !!}
						</select>
					</div>								
					<div class="form-group">
						<label>Price *</label>
						<input type="number" class="form-control" id="price" autocomplete="off">
					</div>				
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="add_route_button" value="Add">
				</div>
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editRouteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Route</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="edit_route_alert" class="alert alert-danger hide"></div>
					<div class="form-group">
						<label>Route Name *</label>
						<input type="text" class="form-control" id="route_name_edit">
					</div>
					<div class="form-group">
						<label>Origin *</label>
						<select class="form-control" id="origin_edit" >
							{!! $selectCities !!}
						</select>
					</div>	
					<div class="form-group">
						<label>Destination *</label>
						<select class="form-control" id="destination_edit" >
							{!! $selectCities !!}
						</select>
					</div>							
					<div class="form-group">
						<label>Bus *</label>
						<select class="form-control" id="bus_edit" >
							{!! $selectBuses !!}
						</select>
					</div>								
					<div class="form-group">
						<label>Price *</label>
						<input type="email" class="form-control" id="price_edit" autocomplete="off">
					</div>			
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="edit_route_button" data-token="{{ csrf_token() }}" value="Edit">
				</div>
				<input type="hidden" id="_tokenEdt" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteRouteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Route</h4>
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
<!-- view Modal HTML -->
<div id="vieweRouteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Route Detail</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					


				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Continue">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="routeDeleted" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Route Deleted</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Route successfully deleted!</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Continue">
				</div>
			</form>
		</div>
	</div>
</div>

<div id="routeUpdated" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Route Updated</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Route successfully Updated!</p>
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
	
	<script src="{{ asset('/js/routes.js') }}"></script>

@endsection