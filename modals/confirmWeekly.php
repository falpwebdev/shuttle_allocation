<!-- Modal -->
<div class="modal fade" id="confirmWeekMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Submit Incoming Shuttle Allocation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          <input type="text" class="form-control" id="dateFilingMod" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
          <p class="d-flex justify-content-start"><em>Confirm Total DS & NS manpower count..</em></p>
           <table class="table table-sm text-center table-bordered">
               <thead>
                   <tr>
                        <th>Route</th>
                        <th>Day Shift (Total)</th>
                        <th>Night Shift (Total)</th>
                   </tr>
               </thead>
               <tbody id="checkWeek">
               </tbody>
           </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnConfirmWeek" class="btn btn-sm btn-primary">Submit</button>        
      </div>
    </div>
  </div>
</div>