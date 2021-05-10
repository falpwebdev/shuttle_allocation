<!-- Modal -->
<div class="modal fade" id="updatePosMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input type="hidden" id="oldPosition" class="form-control" disabled>
           <label for="form1">New Position Name</label>
           <input type="text" id="nPosition" class="form-control">
           <br>
           <label for="special">Choose Position Type </label>
                  <select class="browser-default custom-select" id="nSpecial">
                    <option value="0">Select Specialty</option>
                    <option value="Y">For Agency Only</option>
                    <option value="N">For FAS Only</option>
                    <option value="O">Applicable for All</option>
                  </select>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUpdatePosition" class="btn btn-sm btn-primary">Update Changes</button>
      </div>
    </div>
  </div>
</div>