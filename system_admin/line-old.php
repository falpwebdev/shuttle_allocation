<!DOCTYPE html>
<html>
<head>
  <title>SAS Admin - Line Masterlist</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="../img/sas-logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css?v=2">
  <link href="../css/addons/datatables.min.css" rel="stylesheet">
  <link href="../css/addons/datatables-select.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../lib/fontawesome-free-5.9.0-web/css/all.css">
  <style type="text/css">
  </style>
</head>
<body>
<?php
  include 'modals/viewLineDept.php';
  include 'modals/editLine.php';
?>
<h2 class="card-title text-white z-depth-5  mdb-color lighten-3">SAS Admin</h2>
<div class="container-fluid mt-3">
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <!-- Main Menu -->
          <div class="row">
            <div class="col-lg-2 mb-2">
              <a href="index.php" class="btn btn-sm mdb-color lighten-3 text-white"><i class="fas fa-arrow-left"></i> Main Menu</a>
            </div>
            <div class="col-lg-12">
                <p class="note note-success d-flex justify-content-start text-uppercase">Line Masterlist</p>
            </div>
          </div>
        <!-- /Main Menu -->
        <!-- Add Line Name -->
        
          <div class="row">
            <div class="col-lg-12">
              <div class="form-row">
                <div class="col">
                  <label for="nDepts">Department</label>
                  <select class="browser-default custom-select" id="nDepts">
                  </select>
                </div>
                <div class="col">
                  <label for="nSect">Section</label>
                  <select class="browser-default custom-select" id="nSect">
                  </select>
                </div>
                <div class="col">
                  <label for="nSubSect">Sub-Section</label>
                  <select class="browser-default custom-select" id="nSubSect">
                  </select>
                </div>
                <div class="col">
                  <label for="nCarModel">Car Model</label>
                  <input type="text" class="form-control" id="nCarModel">
                </div>
                <div class="col">
                  <label for="nProcess">Process</label>
                  <input type="text" class="form-control" id="nProcess">
                </div>
                <div class="col">
                  <label for="nLine">Line Name</label>
                  <input type="text" class="form-control" id="nLine">
                </div>
                <div class="col">
                  <label for="btnAddLine">Submit</label>
                  <button id="btnAddLine" class="btn-sm btn-block btn-primary">Add Line</button>
                </div>
              </div>
            </div>
          </div>
        <!-- /Add Line Name -->
          <div class="row mt-2">
            <div class="col-lg-12">
              <table class="table table-sm table-bordered table-hover text-center table-borderedtext-center" id="lineTbl">
                <thead>
                  <tr>
                    <th colspan="7">Line Masterlist</th>
                  </tr>
                  <tr>
                    <th>Department</th>
                    <th>Total Section</th>
                    <th>Total Sub-Section</th>
                    <th>Line</th>
                  </tr>
                  </thead>
                  <tbody id="tblLine">
                  </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- SCRIPTS -->
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <script type="text/javascript" src="../js/addons/datatables.min.js"></script>
  <script src="../js/addons/datatables-select.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="../js/addons/datatables-select2.min.js"></script>
  <script src="../js/sweetalert.js"></script>
<!-- /SCRIPTS -->
<script>
$(document).ready(function(){
  displayDepts();
  displayLine();
});
// Display Line
  const displayLine = () => {
    var table = $('#lineTbl').DataTable();
    table.destroy();
    $.ajax({
      url: '../functions/display/admin_module.php?data=li_line',
      method: 'get',
      success: function(response){
        $('#tblLine').html(response);
        $('#lineTbl').DataTable();
        $('.dataTables_length').addClass('bs-select');
      },error: function(response){
      }
    });
  }

