<?php
	use APp\Http\Controllers\Deadlines_componentsController;
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
 			<!-- Component Table-->
				<div class="row">
					<h3>Components</h3>
				</div>
				<div class="row">
					<table id="component-datatable" class="table table-condensed table-hover" style="width:100%;">
						<div class="container">
						    <div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='startdatesearch2'>
							            <input type='text' class="form-control" placeholder="Starting date for search" />
							            <span class="input-group-addon">
							                <span class="glyphicon glyphicon-calendar"></span>
							            </span>
							        </div>
							    </div>
							</div>
							<div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='enddatesearch2'>
							            <input type='text' class="form-control" placeholder="Ending date for search" />
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
							<td>Project</td>
							<td>Attached To</td>
							<td>From</td>
							<td>To</td>
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
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::getProjectName($component->projectid)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::getWindmillName($component->mainwindmillid) }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::getFromLocation($component->id) }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::getToLocation($component->id) }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->length}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->height}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->width}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->weight}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::getCurrentLocation($component->id) }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->status}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Deadlines_componentsController::countTransports($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->updated_at }}</td>
									<td>
										@permission(('edit-component'))
											<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}"><i class="fa fa-pencil"></i></button>
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
            </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <!-- Datatable script-->
	    @include('partials.scriptimport')
    <!-- own javascript code-->
    	<script type="text/javascript">
        	var $table = $('#component-datatable');
        	var $column = [];
        </script>
        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection