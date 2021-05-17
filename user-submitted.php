<?php
date_default_timezone_set('Asia/Manila');

?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - View Submitted Outgoing</title>
<?php
  include 'db/config.php';
  include 'src/style.php';
?>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card mt-2">
        <h6 class="card-title text-center font-weight-bold mt-3 text-uppercase">Submitted Shuttle Allocation Outgoing Data</h6>
        <div class="card-body">
          <div class="form-row">
            <div class="col-5">
              <!-- SELECT FILED FOR  -->
              <select class="browser-default custom-select" id="filedItem">
                <option selected value="0">Select Filed For</option>
              </select>
            </div>
            <div class="col-5">
              <select class="browser-default custom-select" id="dateFiled">
                  <option selected value="0">Select Filed For First</option>
              </select>
            </div>
            <div class="col">
              <button class="btn btn-sm btn-danger" id="btnExportSummary"><i class="fas fa-download"></i> Export Summary</button>
            </div>
          </div>
          <div id="summary">
            <div class="row">
              <div class="col-lg-12 mt-2">
                <p class="note note-primary"><strong>Submitted Outgoing Report of:</strong> <span id="details"></span></span></p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="outGoing">
                </div>
                <div class="absent">
                </div>
                <div class="filers">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
?>
<script type="text/javascript">
$(document).ready(function(){
  // Nav
    $('#navHome').addClass('font-weight-bold');
    $('#navHome').css('color','#CC0000');
  //  Display
   displayFileds();
});
//  Display Select Filed For
  const displayFileds = () => {
    $.ajax({
      url: 'functions/display/user_submitted.php?data=fileds',
      method: 'get',
      success: function(response){
        $('#filedItem').html(response);
      },error: function(response){
      }
    });
  }
// Display Select Filing For 
  $('#filedItem').change(function(){
    var filedFor = $(this).val();
    filedFor = filedFor.replace("&","@");
    $.ajax({
      url: 'functions/display/user_submitted.php?data=filedFor&filed='+filedFor,
      method: 'get',
      success: function(response){
        $('#dateFiled').html(response);
      },error: function(response){

      }
    });
  });
//  Display Select Filing Details
  $('#dateFiled').change(function(){
    var filedDate = $(this).val();
    filedDate = filedDate.replace("&","@");
    // Details
      $.ajax({
        url: 'functions/display/user_submitted.php?data=filingDetails&type=details&filed='+filedDate,
        method: 'get',
        success: function(response){
          $('#details').text(response);
        },error: function(response){
        }
      });
    // Get Ougtgoing
      $.ajax({
        url: 'functions/display/user_submitted.php?data=filingDetails&type=outGoing&filed='+filedDate,
        method: 'get',
        success: function(response){
          $('.outGoing').html(response);
          $('#tblOutGoing').DataTable();
        },error: function(response){
        }
      });
    // Get Absent
      $.ajax({
        url: 'functions/display/user_submitted.php?data=filingDetails&type=absent&filed='+filedDate,
        method: 'get',
        success: function(response){
          $('.absent').html(response);
          $('#tblAbsent').DataTable();
        },error: function(response){
        }
      });
    // Get Filers
      $.ajax({
        url: 'functions/display/user_submitted.php?data=filingDetails&type=filers&filed='+filedDate,
        method: 'get',
        success: function(response){
          $('.filers').html(response);
          $('#tblFilers').DataTable();
        },error: function(response){
        }
      });
  });
// Generate Report
  $('#btnExportSummary').click(function (e) {
    // Destory Table
        var tblOutGoing = $('#tblOutGoing').DataTable();
        var tblAbsent = $('#tblAbsent').DataTable();
        var tblFilers = $('#tblFilers').DataTable();
        tblOutGoing.destroy();
        tblAbsent.destroy();
        tblFilers.destroy();
    // Generate Report
      window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=summary]').html()));
      e.preventDefault();
    // Restore Table
      $('#tblOutGoing').DataTable();
        $('#tblAbsent').DataTable();
        $('#tblFilers').DataTable();
  });
</script>
</body>
</html>