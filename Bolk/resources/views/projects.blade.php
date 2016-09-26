@extends('layouts.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">Projects</h1>
						
						<!--panel content -->						
						<ul class="nav nav-pills" role="tablist">
							<li role="presentation" class="active"><a href="#">Add Project <span class="badge">+</span></a></li>
						</ul>
						
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project</button>
						
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
				<td>number of transports</td>
				<td>start date</td>
				<td>end date</td>
				<td>remarks</td>
			</thead>
			<tbody>
				@foreach($projects as $project)
				<tr id="project{{$project->id}}" onclick="document.location= '/project/id={{$project->id}}';">
					<td>{{ $project->id }}</td>
					<td>{{ $project->regnumber }}</td>
					<td>{{ $project->name }}</td>
					<td>{{ $project->location }}</td>
					<td>{{ $project->startdate }}</td>
					<td>{{ $project->enddate }}</td>
					<td>{{ $project->remarks }}</td>
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
		$('#frmProject-submit').val('save');
		$('frmProject').trigger('reset');
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
		if(state=='update'){
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
				if(state=='save'){
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
				$('#frmProject-submit').val('update');
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
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
	
  </script>
        <!-- /#page-wrapper -->
@endsection