//  ADDING LINE NAME SCRIPT 

  // Display Department in Adding Line Name
  const displayDepts = () => {
    $.ajax({
      url: '../functions/display/common_department.php?data=a_m_department',
      method: 'get',
      success: function(response){
        $('#nDepts').html(response);
      },error: function(response){
        
      }
    });
  }

  // Display Section & Sub Section of Department
    $('#nDepts').change(function(){
      var dept = $(this).val();
      $.ajax({
        url: '../functions/display/common_department.php?data=m_deptSect&dept='+dept,
        method: 'get',
        success: function(response){
          $('#nSect').html(response);
          var b = $('#nSect').val();
          var sect = b.replace("&","@");
          displaySubSectA(dept,sect);
        },error: function(response){
        }
      });
    });

  // Display Sub Section of Selected Dept
    $('#nSect').change(function(){
      var dept = $('#nDepts').val();
      var b = $('#nSect').val();
      var sect = b.replace("&","@");
      displaySubSectA(dept,sect);
    });

  // Add Line Name
    $('#btnAddLine').click(function(){
      var nDepts = $('#nDepts').val();
      var nSect1 = $('#nSect').val();
      var nSubSect1 = $('#nSubSect').val();
      var nLine = $('#nLine').val();
      var nCarModel = $('#nCarModel').val();
      var nProcess = $('#nProcess').val();
        if(nDepts != '0' && nSect != '' && nSubSect != '' && nLine != '' && nCarModel != '' && nProcess != ''){
          var nSect = nSect1.replace("&","@");
          var nSubSect = nSubSect1.replace("&","@");
            $.ajax({
              url: '../functions/process/admin_module.php?process=add_line&dept='+nDepts+'&sect='+nSect+'&subSect='+nSubSect+'&line='+nLine+'&model='+nCarModel+'&process1='+nProcess,
              method: 'get',
              success: function(response){
                Swal.fire({
                icon: 'info',
                showConfirmButton: false,
                showCloseButton: true,
                title: 'Added Department Item',
                text: response
              });
              $('#nSect').html('');
              $('#nSubSect').html('');
              $('#nLine').val('');
              $('#nCarModel').val('');
              $('#nProcess').val('');
                displayDepts();
                displayLine();
              },error: function(response){

              }
            });
        }else{
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error',
            text: 'Please complete form!',
            showConfirmButton: true,
          })
        }
    });

  // Functions
    // Display Sub Section of Selected Dept
    const displaySubSectA = (dept,sect) => {
      $.ajax({
        url: '../functions/display/common_department.php?data=m_deptSubSect&dept='+dept+'&sect='+sect,
        method: 'get',
        success: function(response){
          $('#nSubSect').html(response);
        },error: function(response){
        }
      });
    }

//  END ADDING LINE NAME SCRIPT 

