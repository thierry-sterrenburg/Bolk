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
					    @include('layouts/projectpanel')
						@include('layouts/windmillpanel')
						@include('layouts/componentpanel')
						@include('layouts/transportpanel')

						<br>
						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Requirement<span class="badge">+</span></a></li>
						</ul>
						
						<br>

						<table id="requirementtable" class="table table-condensed table-hover">
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
										<td></td>
										<td>{{ $requirement->remaks }}</td>
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
		<!-- Datatable script-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" ></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" ></script>
    <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js" ></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
         <!-- own javascript code-->	
        <script type="text/javascript">
        	var $table = $('#requirementtable');
        	var $column = [4, 5];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">

    




@endsection