


<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$role = $_SESSION['role'] ?? '';
if($role != 'admin'){
    die("<div class='alert alert-danger text-center mt-5'>Access Denied ❌<br>You do not have permission to access this page.</div>");
}

$conn = new mysqli("localhost","root","","university");
if($conn->connect_error){
    die("DB connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM doctors WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if(!$doctor){
    die("<div class='alert alert-warning text-center mt-5'>Doctor not found.</div>");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];

    $update = $conn->prepare("UPDATE doctors SET name=?, address=?, age=?, salary=?, gender=? WHERE id=?");
    $update->bind_param("ssdisi", $name, $address, $age, $salary, $gender, $id);
    if($update->execute()){
        header("Location: list.php");
        exit();
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Doctor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #051224ff;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      margin-top: 50px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }
    .card h3 {
      color: #111213ff;
      font-weight: bold;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-primary {
      border-radius: 8px;
      padding: 8px 25px;
    }
    .btn-secondary {
      border-radius: 8px;
      padding: 8px 25px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="card mx-auto" style="max-width:600px;">
    <div class="card-body">
      <h3 class="text-center mb-4">Edit Doctor</h3>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($doctor['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="address" value="<?= htmlspecialchars($doctor['address']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Age</label>
          <input type="number" name="age" value="<?= htmlspecialchars($doctor['age']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Salary</label>
          <input type="number" name="salary" value="<?= htmlspecialchars($doctor['salary']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-control">
            <option <?= $doctor['gender']=='Male'?'selected':''; ?>>Male</option>
            <option <?= $doctor['gender']=='Female'?'selected':''; ?>>Female</option>
          </select>
        </div>
        <div class="text-center">
          <button class="btn btn-primary me-2">Update</button>
          <a href="list.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>


