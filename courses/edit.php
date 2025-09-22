
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id=?");
$stmt->execute([$id]);
$course = $stmt->fetch();
if (!$course) die("Course not found");

$students = $pdo->query("SELECT id, name FROM students")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE courses SET name=?, cost=?, hours=?, id_student=? WHERE id=?");
    $stmt->execute([
        $_POST['name'],
        $_POST['cost'],
        $_POST['hours'],
        $_POST['id_student'],
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
  <title>Edit Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary text-center mb-4">Edit Course</h2>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" value="<?=htmlspecialchars($course['name'])?>" required>
      </div>
      <div class="mb-3">
        <label>Cost</label>
        <input type="number" class="form-control" name="cost" value="<?=htmlspecialchars($course['cost'])?>" required>
      </div>
      <div class="mb-3">
        <label>Hours</label>
        <input type="number" class="form-control" name="hours" value="<?=htmlspecialchars($course['hours'])?>" required>
      </div>
      <div class="mb-3">
        <label>Student</label>
        <select class="form-control" name="id_student" required>
          <?php foreach($students as $s): ?>
            <option value="<?= $s['id'] ?>" <?= $course['id_student']==$s['id']?'selected':'' ?>>
              <?= htmlspecialchars($s['name']) ?>
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