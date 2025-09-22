
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
        <p>You don't have permission to add a employee.</p>
        <hr>
        <a href='list.php' class='btn btn-primary'>Back to List</a>
      </div>
    </body>
    </html>");
}

$departments = $pdo->query("SELECT id, name FROM departments")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO employees (name, address, age, salary, gender, department_id) VALUES (?,?,?,?,?,?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['address'],
        $_POST['age'],
        $_POST['salary'],
        $_POST['gender'],
        $_POST['department_id']
    ]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Add Employee</h2>
    <form method="post">
      <div class="mb-3"><label>Name</label><input class="form-control" name="name" required></div>
      <div class="mb-3"><label>Address</label><input class="form-control" name="address" required></div>
      <div class="mb-3"><label>Age</label><input type="number" class="form-control" name="age" required></div>
      <div class="mb-3"><label>Salary</label><input type="number" class="form-control" name="salary" required></div>
      <div class="mb-3">
        <label>Gender</label>
        <select class="form-control" name="gender" required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Department</label>
        <select class="form-control" name="department_id" required>
          <?php foreach ($departments as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
          <?php endforeach; ?>
        </select>
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