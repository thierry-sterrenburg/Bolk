<?php 
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
						
						<table id="transportphasetable" class="table table-condensed table-hover">
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
										<td>{{ ComponentController::countRequirements($transport->id) }}</td>
										<td>{{ $transport->dateofloading}}</td>
										<td>{{ $transport->dateofarrivalinitial}}</td>
										<td>{{ $transport->dateofarrivalfinal}}</td>
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
		           $('#transportphasetable').DataTable().draw();
		        });
		        $("#enddatesearch").on("dp.change", function (e) {
		            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
		            maxDateFilter = new Date(e.date).getTime();
		           $('#transportphasetable').DataTable().draw();
	        	});
	    	});
    		//DataTables search execution
	    	minDateFilter="";
			maxDateFilter="";
			$.fn.dataTable.ext.search.push(
			   function(oSettings, aData, iDataIndex) {

				if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')||(typeof cData == 'undefined')) {
			      aData._date = new Date(aData[9]).getTime();
			      var bData = new Date(aData[10]).getTime();
			      var cData = new Date(aData[11]).getTime();
			    }

			    if (minDateFilter && !isNaN(minDateFilter)) {
			      if ((aData._date < minDateFilter)&&(bData < minDateFilter)&&(cData < minDateFilter)) {
			        return false;
			      }
			    }

			    if (maxDateFilter && !isNaN(maxDateFilter)) {
			      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)&&(cData > maxDateFilter)) {
			        return false;
			      }
			    }

			    return true;
			  }




			  );

	   		$(document).ready(function () {
				$('#transportphasetable').DataTable({
					responsive: true,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'pdf', 'print'
					]
				});
			} );

		</script>

@endsection