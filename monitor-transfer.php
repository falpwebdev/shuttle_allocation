<?php
  include 'db/config.php';
  set_time_limit(0);
?>
<!DOCTYPE html>
<html>
<head>
  <title>SAS - Auto Transfer Employee</title>
  <?php
    include 'src/style.php';
  ?>
</head>
<body>
<?php
   include 'modals/processingUI.php';
?>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <h2 class="card-title text-center">Transferring Monitoring</h2>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th>Employee</th>
                    <th>Date Transfered</th>
                    <th>Date to return</th>
                    <th>Filed By</th>
                    <th>Return Details</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody id="dat">
                </tbody>
              </table>
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
<script>
  var openCount = 0;
  $(document).ready(function(){
    transferDetails();
  });
  // Generate Table
    const transferDetails = () => {
      $.ajax({
        url: 'functions/display/auto_transfer.php?data=transfer_details',
        method: 'get',
        success: function(response){
          $('#dat').html(response);
          countTransfer();
        },error: function(response){
        }
      });
    }
  // Count MP for Transfer
    const countTransfer = () => {
      console.log('running count');
        $.ajax({
          url: 'functions/process/auto_transfer.php?process=check_transfer',
          method: 'get',
          success: function(response){
            if(response >= '1'){
              openCount = response;
              transferMP();
            }else if(response == '0'){
              setTimeout(function(){ transferDetails() }, 10000);
              // console.log(openCount);
            }
          },error: function(response){
          }
        });
      }
  // Transfer MP
    const transferMP = () => {
      console.log('transferring mp');
      var count = 0;
        // Status
          $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
          var arrayCount = openCount;
          $('#processingProgress').attr('aria-valuemax',arrayCount);
        // Process Table
          $('#dat>tr').each(function(){
            var listID = $(this).attr('id');
            $.ajax({
              url: 'functions/process/auto_transfer.php?process=return_transfer&listId='+listID,
              method: 'get',
              success: function(response){
                count = count + 1;
                $('#status').text(response);
                    var percent = (count / arrayCount) * 100;
                    $('#processingProgress').attr('aria-valuemax',count).css('width', percent+'%');
                    $('#count').text(count+' transferred.');
                    if(count == arrayCount){
                      done();
                    }
              },error: function(response){
              }
            });
          });
    }
  //  Repeat Process
    const done = () => {
      $('.modal-backdrop').remove();
      $('#processingStatMod').modal('toggle');
      transferDetails();
    }
</script>
</body>
</html>
