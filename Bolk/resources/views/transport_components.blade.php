<?php
	use App\Http\Controllers\Transport_componentsController;
?>
@extends('layouts.master')
@section('content')
	<!--Page Content-->
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
			<!--panel-content-->
			<div class="row">
				@include('layouts.projectpanel')
				@include('layouts.transportpanel')
			</div>
			<!--add buttons-->
			<div class="row">
				@permission(('create-component'))
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ComponentModal" id="addComponenttoTransport" value="add">Add Component to Transport<span class="badge">+</span></button>
				@endpermission
			</div>
				@include(('addComponenttoTransport'))
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
						<td>From</td>
						<td>To</td>
						<td>Number of transport phases</td>
						<td>Date of loading</td>
						<td>Date of Arrival</td>
						<td>Offloading(initial)</td>
						<td>Offloading(final)</td>
						<td>Last update</td>
						<td>Remarks</td>
						<td></td>
					</thead>
					<tbody id="component-table">
						@foreach($components as $component)
							<tr id="component{{$component->id}}">
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->id }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->regnumber }}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->name}}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ Transport_componentsController::countTransports($component->id)}}</td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';"></td>
								<td onclick="document.location= '/component/id={{$component->id}}';">{{ $component->remarks }}</td>
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
	</div>
		<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

	//---------add Component---------
	$('#addComponenttoTransport').on('click',function(){
		$('#frmAddComponent-submit').val('Save');
		$('#frmAddComponent').trigger('reset');

		$('#addComponent').modal('show');
	})

	//---------form Component---------
	$(function() {
	$('#frmAddComponent-submit').on('click', function(e){
		e.preventDefault();
		var form=$('#frmAddComponent');
		var formData=form.serialize();
		var url=form.attr('action');
		var state=$('#frmAddComponent-submit').val();
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
				'<td><button class="btn btn-success btn-edit-component" data-id="'+ data.id +'"><i class="fa fa-pencil"></i></button> '+
				'<button class="btn btn-danger btn-delete" data-id-component="'+ data.id +'"><i class="fa fa-trash-o"></i></button></td>'+
				'</tr>';
				if(state=='Save'){
					$('#component-table').append(row);
				}else{
					$('#component'+data.id).replaceWith(row);
				}
				$('#frmAddComponent').trigger('reset');
				$('#componentregnumber').focus();
				$('#addComponent').modal('toggle');
			}
		});
	})
	});

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
		var url = '{{URL::to('deleteComponentfromTransport')}}';
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
		$('#windmill').modal('toggle');
	}else{
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}
}

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