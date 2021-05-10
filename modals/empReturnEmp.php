<!-- Central Modal Small -->
<div class="modal fade" id="modReturn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Return Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden"  id="handler" class="form-control">
        <label for="idNumber">ID Number</label>
        <input type="text" readonly id="idNumber" class="form-control">
        <label for="name">Name</label>
        <input type="text" readonly id="name" class="form-control">
        <label for="type">Type</label>
        <input type="text" readonly id="type" class="form-control">
        <label for="date">Date Reactivated</label>
        <input type="date" readonly id="date" class="form-control" value="<?=$dateNow?>">
        <label for="remarks">Remarks</label>
        <input type="text" id="remarks" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="btnConfirmReturn">Confirm Return</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->