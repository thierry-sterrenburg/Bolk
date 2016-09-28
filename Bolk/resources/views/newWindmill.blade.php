  <!-- Modal -->
  <div class="modal fade" id="windmill" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Windmill Information</h4>
        </div>
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newWindmill" method="post" id="frmWindmill">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="regnumber" id="regnumber" placeholder="Registration Number" class="form-control" required/>
				</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="name" id="name" placeholder="Windmill Name" class="form-control" required/>
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
					<input type="text" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmWindmill-submit" value="Save" id="frmWindmill-submit" class="btn btn-primary" onclick="validator()">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>