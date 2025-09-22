<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /NtiSystem/login.php");
    exit();
}
$currentUser = $_SESSION['user'];
function checkRole($roles = []) {
    global $currentUser;
    if (!in_array($currentUser['role'], $roles)) {
        die("⛔ غير مسموح لك بالدخول هنا");
    }
}