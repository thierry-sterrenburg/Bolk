  <?php 
	use App\Http\Controllers\ProjectController;
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
			
			<div class="row">
				<div class="col-lg-6 col-sm-6">
				<label class="form-check-label">Switchable with</label>
				@foreach($windmills as $windmill)
				<div class="form-check">
					<label for="componentswitchable" class="form-check-label">
					@if(ProjectController::checkSwitchable($componentid,$windmill->id))
						<input type="checkbox" class="form-check-input" id="componentswitchable" name="windmill{{$windmill->id}}" checked>
					@else	
					<input type="checkbox" class="form-check-input" id="componentswitchable" name="windmill{{$windmill->id}}">
					@endif
					{{$windmill->name}}
					</label>
				</div>
				@endforeach
				</div>
				
				<div class="col-lg-6 col-sm-6">
					<div class="form-group">
					<label for="status">Attached to</label>
					<select class="form-control" id="componentinwindmill">
					<option>unknown</option>
					<option>storage</option>
					<option>transport</option>
					<option>delivered</option>
					<option>installed</option>
					</select>
				</div>
					
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<input type="text" name="componentremarks" id="componentremarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
			<input type="hidden" name="projectid" value="{{ $project->id }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="componentid" id="componentid" value="">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmComponent-submit" value="Save" id="frmComponent-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>