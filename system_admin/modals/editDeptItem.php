<!-- Modal -->
<div class="modal fade" id="editDeptItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-fluid" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Section Details (<span id="deptI"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <input type="hidden" name="listID" id="listID" class="form-control">
          <input type="hidden" name="deptName" id="deptName" class="form-control">
          <div class="col">
            <label for="dept">Department</label>
            <select id="dept" class="browser-default custom-select">
            </select>
          </div>
          <div class="col">
            <label for="deptSection">Section</label>
            <!-- <select id="deptSection" class="browser-default custom-select">
            </select> -->
            <input list="eSections" class="form-control" id="deptSection">
            <datalist id="eSections">
            </datalist>
          </div>
          <div class="col">
            <label for="subSect">Sub-Section</label>
            <input type="text" name="subSect" id="subSect" class="form-control">
          </div>
          <div class="col">
            <label for="deptType">Type</label>
            <select class="browser-default custom-select" id="deptType">
              <option selected value="0">Select Type</option>
              <option value="No">For FAS</option>
              <option value="Yes">For Agency</option>
            </select>
          </div>
        </div>
        
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-end">
              <button class="btn btn-sm btn-primary" id="btnUpdateItem"><i class="fas fa-edit"></i> Update Item</button>
            </div>
          </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>