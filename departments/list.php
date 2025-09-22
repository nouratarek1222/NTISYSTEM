
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$role = $_SESSION['role'] ?? 'user';

// جلب الأقسام
$stmt = $pdo->query("SELECT * FROM departments");
$departments = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Departments List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #021324;; font-family:'Segoe UI',sans-serif; }
    .table-container { background: white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(201, 70, 70, 0.1); margin-top:20px; }
    h2 { margin:50px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
<div class="container">
  <h2>Departments Management</h2>
  <div class="table-container">
    <?php if ($role == 'admin' || $role == 'hr'): ?>
      <div class="mb-3 text-end">
        <a class="btn btn-primary" href="add.php"> Add Department</a>
      </div>
    <?php endif; ?>
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Location</th>
          <?php if ($role == 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if ($departments): ?>
        <?php foreach ($departments as $d): ?>
          <tr>
            <td><?=htmlspecialchars($d['id'])?></td>
            <td><?=htmlspecialchars($d['name'])?></td>
            <td><?=htmlspecialchars($d['location'])?></td>
            <?php if ($role == 'admin'): ?>
              <td>
                <a class="btn btn-warning btn-sm" href="edit.php?id=<?=$d['id']?>"> Edit</a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?=$d['id']?>" onclick="return confirm('Delete department?')"> Delete</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="<?=($role=='admin'?4:3)?>" class="text-center">No departments found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>