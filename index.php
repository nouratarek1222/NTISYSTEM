
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NTI System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    .bg {
      /* الخلفية */
      background: url('image/OIP.webp') no-repeat center center fixed;
      background-size: cover;
      height: 100%;
      position: relative;
    }
    .overlay {
      background-color: rgba(0, 0, 0, 0.5); 
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
    }
    .navbar-custom {
      background-color: rgba(21, 23, 49, 1); /* كحلي شفاف */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">NTI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">Doctors</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Students</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Employees</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Departments</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Admins</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="bg">
    <div class="overlay">
      <h1>Welcome to NTI</h1>
      <p> Under the supervision of Engineer Islam Ramadan</p>
      <a href="login.php" class="btn btn-primary btn-lg mt-3">Login</a>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>




