<?php
	use App\Http\Controllers\Deadlines_transportsController;
?>
@extends('layouts.master')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<div class="row">
                    <h1 class="page-header">Transport Deadlines</h1>
                </div>
                <!--nav tabs-->
                <div class="row">
                	@include('partials.deadlinestabs')
				</div>	
				<!--Transport Table -->
				@permission(('read-transport'))
				<div class="row">
					<h3>Transports</h3>
				</div>
				<div class="row">
					<table id="transport-datatable" class="table table-condensed table-hover"  style="width:100%"> 
				
						<div class="container">
							<div class='col-sm-5'>
							    <div class="form-group">
							        <div class='input-group date' id='startdatesearch'>
							            <input type='text' class="form-control" placeholder="Starting date for search" />
							            <span class="input-group-addon">
							                <span class="glyphicon glyphicon-calendar"></span>
							            </span>
							        </div>
							    </div>
							</div>
							<div class='col-sm-5'>
							    <div class="form-group">
							        <div class='input-group date' id='enddatesearch'>
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
							<td>Transport Number</td>
							<td>Project Name</td>
							<td>Company</td>
							<td>Truck</td>
							<td>Trailer</td>
							<td>Configuration</td>
							<td>From</td>
							<td>To</td>
							<td>Number of Components</td>
							<td>Number of Requirements</td>
							<td>Date of loading</td>
							<td>Desired arrival</td>
							<td>Estimated arrival</td>
							<td>Planned arrival</td>
							<td>Actual arrival</td>
							<td>Date of unloading</td>
							<td>Remarks</td>
							<td>Last update</td>
							<td/>
						</thead>

						<tbody id="transport-table">
							@foreach($transports as $transport)
								<tr class="{{Deadlines_transportsController::getTransportColor($transport)}}">
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->id }}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->transportnumber }}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ Deadlines_transportsController::getProjectName($transport->projectid) }}</td>	
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->company}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->truck}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->trailer }}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->configuration}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->from }}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->to}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ Deadlines_transportsController::countComponents($transport->id)}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ Deadlines_transportsController::countRequirements($transport->id)}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ ($transport->loadingdate)}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->datedesired}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->dateestimated}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->dateplanned}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->dateactual}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->unloadingdate}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->remarks}}</td>
									<td onclick="document.location= '/transport_components/id={{$transport->id}}';">{{ $transport->updated_at}}</td>
									<td>
										@permission(('edit-transport'))
										<button class="btn btn-success btn-edit-transport" data-id="{{ $transport->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('delete-transport'))
										<button class="btn btn-danger btn-delete-transport" data-id="{{ $transport->id }}"><i class="fa fa-trash-o"></i></button>
										@endpermission
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@endpermission
				</div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    <!-- Datatable script-->
    @include('partials.scriptimport')
    <!-- own javascript code-->
    <script type="text/javascript">
    	var $table = $('#transport-datatable');
    	var $column = [11, 12, 13, 14, 15, 16];
    	var $ordering = [12];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
