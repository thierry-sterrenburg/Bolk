<?php
	use App\Http\Controllers\WindmillController;
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
						<li><a href="/project/id={{$project->id}}">{{$project->name}}</a></li>
						<li class="active">{{$windmill->name}}</li>
					</ol>
			</div>
			<div class="row">
                <h1 class="page-header">{{$windmill->name}}</h1>
            </div>
			<!--panel content -->
			<div class="row">
			@include('layouts.projectpanel')
			@include('layouts.windmillpanel')
			</div>
			<!--add buttons-->
			@permission(('create-component'))
				<div class="row">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponent" value="add">Add New Component <span class="badge">+</span></button>
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addExistingComponentToWindmill">Add Existing Component <span class="badge">+</span></button>
 					@include('modal.newComponent')
 					@include('modal.addComponentToWindmill')
 				</div>
 			@endpermission
 			<!--table content -->
			@permission(('read-component'))
				<div class="row">
					<h3>Components</h3>
				</div>
				<div class="row">
					<table id="componenttable" class="table table-condensed table-hover"  style="width:100%">
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
							<td>Name</td>
							<td>From</td>
							<td>To</td>
							<td>Length</td>
							<td>Height</td>
							<td>Width</td>
							<td>Weight</td>
							<td>Current location</td>
							<td>status</td>
							<td>Number of transport phases</td>
							<td>Remarks</td>
							<td>Last update</td>
							<td></td>
						</thead>
						<tbody id="component-table">
							@foreach($components as $component)
								<tr id="component{{$component->id}}">
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->id }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->regnumber }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->name}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::getFromLocation($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::getToLocation($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->length}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->height}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->width}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->weight}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::getCurrentLocation($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->status}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::countTransports($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->updated_at }}</td>
									<td>
										@permission(('edit-component'))
											<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}"><i class="fa fa-pencil"></i></button>
										@endpermission
										@permission(('create-component'))
										<button class="btn btn-warning btn-clone-component" data-id="{{ $component->id }}"><i class="fa fa-clipboard"></i></button>
										@endpermission
										@permission(('delete-component'))
											<button class="btn btn-danger btn-delete-component" data-id="{{ $component->id }}"><i class="fa fa-trash-o"></i></button>
										@endpermission
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endpermission
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
	<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
	
	$('#frmComponent-clear').on('click',function(){
		$('#frmComponent').trigger('reset');
	})

	//---------new Component---------
	$('#addComponent').on('click',function(){
		$('#frmComponent-submit').val('Save');
		if($('#frmComponent-dismiss').val() == 'reset'){
			$('#frmComponent').trigger('reset');
		}
		$('#frmComponent-dismiss').val('');
		$('#component').modal('show');
	})

	//---------add Component---------
	$('#addExistingComponentToWindmill').on('click',function(){
		$('#frmAddComponent-submit').val('Save');
		$('#frmAddComponent').trigger('reset');
		$('#addExistingComponent').modal('show');
	})

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

	//---------form add Component---------
	$(function() {
		$('#frmAddComponent-submit').on('click', function(e){
			e.preventDefault();
			var form=$('#frmAddComponent');
			var formData=form.serialize();
			var url=form.attr('action');
			var state=$('#frmExistingComponent-submit').val();
			var type= 'put';
			$.ajax({
				type : type,
				url : url,
				data: formData,
				success:function(data){
					$('#frmAddComponent').trigger('reset');
					$('#componentregnumber').focus();
					$('#addExistingComponent').modal('toggle');
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
	
	//---------form get Component for duplicate---------
	$('#component-table').delegate('.btn-clone-component','click',function(){
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
				$('#frmComponent-submit').val('Duplicate');
				$('#component').modal('show');
			}
		});
	})

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


		</script>
        <!-- Datatable script-->
        @include('partials.scriptimport')
        <!-- own javascript code-->
        <script type="text/javascript">
        	var $table = $('#componenttable');
        	var $column = [];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection