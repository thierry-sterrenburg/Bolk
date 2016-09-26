  <!-- Modal -->
  <div class="modal fade" id="project" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Project</h4>
        </div>
        <div class="modal-body">
		
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
				<div class='col-md-5'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker6'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class='col-md-5'>
					<div class="form-group">
						<div class='input-group date' id='datetimepicker7'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="startdate" id="startdate" placeholder="Start Date" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="enddate" id="enddate" placeholder="End Date" class="form-control">
				</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="form-group">
					<input type="text" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmProject-submit" value="Save" id="frmProject-submit" class="btn btn-primary" data-dismiss="modal">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>