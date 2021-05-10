<!-- Modal -->
<div class="modal fade" id="editAccMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Account Details (<span id="AccI"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="userID" id="userID" class="form-control">
        <div class="form-row">
          <div class="col">
            <label for="oldPw">Old Password</label>
            <input type="text" class="form-control" id="oldPw" readonly>
          </div>
          <div class="col">
            <label for="newPw">New Password</label>
            <input type="text" class="form-control" id="newPw">
          </div>
          <p class="note note-danger mt-1"><strong>Note: </strong>If you want to change the Handled Section/Line. Kindly ask the employee handler to transfer the employee to the new handle group. The system will automatically update the user account.</p>
        </div>  
      </div>
      <div class="modal-footer">
            <div class="col-lg-12 d-flex justify-content-end">
              <button class="btn btn-sm btn-primary" id="btnUpdateAcc"><i class="fas fa-edit"></i> Update Account</button>
              <button class="btn btn-sm btn-danger" id="btnDeleteAcc"><i class="fas fa-trash"></i> Delete Account</button>
            </div>
      </div>
    </div>
  </div>
</div>