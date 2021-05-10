<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-light red lighten-4">
  <a class="navbar-brand" href="#">Shuttle Allocation System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="user-shuttle.php" id="navHome">Shuttle Allocation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-department.php" id="navDept">Department</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin-agency.php" id="navEmp">Employees</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <!-- <a class="dropdown-item" href="#">Announcements/Memo</a> -->
          <!-- <a class="dropdown-item" href="#">Change Password</a> -->
          <a class="dropdown-item" href="functions/process/system_login.php?logOut=<?=$_SESSION['empName'] ?>">Logout (<?=$_SESSION['empName'] ?>)</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->