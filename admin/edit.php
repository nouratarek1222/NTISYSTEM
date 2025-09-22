
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id=?");
$stmt->execute([$id]);
$admin = $stmt->fetch();
if (!$admin) die("Admin not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE admin SET name=?, phone=?, department_id=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['phone'], $_POST['department_id'], $id]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Edit Admin</h2>
    <form method="post">
      <div class="mb-3"><label>Name</label><input class="form-control" name="name" value="<?=$admin['name']?>" required></div>
      <div class="mb-3"><label>Phone</label><input class="form-control" name="phone" value="<?=$admin['phone']?>" required></div>
      <div class="mb-3"><label>Department ID</label><input type="number" class="form-control" name="department_id" value="<?=$admin['department_id']?>" required></div>
      <div class="text-center">
        <button class="btn btn-primary">Update</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>