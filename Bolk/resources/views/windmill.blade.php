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
						
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE Auchrobert registration number:189207<br/>
								latest update: 13-9-2016 13:52:07 <br/>
								number of components: 9
							</div>
						</div>
						
						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Transport for Component<span class="badge">+</span></a></li>
						</ul>
						
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
										<td></td>
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