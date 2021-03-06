
<?php
	use App\Http\Controllers\ProjectsController;
?>
@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						
                        <h1 class="page-header">
							{{$title}}
						</h1>

						<!--panel content -->
						@if($title == 'Projects')
						@permission(('create-project'))
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project <span class="badge">+</span></button>
						@endpermission

						<br>
						@endif
						  <div class="panel-body">
	@include('modal.newProject')
	<table id="projectdatatable" class="table table-condensed table-hover" style="width:100%">
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
		<caption>Projects</caption>
			<thead>
				<td>#</td>
				<td>registration number</td>
				<td>name</td>
				<td>location</td>
				<td>number of windmills</td>
				<td>number of components</td>
				<td>number of transports</td>
				<td>start date</td>
				<td>end date</td>
				<td>remarks</td>
				<td>Last update</td>
				<td></td>
			</thead>
			<tbody>
				@foreach($projects as $project)
				@if(Auth::user()->projectid == $project->id)
				<tr id="project{{$project->id}}">
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->id }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->regnumber }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->name }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->location }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countWindmills($project->id) }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countComponents($project->id) }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countTransports($project->id) }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->startdate }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->enddate }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';" style="white-space:pre-wrap ; word-wrap:break-word;">{{ $project->remarks }}</td>
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->updated_at }}</td>
					<td>
						@if($project->archived == false)
						@permission(('edit-project'))
						<button class="btn btn-success btn-edit" data-id="{{ $project->id }}"><i class="fa fa-pencil"></i></button>
						@endpermission
						@permission(('create-project'))
						<button class="btn btn-warning btn-clone-project" data-id="{{ $project->id }}"><i class="fa fa-clipboard"></i></button>
						@endpermission
						@permission(('create-project'))
						<button class="btn btn-primary btn-archive-project" data-id="{{ $project->id }}"><i class="fa fa-archive"></i></button>
						@endpermission
						@permission(('delete-project'))
						<button class="btn btn-danger btn-delete" data-id="{{ $project->id }}"><i class="fa fa-trash-o"></i></button>
						@endpermission
						@else
								@permission(('create-project'))
								<button class="btn btn-success btn-dearchive-project" data-id="{{ $project->id }}"><i class="fa fa-archive"></i></button>
								@endpermission
						@endif
					</td>
				</tr>
				@elseif(Auth::user()->projectid == '' || Auth::user()->projectid == '0')
					<tr id="project{{$project->id}}">
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->id }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->regnumber }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->name }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->location }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countWindmills($project->id) }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countComponents($project->id) }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ ProjectsController::countTransports($project->id) }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->startdate }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->enddate }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';" style="white-space:pre-wrap ; word-wrap:break-word;">{{ $project->remarks }}</td>
						<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->updated_at }}</td>
						<td>
							@if($project->archived == false)
							@permission(('edit-project'))
							<button class="btn btn-success btn-edit" data-id="{{ $project->id }}"><i class="fa fa-pencil"></i></button>
							@endpermission
							@permission(('create-project'))
							<button class="btn btn-warning btn-clone-project" data-id="{{ $project->id }}"><i class="fa fa-clipboard"></i></button>
							@endpermission
							@permission(('create-project'))
								<button class="btn btn-primary btn-archive-project" data-id="{{ $project->id }}"><i class="fa fa-archive"></i></button>
							@endpermission
							@permission(('delete-project'))
							<button class="btn btn-danger btn-delete" data-id="{{ $project->id }}"><i class="fa fa-trash-o"></i></button>
							@endpermission
							@else
								@permission(('create-project'))
								<button class="btn btn-success btn-dearchive-project" data-id="{{ $project->id }}"><i class="fa fa-archive"></i></button>
								@endpermission
							@endif
						</td>
					</tr>
				@endif
				@endforeach
			</tbody>
	</table>
  </div>

                    </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
		 <script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	$('#frmProject-clear').on('click',function(){
		$('#frmProject').trigger('reset');
	})
	
	$('#add').on('click',function(){
		$('#frmProject-submit').val('Save');
		if($('#frmProject-dismiss').val() == 'reset'){
			$('#frmProject').trigger('reset');
		}
		$('#frmProject-dismiss').val('');
		document.getElementById("error_message").innerHTML = '';
		$('#project').modal('show');
	})

	$(function() {
	$('#frmProject-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmProject');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmProject-submit').val();
		var type= 'post';
		if(state=='Update'){
			type = 'put';
		}
		$.ajax({
			type : type,
			url : url,
			data: formData,
			success:function(data){
				
				$('#frmProject').trigger('reset');
				$('#regnumber').focus();
				location.reload();
			}
		});
	})
	});

	//---------addrow---------
	function addRow(data){
		var row='<tr id="project'+data.id+'">'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.id +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.regnumber +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.name +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.location +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">0</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">0</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">0</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.startdate +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.enddate +'</td>'+
				'<td onclick="document.location= \'/project/id='+data.id+'\';">'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('tbody').append(row);
				}else{
					$('#project'+data.id).replaceWith(row);
				}
	}

	//---------get update---------

	$('tbody').delegate('.btn-edit','click',function(){
		document.getElementById("error_message").innerHTML = '';
		var value=$(this).data('id');
		var url='{{URL::to('getUpdate')}}';
		$.ajax({
			type: 'get',
			url : url,
			data: {'id':value},
			success:function(data){
				$('#id').val(data.id);
				$('#regnumber').val(data.regnumber);
				$('#name').val(data.name);
				$('#location').val(data.location);
				$('#startdate').val(moment(data.startdate).format("DD-MM-YYYY"));
				$('#remarks').val(data.remarks);
				$('#enddate').val(moment(data.enddate).format("DD-MM-YYYY"));
				$('#frmProject-dismiss').val('reset');
				$('#frmProject-submit').val('Update');
				$('#project').modal('show');
			}
		});
	});
	
		//---------get update for duplicate project--------
	$('tbody').delegate('.btn-clone-project','click',function(){
		document.getElementById("error_message").innerHTML = '';
		var value=$(this).data('id');
		var url='{{URL::to('getUpdate')}}';
		$.ajax({
			type: 'get',
			url : url,
			data: {'id':value},
			success:function(data){
				$('#id').val(data.id);
				$('#regnumber').val(data.regnumber);
				$('#name').val(data.name);
				$('#location').val(data.location);
				$('#startdate').val(moment(data.startdate).format("DD-MM-YYYY"));
				$('#remarks').val(data.remarks);
				$('#enddate').val(moment(data.enddate).format("DD-MM-YYYY"));
				$('#frmProject-dismiss').val('reset');
				$('#frmProject-submit').val('Duplicate');
				$('#project').modal('show');
			}
		});
	});

	//---------delete project---------
	$('tbody').delegate('.btn-delete', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteProject')}}';
		if (confirm('Are you sure to delete?')==true){
			$.ajax({
				type : 'delete',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#project'+value).remove();
				}
			});
		}
	});
	
	//---------archive project---------
	$('tbody').delegate('.btn-archive-project', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('archiveProject')}}';
		if (confirm('Are you sure to archive this project?')==true){
			$.ajax({
				type : 'put',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#project'+value).remove();
				}
			});
		}
	});
	
		//---------dearchive project---------
	$('tbody').delegate('.btn-dearchive-project', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('dearchiveProject')}}';
		if (confirm('Are you sure to activate this project?')==true){
			$.ajax({
				type : 'put',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#project'+value).remove();
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
        <!-- /#page-wrapper -->
        <!-- Datatable script-->
        @include('partials.scriptimport')
	    <!-- own javascript code-->
        <script type="text/javascript">
        	var $table = $('#projectdatatable');
        	var $column = [7, 8];
        </script>

        <script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}">
@endsection
