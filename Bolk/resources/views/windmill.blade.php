<?php 
	use App\Http\Controllers\ProjectsController;
	use App\Http\Controllers\ProjectController;
	use App\Http\Controllers\WindmillController;



?>
@extends('layouts.master')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="projects.html">Projects</a></li>
							<li><a href="project.html">Project GE Auchrobert</a></li>
							<li class="active">Windmill T11</li>
						</ol>
                        <h1 class="page-header">Windmill T11</h1>
						
						<!--panel content -->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#projectinfotable">
												<h3 class="panel-title">Project Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="projectinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Project Registration Number:</u> {{$project->regnumber}}</td>
												<td colspan="1"><u>Name:</u> {{$project->name}}</td>
												<td colspan="1"><u>Location:</u> {{$project->location}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date:</u> {{$project->startdate}}</td>
												<td colspan="2"><u>End Date:</u> {{$project->enddate}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Total number of Windmills:</u> {{ProjectsController::countWindmills($project->id)}}</td>
												<td colspan="1"><u>Total number of Components:</u> {{ProjectsController::countComponents($project->id)}}</td>
												<td colspan="1"><u>Total number of Transport Phases:</u> {{ProjectsController::countTransports($project->id)}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$project->remark}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>


						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#windmillinfotable">
												<h3 class="panel-title">Windmill Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="windmillinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Windmill Registration Number:</u> {{$windmill->regnumber}}</td>
												<td colspan="1"><u>Name:</u> {{$windmill->name}}</td>
												<td colspan="1"><u>Location:</u> {{$windmill->location}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date:</u> {{$windmill->startdate}}</td>
												<td colspan="2"><u>End Date:</u> {{$windmill->enddate}}</td>
											</tr>
												<td colspan="3"><u>Number of Components:</u> {{ProjectController::countComponents($windmill->id)}}</td>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$windmill->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						
						<br>
						
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project <span class="badge">+</span></button>
						
						
						<br>
										
						<table class="table table-condensed table-hover">
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
							</thead>
							
							<tbody>
								@foreach($components as $component)
									<tr onclick="document.location= '/component/id={{$component->id}}';">
										<td>{{ $component->id }}</td>
										<td>{{ $component->regnumber }}</td>
										<td>{{ $component->name}}</td>
										<td></td>
										<td></td>
										<td>{{ WindmillController::countTransports($component->id) }}</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ $component->remarks }}</td>
									</tr>
								@endforeach	
							</tbody>
							
						</table>
						
                    </div>
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection