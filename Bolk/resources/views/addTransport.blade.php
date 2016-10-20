<?php
  use App\Http\Controllers\ComponentController;
?>
<!-- Modal -->
  <div class="modal fade" id="addTransportModal" role="dialog">
    <div class="modal-dialog">  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Transport</h4>
        </div>
        <div class="modal-body">
          <div id="error_message"></div>
          <form action="/addTransportToComponent" method="post" id="frmAddTransport">
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="form-group">
                  <label for="status">Transport</label>
                  <select class="form-control" id="transportid" name="transportid">
                    @foreach($allTransports as $transportselect)
						@if(ComponentController::checkOnTransport($component->id,$transportselect->id))
						@if(($transportselect->from != null ||$transportselect->from != "") && ($transportselect->to != null ||$transportselect->to != ""))
							<option value="{{$transportselect->id}}">Transport: {{$transportselect->transportnumber}}, {{$transportselect->from}} -> {{$transportselect->to}} </option>
						@else
							<option value="{{$transportselect->id}}">Transport: {{$transportselect->transportnumber}}</option>
						@endif
						@endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="componentid" id="id" value="{{$component->id}}">
          </form>
        </div>
        <div class="modal-footer">
          <input type="submit" name="frmAddTransport-submit" value="Save" id="frmAddTransport-submit" class="btn btn-primary">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>