<div class="modal fade" id="transferMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-fluid modal-full-height modal-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Transfer Eployee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-lg-3">
             <label for="empDept">Department</label>
             <select class="browser-default custom-select" id="empDept">
            </select>
             <!-- <input type="text" id="empDept" class="form-control" disabled>
             <button class="btn btn-sm btn-primary" id="btnChangeDept">Change Department</button> -->
        </div>
        <div class="col">
            <label for="form1">Section</label>
            <select class="browser-default custom-select" id="deptSect">
            </select>
        </div>
        <div class="col">
             <label for="form1">Sub-Section</label>
             <select class="browser-default custom-select" id="deptSubSect">
            </select>
        </div>
        <div class="col" id="lineDisp">
             <label for="form1">Line No</label>
             <select class="browser-default custom-select" id="lineNo">
            </select>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <p>Transfer Duration</p>
          <input class="pmnt" type="checkbox" id="permanent" name="permanent" value="permanent">
          <label class="pmnt" for="permanent"> Permanent</label>
             <input type="date" id="setDate" name="setDate" class="ml-3">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <table class="table table-sm table-bordered" id="tblSelectedEmp">
            <thead>
              <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Position / Agency</th>
              </tr>
            </thead>
            <tbody id="tbltoTrans"></tbody>
          </table>
          </div>
      </div>
      <div class="row mt-3">
        <div class="col-lg-12 d-flex justify-content-end">
          <p class="note note-danger" id="note"><strong>Note: </strong>Please confirm employees and transfer details first before clicking the Transfer button.</p>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="btnSubmitTrans">Transfer Employees</button>
      </div>
    </div>
  </div>
</div>
