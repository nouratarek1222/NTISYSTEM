

<?php
// ربط قاعدة البيانات
$conn = new mysqli('localhost','root','','university');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Navbar */
nav {
    background-color: #d9d9d9; /* اللون الرمادي للـ navbar */
}
.navbar-brand, .nav-link, .dropdown-item {
    color: #000 !important; /* اللون الأسود للنص */
}


/* اجعل كل النصوص فوق الصورة */
body > * {
    position: relative;
    z-index: 1;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="../index.php">Nti</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <!-- Doctors -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Doctors</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../doctors/add.php">Add Doctor</a></li>
            <li><a class="dropdown-item" href="../doctors/list.php">List Doctors</a></li>
          </ul>
        </li>

        <!-- Students -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Students</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../students/add.php">Add Student</a></li>
            <li><a class="dropdown-item" href="../students/list.php">List Students</a></li>
          </ul>
        </li>

        <!-- Courses -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Courses</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../courses/add.php">Add Course</a></li>
            <li><a class="dropdown-item" href="../courses/list.php">List Courses</a></li>
          </ul>
        </li>

        <!-- Departments -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Departments</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../departments/add.php">Add Department</a></li>
            <li><a class="dropdown-item" href="../departments/list.php">List Departments</a></li>
          </ul>
        </li>

        <!-- Employees -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Employees</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../employees/add.php">Add Employee</a></li>
            <li><a class="dropdown-item" href="../employees/list.php">List Employees</a></li>
          </ul>
        </li>

        <!-- Admin -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../admin/add.php">Add Admin</a></li>
            <li><a class="dropdown-item" href="../admin/list.php">List Admin</a></li>
          </ul>
        </li></ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



