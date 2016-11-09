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
						@include('modal.newTransport')
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
    	var $ordering = 12;

	$('#frmTransport-clear').on('click',function(){
		$('#frmTransport').trigger('reset');
	})

	//---------get update transport---------
	$('#transport-table').delegate('.btn-edit-transport','click',function(){
	document.getElementById("error_message").innerHTML = '';
	var value=$(this).data('id');
		var url='{{URL::to('getUpdateTransport')}}';
		$.ajax({
			type: 'get',
			url : url,
			data: {'id':value},
			success:function(data){
				$('#id').val(data.id);
				$('#transportnumber').val(data.transportnumber);
				$('#transportcompany').val(data.company);
				$('#transporttruck').val(data.truck);
				$('#transporttrailer').val(data.trailer);
				$('#transportconfiguration').val(data.configuration);
				$('#transportfrom').val(data.from);
				$('#transportto').val(data.to);
				$('#loadingdate').val(moment(data.loadingdate).format("DD-MM-YYYY"));
				$('#datedesired').val(moment(data.datedesired).format("DD-MM-YYYY"));
				$('#dateestimated').val(moment(data.dateestimated).format("DD-MM-YYYY"));
				$('#dateplanned').val(moment(data.dateplanned).format("DD-MM-YYYY"));
				$('#dateactual').val(moment(data.dateactual).format("DD-MM-YYYY"));
				$('#unloadingdate').val(moment(data.unloadingdate).format("DD-MM-YYYY"));
				$('#transportremarks').val(data.remarks);
				$('#frmTransport-dismiss').val('reset');
				$('#frmTransport-submit').val('Update');
				$('#transport').modal('show');
			}
		});
	})

	$(function () {
        $('#loadingdatepicker').datetimepicker({
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $('#desireddatepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $('#estimateddatepicker').datetimepicker({
			useCurrent: false,
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $('#planneddatepicker').datetimepicker({
        	useCurrent: false,
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $('#actualdatepicker').datetimepicker({
        	useCurrent: false,
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $('#unloadingdatepicker').datetimepicker({
        	useCurrent: false,
			sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
		});

        $("#loadingdatepicker").on("dp.change", function (e) {
            $('#desireddatepicker').data("DateTimePicker").minDate(e.date);
            $('#estimateddatepicker').data("DateTimePicker").minDate(e.date);
            $('#planneddatepicker').data("DateTimePicker").minDate(e.date);
            $('#unloadingdatepicker').data("DateTimePicker").minDate(e.date);
        });
        $('#unloadingdatepicker').on("dp.change", function (e) {
            $('#loadingdatepicker').data("DateTimePicker").maxDate(e.date);
        });
        
    });
    </script>





    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
