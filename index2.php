<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NTI System - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {height: 100%; margin: 0;}
    .bg {
      background: url('image/OIP.webp') no-repeat center center fixed;
      background-size: cover;
      height: 100%;
      position: relative;
    }
    .overlay {
      background-color: rgba(0,0,0,0.5);
      position: absolute; top:0; left:0;
      width: 100%; height: 100%;
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      color: white; text-align:center;
    }
    .navbar-custom {
      background-color: rgba(2, 2, 19, 0.9);
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="index2.php">NTI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <!-- Doctors -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="doctorsDropdown" role="button" data-bs-toggle="dropdown">
            Doctors
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="doctors/list.php">List</a></li>
            <li><a class="dropdown-item" href="doctors/add.php">Add</a></li>
           <li class="nav-item">
               <a class="nav-link" href="doctors/list.php">Doctors</a>
                </li> 
          </ul>
        </li>

        <!-- Students -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="studentsDropdown" role="button" data-bs-toggle="dropdown">
            Students
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="students/list.php">List</a></li>
            <li><a class="dropdown-item" href="students/add.php">Add</a></li>
          </ul>
        </li>

        <!-- Departments -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="departmentsDropdown" role="button" data-bs-toggle="dropdown">
            Departments
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="departments/list.php">List</a></li>
            <li><a class="dropdown-item" href="departments/add.php">Add</a></li>
          </ul>
        </li>

        <!-- Courses -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="coursesDropdown" role="button" data-bs-toggle="dropdown">
            Courses
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="courses/list.php">List</a></li>
            <li><a class="dropdown-item" href="courses/add.php">Add</a></li>
          </ul>
        </li>

        <!-- Employees -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="employeesDropdown" role="button" data-bs-toggle="dropdown">
            Employees
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="employees/list.php">List</a></li>
            <li><a class="dropdown-item" href="employees/add.php">Add</a></li>
          </ul>
        </li>

        <!-- Admins -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="adminsDropdown" role="button" data-bs-toggle="dropdown">
            Admins
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="admin/list.php">List</a></li>
            <li><a class="dropdown-item" href="admin/add.php">Add</a></li>
          </ul>
        </li><!-- Logout -->
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="bg">
  <div class="overlay">
    <h1>Welcome to NTI System</h1>
    <p>Logged in as: <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)</p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




