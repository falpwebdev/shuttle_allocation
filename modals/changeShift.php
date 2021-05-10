<div class="modal fade" id="changeShiftMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Change Shift</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          <table class="table table-sm table-bordered text-center" id="tblSelectedEmp">
            <thead class="text-uppercase">
              <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Position</th>
                <th>From</th>
                <th>To</th>
              </tr>
            </thead>
            <tbody id="tbltoChange"></tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="btnSubmitChangeShift">CONFIRM CHANGE SHIFT</button>
      </div>
    </div>
  </div>
</div>
