<!-- Modal -->
<div class="modal fade" id="deptDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-fluid modal-top modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Department Details (<span id="deptC"></span> - <span id="deptN"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="col">
          <input list="sections" class="form-control" placeholder="Input or Select Section" id="aDeptSect">
          <datalist id="sections">
          </datalist>
          </div>
          <div class="col">
            <input type="text" class="form-control" name="addSub" id="aDeptSub" placeholder="Input Sub-Section">
          </div>
          <div class="col">
            <select class="browser-default custom-select" id="selType">
              <option selected value="0">Select Type</option>
              <option value="No">For FAS</option>
              <option value="Yes">For Agency</option>
            </select>
          </div>
          <div class="col">
            <button class="btn btn-sm btn-primary" id="btnAddDeptItem"><i class="fas fa-plus"></i> Add Item</button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-sm table-bordered" id="deptDetTbl">
              <thead>
                <tr>
                  <th>Department Name</th>
                  <th>Section</th>
                  <th>Sub-Section</th>
                  <th>Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="TblDeptDet">
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