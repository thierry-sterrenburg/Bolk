  <!-- Modal -->
  <div class="modal fade" id="addExistingComponent" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Component</h4>
        </div>
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/addComponentToWindmill" method="put" id="frmAddComponent">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				
				<div class="form-group">
					<label for="status">Component</label>
					<select class="form-control" id="componentid" name="componentid">
					@foreach($allComponentsWithoutWindmill as $componentselect)
						<option value="{{$componentselect->id}}">{{$componentselect->name}}, {{$componentselect->regnumber}}</option>
					@endforeach
					</select>
				</div>
				
				
				</div>
			</div>
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="windmillid" id="id" value="{{$windmill->id}}">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmAddComponent-submit" value="Save" id="frmAddComponent-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>