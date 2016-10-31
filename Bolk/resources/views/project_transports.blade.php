<?php
	use App\Http\Controllers\Project_transportsController;

?>
@extends('layouts.master')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	<div class="row">
					<ol class="breadcrumb">
						<li><a href="/projects">Projects</a></li>
						<li class="active">{{$project->name}}</li>
					</ol>
				</div>
				<div class="row">
                    <h1 class="page-header">{{$project->name}}</h1>
                </div>
                <!--nav tabs-->
                <div class="row">
                	@include('partials.projecttabs')
				</div>
				<!--panel content -->
				<div class="row">
				@include('layouts.projectpanel')
				</div>
				<!--add buttones-->
				@permission(('create-transport'))
				<div class="row">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="addTransport" value="add">Add Transport <span class="badge">+</span></button>
				</div>
				@endpermission

				@include('newTransport')	
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
							            <input type='text' class="form-control" />
							            <span class="input-group-addon">
							                <span class="glyphicon glyphicon-calendar"></span>
							            </span>
							        </div>
							    </div>
							</div>
							<div class='col-sm-5'>
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
								<tr>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->id }}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->transportnumber }}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->company}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->truck}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->trailer }}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->configuration}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->from }}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->to}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ Project_transportsController::countComponents($transport->id)}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ Project_transportsController::countRequirements($transport->id)}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ ($transport->loadingdate)}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->datedesired}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateestimated}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateplanned}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateactual}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->unloadingdate}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->remarks}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->updated_at}}</td>
									<td>
										@permission(('edit-transport'))
										<button class="btn btn-success btn-edit-transport" data-id="{{ $transport->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('create-transport'))
										<button class="btn btn-warning btn-clone-transport" data-id="{{ $transport->id }}"><i class="fa fa-clipboard"></i></button>
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
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
	
	$('#frmTransport-clear').on('click',function(){
		$('#frmTransport').trigger('reset');
			})

	//---------add Transport---------
	$('#addTransport').on('click',function(){
		if($('#frmTransport-dismiss').val() == 'reset'){
			$('#frmTransport').trigger('reset');
		}
		$('#frmTransport-dismiss').val('');
		$('#frmTransport-submit').val('Save');
		$('#transport').modal('show');
	})

	//---------form Transport---------
	$(function() {
		$('#frmTransport-submit').on('click', function(e){
			e.preventDefault();
			var form=$('#frmTransport');
			var formData=form.serialize();
			var url=form.attr('action');
			var state=$('#frmTransport-submit').val();
			var type= 'post';
			if(state=='Update'){
				type = 'put';
			}
			$.ajax({
				type : type,
				url : url,
				data: formData,
				success:function(data){
					$('#frmTransport').trigger('reset');
					$('#transportnumber').focus();
					$('#transport').modal('toggle');
					location.reload();
				}
			})
		})
	})
	//---------addrow---------
	function addRow(data){
		var row='<tr id="transport'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.transportnumber +'</td>'+
				'<td>'+ data.company +'</td>'+
				'<td>'+ data.truck +'</td>'+
				'<td>'+ data.trailer +'</td>'+
				'<td>'+ data.configuration +'</td>'+
				'<td>'+ data.from +'</td>'+
				'<td>'+ data.to +'</td>'+
				'<td>0</td>'+
				'<td>0</td>'+
				'<td>'+ data.dateofloading +'</td>'+
				'<td>'+ data.datedesired +'</td>'+
				'<td>'+ data.dateestimated +'</td>'+
				'<td>'+ data.dateplanned +'</td>'+
				'<td>'+ data.dateactual +'</td>'+
				'<td>'+ data.unloadingdate +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td/>'+
				'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete-transport" data-id"'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
		$('tbody').append(row);
	}

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
				$('#loadingdate').val(data.loadingdate);
				$('#datedesired').val(data.datedesired);
				$('#dateestimated').val(data.dateestimated);
				$('#dateplanned').val(data.dateplanned);
				$('#dateactual').val(data.dateactual);
				$('#unloadingdate').val(data.unloadingdate);
				$('#transportremarks').val(data.remarks);
				$('#frmTransport-dismiss').val('reset');
				$('#frmTransport-submit').val('Update');
				$('#transport').modal('show');
			}
		});
	})
	
	//---------get update transport for duplicate---------
	$('#transport-table').delegate('.btn-clone-transport','click',function(){
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
				$('#loadingdate').val(data.loadingdate);
				$('#datedesired').val(data.datedesired);
				$('#dateestimated').val(data.dateestimated);
				$('#dateplanned').val(data.dateplanned);
				$('#dateactual').val(data.dateactual);
				$('#unloadingdate').val(data.unloadingdate);
				$('#transportremarks').val(data.remarks);
				$('#frmTransport-dismiss').val('reset');
				$('#frmTransport-submit').val('Duplicate');
				$('#transport').modal('show');
			}
		});
	})

	//---------delete transport---------
	$('#transport-table').delegate('.btn-delete-transport', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteTransport')}}';
		if (confirm('Are you sure to delete?')==true){
			$.ajax({
				type : 'delete',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#transport'+value).remove();
				}
			});
		}
	});

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
    <!-- Datatable script-->
    @include('partials.scriptimport')
    <!-- own javascript code-->
    <script type="text/javascript">
    	var $table = $('#transport-datatable');
    	var $table2 = $('#component-datatable');
    	var $column = [10, 11, 12, 13, 14, 15];
    	var $column2 = [6, 7];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
