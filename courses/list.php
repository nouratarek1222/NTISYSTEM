
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$role = $_SESSION['role'] ?? 'user';

// جلب الكورسات مع اسم الطالب
$stmt = $pdo->query("
    SELECT courses.*, students.name AS student_name
    FROM courses
    LEFT JOIN students ON courses.id_student = students.id
");
$courses = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Courses List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#021324ff; font-family:'Segoe UI',sans-serif; }
    .table-container { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1); margin-top:40px; }
    h2 { margin:20px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
<div class="container">
  <h2> List Courses </h2>
  <div class="table-container">
    <?php if ($role == 'admin' || $role == 'hr'): ?>
      <div class="mb-3 text-end">
        <a class="btn btn-primary" href="add.php"> Add Course</a>
      </div>
    <?php endif; ?>
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Cost</th>
          <th>Hours</th>
          <th>Student</th>
          <?php if ($role == 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if ($courses): ?>
        <?php foreach ($courses as $c): ?>
          <tr>
            <td><?=htmlspecialchars($c['id'])?></td>
            <td><?=htmlspecialchars($c['name'])?></td>
            <td><?=htmlspecialchars($c['cost'])?></td>
            <td><?=htmlspecialchars($c['hours'])?></td>
            <td><?=htmlspecialchars($c['student_name'] ?? 'N/A')?></td>
            <?php if ($role == 'admin'): ?>
              <td>
                <a class="btn btn-warning btn-sm" href="edit.php?id=<?=$c['id']?>"> Edit</a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?=$c['id']?>" onclick="return confirm('Delete course?')"> Delete</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="<?=($role=='admin'?6:5)?>" class="text-center">No courses found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>