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
		
          <form action="newProject" method="post" id="frmProject">
			<div class="row">
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="registrationNumber" id="registrationNumber" placeholder="Registration Number" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-4 col-sm-4">
				<div class="form-group">
					<input type="text" name="projectName" id="projectName" placeholder="Project Name" class="form-control">
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
					<input type="text" name="startDate" id="startDate" placeholder="Start Date" class="form-control">
				</div>
				</div>
				
				<div class="col-lg-6 col-sm-6">
				<div class="form-group">
					<input type="text" name="endDate" id="endDate" placeholder="End Date" class="form-control">
				</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="form-group">
					<input type="text" name="remarks" id="remarks" placeholder="Remarks" class="form-control">
				</div>
			</div>
			
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" value="Save" id="save" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>