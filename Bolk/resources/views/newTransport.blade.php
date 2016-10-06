<<<<<<< HEAD
  <?php 
	use App\Http\Controllers\ProjectController;
?>
  <!--Modal -->
=======
<?php
	
  ?>
  
  <!-- Modal -->
>>>>>>> origin/master
  <div class="modal fade" id="transport" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transport Information</h4>
        </div>
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newTransport" method="post" id="frmTransport">
			<div class="row">
<<<<<<< HEAD
				<div class="col-lg-6 col-sm-6">
=======
				<div class="col-lg-4 col-sm-4">
>>>>>>> origin/master
				<div class="form-group">
					<input type="text" name="transportnumber" id="transportnumber" placeholder="Transport Number" class="form-control">
				</div>
				</div>
				
<<<<<<< HEAD
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transportcompany" id="transportcompany" placeholder="Transport Company" class="form-control">
				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transporttruck" id="transporttruck" placeholder="Truck" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transporttrailer" id="transporttrailer" placeholder="Trailer" class="form-control">
				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<input type="text" name="transportconfiguration" id="transportconfiguration" placeholder="Configuration" class="form-control">
				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transportfrom" id="transportfrom" placeholder="From" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transportto" id="transportto" placeholder="To" class="form-control">
=======
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="company" id="company" placeholder="Company Name" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="truck" id="truck" placeholder="Truck" class="form-control">
				</div>
				</div>
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="trailer" id="trailer" placeholder="Trailer" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="configuration" id="configuration" placeholder="Configuration" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="from" id="from" placeholder="Origin" class="form-control">
				</div>
				</div>
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="to" id="to" placeholder="Destination" class="form-control">
>>>>>>> origin/master
				</div>
				</div>
			</div>
			
<<<<<<< HEAD
				<div class="row">
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='loadingdatepicker'>
							<input type='text' class="form-control" name="loadingdate" id="loadingdate" placeholder="Date of Loading" class="form-control"/>
=======
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='startdatepicker'>
							<input type='text' class="form-control" name="dateofloading" id="dateofloading" placeholder="Date of loading" />
>>>>>>> origin/master
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
<<<<<<< HEAD
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='initialdatepicker'>
							<input type='text' class="form-control" name="initialdatearrival" id="initialdatearrival" placeholder="Initial Date of Arrival" />
=======
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='enddatepicker'>
							<input type='text' class="form-control" name="dateofarrivalinitial" id="dateofarrivalinitial" placeholder="Date of arrival initial" class="form-control"/>
>>>>>>> origin/master
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
<<<<<<< HEAD
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='finaldatepicker'>
							<input type='text' class="form-control" name="finaldatearrival" id="finaldatearrival" placeholder="Final Date of Arrival" class="form-control"/>
=======
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='enddatepicker'>
							<input type='text' class="form-control" name="dateofarrivalfinal" id="dateofarrivalfinal" placeholder="Date of arrival final" class="form-control"/>
>>>>>>> origin/master
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
<<<<<<< HEAD
=======
				<div class="col-lg-4 col-sm-6">
					<div class="form-group">
						<select class="form-control">
							@foreach($components as $component)
								<option>{{$component->name}}:{{$component->regnumber}}</option>
							@endforeach
						</select>
					</div>
				</div>
>>>>>>> origin/master
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
<<<<<<< HEAD
					<input type="text" name="transportremarks" id="transportremarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
			<input type="hidden" name="projectid" value="{{ $project->id }}">
=======
					<input type="text" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
>>>>>>> origin/master
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
		  </form>
        </div>
        <div class="modal-footer">
<<<<<<< HEAD
			<input type="submit" name="frmTransport-submit" value="Save" id="frmTransport-submit" class="btn btn-primary">
=======
			<input type="submit" name="frmTransport-submit" value="Save" id="frmTransport-submit" class="btn btn-primary" onclick="validator()">
>>>>>>> origin/master
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>