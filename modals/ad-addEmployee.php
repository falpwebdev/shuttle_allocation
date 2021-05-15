
<!-- Central Modal Small -->
<div class="modal fade" id="addEmpMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title w-100 text-center" id="myModalLabel">Add Employee</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
         <!-- ID  -->
         <div class="col">
           <div class="md-form">
              <input type="text" id="newIDNum" class="form-control">
              <label for="newIDNum">ID Number</label>
           </div>
         </div>
         <!-- NAME -->
         <div class="col">
          <div class="md-form">
             <input type="text" id="newEmpName" class="form-control" placeholder="LN, FN MI.">
             <label for="newEmpName">Employee Name</label>
          </div>
         </div>
         <!-- NICKNAME -->
           <div class="col">
             <div class="md-form">
                <input type="text" id="newEmpNickname" class="form-control">
                <label for="newEmpNickname">Nickname</label>
             </div>
           </div>
         <!-- CONTACT -->
         <div class="col">
          <div class="md-form">
            <input type="tel" id="empContact" name="phone" class="form-control" placeholder="Ex: 0911-245-4678" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required>
            <label for="empContact">Contact Number</label>
          </div>
         </div>
        </div>

        <div class="row">
         <!-- POSITION -->
         <div class="col">
          <label for="empPosition">Position</label>
          <select class="browser-default custom-select" id="empPosition">
          </select>
        </div>
        <!-- DATE HIRED -->
        <div class="col">
          <label for="dateHired">Date Hired</label>
          <input type="date" class="form-control" id="dateHired">
        </div>
        <!-- DATE HIRED -->
        <div class="col">
          <div class="md-form">
            <label for="empBatch">Batch Number</label>
            <input type="text" class="form-control" id="empBatch">
          </div>
        </div>
         <!-- DEPARTMENT -->
         <div class="col">
          <label for="empDepartment">Department</label>
          <select class="browser-default custom-select" id="empDepartment">
          </select>
         </div>
        </div>

        <div class="row">
          <!-- ROUTE -->
          <div class="col-lg-4">
            <label for="empPosition">Route</label>
            <select class="browser-default custom-select" id="empRoute">
            </select>
          </div>
          <!-- AREA -->
          <div class="col-lg-2">
            <div class="custom-control custom-radio">
             <input type="radio" class="custom-control-input" id="empA" value="A" name="empArea">
             <label class="custom-control-label" for="empA">Area A</label>
            </div>
            <div class="custom-control custom-radio">
             <input type="radio" class="custom-control-input" id="empB" value="B" name="empArea">
             <label class="custom-control-label" for="empB">Area B</label>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="empDS" value="DS" name="empShift">
              <label class="custom-control-label" for="empDS">Day Shift</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="empADS" value="ADS" name="empShift">
              <label class="custom-control-label" for="empADS">Always Day Shift</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="empNS" value="NS" name="empShift">
              <label class="custom-control-label" for="empNS">Night Shift</label>
            </div>
          </div>
          <div class="col-lg-3">
            <?php
              $sql = "SELECT * FROM `a_m_sched`";
              $query = $conn->query($sql);
              while ($dat = $query->fetch_assoc()) {
                $sched = $dat['schedTime'];
                echo '<div class="custom-control custom-radio pt-0">
                <input type="radio" class="custom-control-input custom-control-inline" id="'.$sched.'" value="'.$sched.'" name="empShiftSched">
                <label class="custom-control-label" for="'.$sched.'">'.$sched.'</label></div>';
              }
            ?>
          </div>
        </div>
        
        <div class="row mt-2">
          <div class="col-lg-4">
            <label for="empAgency">Employer</label>
            <input type="text" id="empAgency" class="form-control" value="FAS" placeholder="FAS" disabled>
          </div>
          <div class="col-lg-4">
            <label for="empCostC">Cost Center</label>
            <input type="text" id="empCost" class="form-control" placeholder="Select Position first" disabled>
            </select>
          </div>
          <div class="col-lg-4">
            <label for="empHandler">Handler</label>
            <input type="text" id="empHandler" class="form-control" value="Recruitment and Training" placeholder="Recruitment and Training" disabled>
          </div>
        </div>

        

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="submitNewEmp"><i class="fas fa-user-plus" ></i> Add Employee</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->