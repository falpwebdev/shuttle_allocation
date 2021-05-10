<script>
  // Notif Count
    const notifNum = () => {
      var x = '<?=$handle?>';
      var data = x.replace("&","@");
      $.ajax({
        url: 'functions/process/realtime_count.php?process=unreadNotif_count&handle='+data,
        method: 'get',
        success: function(response){
          // console.log(response);
          $('.notifNum').text(response);
        },error: function(response){
          // console.log(response);
        }

      });
    }
  // Display Notif
    const notifs = () => {
      var x = '<?=$handle?>';
      var data = x.replace("&","@");
      $.ajax({
        url: 'functions/display/common_user.php?data=user_notifs&handle='+data,
        method: 'get',
        success: function(response){
          // console.log(response)
          notifNum();
          $('.rems').html(response);
        },error: function(response){

        }
      })
    }
  //  Read Notif
    const readNotif = () => {
      var x = '<?=$handle?>';
      var data = x.replace("&","@");
      $.ajax({
        url: 'functions/process/realtime_count.php?process=readNotif_count&handle='+data,
        method: 'get',
        success: function(response){
          $('.notifNum').text(response);
        },error: function(response){

        }
      });
    }
</script>