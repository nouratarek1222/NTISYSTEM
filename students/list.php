
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$role = $_SESSION['role'] ?? 'user';

$stmt = $pdo->query("
    SELECT s.*, d.name AS doctor_name 
    FROM students s 
    LEFT JOIN doctors d ON s.id_doctor = d.id
");
$students = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Students List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#010c1bff ; font-family:'Segoe UI',sans-serif; }
    .table-container { background:white; padding:20px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); margin-top:20px; }
    h2 { margin:40px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
<div class="container">
  <h2> List Students</h2>
  <div class="table-container">
    <?php if ($role == 'admin' || $role == 'hr'): ?>
      <div class="mb-3 text-end">
        <a class="btn btn-primary" href="add.php"> Add Student</a>
      </div>
    <?php endif; ?>
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Doctor</th>
          <?php if ($role == 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if ($students): ?>
        <?php foreach ($students as $s): ?>
          <tr>
            <td><?=htmlspecialchars($s['id'])?></td>
            <td><?=htmlspecialchars($s['name'])?></td>
            <td><?=htmlspecialchars($s['address'])?></td>
            <td><?=htmlspecialchars($s['age'])?></td>
            <td><?=htmlspecialchars($s['gender'])?></td>
            <td><?=htmlspecialchars($s['doctor_name'] ?? $s['id_doctor'])?></td>
            <?php if ($role == 'admin'): ?>
              <td>
                <a class="btn btn-warning btn-sm" href="edit.php?id=<?=$s['id']?>"> Edit</a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?=$s['id']?>" onclick="return confirm('Delete student?')"> Delete</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="<?=($role=='admin'?7:6)?>" class="text-center">No students found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>