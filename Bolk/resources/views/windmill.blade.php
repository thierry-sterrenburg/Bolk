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
                    <div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/projects">Projects</a></li>
							<li><a href="/project/id={{$project->id}}">{{$project->name}}</a></li>
							<li class="active">{{$windmill->name}}</li>
						</ol>
                        <h1 class="page-header">{{$windmill->name}}</h1>
						
						<!--panel content -->
						@include('layouts.projectpanel')
						@include('layouts.windmillpanel')

						<br>
						
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponent" value="add">Add Component <span class="badge">+</span></button>
						
						<br>
						@include('newComponent')
						<br>
										
						<table id="componenttable" class="table table-condensed table-hover">
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
							</thead>
							
							<tbody id="component-table">
								@foreach($components as $component)
									<tr id="component{{$component->id}}">
										<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->id }}</td>
										<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->regnumber }}</td>
										<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->name}}</td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';">{{ ProjectController::countTransports($component->id)}}</td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';"></td>
										<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
										<td>
											<button class="btn btn-success btn-edit-component" data-id="{{ $component->id }}">Edit</button>
											<button class="btn btn-danger btn-delete-component" data-id="{{ $component->id }}">Delete</button>
										</td>
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
		//---------add Component---------
		$('#addComponent').on('click',function(){
		$('#frmComponent-submit').val('Save');
		$('#frmComponent').trigger('reset');
		
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
				$('#componentregnumber').focus();
				$('#component').modal('toggle');
			}
		});
	})
	});
	
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
        	var $table = $('#componenttable');
        	var $column = [6, 7];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection