<?php
	use App\Http\Controllers\WindmillController;
	use App\Http\Controllers\ProjectController;
?>
@extends('layouts.master')
@section('content')
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
			<div class="row">
                <h1 class="page-header">Component Deadlines</h1>
            </div>
            <!--nav tabs-->
                <div class="row">
                	@include('partials.deadlinestabs')
				</div>
 			<!--table content -->
			@permission(('read-component'))
				<div class="row">
					<h3>Components</h3>
				</div>
				<div class="row">
					<table id="componenttable" class="table table-condensed table-hover"  style="width:100%">
						<div class="container">
					    	<div class='col-md-5'>
					        	<div class="form-group">
					            	<div class='input-group date' id='startdatesearch'>
					                	<input type='text' class="form-control" />
					                	<span class="input-group-addon">
					                    	<span class="glyphicon glyphicon-calendar"></span>
					                	</span>
					            	</div>
						        </div>
						    </div>
						    <div class='col-md-5'>
						        <div class="form-group">
						            <div class='input-group date' id='enddatesearch'>
						                <input type='text' class="form-control" />
						                <span class="input-group-addon">
					    	                <span class="glyphicon glyphicon-calendar"></span>
					        	        </span>
					            	</div>
						        </div>
						    </div>
						</div>
						<thead>
							<td>#</td>
							<td>Reg. number</td>
							<td>Name</td>
							<td>Length</td>
							<td>Height</td>
							<td>Width</td>
							<td>Weight</td>
							<td>Current location</td>
							<td>status</td>
							<td>Number of transport phases</td>
							<td>Remarks</td>
							<td>Last update</td>
							<td></td>
						</thead>
						<tbody id="component-table">
							@foreach($components as $component)
								<tr id="component{{$component->id}}">
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->id }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->regnumber }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->name}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->length}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->height}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->width}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->weight}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->currentlocation}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->status}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::countTransports($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->updated_at }}</td>
									<td>
										@permission(('edit-component'))
											<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('create-component'))
										<button class="btn btn-warning btn-clone-component" data-id="{{ $component->id }}"><i class="fa fa-clipboard"></i></button>
										@endpermission
										@permission(('delete-component'))
											<button class="btn btn-danger btn-delete-component" data-id="{{ $component->id }}"><i class="fa fa-trash-o"></i></button>
										@endpermission
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endpermission
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- Datatable script-->
	    @include('partials.scriptimport')
    <!-- own javascript code-->
    	<script type="text/javascript">
        	var $table = $('#componenttable');
        	var $column = [];
        </script>
        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection