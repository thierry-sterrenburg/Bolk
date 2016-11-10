<?php
	use App\Http\Controllers\Transport_componentsController;
?>
@extends('layouts.master')
@section('content')
	<!--Page Content-->
	<div id="page-wrapper">
		<div class="container-fluid">
            <!--breadcrumbs-->
            <div class="row">
            	<ol class="breadcrumb">
					<li><a href="/projects">Projects</a></li>
					<li><a href="/project/id={{$project->id}}">{{$project->name}}</a></li>
					<li class="active">{{$transport->transportnumber}}</li>
				</ol>
            </div>
            <!--header-->
			<div class="row">
				<h1 class="page-header">Transport {{$transport->transportnumber}}</h1>
			</div>
			<!--navtabs-->
			<div class="row">
				@include('partials.transporttabs')
			</div>
			<!--panel-content-->
			<div class="row">
				@include('layouts.projectpanel')
				@include('layouts.transportpanel')
			</div>
			<!--add buttons-->
			<div class="row">
				@permission(('create-component'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponenttoTransport" value="add">Add Component to Transport<span class="badge">+</span></button>
				@endpermission
			</div>
				@include('modal.addComponenttoTransport')
				@include('modal.newComponent')
			<!-- Component Table-->
			<div class="row">
				<h3>Components</h3>
			</div>
			<div class="row">
				<table id="component-datatable" class="table table-condensed table-hover"  style="width:100%">
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
						<td>Reg. number</td>
						<td>Attached To</td>
						<td>Name</td>
						<td>Length</td>
						<td>Height</td>
						<td>Width</td>
						<td>Weight</td>
						<td>Number of transport phases</td>
						<td>Currentlocation</td>
						<td>Status</td>
						<td>Remarks</td>
						<td>Last update</td>
						<td></td>
					</thead>
					<tbody id="component-table">
						@foreach($components as $component)
							<tr id="component{{$component->id}}" class= {{Transport_componentsController::getComponentColor($component->id)}}>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->id }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->regnumber }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ Transport_componentsController::getWindmillName($component->mainwindmillid)}}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->name }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->length }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->height }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->width }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->weight }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ Transport_componentsController::countTransports($component->id)}}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ Transport_componentsController::getCurrentLocation($component->id)}}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->status }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->updated_at }}</td>
								<td>
									@permission(('edit-component'))
										<!--<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}"><i class="fa fa-pencil"></i></button>-->
									@endpermission
									@permission(('delete-component'))
										<button class="btn btn-danger btn-delete-component" data-id="{{ $component->id }}"><i class="fa fa-chain-broken"></i></button>
									@endpermission
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	//---------add Component---------
	$('#addComponenttoTransport').on('click',function(){
		$('#frmAddComponent-submit').val('Save');
		$('#frmAddComponent').trigger('reset');

		$('#addComponent').modal('show');
	})
	
	//---------form Component---------
	$(function() {
	$('#frmAddComponent-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmAddComponent');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmAddComponent-submit').val();
		var type= 'post';
		if(state=='Update'){
			type = 'put';
		}
		$.ajax({
			type : type,
			url : url,
			data: formData,
			success:function(data){
				$('#frmAddComponent').trigger('reset');
				$('#componentregnumber').focus();
				$('#addComponent').modal('toggle');
				location.reload();
			}
		});
	})
	});
	
	

		//---------form new Component---------
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
					$('#frmComponent').trigger('reset');
					$('#componentregnumber').focus();
					$('#component').modal('toggle');
					location.reload();
				}
			});
		})
	});


	//---------form get Component---------
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
				$('#currentlocation').val(data.currentlocation);
				$('#componentremarks').val(data.remarks);
				$('#componentstatus').val(data.status).change();
				$('#frmComponent-dismiss').val('reset');
				$('#frmComponent-submit').val('Update');
				$('#component').modal('show');
			}
		});
	})

		//---------delete component---------
	$('#component-table').delegate('.btn-delete-component', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteComponentfromTransport')}}';
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
  </script>
    <!-- Datatable script-->
    @include('partials.scriptimport')
    <!-- own javascript code-->
    <script type="text/javascript">
    	var $table = $('#component-datatable');
    	var $column = [];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">	
@endsection