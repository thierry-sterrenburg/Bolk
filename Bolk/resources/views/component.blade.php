<?php
	use App\Http\Controllers\ComponentController;
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
							@if(!is_null($component->mainwindmillid))
							<li><a href="/windmill/id={{$windmill->id}}">{{$windmill->name}}</a></li>
							@endif
							<li class="active">{{$component->name}}</li>
						</ol>
                        <h1 class="page-header">{{$component->name}}</h1>
						
						<!--panel content -->						
                        @include('layouts/projectpanel')
                        @if(!is_null($component->mainwindmillid))
						@include('layouts/windmillpanel')
						@endif
						@include('layouts/componentpanel')
						<!--end panels-->
						
						<br>
						
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#TransportModal" id="addTransport" value="add">Add Transportphase <span class="badge">+</span></button>
						<br>
						@include('newTransport')
						
						<br>
						
						<table id="transportphasetable" class="table table-condensed table-hover">
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
								<td>Transport Number</td>
								<td>Company</td>
								<td>Truck</td>
								<td>Trailer</td>
								<td>Configuration</td>
								<td>From</td>
								<td>To</td>
								<td>Number of Requirements</td>
								<td>Date of loading</td>
								<td>Date of Arrival(initial)</td>
								<td>Date of Arrival(final)</td>
								<td>Last update</td>
								<td>Remarks</td>
							</thead>
							
							<tbody id="transport-table">
								@foreach($transports as $transport)
									<tr id="transport{{$transport->id}}">
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->id }}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->transportnumber }}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->company}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->truck}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->trailer }}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->configuration}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->from }}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->to}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ ComponentController::countRequirements($transport->id)}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofloading}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofarrivalinitial}}</td>
										<td onclick="document.location= '/transportphase/id={{$transport->id}}';">{{ $transport->dateofarrivalfinal}}</td>
										<td>
											<button class="btn btn-success btn-edit-transport" data-id="{{ $transport->id }}">Edit</button>
											<button class="btn btn-danger btn-delete-transport" data-id="{{ $transport->id }}">Delete</button></td>
										<td>{{ $transport->remarks}}</td>
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
		<script type="text/javascript">
			$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
			//---------add Transport---------
			$('#addTransport').on('click',function(){
				$('#frmTransport-submit').val('Save');
				$('#frmTransport').trigger('reset');
		
				$('#transport').modal('show');
			})	
			
			$(function () {
				$('#loadingdatepicker').datetimepicker({
					sideBySide: true,
					format: 'YYYY-MM-DD HH:mm'});

				$('#initialdatepicker').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					sideBySide: true,
					format: 'YYYY-MM-DD HH:mm'
					});
				$('#finaldatepicker').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					sideBySide: true,
					format: 'YYYY-MM-DD HH:mm'
					});	
					
				$("#loadingdatepicker").on("dp.change", function (e) {
					$('#finaldatepicker').data("DateTimePicker").minDate(e.date);
					
				});
				$("#finaldatepicker").on("dp.change", function (e) {
				$('#loadingdatepicker').data("DateTimePicker").maxDate(e.date);
				});
			});
			
			//---------from transport---------
			$(function() {
				$('#frmTransport-submit').on('click', function(e){
				e.preventDefault();
				var form=$('#frmTransport');
				var formData=form.serialize();
				var url=form.attr('action');
				var state=$('#frmTransport-submit').val();
				var type= 'post';
				if(state=='Update'){
					type = 'put';
				}
				$.ajax({
					type : type,
					url : url,
					data: formData,
					success:function(data){
						var row='<tr id="transport'+data.id+'">'+
						'<td>'+ data.id +'</td>'+
						'<td>'+ data.transportnumber +'</td>'+
						'<td>'+ data.company +'</td>'+
						'<td>'+ data.truck +'</td>'+
						'<td>'+ data.trailer +'</td>'+
						'<td>'+ data.from +'</td>'+
						'<td>0</td>'+
						'<td>'+ data.dateofloading +'</td>'+
						'<td>'+ data.dateofarrivalinitial +'</td>'+
						'<td>'+ data.dateofarrivalfinal +'</td>'+
						'<td><button class="btn btn-success btn-edit-transport" data-id="'+ data.id +'">Edit</button> '+
						'<button class="btn btn-danger btn-delete" data-id-transport="'+ data.id +'">Delete</button></td>'+
						'</tr>';
						if(state=='Save'){
							$('#transportphasetable').append(row);
						}else{
							$('#transport'+data.id).replaceWith(row);
						}
						$('#frmTransport').trigger('reset');
						$('#transportnumber').focus();
						$('#transport').modal('toggle');
					}
				});
				})
			});
	
			//---------get update transport---------
			$('#transportphasetable').delegate('.btn-edit-transport','click',function(){
			document.getElementById("error_message").innerHTML = '';
			var value=$(this).data('id');
				var url='{{URL::to('getUpdateTransport')}}';
				$.ajax({
					type: 'get',
					url : url,
					data: {'id':value},
					success:function(data){
						$('#id').val(data.id);
						$('#transportnumber').val(data.transportnumber);
						$('#transportcompany').val(data.company);
						$('#transporttruck').val(data.truck);
						$('#transporttrailer').val(data.trailer);
						$('#transportconfiguration').val(data.configuration);
						$('#transportfrom').val(data.from);
						$('#transportto').val(data.to);
						$('#loadingdate').val(data.dateofloading);
						$('#initialdatearrival').val(data.dateofarrivalinitial);
						$('#finaldatearrival').val(data.dateofarrivalfinal);
						$('#transportremarks').val(data.transportremarks);
						$('#frmTransport-submit').val('Update');
						$('#transport').modal('show');
					}
				});
			})
			
			//---------delete transport---------
			$('#transport-table').delegate('.btn-delete-transport', 'click',function(){
				var value = $(this).data('id');
				var url = '{{URL::to('deleteTransport')}}';
				if (confirm('Are you sure to delete?'+value)==true){
					$.ajax({
						type : 'delete',
						url : url,
						data : {"_token": "{{ csrf_token() }}" ,
							'id':value},
						success:function(data){
							$('#transport'+value).remove();
						}
					});
				}
			});
		</script>
        <!-- /#page-wrapper -->
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
        <script type="text/javascript">
        	var $table = $('#transportphasetable');
        	var $column = [9, 10, 11];
		</script>
		<script type="text/javascript" src="{{asset('js/Datatables/Datatables.js')}}"></script>

@endsection