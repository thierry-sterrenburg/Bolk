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
							<li class="active">PPM</li>
						</ol>
                        <h1 class="page-header">PPM</h1>
						
						<!--panel content -->
						
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE Auchrobert registration number:189207<br/>
								latest update: 13-9-2016 13:52:07 <br/>
								number of phases: 3<br/>
								weight:<br/>
								height:<br/>
								width:<br/>
								length:<br/>
								
							</div>
						</div>
						
						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Transport Phase<span class="badge">+</span></a></li>
						</ul>
						
						<br>
						
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>Transport Number</td>
								<td>Company</td>
								<td>Truck</td>
								<td>Trailer</td>
								<td>Configuration</td>
								<td>From</td>
								<td>To</td>
								<td>Number of Requirements</td>
								<td>Date of loading</td>
								<td>Date of Arrival(initial)</td>
								<td>Date of Arrival(final)</td>
								<td>Last update</td>
								<td>Remarks</td>
							</thead>
							
							<tbody>
								@foreach($transports as $transport)
									<tr onclick="document.location= '/transportphase/id={{$transport->id}}';">
										<td>{{ $transport->id }}</td>
										<td>{{ $transport->transportnumber }}</td>
										<td>{{ $transport->company}}</td>
										<td>{{ $transport->truck}}</td>
										<td>{{ $transport->trailer }}</td>
										<td>{{ $transport->configuration}}</td>
										<td>{{ $transport->from }}</td>
										<td>{{ $transport->to}}</td>
										<td></td>
										<td>{{ $transport->dateofloading}}</td>
										<td>{{ $transport->dateofarrivalinitial}}</td>
										<td>{{ $transport->dateofarrrivalfinal}}</td>
										<td></td>
										<td>{{ $transport->remarks}}</td>
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