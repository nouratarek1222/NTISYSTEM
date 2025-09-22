
<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit();
}

$role = $_SESSION['role'];
if($role != 'admin'){
    die("❌ غير مسموح لك بالدخول هنا");
}

$conn = new mysqli("localhost","root","","university");
if($conn->connect_error){
    die("DB connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM doctors WHERE id=$id");
header("Location: list.php");
exit();