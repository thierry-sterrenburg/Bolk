<?php 
	use App\Http\Controllers\ProjectController;
?>
  <!-- Modal -->
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
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="transportnumber" id="transportnumber" placeholder="Transport Number" class="form-control">
				</div>
				</div>
				
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
	
				</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='loadingdatepicker'>
							<input type='text' class="form-control" name="loadingdate" id="loadingdate" placeholder="Date of Loading" class="form-control"/>
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='desireddatepicker'>
							<input type='text' class="form-control" name="datedesired" id="datedesired" placeholder="Desired arrival" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='estimateddatepicker'>
							<input type='text' class="form-control" name="dateestimated" id="dateestimated" placeholder="Estimated arrival" class="form-control"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='planneddatepicker'>
							<input type='text' class="form-control" name="dateplanned" id="dateplanned" placeholder="Planned arrival" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='actualdatepicker'>
							<input type='text' class="form-control" name="dateactual" id="dateactual" placeholder="Actual arrival" class="form-control"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4">
					<div class="form-group">
						<div class='input-group date' id='unloadingdatepicker'>
							<input type='text' class="form-control" name="unloadingdate" id="unloadingdate" placeholder="Date of Unloading" class="form-control"/>
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<textarea rows="4" cols="50" type="text" name="transportremarks" id="transportremarks" placeholder="Remarks" class="form-control"></textarea>
				</div>
				</div>
			</div>
			<input type="hidden" name="id" id="id" value="">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			@if(isset($component))
				<input type="hidden" name="componentid" id="componentid" value="{{$component->id}}">
			@endif
			@if(isset($project))
			<input type="hidden" name="projectid" value="{{ $project->id }}">
			@else <input type="hidden" name="projectid" value="unknown">
			@endif
			<input type="hidden" name="frmTransport-dismiss" id="frmTransport-dismiss" value="">
			
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmTransport-submit" value="Save" id="frmTransport-submit" class="btn btn-primary" onclick="validator()">
			<button type="button" class="btn btn-warning" id="frmTransport-clear">Clear</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <script type="text/javascript">
	function validator() {
    var x,y,z,text;
	text="";

    // Get the value of the input field with id="regnumber"
    x = document.getElementById("transportnumber").value;
	y = document.getElementById("transportcompany").value;
	z=  document.getElementById("datedesired").value;

    // If x is Not a Number or less than one or greater than 10
    if (x == "") {
        text = "Transport number must be filled in.";
    }
	if (y == ""){
		if(text!=""){
			text = text+"<br/>";
		}
        text = text+"Transport company must be filled in.";
    }
	if (z == ""){
		if(text!=""){
			text = text+"<br/>";
		}
        text = text+"Desired date must be filled in.";
    }
	
	if(x == "" || y == "" || z == ""){
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}
}
  </script>