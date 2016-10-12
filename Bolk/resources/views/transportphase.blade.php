<?php
use App\Transport;
?>

@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="\projects">Projects</a></li>
							<li><a href="\project\id={{$project->id}}">{{$project->name}}</a></li>							
							<li class="active">Transport {{$transport->transportnumber}}</li>
						</ol>
                        <h1 class="page-header">Transport {{$transport->transportnumber}}</h1>

						<!--panel content -->						
                        @include('layouts/projectpanel')
                        @if(!is_null($component->mainwindmillid))
						@include('layouts/windmillpanel')
						@endif
						@include('layouts/componentpanel')
						@include('layouts/transportpanel')
						<!--end panels-->

						<br>
						
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#RequirementModal" id="addRequirement" value="add">Add Requirement <span class="badge">+</span></button>
						<br>
						@include('newRequirement')
						
						<br>

						<table id="requirementtable" class="table table-condensed table-hover">
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
							</thead>
							
							<tbody id="requirement-table">
								@foreach($requirements as $requirement)
									<tr id="requirement{{$requirement->id}}">
										<td>{{ $requirement->id }}</td>
										<td>{{ $requirement->name }}</td>
										<td>{{ $requirement->country }}</td>
										<td>is nog geen plek voor in database</td>
										<td>{{ $requirement->startdate }}</td>
										<td>{{ $requirement->enddate }}</td>
										<td>{{ $requirement->booked }}</td>
										<td>{{ $requirement->responsibleplanner }}</td>
										<td>
											<button class="btn btn-success btn-edit-requirement" data-id="{{ $requirement->id }}">Edit</button>
											<button class="btn btn-danger btn-delete-requirement" data-id="{{ $requirement->id }}">Delete</button></td>
										<td>{{ $requirement->remaks }}</td>
									</tr>
								@endforeach	
							</tbody>
							
						</table>



                    </div>
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		<script type="text/javascript">
		$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
			//---------add Transport---------
			$('#addRequirement').on('click',function(){
				$('#frmRequirement-submit').val('Save');
				$('#frmRequirement').trigger('reset');
		
				$('#requirement').modal('show');
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
						var row='<tr id="requirement'+data.id+'">'+
						'<td>'+ data.id +'</td>'+
						'<td>'+ data.name +'</td>'+
						'<td>'+ data.country +'</td>'+
						'<td></td>'+
						'<td>'+ data.startdate +'</td>'+
						'<td>'+ data.enddate +'</td>'+
						'<td>'+ data.booked +'</td>'+
						'<td>'+ data.responsibleplanner +'</td>'+
						'<td></td>'+
						'<td>'+ data.remarks +'</td>'+
						'<td><button class="btn btn-success btn-edit-requirement" data-id="'+ data.id +'">Edit</button> '+
						'<button class="btn btn-danger btn-delete" data-id-requirement="'+ data.id +'">Delete</button></td>'+
						'</tr>';
						if(state=='Save'){
							$('#requirement-table').append(row);
						}else{
							$('#requirement'+data.id).replaceWith(row);
						}
						$('#frmRequirement').trigger('reset');
						$('#name').focus();
						$('#requirement').modal('toggle');
					}
				});
				})
			});
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
        	var $table = $('#requirementtable');
        	var $column = [4, 5];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">

    




@endsection