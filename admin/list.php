

<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$role = $_SESSION['role'] ?? 'user';

$stmt = $pdo->query("SELECT * FROM admin");
$admins = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admins List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #021324ff; font-family:'Segoe UI',sans-serif; }
    .table-container { background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1); margin-top:20px; }
    h2 { margin:40px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
<div class="container">
  <h2>List Admin </h2>
  <div class="table-container">
    <?php if ($role == 'admin'): ?>
      <div class="mb-3 text-end">
        <a class="btn btn-primary" href="add.php"> Add Admin</a>
      </div>
    <?php endif; ?>
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th><th>Name</th><th>Phone</th><th>Department ID</th>
          <?php if ($role == 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if ($admins): ?>
        <?php foreach ($admins as $a): ?>
          <tr>
            <td><?=htmlspecialchars($a['id'])?></td>
            <td><?=htmlspecialchars($a['name'])?></td>
            <td><?=htmlspecialchars($a['phone'])?></td>
            <td><?=htmlspecialchars($a['department_id'])?></td>
            <?php if ($role == 'admin'): ?>
              <td>
                <a class="btn btn-warning btn-sm" href="edit.php?id=<?=$a['id']?>"> Edit</a>
                <a class="btn btn-danger btn-sm" href="delete.php?id=<?=$a['id']?>" onclick="return confirm('Delete admin?')"> Delete</a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="<?=($role=='admin'?5:4)?>" class="text-center">No admins found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>



