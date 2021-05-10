<?php
  $interface = 'department';
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
?>
<?php
  include 'db/config.php';
  include 'functions/inc/user-shuttle.php';
  include 'functions/inc/inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Line Leader (Transfer)</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
<?php
  include 'src/navs/line-topnav.php';
  include 'modals/transferEmp.php';
  include 'modals/processingUI.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <h4 class="card-title text-center mt-3">LINE MASTER (<?=$userHandle?>)</h4>
          <input type="hidden" id="countStatus" value="<?=$totcount?>">
        <div class="card-body">
            <div class="col-lg-12 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-primary waves-effect" id="btnSelectAll">Select All</button>
                <button type="button" class="btn btn-sm btn-outline-cyan waves-effect generateChecked" id="btnTransfer">Transfer</button>
            </div>
          <table class="table table-sm table-bordered" id="tblHandle">
            <thead>
              <tr>
                <th></th>
                <th>ID Number</th>
                <th>Name</th>
                <th>Shift</th>
                <th>Employer</th>
              </tr>
            </thead>
            <tbody id="tblEmpHandle">
            </tbody>
          </table>
          <p id="test" style="display:none;"></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
  include 'functions/js/notif.php';
?>
<script type="text/javascript">
$(document).ready(function(){
  // Navs
    $('#navDept').addClass('font-weight-bold');
    $('#navDept').css('color','#CC0000');
  // Realtime
    filingMPCount();
    notifNum();
  // Display Line Handle
    displayEmpHandle('<?=$userHandle?>');
});
  // Real time Counting
    setInterval(function(){
      filingMPCount();
      notifNum();
    }, 3000);

    const filingMPCount = () => {
      $.ajax({
        url: 'functions/process/realtime_count.php?process=filingMP_count&handle=<?=$handle?>&type=<?=$userType?>&interface=<?=$interface?>',
        method: 'get',
        success: function(response){
          console.log(response);
          if('<?=$totcount?>' != response){
            Swal.fire({
              title: 'This page needs to reload. Your masterlist have been changed!',
              showCancelButton: false,
              confirmButtonText: `Okay`,
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            })    
          }
        },error: function(response){
        }
      });
    }
  // FUNCTIONS TO UI
    // Display Handled MP
      const displayEmpHandle = (x) => {
          $.ajax({
            url: 'functions/display/user_department.php?data=lineMP&handle='+x,
            method: 'get',
            success: function(response){
              $('#tblEmpHandle').html(response);
                $('#tblHandle').DataTable({
                  scrollY: "480px",
                  scrollCollapse: true,
                  paging: false
                });
            },error: function(response){
            }
          });
        }
    // Select/UnSelect All
      $('#btnSelectAll').click(function(){
      var text = $(this).text();
        if(text == 'Select All'){
          $('#tblEmpHandle .empC').prop("checked",true);
          $(this).text('Unselect All');
          $('#test').text('all');
        }else{
          $('#tblEmpHandle .empC').prop("checked",false);
          $(this).text('Select All');
          $('#test').text('none');
        }
      });
    // Transfer button Functions
      $('#btnSubmitTrans').hover(function(){
        $('#note').addClass('animated bounce infinite');
      });
      $('#btnSubmitTrans').mouseleave(function(){
        $('#note').removeClass('animated bounce infinite');
      });
  // Transfer Employees
    // Open Transfer Modal
    $('#btnTransfer').click(function(){
          // Variables
            var count = 0;
            var checked = 'none';
          // UI
            $('#tbltoTrans').html('');
          // Get Checked
            $('#tblEmpHandle>tr').each(function(){
                var datID = $(this).attr('id');
                if($('#C'+datID).prop('checked') == true){
                  checked = '1';
                  var data = $('#C'+datID).val();
                  data = data.split("/");
                  deptsx = data[2];
                  // Determine if Same Department
                    if(count == 0){
                      first = deptsx;
                      $('#tbltoTrans').append('<tr id="'+data[0]+'"><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[3]+'</td></tr>');
                    }else{
                      next = deptsx;
                      if(first != next){
                        checked = '2';
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Employees selected does not have the same department.',
                          showConfirmButton: true
                        })
                      }else{
                        $('#tbltoTrans').append('<tr id="'+data[0]+'"><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[3]+'</td></tr>');
                      }
                    }
                  count++;
                }
            });
            if(checked == 'none'){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please select employees',
                showConfirmButton: false,
                timer: 1500
              })
            }else if(checked == '1'){
              $('#transferMod').modal();
              displayDept(first);
            }
        });
      // Display Department
        const displayDept = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=a_m_department',
            method: 'get',
            success: function(response){
              $('#empDept').html(response);
              $('#empDept').val(x);
              displaySection(x);
            },error: function(){
            }
          });
        }
      // Display Section
        const displaySection = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_deptSect&dept='+x,
            method: 'get',
            success: function(response){
              $('#deptSect').html(response);
              var y = $('#deptSect').val();
              y = y.replace("&","@");
              displaySubSect(x,y);
            },error: function(response){
              
            }
          });
        }
      // Display Sub-Section
        const displaySubSect = (x,y) => {
          var deptwithLine = new Array();
            <?php 
              foreach($withLineDept as $key => $val){ 
            ?>
              deptwithLine.push('<?=$val;?>');
            <?php
              } 
            ?>
          $.ajax({
            url: 'functions/display/common_department.php?data=m_deptSubSect&dept='+x+'&sect='+y,
            method: 'get',
            success: function(response){
              $('#deptSubSect').html(response);

                if(deptwithLine.includes(x) == true){
                  $('#lineDisp').show();
                  var deptSubSect =  $('#deptSubSect').val();
                  var z = deptSubSect.replace("&","@");
                  displayLine(x,y,z);
                }else{
                  $('#lineDisp').hide();
                  $('#lineNo').val(0);
                }
            },error: function(response){
            }
          });
        }
      // Display Line 
        const displayLine = (x,y,z) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_line&dept='+x+'&sect='+y+'&subSect='+z,
            method: 'get',
            success: function(response){
              $('#lineNo').html(response);
            },error: function(){

            }
          });
        }
      // Display Selected Department Details
        $('#empDept').change(function(){
          var dept = $(this).val();
          displaySection(dept);
        });
      // Display Selected Section Details
        $('#deptSect').change(function(){
          var dept = $('#empDept').val();
          var sect = $('#deptSect').val();
          displaySubSect(dept,sect);
        });
      // Display Selected Sub-Section Line Details
        $('#deptSubSect').change(function(){
          var dept = $('#empDept').val();
          var sect = $('#deptSect').val();
          var subSect = $('#deptSubSect').val();
          displayLine(dept,sect,subSect);
        });
      // Transfer Type Function
        // $('#permanent').click(function(){
        //     if ($(this).is(':checked')) {
        //       $('#setDate').prop('disabled', true);
        //     }else{
        //       $('#setDate').prop('disabled', false);
        //     }
        // });
        $('.pmnt').hide();
      // Submit Transfer
        $('#btnSubmitTrans').click(function(){
          // UI
            $('#note').removeClass('animated bounce infinite');
          // Variables
            var checked = 'none';
            var transfTime = '';
            var empTransfer = [];
            var count = 0;
            var empDept = $('#empDept').val();
            var deptSect1 = $('#deptSect').val();
              var deptSect =deptSect1.replace("&","@");
            var deptSubSect1 = $('#deptSubSect').val();
              var deptSubSect =deptSubSect1.replace("&","@");
            var lineNo = $('#lineNo').val();
              if(lineNo == null){
                lineNo = 0;
              }
          // Check if Form is Complete
            if ($('#permanent').is(':checked')) {
              transfTime = 'permanent';
            }else{
              transfTime = $('#setDate').val();
            }
            if(transfTime == ''){
              Swal.fire(
                'Error!',
                'Please set Transfer Details',
                'error'
              )
            }
          // Get Transfer MP
            $('#tbltoTrans>tr').each(function(){
              var id = $(this).attr('id');
              empTransfer.push(id);
            });
          // Transfer MP
            if(transfTime != ''){
              $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
              var arrayCount = empTransfer.length;
              $('#processingProgress').attr('aria-valuemax',arrayCount);
              
              empTransfer.forEach(id => {
                id = id.replace('CS','');
                $.ajax({
                  url: 'functions/process/user_department.php?process=transferEmp&empID='+id+'&empDept='+empDept+'&deptSect='+deptSect+'&deptSubSect='+deptSubSect+'&lineNo='+lineNo+'&transDate='+transfTime+'&user=<?=$userId?>',
                  method: 'get',
                  success: function(response){
                    console.log(response);
                    count = count + 1;
                    $('#status').text(response);
                    var percent = (count / arrayCount) * 100;
                    $('#processingProgress').attr('aria-valuemax',count).css('width', percent+'%');
                    $('#count').text(count+' updated.');
                    
                    if(count == arrayCount){
                      if(transfTime != 'permanent'){
                        $.ajax({
                          url: 'functions/process/user_department.php?process=finishedTrans&user=<?=$userId?>&transDate='+transfTime,
                          method: 'get',
                          success: function(response){

                          },error: function(response){
                          }
                        });
                      }
                      setTimeout(() => {
                        Swal.fire(
                        'Success!',
                        'Transferring done.',
                        'success'
                        )
                          setInterval(function(){
                            location.reload();
                          },2000);
                      }, 2000);
                    }
                  },error: function(response){

                  }
                });
              });
            }
        });
</script>
</body>
</html>
