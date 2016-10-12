<?php 
	use App\Http\Controllers\ProjectController;
	use App\Http\Controllers\Project_transportController;
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
                <div class="row">    
                    <ul class="nav nav-tabs">
						<li><a onclick="document.location= '/project/id={{$project->id}}';">Windmills</a></li>
						<li class="active"><a onclick="document.location= '/project_transport/id={{$project->id}}';">Transports</a></li>
						<li><a href="#">Menu 2</a></li>
						<li><a href="#">Menu 3</a></li>
					</ul>
				</div>
				<!--panel content -->
				<div class="row">									
				@include('layouts.projectpanel')
				</div>
				<!--add buttones-->
				<div class="row">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="addTransport" value="add">Add Transport <span class="badge">+</span></button>
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponent" value="add">Add Component <span class="badge">+</span></button>
				</div>
				<div class="row">
					@include('newTransport')
					@include('newComponent')
				</div>
				<!--Transport Table -->
				<div class"row">
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
								<tr onclick="document.location= '/transportphase/id={{$transport->id}}';">
									<td>{{ $transport->id }}</td>
									<td>{{ $transport->transportnumber }}</td>
									<td>{{ $transport->company}}</td>
									<td>{{ $transport->truck}}</td>
									<td>{{ $transport->trailer }}</td>
									<td>{{ $transport->configuration}}</td>
									<td>{{ $transport->from }}</td>
									<td>{{ $transport->to}}</td>
									<td>{{ Project_transportController::countComponents($transport->id)}}</td>
									<td>{{ Project_transportController::countRequirements($transport->id)}}</td>
									<td>{{ $transport->dateofloading}}</td>
									<td>{{ $transport->dateofarrivalinitial}}</td>
									<td>{{ $transport->dateofarrivalfinal}}</td>
									<td></td>
									<td>{{ $transport->remarks}}</td>
									<td>
										<button class="btn btn-success btn-edit-transport" data-id="{{ $transport->id }}">Edit</button>
										<button class="btn btn-danger btn-delete-transport" data-id="{{ $transport->id }}">Delete</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
	
				<!-- Component Table-->
				<div class="row">
					<h3>Components</h3>
				</div>
				<div class="row">
					<table id="component-datatable" class="table table-condensed table-hover">
						<div class="container">
						    <div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='startdatesearch2'>
							            <input type='text' class="form-control" />
							            <span class="input-group-addon">
							                <span class="glyphicon glyphicon-calendar"></span>
							            </span>
							        </div>
							    </div>
							</div>
							<div class='col-md-5'>
							    <div class="form-group">
							        <div class='input-group date' id='enddatesearch2'>
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
							<td></td>
						</thead>

						<tbody id="component-table">
							@foreach($components as $component)
								<tr id="component{{$component->id}}" onclick="document.location= '/component/id={{$component->id}}';">
									<td>{{ $component->id }}</td>
									<td>{{ $component->regnumber }}</td>
									<td>{{ $component->name}}</td>
									<td></td>
									<td></td>
									<td>{{ ProjectController::countTransports($component->id)}}</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>{{ $component->remarks }}</td>
									<td>
										<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}">Edit</button>
										<button class="btn btn-danger btn-delete-component" data-id="{{ $component->id }}">Delete</button>
									</td>
								</tr>	
							@endforeach
						</tbody>	
					</table>
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
	
	//---------add Component---------
	$('#addComponent').on('click',function(){
		$('#frmComponent-submit').val('Save');
		$('#frmComponent').trigger('reset');
		
		$('#component').modal('show');s
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
				'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'">Edit</button> '+
				'<button class="btn btn-danger btn-delete" data-id-transport="'+ data.id +'">Delete</button></td>'+
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
	
	//---------form Component---------
	$(function() {
	$('#frmComponent-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmComponent');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmComponent-submit').val();
		var type= 'post';
		if(state=='Update'){
			type = 'put';
		}
		$.ajax({
			type : type,
			url : url,
			data: formData,
			success:function(data){
				var row='<tr id="component'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td></td>'+
				'<td></td>'+
				'<td>0</td>'+
				'<td></td>'+
				'<td></td>'+
				'<td></td>'+
				'<td></td>'+
				'<td></td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-component" data-id="'+ data.id +'">Edit</button> '+
				'<button class="btn btn-danger btn-delete" data-id-component="'+ data.id +'">Delete</button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#component-table').append(row);
				}else{
					$('#component'+data.id).replaceWith(row);
				}
				$('#frmComponent').trigger('reset');
				$('#regnumber').focus();
				$('#component').modal('toggle');
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
				'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'">Edit</button> '+
				'<button class="btn btn-danger btn-delete" data-id-transport="'+ data.id +'">Delete</button></td>'+
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
    	var $table = $('#transport-datatable');
    	var $table2 = $('#component-datatable');
    	var $column = [9, 10, 11];
    	var $column2 = [6, 7];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection