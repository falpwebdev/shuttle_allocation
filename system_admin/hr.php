<!DOCTYPE html>
<html>
<head>
  <title>SAS Admin - HR Masterlist</title>
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
  include 'modals/editOutGoing.php';
  include 'modals/editWorkS.php';
  include 'modals/editAgency.php';
  include 'modals/editPosition.php';
  include 'modals/viewDept.php';
  include 'modals/editDeptItem.php';
?>
  <h2 class="card-title text-white z-depth-5  mdb-color lighten-3">SAS Admin</h2>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-2 mb-2">
              <a href="index.php" class="btn btn-sm mdb-color lighten-3 text-white"><i class="fas fa-arrow-left"></i> Main Menu</a>
            </div>
          </div>
          <div class="row">
            <!-- Agency -->
            <div class="col-lg-6">
              <p class="note note-success d-flex justify-content-start text-uppercase">Agency Masterlist</p>
              <div class="form-row">
                <div class="col">
                  <label for="aCode">Agency Code</label>
                  <input type="text" class="form-control" id="aCode">
                </div>
                <div class="col">
                  <label for="aName">Agency Name</label>
                  <input type="text" class="form-control" id="aName">
                </div>
              </div>
              <button id="addAgency" class="btn-sm btn-primary mt-1">Add Agency</button>
              <table class="table table-sm table-bordered table-hovered table-borderedtext-center" id="agencyTbl">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center">Agency</th>
                  </tr>
                  <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="tblAgency">
                </tbody>
              </table>
            </div>
            <!-- Position -->
            <div class="col-lg-6">
              <p class="note note-success d-flex justify-content-start text-uppercase">Position Masterlist</p>
              <div class="form-row">
                <div class="col">
                  <label for="position">New Position</label>
                  <input type="text" class="form-control" id="position">
                </div>
                <div class="col">
                  <label for="special">Choose Position Type </label>
                    <select class="browser-default custom-select" id="special">
                      <option value="0" selected>Select Type</option>
                      <option value="Y">For Agency Only</option>
                      <option value="N">For FAS Only</option>
                      <option value="O">Applicable for All</option>
                    </select>
                </div>
              </div>
              <button id="addPosition" class="btn-sm btn-primary mt-1">Add Position</button>
              <table class="table table-sm table-bordered table-hovered table-borderedtext-center" id="positionTbl">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center">Position</th>
                  </tr>
                  <tr>
                    <th>Position</th>
                    <th>Special</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="tblPosition">
                </tbody>
              </table>
            </div>
            <!--  -->
            <div class="col-lg-12">
              <p class="note note-success d-flex justify-content-start text-uppercase">Department Masterlist</p>
              <div class="form-row">
                <div class="col">
                  <label for="dCode">Department Code</label>
                  <input type="text" class="form-control" id="dCode">
                </div>
                <div class="col">
                  <label for="dName">Department Name</label>
                  <input type="text" class="form-control" id="dName">
                </div>
                <div class="col">
                  <label for="dSection">Department Section</label>
                  <input type="text" class="form-control" id="dSection">
                </div>
                <div class="col">
                  <label for="dSubSection">Department Sub-Section</label>
                  <input type="text" class="form-control" id="dSubSection">
                </div>
                <div class="col">
                  <label for="dType">Type</label>
                  <select class="browser-default custom-select" id="dType">
                    <option selected value="0">Select Type</option>
                    <option value="No">For FAS</option>
                    <option value="Yes">For Agency</option>
                  </select>
                </div>
              </div>
              <button id="addDept" class="btn-sm btn-primary mt-1">Add Deparment</button>
              <table class="table table-sm table-bordered table-hovered table-borderedtext-center" id="deptTbl">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center">Department</th>
                  </tr>
                  <tr>
                    <th>Code</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody id="tblDept">
                </tbody>
              </table>
            </div>
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
  displayAgency();
  displayPosition();
  displayDept();
  // viewDept('ACC','N/A');
});

$('#addAgency').click(function(){
  var code = $('#aCode').val();
  var name = $('#aName').val();
  if(code != '' || name != ''){
    $.ajax({
      url: '../functions/process/admin_module.php?process=add_agency&code='+code+'&name='+name,
      method: 'get',
      success: function(response){
        Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Adding Status',
              text: response
            });
            $('#aCode').val('');
            $('#aName').val('');
            displayAgency();
      },error: function(response){

      }
    });
  }else{
    Swal.fire({
      icon: 'error',
      showConfirmButton: true,
      showCloseButton: true,
      title: 'Error',
      text: 'Please complete form.'
    });
  }
});

