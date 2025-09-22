
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// لو هو user يطلع رسالة خطأ
if ($_SESSION['role'] == 'user') {
    die("<!doctype html>
    <html lang='en'>
    <head>
      <meta charset='utf-8'>
      <title>Access Denied</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='d-flex align-items-center justify-content-center vh-100 bg-light'>
      <div class='alert alert-danger text-center' style='max-width:500px;'>
        <h4 class='alert-heading'>Access Denied 🚫</h4>
        <p>You don't have permission to add a doctor.</p>
        <hr>
        <a href='list.php' class='btn btn-primary'>Back to List</a>
      </div>
    </body>
    </html>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO doctors (name, address, age, salary, gender) VALUES (?,?,?,?,?)");
    $stmt->execute([$_POST['name'], $_POST['address'], $_POST['age'], $_POST['salary'], $_POST['gender']]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Doctor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #070f31ff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-container {
      background: #d2d7e4ff;
      margin: 50px auto;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      max-width: 500px;
    }
    h2 {
      color: #141414ff;
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
    }
    .btn-success { background-color: #271bccff; border: none; }
    .btn-success:hover { background-color: #e2df26ff; }
    .btn-secondary { margin-left: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <h2>Add Doctor</h2>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <input class="form-control" name="address" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Age</label>
          <input type="number" class="form-control" name="age" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Salary</label>
          <input type="number" class="form-control" name="salary" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Gender</label>
          <select class="form-control" name="gender" required>
            <option value="" disabled selected>Choose gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="text-center">
          <button class="btn btn-success">💾 Save</button>
          <a href="list.php" class="btn btn-secondary">↩ Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
