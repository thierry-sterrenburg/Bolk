<?php 
	use App\Http\Controllers\ProjectsController;
	use App\Http\Controllers\ProjectController;
	use App\Http\Controllers\WindmillController;
	use App\Http\Controllers\ComponentController;
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
							<li><a href="windmill.html">Windmill T11</a></li>
							<li><a href="transport.html">PPM</a></li>
							<li class="active">Transport 670</li>
						</ol>
                        <h1 class="page-header">Transport 670</h1>
						
						<!--panel projectinfo -->
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
												<td colspan="1"><u>Name: {{$project->name}}</u></td>
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
												<td colspan="3"><u>Remarks:</u>{{$project->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end panel projectinfo-->
						<!--panel windmillinfo-->
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
												<td colspan="1"><u>Name: </u> {{$windmill->name}}</td>
												<td colspan="1"><u>Location:</u> {{$windmill->location}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Start Date: {{$windmill->startdate}}</u></td>
												<td colspan="2"><u>End Date:</u> {{$windmill->enddate}}</td>
											</tr>
												<td colspan="3"><u>Number of Components: {{ProjectController::countComponents($windmill->id)}}</u></td>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$windmill->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end panel windmillinfo-->
						<!--panel componentinfo-->
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-8">
											<a data-toggle="collapse" href="#componentinfotable">
												<h3 class="panel-title">Component Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="componentinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="2"><u>Component Registration Number:</u> {{$component->regnumber}}</td>
												<td colspan="2"><u>Name:</u> {{$component->name}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Length: {{$component->length}}</u></td>
												<td colspan="1"><u>Heigth: {{$component->heigth}}</u></td>
												<td colspan="1"><u>Width: {{$component->width}}</u></td>
												<td colspan="1"><u>Weight:</u> {{$component->weight}}</td>
											</tr>
											<tr>
												<td colspan="2"><u>Switchable:</u> {{$component->switchable}}</td>
												<td colspan="2"><u>Status:</u> {{$component->status}}</td>
											</tr>
											<tr>
												<td colspan="4"><u>Number of Transport Phases:</u> {{WindmillController::countTransports($component->id)}}</td>

											</tr>
											<tr>
												<td colspan="4"><u>Remarks:</u></td>
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
											<a data-toggle="collapse" href="#transportinfotable">
												<h3 class="panel-title">Transport Information </h3>
											</a>
										</div>
										<div class="col-md-4">
											<div class="pull-right">
												<small>Latest Update:</small>
											</div>
										</div>
									</div>
								</div>
								<div id="transportinfotable" class="panel-collapse collapse">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td colspan="1"><u>Transport Number:</u> {{$transport->transportnumber}}</td>
												<td colspan="2"><u>Company</u> {{$transport->company}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Truck:</u> {{$transport->truck}}</td>
												<td colspan="1"><u>Trailer:</u> {{$transport->trailer}}</td>
												<td colspan="1"><u>Configuration: {{$transport->configuration}}</u></td>
											</tr>
											<tr>
												<td colspan="1"><u>Start location: {{$transport->from}}</u></td>
												<td colspan="2"><u>End location:</u> {{$transport->to}}</td>
											</tr>
											<tr>
												<td colspan="1"><u>Date of loading:</u> {{$transport->dateofloading}}</td>
												<td colspan="1"><u>Date initial arrival:</u>{{$transport->dateofarrivalinitial}}</td>
												<td colspan="1"><u>Date final arrival:</u>{{$transport->dateofarrivalfinal}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Number of Requirements:</u>{{ComponentController::countRequirements($transport->id)}}</td>
											</tr>
											<tr>
												<td colspan="3"><u>Remarks:</u> {{$transport->remarks}}</td>
											</tr>
										</tbody>
									</table>
								</div>
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
							</tbody>
							
						</table>


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
        <script type="text/javascript">
        //linked datetimepicker
    		$(function () {
		        $('#startdatesearch').datetimepicker({
		        	format: 'DD/MM/YYYY'
		        });
		        $('#enddatesearch').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format: 'DD/MM/YYYY'
		        });
		        $("#startdatesearch").on("dp.change", function (e) {
		            $('#enddatesearch').data("DateTimePicker").minDate(e.date);
		            minDateFilter = new Date(e.date).getTime();
		           $('#requirementtable').DataTable().draw();
		        });
		        $("#enddatesearch").on("dp.change", function (e) {
		            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
		            maxDateFilter = new Date(e.date).getTime();
		           $('#requirementtable').DataTable().draw();
	        	});
	    	});
    		//DataTables search execution
	    	minDateFilter="";
			maxDateFilter="";
			$.fn.dataTable.ext.search.push(
			   function(oSettings, aData, iDataIndex) {

				if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')) {
			      aData._date = new Date(aData[5]).getTime();
			      var bData = new Date(aData[4]).getTime();
			    }

			    if (minDateFilter && !isNaN(minDateFilter)) {
			      if ((aData._date < minDateFilter)&&(bData < minDateFilter)) {
			        return false;
			      }
			    }

			    if (maxDateFilter && !isNaN(maxDateFilter)) {
			      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)) {
			        return false;
			      }
			    }

			    return true;
			  }




			  );

	   		$(document).ready(function () {
				$('#requirementtable').DataTable({
					responsive: true,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'pdf', 'print'
					]
				});
			} );

		</script>

    




@endsection