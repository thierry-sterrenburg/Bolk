<?php 
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
							<li><a href="projects.html">Projects</a></li>
							<li class="active">Project GE Auchrobert</li>
						</ol>
                        <h1 class="page-header">Project GE Auchrobert</h1>
						
						<!--panel content -->						
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">General Information</h3>
							</div>
							<div class="panel-body">
								Project GE A registration number:189207 latest update: 13-9-2016 13:52:07 number of windmills: 6
							</div>
						</div>
						
						<br>
						
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Windmill <span class="badge">+</span></button>
						
						<br>
						@include('newWindmill')
						<!--Windmill Table -->
						<h3>Windmills</h3>
						<table class="table table-condensed table-hover">
							<thead>
								<td>#</td>
								<td>registration number</td>
								<td>name</td>
								<td>location</td>
								<td>number of components</td>
								<td>start date</td>
								<td>end date</td>
								<td>last update</td>
								<td>remarks</td>
							</thead>
							
							<tbody>
								@foreach($windmills as $windmill)
									<tr onclick="document.location= '/windmill/id={{$windmill->id}}';">
										<td>{{ $windmill->id }}</td>
										<td>{{ $windmill->regnumber }}</td>
										<td>{{ $windmill->name }}</td>
										<td>{{ $windmill->location }}</td>
										<td>{{ ProjectController::countComponents($windmill->id)}}</td>
										<td>{{ $windmill->startdate }}</td>
										<td>{{ $windmill->enddate }}</td>
										<td></td>
										<td>{{ $windmill->remarks }}</td>
									</tr>
								@endforeach	
							</tbody>
							
						</table>
						<!-- Component Table-->
						<h3>Components</h3>
						<table class="table table-condensed table-hover">
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

							<tbody>
								@foreach($components as $component)
									<tr onclick="document.location= '/component/id={{$component->id}}';">
										<td>{{ $component->id }}</td>
										<td>{{ $component->regnumber }}</td>
										<td>{{ $component->name}}</td>
										<td></td>
										<td></td>
										<td>{{ ProjectController::countTransports($component->id) }}</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>{{ $component->remarks }}</td>
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
	
	$('#add').on('click',function(){
		$('#frmWindmill-submit').val('Save');
		$('#frmWindmill').trigger('reset');
		
		$('#windmill').modal('show');
	})	
	
	$(function() {
	$('#frmWindmill-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmWindmill');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmWindmill-submit').val();
		var type= 'post';
		if(state=='Update'){
			type = 'put';
		}
		$.ajax({
			type : type,
			url : url,
			data: formData,
			success:function(data){
				var row='<tr id="windmill'+data.id+'">'+
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
				$('#frmWindmill').trigger('reset');
				$('#regnumber').focus();
			}
		});
	})
	});
	
	//---------addrow---------
	function addRow(data){
		var row='<tr id="windmill'+data.id+'">'+
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
		var value=$(this).data('id');
		var url='{{URL::to('getUpdateWindmill')}}';
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
				$('#frmWindmill-submit').val('Update');
				$('#project').modal('show');
			}
		});
	});
	
	//---------delete project---------
	$('tbody').delegate('.btn-delete', 'click',function(){
		var value = $(this).data('id');
		var url = '{{URL::to('deleteWindmill')}}';
		if (confirm('Are you sure to delete?')==true){
			$.ajax({
				type : 'delete	',
				url : url,
				data : {"_token": "{{ csrf_token() }}" ,
					'id':value},
				success:function(data){
					$('#windmill'+value).remove();
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
}
	
  </script>
@endsection