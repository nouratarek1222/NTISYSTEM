
<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}


if ($_SESSION['role'] == 'user') {
    die("<!doctype html>
    <html lang='en'>
    <head>
      <meta charset='utf-8'>
      <title>Access Denied</title>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='d-flex align-items-center justify-content-center vh-100 bg-light'>
      <div class='alert alert-danger text-center' style='max-width:500px;'>
        <h4 class='alert-heading'>Access Denied 🚫</h4>
        <p>You don't have permission to add a courses.</p>
        <hr>
        <a href='list.php' class='btn btn-primary'>Back to List</a>
      </div>
    </body>
    </html>");
}

$students = $pdo->query("SELECT id, name FROM students")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO courses (name, cost, hours, id_student) VALUES (?,?,?,?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['cost'],
        $_POST['hours'],
        $_POST['id_student']
    ]);
    header("Location: list.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Add Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
<div class="container">
  <div class="bg-white p-4 shadow rounded mt-5" style="max-width:500px;margin:auto;">
    <h2 class="text-primary
     text-center mb-4">Add Course</h2>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input class="form-control" name="name" required>
      </div>
      <div class="mb-3">
        <label>Cost</label>
        <input type="number" class="form-control" name="cost" required>
      </div>
      <div class="mb-3">
        <label>Hours</label>
        <input type="number" class="form-control" name="hours" required>
      </div>
      <div class="mb-3">
        <label>Student</label>
        <select class="form-control" name="id_student" required>
          <?php foreach ($students as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="text-center">
        <button class="btn btn-primary">Save</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>