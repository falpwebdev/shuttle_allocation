<!-- Modal -->
<div class="modal fade" id="updateWorkSMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Work Sched</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
           <input type="hidden" id="oldWork" class="form-control">
           <label for="newTWork">New Time</label>
           <input type="text" id="newTWork" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUpdateWork" class="btn btn-sm btn-primary">Update Changes</button>
        
      </div>
    </div>
  </div>
</div>