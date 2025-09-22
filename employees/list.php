
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}
$role = $_SESSION['role'] ?? 'user';

$stmt = $pdo->query("
    SELECT employees.*, departments.name AS dept_name
    FROM employees
    LEFT JOIN departments ON employees.department_id = departments.id
");
$employees = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Employees List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#021324ff; font-family:'Segoe UI',sans-serif; }
    .table-container { background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1); margin-top:20px; }
    h2 { margin:50px 0; color:white; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
<div class="container">
  <h2>List Employees</h2>
  <div class="table-container">
    <?php if ($role == 'admin' || $role == 'hr'): ?>
      <div class="mb-3 text-end">
        <a class="btn btn-primary" href="add.php"> Add Employee</a>
      </div>
    <?php endif; ?>
    <table class="table table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Age</th>
          <th>Salary</th>
          <th>Gender</th>
          <th>Department</th>
          <?php if ($role == 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php if ($employees): ?>
          <?php foreach ($employees as $e): ?>
            <tr>
              <td><?= htmlspecialchars($e['id']) ?></td>
              <td><?= htmlspecialchars($e['name']) ?></td>
              <td><?= htmlspecialchars($e['address']) ?></td>
              <td><?= htmlspecialchars($e['age']) ?></td>
              <td><?= htmlspecialchars($e['salary']) ?></td>
              <td><?= ucfirst($e['gender']) ?></td>
              <td><?= htmlspecialchars($e['dept_name']) ?></td>
              <?php if ($role == 'admin'): ?>
                <td>
                  <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $e['id'] ?>"> Edit</a>
                  <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Delete employee?')"> Delete</a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="<?= ($role=='admin'?8:7) ?>" class="text-center">No Employees Found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>