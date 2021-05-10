<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-light red lighten-4">
  <a class="navbar-brand" href="#">Shuttle Allocation System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav ml-auto">
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-shuttle.php" id="navHome">Shuttle Allocation</a>
          <span class="sr-only">(current)</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-department.php" id="navDept">Department</a>
      </li>
      <!-- Notif Bar -->
        <li class="nav-item dropdown" onclick="notifs();">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" onclick="readNotif();">
            <i class="fas fa-bell"></i>
            <span class="badge badge-danger notifNum"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-default rems"
            aria-labelledby="navbarDropdownMenuLink-333" style="width:500;height:500px;overflow:scroll;" onmouseleave="notifs();">
          </div>
        </li>
      <!-- User Bar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="user-out-modify.php">Modify Outgoing</a>
          <a class="dropdown-item" href="user-submitted.php">View Submitted Outgoing</a>
          <!-- <a class="dropdown-item" href="#">Announcements/Memo</a> -->
          <a class="dropdown-item" href="functions/process/system_login.php?logOut=<?=$_SESSION['empName'] ?>">Logout (<?=$_SESSION['empName'] ?>)</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->