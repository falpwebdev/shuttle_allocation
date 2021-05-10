<!-- Modal -->
<div class="modal fade" id="editLineMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Line Details (<span id="lineI"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="oLine" id="oLine" class="form-control">
        <div class="form-row">
          <div class="col">
            <label for="eLine">Line Name</label>
            <input type="text" class="form-control" id="eLine">
          </div>
          <div class="col">
            <label for="eProcess">Process</label>
            <input type="text" class="form-control" id="eProcess">
          </div>
          <div class="col">
            <label for="eCarModel">Car Model</label>
            <input type="text" class="form-control" id="eCarModel">
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col">
            <label for="eDepts">Department</label>
            <select class="browser-default custom-select" id="eDepts">
            </select>
          </div>
          <div class="col">
            <label for="eSect">Section</label>
            <select class="browser-default custom-select" id="eSect">
            </select>
          </div>
          <div class="col">
            <label for="eSubSect">Sub-Section</label>
            <select class="browser-default custom-select" id="eSubSect">
            </select>
          </div>
        </div>  
      </div>
      <div class="modal-footer">
            <div class="col-lg-12 d-flex justify-content-end">
              <button class="btn btn-sm btn-primary" id="btnUpdateLine"><i class="fas fa-edit"></i> Update Item</button>
            </div>
      </div>
    </div>
  </div>
</div>