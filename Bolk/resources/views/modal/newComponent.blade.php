  <?php
	use App\Http\Controllers\ProjectController;
	use App\Project;
	use App\Component;
	use App\Switchable;
	$componentid = Cookie::get('componentid');
?>
  <!--Modal -->
  <div class="modal fade" id="component" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Component Information</h4>
        </div>
        @permission(('create-component'))
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newComponent" method="post" id="frmComponent">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="componentregnumber" id="componentregnumber" placeholder="Registration Number" class="form-control">
				</div>
				</div>

				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="componentname" id="componentname" placeholder="Component Name" class="form-control">
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<label for="componentlength" class="col-form-label">Length</label>
				</div>
				<div class="col-lg-6 col-sm-6">
					<label for="componentwidth" class="col-form-label">Width</label>
				</div>

				<div class="form-group">
				<div class="col-lg-6 col-sm-6">
					<div class="input-group">
					<input type="text" name="componentlength" id="componentlength" placeholder="Length" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>

				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="componentwidth" id="componentwidth" placeholder="Width" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<label for="componentheight" class="col-form-label">Height</label>
				</div>
				<div class="col-lg-6 col-sm-6">
					<label for="componentweight" class="col-form-label">Weight</label>
				</div>
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="componentheight" id="componentheight" placeholder="Height" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>

				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="componentweight" id="componentweight" placeholder="Weight" class="form-control">
					<div class="input-group-addon">kg</div>
					</div>
				</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
				 <label for="componentstatus">Status</label>
					<select class="form-control" id="componentstatus" name="componentstatus">
					<option value="unknown">unknown</option>
					<option value="storage">storage</option>
					<option value="transport">transport</option>
					<option value="delivered">delivered</option>
					<option value="installed">installed</option>
					</select>
				</div>
				</div>
			</div>
				@if(isset($windmills))
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<label class="form-check-label">Switchable with</label>

				@foreach($windmills as $eachwindmill)
				<div class="form-check">
					<label for="componentswitchable" class="form-check-label">
					@if(isset($windmill))
						@if(ProjectController::checkSwitchable($componentid,$eachwindmill->id) || $eachwindmill == $windmill)
							@if($eachwindmill == $windmill)
							<input type="checkbox" class="form-check-input" id="windmill{{$eachwindmill->id}}" name="windmill{{$eachwindmill->id}}" disabled checked>
							@else	
							<input type="checkbox" class="form-check-input" id="windmill{{$eachwindmill->id}}" name="windmill{{$eachwindmill->id}}" checked>
							@endif
						@else
						<input type="checkbox" class="form-check-input" id="windmill{{$eachwindmill->id}}" name="windmill{{$eachwindmill->id}}">
						@endif
					@else
						@if(ProjectController::checkSwitchable($componentid,$eachwindmill->id))
						<input type="checkbox" class="form-check-input" id="windmill{{$eachwindmill->id}}" name="windmill{{$eachwindmill->id}}" checked>
						@else
						<input type="checkbox" class="form-check-input" id="windmill{{$eachwindmill->id}}" name="windmill{{$eachwindmill->id}}">
						@endif
					@endif
					{{$eachwindmill->name}}
					</label>
				</div>
				@endforeach

				</div>

				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
					<label for="status">Attached to</label>
					<select class="form-control" id="componentinwindmill" name="componentinwindmill">
					@if(isset($windmill))
					<option value="{{$windmill->id}}">{{$windmill->name}}</option>
					@endif
					<option value="none">none</option>
					@foreach($windmills as $eachwindmill)
						@if(isset($windmill))
							@if(($windmill->id != $eachwindmill->id) && (ProjectController::checkSwitchable($componentid,$eachwindmill->id)))
								<option value="{{$eachwindmill->id}}">{{$eachwindmill->name}}</option>
							@endif
						@else
							@if((ProjectController::checkSwitchable($componentid,$eachwindmill->id)))
							<option value="{{$eachwindmill->id}}">{{$eachwindmill->name}}</option>
							@endif
						@endif
					@endforeach
					</select>
				</div>

				</div>
			</div>
			@endif
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<textarea rows="4" cols="50" type="text" name="componentremarks" id="componentremarks" placeholder="Remarks" class="form-control"></textarea>
				</div>
				</div>
			</div>

			@if(isset($project))
			<input type="hidden" name="projectid" value="{{ $project->id }}">
			@else <input type="hidden" name="projectid" value="unknown">
			@endif
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="componentid" id="componentid" value="">
			<input type="hidden" name="frmComponent-dismiss" id="frmComponent-dismiss" value="">
		  </form>
        </div>
        @endpermission
        <?php
        if (!Entrust::can('create-component')){
          ?>
        <div class="modal-body">
          <div class="alert alert-danger">
            You are not allowed to do this
          </div>
        </div>
        <?php
      }
         ?>
        <div class="modal-footer">
			<input type="submit" name="frmComponent-submit" value="Save" id="frmComponent-submit" class="btn btn-primary" onclick="validator()">
			<button type="button" class="btn btn-warning" id="frmComponent-clear">Clear</button>
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
    x = document.getElementById("componentregnumber").value;
	y = document.getElementById("componentname").value;

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
		$('#windmill').modal('toggle');
	}else{
		document.getElementById("error_message").innerHTML = '<div class="alert alert-danger">'+text+'</div>';
	}
}
  </script>