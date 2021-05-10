<!-- Modal -->
<div class="modal fade" id="updateAgency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Route Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <input type="hidden" id="oldAgencyCode" class="form-control" disabled>
           <label for="form1">Agency Code</label>
           <input type="text" id="nAgencyCode" class="form-control">
           <br>
           <label for="form1">Name</label>
           <input type="text" id="nAgencyName" class="form-control"> 
           <br> 
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUpdateAgency" class="btn btn-sm btn-primary">Updated changes</button>
      </div>
    </div>
  </div>
</div>