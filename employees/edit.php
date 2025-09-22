<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id=?");
$stmt->execute([$id]);
$employee = $stmt->fetch();
if (!$employee) die("Employee not found");

$departments = $pdo->query("SELECT id, name FROM departments")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE employees SET name=?, address=?, age=?, salary=?, gender=?, department_id=? WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['address'],
        $_POST['age'],
        $_POST['salary'],
        $_POST['gender'],
        $_POST['department_id'],
        $id
    ]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Employee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Edit Employee</h2>
    <form method="post">
      <div class="mb-3"><label>Name</label><input class="form-control" name="name" value="<?=htmlspecialchars($employee['name'])?>" required></div>
      <div class="mb-3"><label>Address</label><input class="form-control" name="address" value="<?=htmlspecialchars($employee['address'])?>" required></div>
      <div class="mb-3"><label>Age</label><input type="number" class="form-control" name="age" value="<?=htmlspecialchars($employee['age'])?>" required></div>
      <div class="mb-3"><label>Salary</label><input type="number" class="form-control" name="salary" value="<?=htmlspecialchars($employee['salary'])?>" required></div>
      <div class="mb-3">
        <label>Gender</label>
        <select class="form-control" name="gender" required>
          <option value="Male" <?= $employee['gender']=='Male'?'selected':'' ?>>Male</option>
          <option value="Female" <?= $employee['gender']=='Female'?'selected':'' ?>>Female</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Department</label>
        <select class="form-control" name="department_id" required>
          <?php foreach ($departments as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $employee['department_id']==$d['id']?'selected':'' ?>>
              <?= htmlspecialchars($d['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="text-center">
        <button class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>