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
							<li><a href="windmill.html">Windmill T11</a></li>
							<li><a href="transport.html">PPM</a></li>
							<li class="active">Transport 670</li>
						</ol>
                        <h1 class="page-header">Transport 670</h1>
						
						<!--panel content -->
						
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE Auchrobert registration number:189207<br/>
								latest update: 13-9-2016 13:52:07 <br/>
								number of requirements: 3<br/>
								weight:<br/>
								height:<br/>
								width:<br/>
								length:<br/>
								<br>
								truck:<br/>
								trailer:<br />
								configuration:<br>
								
							</div>
						</div>
						
						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Requirement<span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>Name</td>
								<td>Country</td>
								<td>Document Location</td>
								<td>Start datetime</td>
								<td>End datetime</td>
								<td>Booked</td>
								<td>Responsible planner</td>
								<td>Last update</td>
								<td>Remarks</td>
							</thead>
							
							<tbody>
								@foreach($requirements as $requirement)
									<tr>
										<td>{{ $requirement->id }}</td>
										<td>{{ $requirement->name }}</td>
										<td>{{ $requirement->country }}</td>
										<td>is nog geen plek voor in database</td>
										<td>{{ $requirement->startdate }}</td>
										<td>{{ $requirement->enddate }}</td>
										<td>{{ $requirement->booked }}</td>
										<td>{{ $requirement->responsibleplanner }}</td>
										<td>{{ $requirement->remaks }}</td>
									</tr>
								@endforeach	
								<tr class="success">
									<td>1</td>
									<td>Escort</td>
									<td>Germany</td>
									<td>none</td>
									<td>16-08-2016 9:00:00</td>
									<td>16-08-2016 15:00:00</td>
									<td>Yes</td>
									<td>24-08-2016 13:57:09</td>
									<td>2 vans</td>
								</tr>
								<tr class="danger">
									<td>2</td>
									<td>Permit</td>
									<td>none</td>
									<td>16-08-2016 9:00:00</td>
									<td>16-08-2016 15:00:00</td>
									<td>No</td>
									<td>24-08-2016 13:57:09</td>
									<td>2 vans + truck</td>
								</tr>
								<tr class="danger">
									<td>3</td>
									<td>Offloading</td>
									<td>none</td>
									<td>16-08-2016 15:00:00</td>
									<td>16-08-2016 16:00:00</td>
									<td>No</td>
									<td>24-08-2016 13:57:09</td>
									<td>-</td>
								</tr>
								
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