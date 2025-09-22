<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}
$id = $_GET['id'] ?? 0;
$id = intval($id); 

$stmt = $pdo->prepare("SELECT * FROM departments WHERE id=?");
$stmt->execute([$id]);
$dept = $stmt->fetch();

if (!$dept) {
    die("<div style='margin:50px auto;max-width:500px;' class='alert alert-warning text-center'>
        <h4>Not Found ⚠️</h4>
        <p>Department with ID $id does not exist.</p>
        <a href='list.php' class='btn btn-primary'>Back</a>
    </div>");
}

// الحذف
$stmt = $pdo->prepare("DELETE FROM departments WHERE id=?");
$stmt->execute([$id]);

header("Location: list.php");
exit();