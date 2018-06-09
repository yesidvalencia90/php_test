@extends('base')

@section('title')
	Quotes
@endsection

@section('content-body')

<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
				<h2>Price <b>Quote</b></h2>
			</div>
			<div class="col-sm-6">
				<a href="#priceQuoteModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>New Price Quote</span></a>					
			</div>
        </div>
    </div>

    <div id="route_response"></div>

</div>

<?php

	$origins = "";
	$destinations = "";
	foreach ($routes as $route) {
		$origins .= "<option value='".$route->origin."'>".$route->origin."</option>";
		$destinations .= "<option value='".$route->destination."'>".$route->destination."</option>";
	}

?>

<div id="priceQuoteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="price_form">				
				<div class="modal-header">						
					<h4 class="modal-title">New Price Quote</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">		
					<div id="price_alert" class="alert alert-danger hide"></div>			
					<div class="form-group">
						<label>Origin *</label>
						<select class="form-control" id="origin" >
							{!! $origins !!}
						</select>
					</div>	
					<div class="form-group">
						<label>Destination *</label>
						<select class="form-control" id="destination" >
							{!! $destinations !!}
						</select>
					</div>	
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="button" class="btn btn-success" id="price_button" value="Price It !">
				</div>
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	
	<script src="{{ asset('/js/quote.js') }}"></script>

@endsection