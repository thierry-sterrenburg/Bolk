
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

                        <h1 class="page-header">Projects</h1>

						<!--panel content -->
						@permission(('create-project'))
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project <span class="badge">+</span></button>
						@endpermission

						<br>

						  <div class="panel-body">
	@include('newProject')
	<table id="projectdatatable" class="table table-condensed table-hover">
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
				<td></td>
			</thead>
			<tbody>
				@foreach($projects as $project)
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
					<td onclick="document.location= '/project/id={{$project->id}}';">{{ $project->remarks }}</td>
					<td>
						@permission(('edit-project'))
						<button class="btn btn-success btn-edit" data-id="{{ $project->id }}"><i class="fa fa-pencil"></i></button>
						@endpermission
						@permission(('delete-project'))
						<button class="btn btn-danger btn-delete" data-id="{{ $project->id }}"><i class="fa fa-trash-o"></i></button>
						@endpermission
					</td>
				</tr>
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
				$('#startdate').val(data.startdate);
				$('#remarks').val(data.remarks);
				$('#enddate').val(data.enddate);
				$('#frmProject-submit').val('Update');
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

	function validator() {
    var x,y,text;
	text="";
    // Get the value of the input field with id="regnumber"
    x = document.getElementById("regnumber").value;
	y = document.getElementById("name").value;

    // If x is Not a Number or less than one or greater than 10
    if (x == "") {
        text = "Regnumber must be filled in.";
    }
	if (y == ""){
		if(text!=""){
			text = text+"<br/>";
		}
        text = text+"Name must be filled in.";
    }
	if(x != "" && y != ""){
		$('#project').modal('toggle');
		
	}else{
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}

	function resetError(){
		document.getElementById("error_message").innerHTML = '';
	}
}

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
