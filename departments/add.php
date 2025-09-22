
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

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
        <p>You don't have permission to add a department.</p>
        <hr>
        <a href='list.php' class='btn btn-primary'>Back to List</a>
      </div>
    </body>
    </html>");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO departments (name, location) VALUES (?, ?)");
    $stmt->execute([$_POST['name'], $_POST['location']]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Department</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #021324;; font-family:'Segoe UI',sans-serif; }
    .table-container { background: white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(201, 70, 70, 0.1); margin-top:40px; }
    h2 { margin:50px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
body class="bg- #">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-4" style="max-width:500px; margin: Auto;">
 
<h2 class="text-dark text-center mb-4">Add Department</h2>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label>Location</label>
        <input class="form-control" name="location" required>
      </div>
      <div class="text-center">
        <button class="btn btn-primary">Save</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>


