<!-- Modal -->
  <div class="modal fade" id="requirement" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Requirement Information</h4>
        </div>
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newRequirement" method="post" id="frmRequirement">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="requirementname" id="requirementname" placeholder="Name" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="requirementcountry" id="requirementcountry" placeholder="Country" class="form-control">
				</div>
				</div>
				
			</div>
			
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="requirementplanner" id="requirementplanner" placeholder="Planner" class="form-control" value="{{Auth::user()->fullname}}">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
				 <label for="requirementbooked">Booked</label>
					<select class="form-control" id="requirementbooked" name="requirementbooked">
					<option value="no">no</option>
					<option value="pending">pending</option>
					<option value="yes">yes</option>
					</select>
				</div>
				</div>
				
			</div>
			
			
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='requirementstartdatepicker'>
							<input type='text' class="form-control" name="requirementstartdate" id="requirementstartdate" placeholder="Start Date" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='requirementenddatepicker'>
							<input type='text' class="form-control" name="requirementenddate" id="requirementenddate" placeholder="End Date" class="form-control"/>
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
					<textarea rows="4" cols="50" type="text" name="requirementremarks" id="requirementremarks" placeholder="Remarks" class="form-control"></textarea>
				</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
			<input type="hidden" name="frmRequirement-dismiss" id="frmRequirement-dismiss" value="">
			<input type="hidden" name="transportid" id="id" value="{{$transport->id}}">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmRequirement-submit" value="Save" id="frmRequirement-submit" class="btn btn-primary" onclick="validator()">
			<button type="button" class="btn btn-warning" id="frmRequirement-clear">Clear</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
	function validator() {
    var x,y,text;
	text="";

    // Get the value of the input field with id="regnumber"
    x = document.getElementById("requirementname").value;
	y = document.getElementById("requirementplanner").value;

    // If x is Not a Number or less than one or greater than 10
    if (x == "") {
        text = "Name must be filled in.";
    }
	if (y == ""){
		if(text!=""){
			text = text+"<br/>";
		}
        text = text+"Planner must be filled in.";
    }
	if(x == "" || y == ""){
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}
}
  </script>