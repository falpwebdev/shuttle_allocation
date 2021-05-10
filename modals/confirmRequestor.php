<!-- Modal -->
<div class="modal fade" id="confirmCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Code Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control" id="cType">
        <input type="hidden" class="form-control" id="cPart">
        <div class="form-row">
          <div class="col">
            <label for="cDept">Deparment</label>
            <input type="text" class="form-control" id="cDept" readonly>
          </div>
          <div class="col">
            <label for="cSectLine">Handle (Section/Line)</label>
            <input type="text" class="form-control" id="cSectLine" readonly>
          </div>
          <div class="col">
            <label for="cShift">Shift</label>
            <input type="text" class="form-control" id="cShift" readonly>
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col">
            <label for="cDate">Date to Modify</label>
            <input type="text" class="form-control"  id="cDate" readonly>
            </select>
          </div>
          <div class="col">
            <label for="cID">Requestor ID</label>
            <input type="text" class="form-control"  id="cID" readonly>
            </select>
          </div>
          <div class="col">
            <label for="cName">Requestor Name</label>
            <input type="text" class="form-control"  id="cName" readonly>
            </select>
          </div>
        </div>  
      </div>
      <div class="modal-footer">
        <div class="col-lg-12 d-flex justify-content-end">
          <button class="btn btn-sm btn-primary" id="btnGenerateCode"><i class="fas fa-edit"></i> Generate Code</button>
        </div>
      </div>
    </div>
  </div>
</div>