  <!-- Modal -->
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
					<input type="text" name="regnumber" id="regnumber" placeholder="Registration Number" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="name" id="name" placeholder="Component Name" class="form-control">
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<label for="length" class="col-form-label">Length</label>
				</div>
				<div class="col-lg-6 col-sm-6">
					<label for="width" class="col-form-label">Width</label>
				</div>
				
				<div class="form-group">
				<div class="col-lg-6 col-sm-6">
					<div class="input-group">
					<input type="text" name="length" id="length" placeholder="Length" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>
	
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="width" id="width" placeholder="Width" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<label for="height" class="col-form-label">Height</label>
				</div>
				<div class="col-lg-6 col-sm-6">
					<label for="Weight" class="col-form-label">Weight</label>
				</div>
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="height" id="height" placeholder="Height" class="form-control">
					<div class="input-group-addon">m</div>
					</div>
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<div class="input-group">
					<input type="text" name="weight" id="weight" placeholder="Weight" class="form-control">
					<div class="input-group-addon">kg</div>
					</div>
				</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
				 <label for="exampleSelect2">Status</label>
					<select class="form-control" id="status">
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
				<label class="form-check-label">Switchable with</label>
				@foreach($windmills as $windmill)
				<div class="form-check">
					<label for="switchable" class="form-check-label">
					<input type="checkbox" class="form-check-input" id="switchable" name="switchable" value="{{$windmill->id}}">
					{{$windmill->name}}
					</label>
				</div>
				@endforeach
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<input type="text" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
			<input type="hidden" name="projectid" value="{{ $project->id }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmComponent-submit" value="Save" id="frmComponent-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>