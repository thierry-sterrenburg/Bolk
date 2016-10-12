<?php
	use App\Http\Controllers\ProjectController;
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
                	@include('partials.projecttabs')
				</div>
				<!--panel content -->
				<div class="row">
					@include('layouts.projectpanel')
				</div>
				<!--add buttons-->
				<div class="row">
					@permission(('create-windmill'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="addWindmill" value="add">Add Windmill <span class="badge">+</span></button>
					@endpermission
					@permission(('create-component'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponent" value="add">Add Component <span class="badge">+</span></button>
					@endpermission

				</div>
				@include('newWindmill')
				@include('newComponent')
				<!--Windmill Table -->
				<div class="row">
					@permission(('read-windmill'))
					<h3>Windmills</h3>
				</div>
				<div class="row">
					<table id="windmill-datatable" class="table table-condensed table-hover">
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
							<td>registration number</td>
							<td>name</td>
							<td>location</td>
							<td>number of components</td>
							<td>start date</td>
							<td>end date</td>
							<td>last update</td>
							<td>remarks</td>
							<td></td>
						</thead>
						<tbody id="windmill-table">
							@foreach($windmills as $windmill)
								<tr id="windmill{{$windmill->id}}">
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->id }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->regnumber }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->name }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->location }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ ProjectController::countComponents($windmill->id)}}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->startdate }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->enddate }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';"></td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->remarks }}</td>
									<td>
										@permission(('edit-windmill'))
										<button class="btn btn-success btn-edit-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('delete-windmill'))
										<button class="btn btn-danger btn-delete-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-trash-o"></i></button>
										@endpermission
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@endpermission
						@if(!Entrust::can('read-windmill'))
						<div class="alert alert-danger">
							<strong>{{$project->name}} Windmills</strong> You are not allowed to access this information
						</div>
						@endif
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	//---------add Windmill---------
	$('#addWindmill').on('click',function(){
		$('#frmWindmill-submit').val('Save');
		$('#frmWindmill').trigger('reset');

		$('#windmill').modal('show');
	})

	//---------add Component---------
	$('#addComponent').on('click',function(){
		$('#frmComponent-submit').val('Save');
		$('#frmComponent').trigger('reset');

		$('#component').modal('show');
	})

	//---------form Windmill---------
	$(function() {
	$('#frmWindmill-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmWindmill');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmWindmill-submit').val();
		var type= 'post';
		if(state=='Update'){
			type = 'put';
		}
		$.ajax({
			type : type,
			url : url,
			data: formData,
			success:function(data){
				var row='<tr id="windmill'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.location +'</td>'+
				'<td>'+ data.startdate +'</td>'+
				'<td>'+ data.enddate +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-windmill" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id-windmill="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#windmill-table').append(row);
				}else{
					$('#windmill'+data.id).replaceWith(row);
				}
				$('#frmWindmill').trigger('reset');
				$('#regnumber').focus();
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
				'<td><button class="btn btn-success btn-edit-component" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id-component="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#component-table').append(row);
				}else{
					$('#component'+data.id).replaceWith(row);
				}
				$('#frmComponent').trigger('reset');
				$('#componentregnumber').focus();
				$('#component').modal('toggle');
			}
		});
	})
	});

	//---------addrow---------
	function addRow(data){
		var row='<tr id="windmill'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.location +'</td>'+
				'<td>'+ data.startdate +'</td>'+
				'<td>'+ data.enddate +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit"><i class="fa fa-pencil"></i></button>'+
				'<button class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
		$('tbody').append(row);
	}

	//---------get update windmill---------
	$('#windmill-table').delegate('.btn-edit-windmill','click',function(){
	document.getElementById("error_message").innerHTML = '';
	var value=$(this).data('id');
		var url='{{URL::to('getUpdateWindmill')}}';
		$.ajax({
			type: 'get',
			url : url,
			data: {'id':value},
			success:function(data){
				$('#id').val(data.id);
				$('#regnumber').val(data.regnumber);
				$('#name').val(data.name);
				$('#location').val(data.location);
				$('#startdate').val(data.startdate);
				$('#remarks').val(data.remarks);
				$('#enddate').val(data.enddate);
				$('#frmWindmill-submit').val('Update');
				$('#windmill').modal('show');
			}
		});
	})

		//---------get update component---------
	$('#component-table').delegate('.btn-edit-component','click',function(){
	document.getElementById("error_message").innerHTML = '';
	var value=$(this).data('id');
		var url='{{URL::to('getUpdateComponent')}}';
		$.ajax({
			type: 'get',
			url : url,
			data: {'id':value},
			success:function(data){
				$('#componentid').val(data.id);
				$('#componentregnumber').val(data.regnumber);
				$('#componentname').val(data.name);
				$('#componentlength').val(data.length);
				$('#componentheight').val(data.height);
				$('#componentwidth').val(data.width);
				$('#componentweight').val(data.weight);
				$('#componentremarks').val(data.remarks);
				$('#componentstatus').val(data.status).change();
				$('#frmComponent-submit').val('Update');
				$('#component').modal('show');
			}
		});
	})


	//---------delete windmill---------
	$('#windmill-table').delegate('.btn-delete-windmill', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteWindmill')}}';
		if (confirm('Are you sure to delete?')==true){
			$.ajax({
				type : 'delete',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#windmill'+value).remove();
				}
			});
		}
	});

		//---------delete component---------
	$('#component-table').delegate('.btn-delete-component', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteComponent')}}';
		if (confirm('Are you sure to delete?')==true){
			$.ajax({
				type : 'delete',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#component'+value).remove();
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
		$('#windmill').modal('toggle');
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
    	var $table = $('#windmill-datatable');
    	var $table2 = $('#component-datatable');
    	var $column = [5, 6];
    	var $column2 = [6, 7];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
