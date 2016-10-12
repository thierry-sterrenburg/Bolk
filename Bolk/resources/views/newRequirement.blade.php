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
					<input type="text" name="requirementplanner" id="requirementplanner" placeholder="Planner" class="form-control">
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
					<input type="text" name="requirementremarks" id="requirementremarks" placeholder="Remarks" class="form-control">
				</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
			<input type="hidden" name="transportid" id="id" value="{{$transport->id}}">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmRequirement-submit" value="Save" id="frmRequirement-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>