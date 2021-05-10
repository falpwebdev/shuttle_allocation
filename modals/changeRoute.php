<!-- Central Modal Small -->
<div class="modal fade" id="changeRouteMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Change Route</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
          <input type="hidden" id="routeIdNum">
          <input type="hidden" id="routeFrom">
          <label for="routeTo">Select Route:</label>
          <select class="browser-default custom-select" id="routeTo">
            <!-- <option selected>Open to change route</option> -->
            <?php
                $sql = "SELECT * FROM `sas_m_route`";
                $query = $conn->query($sql);
                while ($dat = $query->fetch_assoc()) {
                  $route = $dat['route'];
            ?>
              <option value="<?=$route?>"><?=$route?></option>
            <?php
                }
            ?>
          </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="setTempRoute">Set Temporary Route</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->