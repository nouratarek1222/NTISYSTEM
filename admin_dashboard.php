
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "university");

// إضافة دكتور جديد
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO doctors (name, specialty, email) VALUES ('$name','$specialty','$email')");
}

// حذف دكتور
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM doctors WHERE id=$id");
}

// تعديل دكتور (مثال بسيط - هيتعامل مع فورم منفصل في صفحة تانية غالباً)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $email = $_POST['email'];
    $conn->query("UPDATE doctors SET name='$name', specialty='$specialty', email='$email' WHERE id=$id");
}

// قراءة البيانات
$result = $conn->query("SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <span class="navbar-text text-white">
      Welcome, <?= $_SESSION['username'] ?>
    </span>
  </div>
</nav>

<div class="container mt-4">
  <h2>Doctors List</h2>

  <!-- جدول عرض -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Specialty</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['specialty'] ?></td>
          <td><?= $row['email'] ?></td>
          <td>
            <!-- Edit/Delete -->
            <a href="edit_doctor.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="admin_dashboard.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- فورم إضافة -->
  <h3 class="mt-4">Add Doctor</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Specialty</label>
      <input type="text" name="specialty" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" name="add" class="btn btn-primary">Add Doctor</button>
  </form>
</div>

</body>
</html>