$('#btnUpdateAgency').click(function(){
 var oldAgencyCode = $('#oldAgencyCode').val();
 var nAgencyCode = $('#nAgencyCode').val();
 var nAgencyName = $('#nAgencyName').val();
  $.ajax({
      url: '../functions/process/admin_module.php?process=edit_agency&prev='+oldAgencyCode+'&code='+nAgencyCode+'&name='+nAgencyName,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Updated Out',
            text: response
          });
          $('#oldAgencyCode').val('');
          $('#nAgencyCode').val('');
          $('#nAgencyName').val('');
          $('#updateAgency').modal('toggle');
          displayAgency();
      },error: function(response){

      }
  });
});

$('#addPosition').click(function(){
  var position = $('#position').val();
  var special = $('#special').val();
  console.log(position+''+special);
  if(special != '0' || position != ''){
    $.ajax({
    url: '../functions/process/admin_module.php?process=add_position&position='+position+'&special='+special,
    method: 'get',
      success: function(response){
        Swal.fire({
          icon: 'info',
          showConfirmButton: false,
          showCloseButton: true,
          title: 'Adding Status',
          text: response
        })
        $('#position').val('');
        $('#special').val('0');
        displayPosition();
      },error: function(response){

      }
    })
  }else{
    Swal.fire({
      icon: 'error',
      showConfirmButton: true,
      showCloseButton: true,
      title: 'Error',
      text: 'Please complete form.'
     });
  }
  

});

$('#btnUpdatePosition').click(function(){
 var oldPosition = $('#oldPosition').val();
 var nPosition = $('#nPosition').val();
 var nSpecial = $('#nSpecial').val();
 $.ajax({
      url: '../functions/process/admin_module.php?process=edit_position&prev='+oldPosition+'&position='+nPosition+'&special='+nSpecial,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Updated Position',
            text: response
          });
          $('#oldPosition').val('');
          $('#nPosition').val('');
          $('#nSpecial').val('0');
          $('#updatePosMod').modal('toggle');
          displayPosition();
      },error: function(response){

      }
  });
});

$('#btnAddDeptItem').click(function(){
  var dept1 = $('#deptC').text();
    var dept = dept1.replace("&","@");
  var name1 = $('#deptN').text();
    var name = name1.replace("&","@");
  var aDeptSect1 = $('#aDeptSect').val();
    var aDeptSect = aDeptSect1.replace("&","@");
  var aDeptSub1 = $('#aDeptSub').val();
    var aDeptSub = aDeptSub1.replace("&","@");
  var selType = $('#selType').val();
  if(dept != '' && name != '' && aDeptSect != '' && selType != '0' && aDeptSub != ''){
    $.ajax({
      url: '../functions/process/admin_module.php?process=add_dept_item&deptCode='+dept+'&deptName='+name+'&section='+aDeptSect+'&subSect='+aDeptSub+'&type='+selType,
      method: 'get',
      success: function(response){
        console.log(response);
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Added Department Item',
            text: response
          });
          $('#deptC').text('');
          $('#deptN').text('');
          $('#aDeptSect').val('');
          $('#aDeptSub').val('');
          $('#selType').val('0');
          viewDept(dept,name);
          displayDept();
      },error: function(response){
        
      }
    });
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Please complete form.',
    });
  }
});

$('#btnUpdateItem').click(function(){
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
      var listID = $('#listID').val();
      var dept1 = $('#dept').val();
      var deptName1 = $('#deptName').val();
      var deptSection1 = $('#deptSection').val();
      var subSect1 = $('#subSect').val();

      var dept = dept1.replace("&","@");
      var deptName = deptName1.replace("&","@");
      var deptSection = deptSection1.replace("&","@");
      var subSect = subSect1.replace("&","@");

      var deptType = $('#deptType').val();
      $.ajax({
        url: '../functions/process/admin_module.php?process=update_dept_item&itemNo='+listID+'&deptCode='+dept+'&deptSection='+deptSection+'&subSect='+subSect+'&deptType='+deptType+'&deptName='+deptName,
        method: 'get',
        success: function(response){
          // console.log(response);
          Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Update Department Item Agency',
              text: response
          });
            displayDeptDetails(dept);
            $('#editDeptItem').modal('toggle');
        },error: function(response){

        }
      });
    }
  })
  
});