//  UPDATE LINE NAME SCRIPT 
  
  // Add Line Name in Selected Dept Modal
    $('#btnAddDeptLine').click(function(){
      var aDepts = $('#aDepts').val();
      var aSect1 = $('#aSect').val();
      var aSubSect1 = $('#aSubSect').val();
      var aCarModel = $('#aCarModel').val();
      var aProcess = $('#aProcess').val();
      var aLine = $('#aLine').val();
      if(aDepts != '' && aSect != '' && aSubSect != '' && aCarModel != '' && aProcess != '' && aLine != ''){
        var aSect = aSect1.replace("&","@");
        var aSubSect = aSubSect1.replace("&","@");
        $.ajax({
          url: '../functions/process/admin_module.php?process=add_line&dept='+aDepts+'&sect='+aSect+'&subSect='+aSubSect+'&model='+aCarModel+'&process1='+aProcess+'&line='+aLine,
          method: 'get',
          success: function(response){
            Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Added Department Item',
              text: response
            });
            displayAFields(aDepts);
            deptLines(aDepts);
            $('#aCarModel').val('');
            $('#aProcess').val('');
            $('#aLine').val('');

          },error: function(response){

          }
        })
      }else{
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error',
            text: 'Please complete form!',
            showConfirmButton: true,
          })
        }
    });

  // Display Sub Section of Selected Dept
    $('#aSect').change(function(){
      var dept = $('#aDepts').val();
      var sect = $('#aSect').val();
      displaySubSect(dept,sect);
    });

  // Display Section of Selected Dept in Edit Line 
    $('#eDepts').change(function(){
      var dept = $(this).val();
      $.ajax({
        url: '../functions/display/common_department.php?data=m_deptSect&dept='+dept,
        method: 'get',
        success: function(response){
          $('#eSect').html(response);
          var b = $('#eSect').val();
          var sect = b.replace("&","@");
          displaySubSectB(dept,sect);
        },error: function(response){
          
        }
      });
    });
  
  // Display Sub Section of Selected Dept in Edit Line 
    $('#eSect').change(function(){
      var dept = $('#eDepts').val();
      var sect = $('#eSect').val();
      displaySubSectB(dept,sect);
    });

  //  Update Line Name in Dept Line Modal
    $('#btnUpdateLine').click(function(){
      var prev = $('#oLine').val();
      var newLine = $('#eLine').val();
      var eProcess = $('#eProcess').val();
      var eCarModel = $('#eCarModel').val();
      var eDepts = $('#eDepts').val();
      var eSect1 = $('#eSect').val();
      var eSubSect1 = $('#eSubSect').val();
      if(prev != '' && newLine != '' && eProcess != '' && eCarModel != '' && eDepts != '0' && eSect1 != '0' && eSubSect1 != '0'){
        var eSect = eSect1.replace("&","@");
        var eSubSect = eSubSect1.replace("&","@");
        Swal.fire({
          title: 'Are you sure?',
          text: "If you update the item. Affected employees will be updated too. You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: '../functions/process/admin_module.php?process=update_line_name&prev='+prev+'&dept='+eDepts+'&sect='+eSect+'&subSect='+eSubSect+'&model='+eCarModel+'&process1='+eProcess+'&line='+newLine,
                method: 'get',
                success: function(response){
                  // console.log(response);
                Swal.fire({
                  icon: 'info',
                  showConfirmButton: false,
                  showCloseButton: true,
                  title: 'Line Update Status',
                  text: response
                });
                $('#editLineMod').modal('toggle');
                $('#oLine').val('');
                $('#eLine').val('');
                $('#eProcess').val('');
                $('#eCarModel').val('');
                $('#eDepts').val('');
                $('#eSect').val('');
                $('#eSubSect').val('');
                viewLines(eDepts);
          },error: function(response){

          }
        })
            }
          });

      }else{
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error',
            text: 'Please complete form!',
            showConfirmButton: true,
        })
      }
    });


  // Functions
    // Department Line Module View Modal
      const viewLines = (x) => {
        $('#viewLineMod').modal();
        $('#ldept').text(x);
        $('#aDepts').val(x);
        displayAFields(x);
        deptLines(x);
      }

    // Display Additional Line in Department Selected
    const displayAFields = (x) => {
      $.ajax({
        url: '../functions/display/common_department.php?data=m_deptSect&dept='+x,
        method: 'get',
        success: function(response){
          $('#aSect').html(response);
          var y = $('#aSect').val();
          var sect = y.replace("&","@");
          $.ajax({
            url: '../functions/display/common_department.php?data=deptSubSect&dept='+x+'&sect='+sect,
            method: 'get',
            success: function(response){
              console.log(response);
              $('#aSubSect').html(response);
            },error: function(response){
            }
          });
        },error: function(response){
        }
      });
    }

    // Display Additional Line in Department Selected in the modal
      const deptLines = (x) => {
        var table = $('#deptLineTbl').DataTable();
        table.destroy();
        $.ajax({
          url: '../functions/display/admin_module.php?data=li_dept_line&dept='+x,
          method: 'get',
          success: function(response){
            $('#tblDeptLine').html(response);
            $('#deptLineTbl').DataTable();
            $('.dataTables_length').addClass('bs-select');
          },error: function(response){
            
          }
        });
      }

    // Display SubSection in Department Modal
      const displaySubSect = (x,y) => {
        var sect = y.replace("&","@");
        $.ajax({
          url: '../functions/display/common_department.php?data=m_deptSubSect&dept='+x+'&sect='+sect,
          method: 'get',
          success: function(response){
            $('#aSubSect').html(response);
          },error: function(response){
          }
        });
      }

      const displaySubSectB = (x,y) => {
        var sect = y.replace("&","@");
        $.ajax({
          url: '../functions/display/common_department.php?data=m_deptSubSect&dept='+x+'&sect='+sect,
          method: 'get',
          success: function(response){
            console.log(response);
            $('#eSubSect').html(response);
          },error: function(response){
          }
        });
      }

    // Display Line Modal
      const editLine = (x) => {
        $('#editLineMod').modal();
        $('#lineI').text(x);
        $('#oLine').val(x);
        $('#eLine').val(x);
        displayLineDept(x);
      }

    // Display Line info 
      const displayLineDept = (x) => {
        $.ajax({
          url: "../functions/display/admin_module.php?data=line_details&line="+x,
          method: "get",
          dataType:"json",
          success: function(data){
            // console.log(data);
              $('#eProcess').val(data.process);
              $('#eCarModel').val(data.carModel);
              $.ajax({
                url: '../functions/display/common_department.php?data=a_m_department',
                method: 'get',
                success: function(response){
                  $('#eDepts').html(response);
                  $('#eDepts').val(data.dept);
                },error: function(response){
                  
                }
              });
              $.ajax({
                url: '../functions/display/common_department.php?data=m_deptSect&dept='+data.dept,
                method: 'get',
                success: function(response){
                  $('#eSect').html(response);
                  $('#eSect').val(data.section);
                },error: function(response){
                }
              });
              var y = data.section;
              var sect = y.replace("&","@");
              $.ajax({
                url: '../functions/display/common_department.php?data=m_deptSubSect&dept='+data.dept+'&sect='+sect,
                method: 'get',
                success: function(response){
                  console.log(response);
                  $('#eSubSect').html(response);
                  $('#eSubSect').val(data.subSect);
                },error: function(response){
                }
              });
              

          },error: function(response){
          }
        });
      }

//  END UPDATE LINE NAME SCRIPT

// DELETE LINE NAME
    const deleteLine = (x,y) => {
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
              url: '../functions/process/admin_module.php?process=delete_line&line='+x,
              method: 'get',
              success: function(response){
                Swal.fire({
                  icon: 'info',
                  showConfirmButton: false,
                  showCloseButton: true,
                  title: 'Added Department Item',
                  text: response
                });
                viewLines(y);
              },error: function(response){
                
              }
            });
          }
        });
    }
        
</script>
</body>
</html>