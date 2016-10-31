<?php
use app\Http\Controllers\TransportphaseController as TransportphaseController;
?>

@extends('layouts.master')
@section('content')
        <!-- Page Content -->
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
				<!--panel content -->
				<div class="row">
                	@include('layouts/projectpanel')
					@include('layouts/transportpanel')
				</div>
				<!--end panels-->
				<!--add buttons-->
				<div class="row">
					@permission(('edit-transport'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#RequirementModal" id="addRequirement" value="add">Add Requirement <span class="badge">+</span></button>
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ChecklistModal" id="addChecklist" value="add">Add Checklist <span class="badge">+</span></button>
					@endpermission
				</div>
				
				<br/>
				@permission(('edit-transport'))
				@include('newRequirement')
				@include('newChecklist')
				@endpermission
				
				<!--Requirement Table-->
				<div class="row" id="tablecontainer">
					<table id="requirementtable" class="table table-condensed table-hover"  style="width:100%">
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
							<td>Name</td>
							<td>Country</td>
							<td>Document Location</td>
							<td>Start datetime</td>
							<td>End datetime</td>
							<td>Booked</td>
							<td>Responsible planner</td>
							<td>Last update</td>
							<td>Remarks</td>
							<td></td>
						</thead>
						<tbody id="requirement-table">
							@foreach($requirements as $requirement)
								<tr id="requirement{{$requirement->id}}" class="{{TransportphaseController::checkStatusRequirement($requirement->id)}}">
									<td>{{ $requirement->id }}</td>
									<td>{{ $requirement->name }}</td>
									<td>{{ $requirement->country }}</td>
									<td>is nog geen plek voor in database</td>
									<td>{{ $requirement->startdate }}</td>
									<td>{{ $requirement->enddate }}</td>
									<td>{{ $requirement->booked }}</td>
									<td>{{ $requirement->responsibleplanner }}</td>
									<td>{{ $requirement->updated_at }}</td>
									<td>{{ $requirement->remarks }}</td>
									<td>
										@permission(('edit-transport'))
										<button class="btn btn-success btn-edit-requirement" data-id="{{ $requirement->id }}"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-warning btn-clone-requirement" data-id="{{ $requirement->id }}"><i class="fa fa-clipboard"></i></button>
										<button class="btn btn-danger btn-delete-requirement" data-id="{{ $requirement->id }}"><i class="fa fa-trash-o"></i></button></td>
									@endpermission
									
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
		
		$('#frmRequirement-clear').on('click',function(){
		$('#frmRequirement').trigger('reset');
			})
			
		$('#frmChecklist-clear').on('click',function(){
		$('#frmChecklist').trigger('reset');
			})
			
			//---------add Transport---------
			$('#addRequirement').on('click',function(){
				if($('#frmRequirement-dismiss').val() == 'reset'){
					$('#frmRequirement').trigger('reset');
				}
				$('#frmRequirement-dismiss').val('');
				$('#frmRequirement-submit').val('Save');
				$('#requirement').modal('show');
			})
			
			//---------add Transport---------
			$('#addChecklist').on('click',function(){
				$('#frmChecklist-submit').val('Save');
				$('#checklist').modal('show');
			})

			//---------form requirement---------
			$(function() {
				$('#frmRequirement-submit').on('click', function(e){
				e.preventDefault();
				var form=$('#frmRequirement');
				var formData=form.serialize();
				var url=form.attr('action');
				var state=$('#frmRequirement-submit').val();
				var type= 'post';
				if(state=='Update'){
					type = 'put';
				}
				$.ajax({
					type : type,
					url : url,
					data: formData,
					success:function(data){
					
						$('#frmRequirement').trigger('reset');
						$('#name').focus();
						$('#requirement').modal('toggle');
						location.reload();
					}
				});
				})
			});
			
			//---------form checklist---------
			$(function() {
				$('#frmChecklist-submit').on('click', function(e){
				e.preventDefault();
				var form=$('#frmChecklist');
				var formData=form.serialize();
				var url=form.attr('action');
				var state=$('#frmChecklist-submit').val();
				var type= 'post';
				if(state=='Update'){
					type = 'put';
				}
				$.ajax({
					type : type,
					url : url,
					data: formData,
					success:function(data){
						
						$('#frmChecklist').trigger('reset');
						$('#name').focus();
						$('#checklist').modal('toggle');
						location.reload;
					}
				});
				})
			});
			
			//---------get update requirement---------
			$('#requirement-table').delegate('.btn-edit-requirement','click',function(){
			document.getElementById("error_message").innerHTML = '';
			var value=$(this).data('id');
				var url='{{URL::to('getUpdateRequirement')}}';
				$.ajax({
					type: 'get',
					url : url,
					data: {'id':value},
					success:function(data){
						$('#id').val(data.id);
						$('#requirementname').val(data.name);
						$('#requirementcountry').val(data.country);
						$('#requirementstartdate').val(data.startdate);
						$('#requirementenddate').val(data.enddate);
						$('#requirementplanner').val(data.responsibleplanner);
						$('#requirementbooked').val(data.booked);
						$('#requirementremarks').val(data.remarks);
						$('#frmRequirement-submit').val('Update');
						$('#frmRequirement-dismiss').val('reset');
						$('#requirement').modal('show');
					}
				});
			})
			
			
			//---------get update requirement for duplicate---------
			$('#requirement-table').delegate('.btn-clone-requirement','click',function(){
			document.getElementById("error_message").innerHTML = '';
			var value=$(this).data('id');
				var url='{{URL::to('getUpdateRequirement')}}';
				$.ajax({
					type: 'get',
					url : url,
					data: {'id':value},
					success:function(data){
						$('#id').val(data.id);
						$('#requirementname').val(data.name);
						$('#requirementcountry').val(data.country);
						$('#requirementstartdate').val(data.startdate);
						$('#requirementenddate').val(data.enddate);
						$('#requirementplanner').val(data.responsibleplanner);
						$('#requirementbooked').val(data.booked);
						$('#requirementremarks').val(data.remarks);
						$('#frmRequirement-submit').val('Duplicate');
						$('#frmRequirement-dismiss').val('reset');
						$('#requirement').modal('show');
					}
				});
			})
			
			//---------delete requirement---------
			$('#requirement-table').delegate('.btn-delete-requirement', 'click',function(){
				var value = $(this).data('id');
				var url = '{{URL::to('deleteRequirement')}}';
				if (confirm('Are you sure to delete?'+value)==true){
					$.ajax({
						type : 'delete',
						url : url,
						data : {"_token": "{{ csrf_token() }}" ,
							'id':value},
						success:function(data){
							$('#requirement'+value).remove();
						}
					});
				}
			});
		</script>
		<!-- Datatable script-->
		@include('partials.scriptimport')
         <!-- own javascript code-->
        <script type="text/javascript">
        	var $table = $('#requirementtable');
        	var $column = [4, 5];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">






@endsection
