<?php
	use App\Http\Controllers\Project_componentsController;
?>
@extends('layouts.master')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	<div class="row">
					<ol class="breadcrumb">
						<li><a href="/projects">Projects</a></li>
						<li class="active">{{$project->name}}</li>
					</ol>
				</div>
				<div class="row">
                    <h1 class="page-header">{{$project->name}}</h1>
                </div>
                <!--nav tabs-->
                <div class="row">
                	@include('partials.projecttabs')
				</div>
				<!--panel content -->
				<div class="row">
				@include('layouts.projectpanel')
				</div>
				<!--add buttones-->

				@include('newTransport')	
				<!-- Component Table-->
				<div class="row">
					<h3>Components</h3>
				</div>
				<div class="row">
					<table id="component-datatable" class="table table-condensed table-hover">
						<div class="container">
						    <div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='startdatesearch2'>
							            <input type='text' class="form-control" />
							            <span class="input-group-addon">
							                <span class="glyphicon glyphicon-calendar"></span>
							            </span>
							        </div>
							    </div>
							</div>
							<div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='enddatesearch2'>
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
							<td>From</td>
							<td>To</td>
							<td>Number of transport phases</td>
							<td>Date of loading</td>
							<td>Date of Arrival</td>
							<td>Offloading(initial)</td>
							<td>Offloading(final)</td>
							<td>Last update</td>
							<td>Remarks</td>
							<td></td>
						</thead>

						<tbody id="component-table">
							@foreach($components as $component)
								<tr id="component{{$component->id}}" onclick="document.location= '/component/id={{$component->id}}';">
									<td>{{ $component->id }}</td>
									<td>{{ $component->regnumber }}</td>
									<td>{{ $component->name}}</td>
									<td></td>
									<td></td>
									<td>{{ Project_componentsController::countTransports($component->id)}}</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>{{ $component->remarks }}</td>
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
@endsection