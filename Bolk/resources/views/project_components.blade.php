<?php
	use App\Http\Controllers\Project_componentsController;
	use App\Http\Controllers\WindmillController;
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
				<div class="row">
					@permission(('create-component'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponent" value="add">Add Component <span class="badge">+</span></button>
					@endpermission
				</div>
				@include('newComponent')	
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
<<<<<<< HEAD
							<td>Length</td>
							<td>Height</td>
							<td>Width</td>
							<td>Weight</td>
							<td>Current location</td>
							<td>status</td>
=======
							<td>Attached To</td>
							<td>From</td>
							<td>To</td>
>>>>>>> origin/master
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
<<<<<<< HEAD
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->length}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->height}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->width}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->weight}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->currentlocation}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->status}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ WindmillController::countTransports($component->id)}}</td>
=======
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Project_componentsController::getWindmillName($component->mainwindmillid) }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ Project_componentsController::countTransports($component->id)}}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
									<td onclick="document.location= '/component/id={{$component->id}}';"></td>
>>>>>>> origin/master
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
									<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->updated_at }}</td>
									<td>
										@permission(('edit-component'))
											<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}"><i class="fa fa-pencil"></i></button>
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
	$('#frmComponent-clear').on('click',function(){
		$('#frmComponent').trigger('reset');
		})	

	//---------add Component---------
	$('#addComponent').on('click',function(){
		$('#frmComponent-submit').val('Save');
		$('#component').modal('show');
	})

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
				$('#frmComponent').trigger('reset');
				$('#componentregnumber').focus();
				$('#component').modal('toggle');
				addRow(data);
				data.numberoftransports = 0;
				$("#component-datatable").DataTable().row.add(data).draw();

			}
		});
	})
	});

	//---------addrow---------
	function addRow(data){
		var row='<tr id="component'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.length +'</td>'+
				'<td>'+ data.heigth +'</td>'+
				'<td>'+ data.width +'</td>'+
				'<td>'+ data.weight +'</td>'+
				'<td>'+ data.currentlocation +'</td>'+
				'<td>'+ data.status +'</td>'+
				'<td>0</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit-component" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete-component" data-id="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				// if(state=='Save'){
				// 	$('#component-table').append(row);
				// }else{
				// 	$('#component'+data.id).replaceWith(row);
				// }
		
	}

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
				$('#currentlocation').val(data.currentlocation);
				$('#componentremarks').val(data.remarks);
				$('#componentstatus').val(data.status).change();
				$('#frmComponent-submit').val('Update');
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
    	var $table = $('#windmill-datatable');
    	var $table2 = $('#component-datatable');
    	var $column = [5, 6];
    	var $column2 = [6, 7];
    </script>

    <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
