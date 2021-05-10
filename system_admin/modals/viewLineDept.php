<!-- Modal -->
<div class="modal fade" id="viewLineMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-fluid modal-top modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Department Line Details (<span id="ldept"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <!-- Add Line -->
            <div class="form-row">
              <div class="col">
                <label for="aDepts">Department</label>
                <input type="text" id="aDepts" class="form-control" disabled>
              </div>
              <div class="col">
                <label for="aSect">Section</label>
                <select class="browser-default custom-select" id="aSect">
                </select>
              </div>
              <div class="col">
                <label for="aSubSect">Sub-Section</label>
                <select class="browser-default custom-select" id="aSubSect">
                </select>
              </div>
              <div class="col">
                <label for="aCarModel">Car Model</label>
                <input type="text" class="form-control" id="aCarModel">
              </div>
              <div class="col">
                <label for="aProcess">Process</label>
                <input type="text" class="form-control" id="aProcess">
              </div>
              <div class="col">
                <label for="aLine">Line Name</label>
                <input type="text" class="form-control" id="aLine">
              </div>
              <div class="col">
                <label for="btnAddDeptLine">Submit</label>
                <button id="btnAddDeptLine" class="btn-sm btn-block btn-primary">Add Line</button>
              </div>
            </div>
            <table class="mt-3 table table-sm table-bordered table-hover text-center table-borderedtext-center" id="deptLineTbl">
              <thead>
                <tr>
                  <th>Line Name</th>
                  <th>Department</th>
                  <th>Section</th>
                  <th>Sub-Section</th>
                  <th>Car Model</th>
                  <th>Process</th>
                  <th></th>
                </tr>
              </thead>
                  <tbody id="tblDeptLine">
                  </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>