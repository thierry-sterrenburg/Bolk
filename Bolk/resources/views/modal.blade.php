<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bolk</title>
  <meta charset="utf-8">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Projects</h2>
  <!-- Trigger the modal with a button -->
  @permission(('create-project'))
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="add" value="add">Add Project</button>
  @endpermission



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
				<tr class="success" onclick="document.location = 'project.html';">
					<td>1</td>
					<td>189207</td>
					<td>Project GE Auchrobert</td>
					<td>Auchrobert</td>
					<td>6</td>
					<td>60</td>
					<td>24-08-2016</td>
					<td>30-08-2016</td>
					<td>blabla</td>
				</tr>

				@foreach($projects as $project)
				<tr id="project{{$project->id}}">
					<td>{{ $project->id }}</td>
					<td>{{ $project->regnumber }}</td>
					<td>{{ $project->name }}</td>
					<td>{{ $project->location }}</td>
					<td>{{ $project->startdate }}</td>
					<td>{{ $project->enddate }}</td>
					<td>{{ $project->remarks }}</td>
					<td>
            @permission(('edit-project'))
						<button class="btn btn-success btn-edit" data-id="{{ $project->id }}">Edit</button>
            @endpermission
            @permission(('delete-project'))
						<button class="btn btn-danger btn-delete" data-id="{{ $project->id }}">Delete</button>
            @endpermission
					</td>
				</tr>
				@endforeach
			</tbody>
	</table>
  </div>

  <script type="text/javascript">
	$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
	})



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
				data : {'id':value},
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
</div>

</body>
</html>
