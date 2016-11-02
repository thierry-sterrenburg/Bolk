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
				</div>
				@include('modal.newWindmill')
				<!--Windmill Table -->
				<div class="row">
					@permission(('read-windmill'))
					<h3>Windmills</h3>
				</div>
				<div class="row">
					<table id="windmill-datatable" class="table table-condensed table-hover"  style="width:100%">
						<div class="container">
						    <div class='col-md-5'>
						        <div class="form-group">
						            <div class='input-group date' id='startdatesearch'>
						                <input type='text' class="form-control" placeholder="Starting date for search" />
						                <span class="input-group-addon">
						                    <span class="glyphicon glyphicon-calendar"></span>
						                </span>
						            </div>
						        </div>
						    </div>
						    <div class='col-md-5'>
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
							<td>registration number</td>
							<td>name</td>
							<td>location</td>
							<td>number of components</td>
							<td>start date</td>
							<td>end date</td>
							<td>remarks</td>
							<td>last update</td>
							<td></td>
						</thead>
						<tbody id="windmill-table">
							@foreach($windmills as $windmill)
								@if(Auth::user()->projectid == $project->id)
								<tr id="windmill{{$windmill->id}}">
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->id }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->regnumber }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->name }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->location }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ ProjectController::countComponents($windmill->id)}}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->startdate }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->enddate }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->remarks }}</td>
									<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->updated_at }}</td>
									<td>
										@permission(('edit-windmill'))
										<button class="btn btn-success btn-edit-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('create-windmill'))
										<button class="btn btn-warning btn-clone-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-clipboard"></i></button>
										@endpermission
										@permission(('delete-windmill'))
										<button class="btn btn-danger btn-delete-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-trash-o"></i></button>
										@endpermission
									</td>
								</tr>
								@elseif(Auth::user()->projectid == '')
									<tr id="windmill{{$windmill->id}}">
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->id }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->regnumber }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->name }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->location }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ ProjectController::countComponents($windmill->id)}}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->startdate }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->enddate }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->remarks }}</td>
										<td onclick="document.location= '/windmill/id={{$windmill->id}}';">{{ $windmill->updated_at }}</td>
										<td>
											@permission(('edit-windmill'))
											<button class="btn btn-success btn-edit-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-pencil"></i></button>
											@endpermission
											@permission(('create-windmill'))
											<button class="btn btn-warning btn-clone-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-clipboard"></i></button>
											@endpermission
											@permission(('delete-windmill'))
											<button class="btn btn-danger btn-delete-windmill" data-id="{{ $windmill->id }}"><i class="fa fa-trash-o"></i></button>
											@endpermission
										</td>
									</tr>
								@endif
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

	$('#frmWindmill-clear').on('click',function(){
		$('#frmWindmill').trigger('reset');
	})
	//---------add Windmill---------
	$('#addWindmill').on('click',function(){
		if($('#frmWindmill-dismiss').val() == 'reset'){
			$('#frmWindmill').trigger('reset');
		}
		$('#frmWindmill-dismiss').val('');
		$('#frmWindmill-submit').val('Save');
		document.getElementById("error_message").innerHTML = '';
		$('#windmill').modal('show');
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
				
				$('#frmWindmill').trigger('reset');
				$('#regnumber').focus();
				location.reload();
			}
		});
	})
	});
	
	function addRowWindmill(data){
		var row='<tr id="windmill'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.location +'</td>'+
				'<td>0</td>'+
				'<td>'+ data.startdate +'</td>'+
				'<td>'+ data.enddate +'</td>'+
				'<td></td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-windmill" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete-windmill"  data-id="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#windmill-table').append(row);
				}else{
					$('#windmill'+data.id).replaceWith(row);
				}
	}
	
	function addRowWindmill(data){
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
				$('#frmWindmill-dismiss').val('reset');
				$('#frmWindmill-submit').val('Update');
				$('#windmill').modal('show');
			}
		});
	})
	
		//---------get update windmill for duplicate---------
	$('#windmill-table').delegate('.btn-clone-windmill','click',function(){
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
				$('#frmWindmill-dismiss').val('reset');
				$('#frmWindmill-submit').val('Duplicate');
				$('#windmill').modal('show');
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

	$(function () {
        $('#startdatepicker').datetimepicker({
			format: 'DD-MM-YYYY'});


        $('#enddatepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			format: 'DD-MM-YYYY'
			});
        $("#startdatepicker").on("dp.change", function (e) {
            $('#enddatepicker').data("DateTimePicker").minDate(e.date);
        });
        $("#enddatepicker").on("dp.change", function (e) {
            $('#startdatepicker').data("DateTimePicker").maxDate(e.date);
        });
    });

  </script>
    <!-- Datatable script-->
    @include('partials.scriptimport')
    <!-- own javascript code-->
    <script type="text/javascript">
    	var $table = $('#windmill-datatable');
    	var $column = [5, 6];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
