@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
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
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#RequirementModal" id="addRequirement" value="add">Add Requirement <span class="badge">+</span></button>
				</div>
				@include('newRequirement')
				<!--Requirement Table-->
				<div class="row">
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
										<button class="btn btn-success btn-edit-requirement" data-id="{{ $requirement->id }}"><i class="fa fa-pencil"></i></button>
										<button class="btn btn-danger btn-delete-requirement" data-id="{{ $requirement->id }}"><i class="fa fa-trash-o"></i></button></td>
									<td>{{ $requirement->remaks }}</td>
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
						'<td><button class="btn btn-success btn-edit-requirement" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
						'<button class="btn btn-danger btn-delete" data-id-requirement="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
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
