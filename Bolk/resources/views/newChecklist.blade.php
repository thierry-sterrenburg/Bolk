  <!-- Modal -->
  <div class="modal fade" id="checklist" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Checklist</h4>
        </div>
        <div class="modal-body">
			<div id="error_message"></div>
          <form action="/newChecklist" method="post" id="frmChecklist">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					CMR
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr" value="yes">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr" value="no">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr" value="notapplicable" checked>Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Register Address of Loading
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistaddressloading">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistaddressloading">No</label>
					<label class="radio-inline"><input type="radio" name="checklistaddressloading">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Permit Empty Truck(EN)
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Permit Loaded Truck(EN)
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Nachtrag, Par 70
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Trailer papers/SERT
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Route Report
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					VLM
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Escort
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Registered by the Police
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Ferry Booked
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Register Address of Arrival
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Remarks 1
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-sm-12">
				<div class="form-group">
					<div class="col-lg-5 col-sm-5">
					Remarks 2
					</div>
					<div class="col-lg-7 col-sm-7">
					<label class="radio-inline"><input type="radio" name="checklistcmr">Yes</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">No</label>
					<label class="radio-inline"><input type="radio" name="checklistcmr">Not Applicable</label></div>
					</div>
				</div>
			</div>
			
			
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" id="id" value="">
			<input type="hidden" name="transportid" id="id" value="{{$transport->id}}">
		  </form>
        </div>
        <div class="modal-footer">
			<input type="submit" name="frmChecklist-submit" value="Save" id="frmChecklist-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>