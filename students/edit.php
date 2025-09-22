
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$student = $stmt->fetch();
if (!$student) die("Student not found");

$doctors = $pdo->query("SELECT id, name FROM doctors")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE students SET name=?, address=?, age=?, gender=?, id_doctor=? WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['address'],
        $_POST['age'],
        $_POST['gender'],
        $_POST['id_doctor'],
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
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white  p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-dark text-center mb-4">Edit Student</h2>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" value="<?=htmlspecialchars($student['name'])?>" required>
      </div>
      <div class="mb-3">
        <label>Address</label>
        <input class="form-control" name="address" value="<?=htmlspecialchars($student['address'])?>" required>
      </div>
      <div class="mb-3">
        <label>Age</label>
        <input type="number" class="form-control" name="age" value="<?=htmlspecialchars($student['age'])?>" required>
      </div>
      <div class="mb-3">
        <label>Gender</label>
        <select class="form-control" name="gender" required>
          <option value="Male" <?= $student['gender']=='Male'?'selected':'' ?>>Male</option>
          <option value="Female" <?= $student['gender']=='Female'?'selected':'' ?>>Female</option>
        </select>
      </div>
      <div class="mb-3">
        <label>Doctor</label>
        <select class="form-control" name="id_doctor" required>
          <?php foreach($doctors as $d): ?>
            <option value="<?= $d['id'] ?>" <?= $student['id_doctor']==$d['id']?'selected':'' ?>>
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



