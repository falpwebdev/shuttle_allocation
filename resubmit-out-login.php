<!DOCTYPE html>
<html>
<head>
<title>Modify Outgoing Data</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6 animated fadeInUp" id="sec">
                <div class="card">
                    <div class="card-body">
                        <p class="note note-primary"><strong>Note: </strong>Go to Admin to request for code to edit Shuttle Allocation Outgoing Data and input here.
                        </p>
                        <p class="note note-danger"><strong>Deadline:</strong> Changing of Shuttle Allocation after cut-off is until 5:00 am/pm only. If changes occur after 5:00 am/pm, you need to submit <a href="functions/templates/Modify Outgoing Data.xlsx">this</a> file to GA.  
                        </p>
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-6 mt-3">
                                <input type="text" id="code" name="code" class="form-control" placeholder="Enter Code">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
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
    $(document).ready(function(){
    });
    
    $('#btnSubmit').click(function(){
        let code = $('#code').val();
        $.getJSON('functions/additional-proc.php?process=checkCode&code='+code, function(data) {
            if(data == false){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'The code you enter does not exist or already used! Go to Admin.',
                    showConfirmButton: false,
                    timer: 2000
                })
            }else{
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
    
                swalWithBootstrapButtons.fire({
                    title: 'Hi '+data.name+', ',
                    text: 'Update '+data.item+' on '+data.date,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm Modification',
                    cancelButtonText: 'Request new',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = 'resubmit-outgoing.php?code='+code;
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                         )
                        }
                })
            }
    });
    });
</script>
</body>
</html>