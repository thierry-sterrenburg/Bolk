<?php 
	use App\Http\Controllers\ProjectController;
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
							<li class="active">Project GE Auchrobert</li>
						</ol>
                        <h1 class="page-header">Project GE Auchrobert</h1>
						
						<!--panel content -->						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE A registration number:189207 latest update: 13-9-2016 13:52:07 number of windmills: 6
							</div>
						</div>
						
						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Windmill <span class="badge">+</span></a></li>
						</ul>
						
						<br>
						<!--Windmill Table -->
						<h3>Windmills</h3>
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>registration number</td>
								<td>name</td>
								<td>location</td>
								<td>number of components</td>
								<td>start date</td>
								<td>end date</td>
								<td>last update</td>
								<td>remarks
							</thead>
							
							<tbody>
								@foreach($windmills as $windmill)
									<tr onclick="document.location= '/windmill/id={{$windmill->id}}';">
										<td>{{ $windmill->id }}</td>
										<td>{{ $windmill->regnumber }}</td>
										<td>{{ $windmill->name }}</td>
										<td>{{ $windmill->location }}</td>
										<td>{{ ProjectController::countComponents($windmill->id)}}</td>
										<td>{{ $windmill->startdate }}</td>
										<td>{{ $windmill->enddate }}</td>
										<td></td>
										<td>{{ $windmill->remarks }}</td>
									</tr>
								@endforeach	
							</tbody>
							
						</table>
						<!-- Component Table-->
						<h3>Components</h3>
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
										<td>{{ ProjectController::countTransports($component->id) }}</td>
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