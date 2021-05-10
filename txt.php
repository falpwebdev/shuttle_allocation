<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<button onclick="check4();">Click Me!</button><br>
<input type="radio" class="custom-control-input check4" id="emp19-05013T4:00" value="4:00" name="emp19-05013">
<label class="custom-control-label" for="emp19-05013T4:00">4:00</label>

<?php
  include 'src/script.php';
?>
<script>
  function check4(){
    // $('#emp19-05013T4:00').prop('checked','checked');
    document.getElementsByClassName('check4').checked = true;
  }
</script>
</body>
</html>