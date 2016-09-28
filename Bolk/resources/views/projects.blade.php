
<?php
	use App\Http\Controllers\ProjectsController;
?>
@extends('layouts.master');
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">Projects</h1>
						
						<!--panel content -->												
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project <span class="badge">+</span></button>
						
						<br>
						
						  <div class="panel-body">
	@include('newProject')
	<table class="table table-hover">
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
						<button class="btn btn-success btn-edit" data-id="{{ $project->id }}">Edit</button>
						<button class="btn btn-danger btn-delete" data-id="{{ $project->id }}">Delete</button>
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
	

	
	$('#add').on('click',function(){
		$('#frmProject-submit').val('Save');
		$('#frmProject').trigger('reset');
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
				var row='<tr id="project'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.location +'</td>'+
				'<td>'+ data.startdate +'</td>'+
				'<td>'+ data.enddate +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit" data-id="'+ data.id +'">Edit</button> '+
				'<button class="btn btn-danger btn-delete" data-id="'+ data.id +'">Delete</button></td>'+
				'</tr>';
				if(state=='Save'){
					$('tbody').append(row);
				}else{
					$('#project'+data.id).replaceWith(row);
				}
				$('#frmProject').trigger('reset');
				$('#regnumber').focus();
			}
		});
	})
	});
	
	//---------addrow---------
	function addRow(data){
		var row='<tr id="project'+data.id+'">'+
				'<td>'+ data.id +'</td>'+
				'<td>'+ data.regnumber +'</td>'+
				'<td>'+ data.name +'</td>'+
				'<td>'+ data.location +'</td>'+
				'<td>'+ data.startdate +'</td>'+
				'<td>'+ data.enddate +'</td>'+
				'<td>'+ data.remarks +'</td>'+
				'<td><button class="btn btn-success btn-edit">Edit</button>'+
				'<button class="btn btn-danger btn-delete">Delete</button></td>'+
				'</tr>';
		$('tbody').append(row);
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
	
	function validator() {
    var x,y,text;

    // Get the value of the input field with id="regnumber"
    x = document.getElementById("regnumber").value;
	y = document.getElementById("name").value;

    // If x is Not a Number or less than one or greater than 10
    if (x == "") {
        text = "Regnumber must be filled in.";
    } 
	if (y == ""){
		if(text!=null){
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
@endsection