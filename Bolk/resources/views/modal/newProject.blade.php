  <!-- Modal -->
  <div class="modal fade" id="project" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Project Information</h4>
        </div>
        @permission(('create-project'))
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newProject" method="post" id="frmProject">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="regnumber" id="regnumber" placeholder="Registration Number" class="form-control">
				</div>
				</div>

				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="name" id="name" placeholder="Project Name" class="form-control">
				</div>
				</div>

				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="location" id="location" placeholder="Location" class="form-control">
				</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='startdatepicker'>
							<input type='text' class="form-control" name="startdate" id="startdate" placeholder="Start Date" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
						<div class='input-group date' id='enddatepicker'>
							<input type='text' class="form-control" name="enddate" id="enddate" placeholder="End Date" class="form-control"/>
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
					<textarea rows="4" cols="50" name="remarks" id="remarks" placeholder="Remarks" class="form-control"></textarea>
				</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
			<input type="hidden" name="frmProject-dismiss" id="frmProject-dismiss" value="">
		  </form>
        </div>
        @endpermission
        @if(!Entrust::can('create-project'))
        <div class="modal-body">
          <div class="alert alert-danger">
            You are not allowed to do this
          </div>
        </div>
        @endif
        <div class="modal-footer">
			<input type="submit" name="frmProject-submit" value="Save" id="frmProject-submit" class="btn btn-primary" onclick="validator()">
			<button type="button" class="btn btn-warning" id="frmProject-clear">Clear</button>
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
