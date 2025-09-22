
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM departments WHERE id=?");
$stmt->execute([$id]);
$dept = $stmt->fetch();
if (!$dept) die("Department not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE departments SET name=?, location=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['location'], $id]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Department</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-3" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Edit Department</h2>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" value="<?=htmlspecialchars($dept['name'])?>" required>
      </div>
      <div class="mb-3">
        <label>Location</label>
        <input class="form-control" name="location" value="<?=htmlspecialchars($dept['location'])?>" required>
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