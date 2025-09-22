<?php
require '../db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    die("Access denied 🚫");
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM courses WHERE id=?");
$stmt->execute([$id]);
header("Location: list.php");
exit();