<!-- Modal -->
<div class="modal fade" id="editAlarmMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alarm Details (<span id="AlarmI"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="shift" id="shift" class="form-control">
        <div class="form-row">
          <div class="col">
            <label for="timeCut">Cut Off Time</label>
            <input type="text" class="form-control" id="timeCut">
          </div>
          <div class="col">
            <label for="timeAlarm">Alarm Time</label>
            <input type="text" class="form-control" id="timeAlarm">
          </div>
          <div class="col">
            <label for="timeSnooze">Snooze Time</label>
            <input type="text" class="form-control" id="timeSnooze">
          </div>
        </div>  
          <p class="note note-danger mt-2"><strong>Note: </strong>Input the time in 24 hour format.</p>
      </div>
      <div class="modal-footer">
            <div class="col-lg-12 d-flex justify-content-end">
              <button class="btn btn-sm btn-primary" id="btnUpdateAlarm"><i class="fas fa-edit"></i> Update Alarm</button>
            </div>
      </div>
    </div>
  </div>
</div>