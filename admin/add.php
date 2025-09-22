
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    
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
        <p>You don't have permission to add a admin.</p>
        <hr>
        <a href='list.php' class='btn btn-primary'>Back to List</a>
      </div>
    </body>
    </html>");
}








if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO admin (name, phone, department_id) VALUES (?,?,?)");
    $stmt->execute([$_POST['name'], $_POST['phone'], $_POST['department_id']]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark primary">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Add Admin</h2>
    <form method="post">
      <div class="mb-3"><label>Name</label><input class="form-control" name="name" required></div>
      <div class="mb-3"><label>Phone</label><input class="form-control" name="phone" required></div>
      <div class="mb-3"><label>Department ID</label><input type="number" class="form-control" name="department_id" required></div>
      <div class="text-center">
        <button class="btn btn-primary">Save</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>