$('#addDept').click(function(){
  var nDept1 = $('#dCode').val();
  var nDept = nDept1.replace("&","@");
  var nName1 = $('#dName').val();
  var nName = nName1.replace("&","@");
  var nSect1 = $('#dSection').val();
  var nSect = nSect1.replace("&","@");
  var nSubSect1 = $('#dSubSection').val();
  var nSubSect = nSubSect1.replace("&","@");
  var nType1 = $('#dType').val();
  var nType = nType1.replace("&","@");
  $.ajax({
    url: '../functions/process/admin_module.php?process=add_department&deptCode='+nDept+'&deptName='+nName+'&deptSect='+nSect+'&subSect='+nSubSect+'&type='+nType,
    method: 'get',
    success: function(response){
      // console.log(response);
      Swal.fire({
        icon: 'info',
        showConfirmButton: false,
        showCloseButton: true,
        title: 'Added Department Item',
        text: response
      });
      $('#dCode').val('');
      $('#dName').val('');
      $('#dSection').val('');
      $('#dSubSection').val('');
      $('#dType').val('0'); 
      displayDept();
    },error: function(response){
      
    }
  })
});

const displayAgency = () => {
  var table = $('#agencyTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_agency',
    method: 'get',
    success: function(response){
      $('#tblAgency').html(response);
      $('#agencyTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  })
}

const editAgency = (x) => {
  $('#updateAgency').modal();
  var data = x.split("@");
  var aCode = data[0];
  var aName = data[1];
  $('#oldAgencyCode').val(aCode);
  $('#nAgencyCode').val(aCode);
  $('#nAgencyName').val(aName);
}

const deleteAgency = (x) => {
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
        url: '../functions/process/admin_module.php?process=delete_agency&item='+x,
        method: 'get',
        success: function(response){
          Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Deleted Agency',
              text: response
            });
            displayAgency();
        },error: function(response){

        }
      });
    }
  })
}

const displayPosition = () => {
  var table = $('#positionTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_position',
    method: 'get',
    success: function(response){
      // console.log(response);
      $('#tblPosition').html(response);
      $('#positionTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  });
}

const editPosition = (x) => {
  $('#updatePosMod').modal();
  var data = x.split("@");
  var pPosition = data[0];
  var pSpecial = data[1];
  $('#oldPosition').val(pPosition);
  $('#nPosition').val(pPosition);
  $('#nSpecial').val(pSpecial);
}

const deletePosition = (x) => {
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
        url: '../functions/process/admin_module.php?process=delete_position&item='+x,
        method: 'get',
        success: function(response){
          Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Deleted Position',
              text: response
            });
            displayPosition();
        },error: function(response){

        }
      });
    }
  })
}

const displayDept = () => {
  var table = $('#deptTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_department',
    method: 'get',
    success: function(response){
      $('#tblDept').html(response);
      $('#deptTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  });
}

const viewDept = (x,y) => {
  $('#deptDetails').modal();
  $('#deptC').text(x);
  $('#deptN').text(y);
  displayDeptDetails(x);
  displaySection(x);
}

const displayDeptDetails = (x) => {
  var table = $('#deptDetTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_dept_details&dept='+x,
    method: 'get',
    success: function(response){
      $('#TblDeptDet').html(response);
      $('#deptDetTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  });
}

const displaySection = (x) => {
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_dept_sect&dept='+x,
    method: 'get',
    success: function(response){
      $('#sections').html(response);
      $('#eSections').html(response);

    },error: function(response){
      
    }
  });
}

const editDeptColumn = (code,deptCode,deptName,section,subSect,special) => {
  $('#editDeptItem').modal();
  $('#listID').val(code);
  $('#deptName').val(deptName);
  $('#deptI').text(deptCode+' > '+section+' > '+subSect);
  displayEDept(deptCode);
  displaySect(deptCode,section);
  $('#subSect').val(subSect);
  $('#deptType').val(special);
}

const displayEDept = (deptCode) => {
  $.ajax({
    url: '../functions/display/common_department.php?data=ma_department',
    method: 'get',
    success: function(response){
      $('#dept').html(response);
      $('#dept').val(deptCode);
      
    },error: function(){

    }
  });
}

const displaySect = (deptCode,section) => {
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_dept_sect&dept='+deptCode,
    method: 'get',
    success: function(response){
      $('#eSections').html(response);
      $('#deptSection').val(section);
    },error: function(response){
      
    }
  });
}

</script>
</body>
</html>


          

