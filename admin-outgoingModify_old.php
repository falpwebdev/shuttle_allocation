<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
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
<title>SAS - Modify Out</title>
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
                          <label for="dept">Department</label>
                          <select class="browser-default custom-select" id="dept"></select>
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
                            <label for="sectLine">Section or Line Number</label>
                            <select id="sectLine" class="browser-default custom-select"></select>
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <label for="shift">Shift</label>
                          <select id="shift" class="browser-default custom-select">
                            <option value="0">Please select</option>
                            <option value="DS">DS</option>
                            <option value="NS">NS</option>
                          </select>
                        </div>
                        <div class="col">
                        <label for="requestorID">Requestor ID Number</label>
                        <input type="text" name="requestorID" id="requestorID" class="form-control">
                        </div>
                      </div>
                      <div class="form-row mt-2">
                        <div class="col">
                          <p class="note note-primary"><strong>Code:</strong> <span id="codeGenerated"></span></span></p>
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
                            <label for="pDate">Date to Modify</label>
                            <input type="date" id="pDate" class="form-control">
                          </div>
                          <div class="col mt-4">
                            <label for="pDept">Department</label>
                            <select class="browser-default custom-select" id="pDept"></select>
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
                              <label for="pSectLine">Section or Line Number</label>
                              <select id="pSectLine" class="browser-default custom-select"></select>
                          </div>
                        </div>
                        <div class="form-row mt-2">
                          <div class="col">
                            <label for="pShift">Shift</label>
                            <select id="pShift" class="browser-default custom-select">
                              <option value="0">Please select</option>
                              <option value="DS">DS</option>
                              <option value="NS">NS</option>
                            </select>
                          </div>
                          <div class="col">
                            <label for="pRequestorID">Requestor ID Number</label>
                            <input type="text" name="requestorID" id="pRequestorID" class="form-control">
                          </div>
                        </div>
                        <div class="form-row mt-2">
                          <div class="col">
                            <p class="note note-info"><strong>Code:</strong> <span id="codePGenerated"></span></span></p>
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
                        <th rowspan="2">Requested Date</th>
                        <th rowspan="2">Requestor ID / Name</th>
                        <th rowspan="2">Date Closed</th>
                        <th rowspan="2">x</th>
                        <th rowspan="2">Status</th>
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
  $('#navHome').addClass('font-weight-bold');
  $('#navHome').css('color','#CC0000');
  codeStatus();
  displayDept();
  deptWLine();
});

  // Functions to UI
    // Display Table of Codes
      const codeStatus = () => {
        var table = $('#codesTbl').DataTable();
        table.destroy();
        $.ajax({
          url: 'functions/additional-disp.php?process=code_displayList',
          method: 'get',
          success: function(response){
            $('#tblCode').html(response);
            $('#codesTbl').DataTable({
              "order": [[ 3, "asc" ]]
            });
          },error: function(response){

          }
        });
      }
    //  Display Department List 
      const displayDept = () => {
        $.ajax({
          url: 'functions/display/common_department.php?data=a_m_department',
          method: 'get',
          success: function(response){
            $('#dept').html(response);
            $('#pDept').html(response);
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
        if(part == 'today'){
          var type = '';
          if($('#sectionToday').is(':checked')){
            type = 'deptSection';
          }else if($('#lineToday').is(':checked')){
            type = 'lineNo';
          }
          sectLine = 'sectLine';
        }else if(part == 'prev'){
          var type = '';
          if($('#sectionPrev').is(':checked')){
            type = 'deptSection';
          }else if($('#linePrev').is(':checked')){
            type = 'lineNo';
          }
          sectLine = 'pSectLine';
        }
        $.ajax({
          url: 'functions/additional-disp.php?process=code_type&dept='+dept+'&type='+type,
          method: 'get',
          success: function(response){
            $('#'+sectLine).html(response);
          },error: function(response){
          }
        });
      }

  // Generate Code Today
    // Display Department 
      $('#dept').change(function(){
        var dept = $(this).val();
        $('.btnProceed').prop('disabled',true);
        $('#lineToday').prop('disabled',true);
        $('#lineToday').prop("checked", false);
        $('#sectionToday').prop("checked", true);
        $('#requestorID').val('');
        $('#shift').val(0);
        
        if(deptwithLine.includes(dept) == true){
          $('#lineToday').prop('disabled',false);
        }
          displaySectline(dept,"today");
      });
    // Change of Type Today 
      $('.typeToday').click(function(){
        var dept = $('#dept').val();
        displaySectline(dept,"today");
      });
    // Confirm Code Request Details
      $('#requestorID').change(function(){
        $('#cPart').val('today');
        var dept = $('#dept').val();
        var type = '';
          if($('#sectionToday').is(':checked')){
            type = 'deptSection';
          }else if($('#lineToday').is(':checked')){
            type = 'lineNo';
          }
        var sectLine = $('#sectLine').val();
        var shift = $('#shift').val();
        var requestorID = $('#requestorID').val();
        $.ajax({
            url: 'functions/additional-proc.php?process=code_checkEmp&emp='+requestorID+'&dept='+dept+'&type='+type+'&sectLine='+sectLine+'&shift='+shift,
            method: 'get',
            success: function(response){
              if(response != 'false'){
                $('#confirmCode').modal();
                $('#cType').val(type);
                $('#cDept').val(dept);
                $('#cSectLine').val(sectLine);
                $('#cShift').val(shift);
                $('#cDate').val('<?=date('Y-m-d');?>');
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
      });
  // Generate Prev
    // Display Department
      $('#pDept').change(function(){
        var dept = $(this).val();
        $('.btnProceed').prop('disabled',true);
        $('#linePrev').prop('disabled',true);
        $('#linePrev').prop("checked", false);
        $('#sectionPrev').prop("checked", true);
        $('#pRequestorID').val('');
        $('#pShift').val(0);
        
        if(deptwithLine.includes(dept) == true){
          $('#linePrev').prop('disabled',false);
        }
          displaySectline(dept,"prev");
      });
    // Change of Type Prev 
      $('.typePrev').click(function(){
        var dept = $('#pDept').val();
        displaySectline(dept,"prev");
      });
    // Confirm Code Request Details
      $('#pRequestorID').change(function(){
        $('#cPart').val('prev');
        var dept = $('#pDept').val();
        var type = '';
          if($('#sectionPrev').is(':checked')){
            type = 'deptSection';
          }else if($('#linePrev').is(':checked')){
            type = 'lineNo';
          }
        var sectLine = $('#pSectLine').val();
        var shift = $('#pShift').val();
        var requestorID = $('#pRequestorID').val();
        var date = $('#pDate').val();
        $.ajax({
            url: 'functions/additional-proc.php?process=code_checkEmp&emp='+requestorID+'&dept='+dept+'&type='+type+'&sectLine='+sectLine+'&shift='+shift,
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
      });
  // Same Processing Function
    // Generate Code
      $('#btnGenerateCode').click(function(){
        var type = $('#cPart').val();
        var d = new Date();
        var datenow = d.getDate();
        var randNum = Math.floor(Math.random() * 999999);

        if(type == 'today'){
          $('#confirmCode').modal('toggle');
          $('#dept').prop('disabled',true);
          $('#sectionToday').prop('disabled',true);
          $('#lineToday').prop('disabled',true);
          $('#sectLine').prop('disabled',true);
          $('#shift').prop('disabled',true);
          $('#requestorID').prop('disabled',true);
          var dept = $('#dept').val();
          var codeGenerated = dept +'-'+randNum+'-'+datenow;
            $('#codeGenerated').text(codeGenerated);
            $('#btnToday').prop('disabled',false);
        }else if(type == 'prev'){
          $('#confirmCode').modal('toggle');
          $('#dept').prop('disabled',true);
          $('#sectionPrev').prop('disabled',true);
          $('#linePrev').prop('disabled',true);
          $('#pSectLine').prop('disabled',true);
          $('#pShift').prop('disabled',true);
          $('#pRequestorID').prop('disabled',true);
          var dept = $('#pDept').val();
          var codeGenerated = dept +'-'+randNum+'-'+datenow;
          $('#codePGenerated').text(codeGenerated);
          $('#btnPrev').prop('disabled',false);
        }
      });
    // Proceed Code
    $('.btnProceed').click(function(){
        $('.btnProceed').prop('disabled',true);
        var type = $(this).attr('id');
        if(type == 'btnToday'){
          var requestor = $('#requestorID').val();
          var shift = $('#shift').val();
          var item = $('#sectLine').val();
          var code = $('#codeGenerated').text();
        }else if(type == 'btnPrev'){
          var requestor = $('#pRequestorID').val();
          var shift = $('#pShift').val();
          var item = $('#pSectLine').val();
          var code = $('#codePGenerated').text();
        }
          var date = $('#cDate').val();
          var requestor = $('#requestorID').val();
          var name = $('#cName').val();
        var datax = {
          "code": code,
          "date": date,
          "item": item,
          "requestor": requestor,
          "name": name,
          "shift": shift
        };
        var data = JSON.stringify(datax);
        $.ajax({
          url: 'functions/additional-proc.php?process=code_createTicket&data='+data,
          method: 'get',
          success: function(response){
            if(response == 'done'){
              resetToday();
              resetPrev();
              codeStatus();
            }else{
              Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Error!',
                  text: 'Code already exist. Kindly resubmit resubmit request.',
                  showConfirmButton: true
                })
            }
          },error: function(response){
          }
        });
      });
</script>
</body>
</html>