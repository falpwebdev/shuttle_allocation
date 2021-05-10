<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
    $userId = $_SESSION['idNumber'];
    $userEmpName = $_SESSION['empName']; 
  }
?>
<?php
  include 'db/config.php';
  include 'functions/inc/inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Modify Out (Admin)</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
<?php
  include 'src/navs/admin-topnav.php';
  include 'modals/uploadModificationOut.php';
  include 'modals/confirmRequestor.php';
?>
<div class="container-fluid">
  <div class="col-lg-12">
    <div class="card">
      <h4 class="card-title text-center mt-2">Modify Outgoing Data</h4>
      <div class="card-body">
        <div class="row">
          <!-- Generate Code Filed Today -->
            <div class="col-lg-6">
              <div class="card">
                <h5 class="card-title text-center mt-3">Generate Code (Filed data today)</h5>
                <div class="card-body">
                  <p class="note note-danger"><strong>Note:</strong> To modify the outgoing allocation filed TODAY (DS/NS). Create code here. </p>
                    <!-- Form to Generate Code for Filed Today -->
                      <div class="form-row">
                        <div class="col mt-4">
                          <input type="hidden" id="dateToday" class="form-control" value="<?=date('Y-m-d');?>">
                          <label for="dept">Department</label>
                          <select class="browser-default custom-select selDept" id="deptToday"></select>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="typeToday custom-control-input" id="sectionToday" name="typeToday" value="deptSection" checked>
                            <label class="custom-control-label" for="sectionToday">Section</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="typeToday custom-control-input" id="lineToday" name="typeToday" value="lineNo" disabled>
                            <label class="custom-control-label" for="lineToday">Line</label>
                          </div>
                            <label for="sectLineToday">Section or Line Number</label>
                            <select id="sectLineToday" class="browser-default custom-select"></select>
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <label for="shiftToday">Shift</label>
                          <select id="shiftToday" class="browser-default custom-select shift">
                            <option value="0">Please select</option>
                            <option value="DS">DS</option>
                            <option value="NS">NS</option>
                          </select>
                        </div>
                        <div class="col">
                        <label for="requestorID">Requestor ID Number</label>
                        <input type="text" name="requestorID" id="requestorToday" class="form-control requestorID">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <p class="note note-primary"><strong>Code:</strong> <span id="codeGeneratedToday"></span></span></p>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col">
                          <button type="button" id="btnToday" class="btnProceed btn btn-primary btn-md btn-block" disabled>Proceed</button>
                        </div>
                        <div class="col">
                          <button type="button" id="btnCToday" class="btnCancel btn btn-danger btn-md btn-block">Cancel</button>
                        </div>
                      </div>
                    <!-- End Form to Generate Code for Filed Today -->
                </div>
              </div>
            </div>
          <!-- End Generate Code Filed Today -->
          <!-- Generate Code Filed Previous -->
            <div class="col-lg-6">
              <div class="card">
                <h5 class="card-title text-center mt-3">Generate Code (Previous Days) </h5>
                  <div class="card-body">
                    <p class="note note-info"><strong>Note:</strong> To modify the outgoing previous allocation filed (DS/NS). Create code here. </p>
                      <!-- Form to Generate Code for Filed Previously -->
                        <div class="form-row">
                          <div class="col mt-4">
                            <label for="datePrev">Date to Modify</label>
                            <input type="date" id="datePrev" class="form-control">
                          </div>
                          <div class="col mt-4">
                            <label for="deptPrev">Department</label>
                            <select class="browser-default custom-select selDept" id="deptPrev"></select>
                          </div>
                          <div class="col">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="typePrev custom-control-input" id="sectionPrev" name="typePrev" value="deptSection" checked>
                              <label class="custom-control-label" for="sectionPrev">Section</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="typePrev custom-control-input" id="linePrev" name="typePrev" value="lineNo" disabled>
                              <label class="custom-control-label" for="linePrev">Line</label>
                            </div>
                              <label for="sectLinePrev">Section or Line Number</label>
                              <select id="sectLinePrev" class="browser-default custom-select"></select>
                          </div>
                        </div>
                        <div class="form-row mt-2">
                          <div class="col">
                            <label for="shiftPrev">Shift</label>
                            <select id="shiftPrev" class="browser-default custom-select shift">
                              <option value="0">Please select</option>
                              <option value="DS">DS</option>
                              <option value="NS">NS</option>
                            </select>
                          </div>
                          <div class="col">
                            <label for="pRequestorID">Requestor ID Number</label>
                            <input type="text" name="requestorID" id="requestorPrev" class="form-control requestorID">
                          </div>
                        </div>
                        <div class="form-row mt-2">
                          <div class="col">
                            <p class="note note-info"><strong>Code:</strong> <span id="codeGeneratedPrev"></span></span></p>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col">
                            <button type="button" id="btnPrev" class="btnProceed btn btn-info btn-md btn-block" disabled>Proceed</button>
                          </div>
                          <div class="col">
                            <button type="button" id="btnCPrev" class="btnCancel btn btn-danger btn-md btn-block">Cancel</button>
                          </div>
                        </div>
                      <!-- End Form to Generate Code for Filed Previously -->
                  </div>
              </div>
            </div>
          <!-- End Generate Code Filed Previous -->
        </div>
        <div class="row mt-2">
          <!-- Table of Codes -->
              <div class="col-lg-12">
                <h5 class="card-title text-center mt-3">Modification Status</h5>
              </div>
              <!-- Table UI  -->
                <div class="col-lg-12 mt-2">
                  <table class="table table-sm table-bordered text-center" id="codesTbl">
                    <thead>
                      <tr>
                        <th rowspan="2">Code</th>
                        <th colspan="2">Data to modify</th>
                        <th rowspan="2">Code Created</th>
                        <th rowspan="2">Requestor ID / Name</th>
                        <th rowspan="2">Code Closed Date</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Action</th>
                      </tr>
                      <tr>
                        <th>Section/Line</th>
                        <th>Date</th>
                      </tr>
                      </thead>
                      <tbody id="tblCode">
                      </tbody>
                    </table>
                </div>
              <!-- End Table UI -->
          <!-- Table of Codes -->
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
?>
<script>
$(document).ready(function(){
  // Navs
    $('#navHome').addClass('font-weight-bold');
    $('#navHome').css('color','#CC0000');
    displayDept();
    deptWLine();
    displayCodes();
});
  // FUNCTIONS TO UI
    // Display Dept
      const displayDept = () => {
        $.ajax({
          url: 'functions/display/common_department.php?data=a_m_department',
          method: 'get',
          success: function(response){
            $('.selDept').html(response);
          },error: function(){
          }
        });
      }
    //  Determine Depts with Line
      var deptwithLine = [];
      const deptWLine = () => {
        <?php 
          foreach($withLineDept as $key => $val){ 
        ?>
          deptwithLine.push('<?=$val;?>');
        <?php
          } 
        ?>
      }
    // Reset Today Form
      const resetToday = () => {
        $('#dept').prop('disabled',false);
        displayDept();
        $('#sectionToday').prop('disabled',false);
        $('#sectionToday').prop('checked',true);
        $('#lineToday').prop('disabled',true);
        $('#sectLine').prop('disabled',false);
        $('#sectLine').html('<option>Select Department</option>');
        $('#shift').prop('disabled',false);
        $('#shift').val('0');
        $('#requestorID').prop('disabled',false);
        $('#requestorID').val('');
        $('#codeGenerated').text('');
        $('.btnProceed').prop('disabled',true);
      }
    // Reset Prev Form
      const resetPrev = () => {
        $('#pDept').prop('disabled',false);
        $('#pDate').val('dd/mm/yyyy');
        displayDept();
        $('#sectionPrev').prop('disabled',false);
        $('#sectionPrev').prop('checked',true);
        $('#linePrev').prop('disabled',true);
        $('#pSectLine').prop('disabled',false);
        $('#pSectLine').html('<option>Select Department</option>');
        $('#pShift').prop('disabled',false);
        $('#pShift').val('0');
        $('#pRequestorID').prop('disabled',false);
        $('#pRequestorID').val('');
        $('#codePGenerated').text('');
        $('.btnProceed').prop('disabled',true);
      }
    // Cancel Code
      $('.btnCancel').click(function(){
        var type = $(this).prop('id');
        if(type == 'btnCToday'){
          resetToday();
        }else if(type == 'btnCPrev'){
          resetPrev();
        }
      });
    // Display Section of the Selected Department
      const displaySectline = (dept,part) => {
        var sectLine = '';
        var type = '';
          if($('#section'+part).is(':checked')){
            type = 'deptSection';
          }else if($('#line'+part).is(':checked')){
            type = 'lineNo';
          }
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=code_type&dept='+dept+'&type='+type,
          method: 'get',
          success: function(response){
            $('#sectLine'+part).html(response);
          },error: function(response){
          }
        });
      }
    // Change of Type Today 
      $('.typeToday').click(function(){
        var dept = $('#deptToday').val();
        displaySectline(dept,"Today");
      });
      $('.typePrev').click(function(){
        var dept = $('#deptToday').val();
        displaySectline(dept,"prev");
      });
    // Change of Prev Today 
      $('.typePrev').click(function(){
        var dept = $('#deptPrev').val();
        displaySectline(dept,"Prev");
      });
    // Display Code 
      const displayCodes = () => {
        var table = $('#codesTbl').DataTable();
        table.destroy();
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=li_code_out',
          method: 'get',
          success: function(response){
            $('#tblCode').html(response);
            $('#codesTbl').DataTable({
              "order": [[ 2, "desc" ]]
            });
          },error: function(response){
          }
        })
      }
  // Generate Codes
    $('.selDept').change(function(){
      var dept = $(this).val();
      var id = $(this).attr('id');
      var selType = id.split('t');
      var type = selType[1];
      $('.btnProceed').prop('disabled',true);
      $('#line'+type).prop('disabled',true);
      $('#line'+type).prop("checked", false);
      $('#section'+type).prop("checked", true);
      $('#requestorID').val('');
      $('#shift'+type).val(0);
      if(deptwithLine.includes(dept) == true){
        $('#line'+type).prop('disabled',false);
      }
      displaySectline(dept,type);
    });
  // Confirm Code Request Details
    $('.requestorID').change(function(){
      var id = $(this).attr('id');
      var selType = id.split('or');
      var type = selType[1];
      var dept = $('#dept'+type).val();
        if($('#section'+type).is(':checked')){
          categ = 'empDeptSection';
        }else if($('#line'+type).is(':checked')){
          categ = 'lineNo';
        }
      var sectLine = $('#sectLine'+type).val();
      var shift = $('#shift'+type).val();
      var requestorID = $('#requestor'+type).val();
      var date = $('#date'+type).val();
        if(dept != '0' && sectLine != '' && shift != '0' && requestorID != '' && date != ''){
          $.ajax({
            url: 'functions/display/modify_outgoing.php?data=code_check_emp&emp='+requestorID+'&dept='+dept+'&categ='+categ+'&sectLine='+sectLine+'&shift='+shift,
            method: 'get',
            success: function(response){
              if(response != 'false'){
                $('#confirmCode').modal();
                $('#cType').val(type);
                $('#cDept').val(dept);
                $('#cSectLine').val(sectLine);
                $('#cShift').val(shift);
                $('#cDate').val(date);
                $('#cID').val(requestorID);
                $('#cName').val(response);
              }else{
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Error!',
                  text: 'Employee does not exist in Department or in master',
                  showConfirmButton: true
                })
              }
            },error: function(response){
            }
          });
        }else{
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error!',
            text: 'Please complete form.',
            showConfirmButton: true
          })
        }
    });
  // Generate Code
    $('#btnGenerateCode').click(function(){
      var type = $('#cType').val();
      // Generate Random
        var d = new Date();
        var datenow = d.getDate();
        var randNum = Math.floor(Math.random() * 999999);
      // Disable UI
          $('#confirmCode').modal('toggle');
          $('#dept'+type).prop('disabled',true);
          $('#section'+type).prop('disabled',true);
          $('#lineToday').prop('disabled',true);
          $('#sectLine'+type).prop('disabled',true);
          $('#shift'+type).prop('disabled',true);
          $('#requestor'+type).prop('disabled',true);
      // Variables
          var dept = $('#dept'+type).val();
          var codeGenerated = dept +'-'+randNum+'-'+datenow;
          $('#codeGenerated'+type).text(codeGenerated);
          $('#btn'+type).prop('disabled',false);
    });
  // Proceed Code
    $('.btnProceed').click(function(){
      $('.btnProceed').prop('disabled',true);
      var id = $(this).attr('id');
      var selType = id.split('btn');
      var type = selType[1];
      // Variables
        var date = $('#date'+type).val();
        var item = $('#sectLine'+type).val();
        var shift = $('#shift'+type).val();
        var requestorID = $('#requestor'+type).val();
        var code = $('#codeGenerated'+type).text();
        var name = $('#cName').val();
      // Data
        var datax = {
          "date": date,
          "item": item,
          "shift": shift,
          "requestor": requestorID,
          "code": code,
          "name": name
        };
        var data = JSON.stringify(datax);
      // Process
        $.ajax({
          url: 'functions/process/modify_outgoing.php?process=record_code&data='+data,
          method: 'get',
          success: function(response){
            if(response == 'done'){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'Code successfully created',
                showConfirmButton: true
              })
                $('#date'+type).val('');
                $('#sectLine'+type).prop("disabled",false);
                $('#shift'+type).val(0);
                $('#shift'+type).prop("disabled",false);
                $('#requestor'+type).val('');
                $('#codeGenerated'+type).text('');
                $('#cName').val('');
                $('.selDept').val(0);
                $('.selDept').prop("disabled",false);
                $('#section'+type).prop("disabled",false);
                $('#date'+type).val('dd/mm/yyyy');
              displayCodes();
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error!',
                text: 'Please try again.',
                showConfirmButton: true
              })
            }
          },error: function(response){
          }
        });
    });
  // Follow Up Opens
    const followUp = (x,y) => {
      $.ajax({
        url: 'functions/process/modify_outgoing.php?process=alert_code&handle='+x+'&code='+y+'&userId=<?=$userId?>',
        method: 'get',
        success: function(response){
          if(response == 'done'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'Reminder have been sent to requestor',
                showConfirmButton: true
            })
          }
        },error: function(response){
        }
       });
    }
  // Delete Code
    const deleteCode = (x) => {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'functions/process/modify_outgoing.php?process=delete_code&code='+x,
              method: 'get',
              success: function(response){
                Swal.fire({
                    icon: 'info',
                    showConfirmButton: false,
                    showCloseButton: true,
                    title: 'Deleted Code',
                    text: response
                  });
                  displayCodes();
              },error: function(response){

              }
            });
          }
      })
    }
  // Refresh Code
  const refreshCode = (x) => {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'functions/process/modify_outgoing.php?process=reopen_code&code='+x,
              method: 'get',
              success: function(response){
                Swal.fire({
                    icon: 'info',
                    showConfirmButton: false,
                    showCloseButton: true,
                    title: 'Code reopened.',
                    text: response
                  });
                  displayCodes();
              },error: function(response){

              }
            });
          }
      })
    }
</script>
</body>
</html>