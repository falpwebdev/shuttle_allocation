<!-- Modal -->
<div class="modal fade" id="updateOutGoingMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Out Going Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
           <label for="form1">Old </label>
           <input type="text" id="oldOut" class="form-control" disabled>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <p>New</p>
          </div>
          <div class="col-lg-6">
            <select class="browser-default custom-select" id="uhr">
              <?php
                for ($i=1; $i < 13; $i++) { 
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
              ?>
            </select>
          </div>
          <div class="col-lg-6">
            <select class="browser-default custom-select" id="umin">
              <?php
                for ($i=0; $i < 60; $i++) { 
                  if($i == 0){
                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                  }elseif($i < 10){
                    echo '<option value="0'.$i.'">0'.$i.'</option>';
                  }else{
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  }
                }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnUpdateOut" class="btn btn-sm btn-primary">Update Changes</button>
      </div>
    </div>
  </div>
</div>