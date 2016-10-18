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
					<table id="transport-datatable" class="table table-condensed table-hover">
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
							<td>Date of Arrival(initial)</td>
							<td>Date of Arrival(final)</td>
							<td>Last update</td>
							<td>Remarks</td>
							<td></td>
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
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofloading}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofarrivalinitial}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofarrivalfinal}}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->updated_at }}</td>
									<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->remarks}}</td>
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
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	//---------add Transport---------
	$('#addTransport').on('click',function(){
		$('#frmTransport-submit').val('Save');
		$('#frmTransport').trigger('reset');

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
				var row='<tr id="transport'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.transportnumber +'</td>'+
				'<td>'+ data.company +'</td>'+
				'<td>'+ data.truck +'</td>'+
				'<td>'+ data.trailer +'</td>'+
				'<td>'+ data.configuration +'</td>'+
				'<td>'+ data.from +'</td>'+
				'<td>'+ data.to +'</td>'+
				'<td>'+ data.dateofloading +'</td>'+
				'<td>'+ data.dateofarrivalinitial +'</td>'+
				'<td>'+ data.dateofarrivalfinal +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id-transport="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#transport-table').append(row);
				}else{
					$('#transport'+data.id).replaceWith(row);
				}
				$('#frmTransport').trigger('reset');
				$('#transportnumber').focus();
			}
		});
	})
	});

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
				'<td>'+ data.dateofloading +'</td>'+
				'<td>'+ data.dateofarrivalinitial +'</td>'+
				'<td>'+ data.dateofarrivalfinal +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id-transport="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
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
				$('#company').val(data.company);
				$('#truck').val(data.truck);
				$('#trailer').val(data.trailer);
				$('#configuration').val(data.configuration);
				$('#from').val(data.from);
				$('#to').val(data.to);
				$('#dateofloading').val(data.dateofloading);
				$('#dateofarrivalinitial').val(data.dateofarrivalinitial);
				$('#dateofarrivalfinal').val(data.dateofarrivalfinal);
				$('#remarks').val(data.remarks);
				$('#frmTransport-submit').val('Update');
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
        $('#startdatepicker').datetimepicker({
			sideBySide: true,
			format: 'YYYY-MM-DD HH:mm'});


        $('#enddatepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			sideBySide: true,
			format: 'YYYY-MM-DD HH:mm'
			});
        $("#startdatepicker").on("dp.change", function (e) {
            $('#enddatepicker').data("DateTimePicker").minDate(e.date);
        });
        $("#enddatepicker").on("dp.change", function (e) {
            $('#startdatepicker').data("DateTimePicker").maxDate(e.date);
        });
    });

	function validator() {
    var x,y,text;

    // Get the value of the input field with id="regnumber"
    x = document.getElementById("regnumber").value;
	y = document.getElementById("name").value;

    // If x is Not a Number or less than one or greater than 10
    if (x == "") {
        text = "Regnumber must be filled in.";
    }
	if (y == ""){
		if(text!=null){
			text = text+"<br/>";
		}
        text = text+"Name must be filled in.";
    }
	if(x != "" && y != ""){
		$('#transport').modal('toggle');
	}else{
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}
}

  </script>
    <!-- Datatable script-->
    @include('partials.scriptimport')
    <!-- own javascript code-->
    <script type="text/javascript">
    	var $table = $('#transport-datatable');
    	var $table2 = $('#component-datatable');
    	var $column = [9, 10, 11];
    	var $column2 = [6, 7];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
