<?php
require_once DIR . "/shared/db.php";

$users = [
  ['admin@nti.com', 'Admin@123', 'Main Admin', 'admin'],
  ['hr@nti.com', 'Hr@123', 'HR User', 'hr'],
  ['user@nti.com', 'User@123', 'Normal User', 'user'],
];

foreach ($users as $u) {
  [$username, $plain, $fullname, $role] = $u;
  $hash = password_hash($plain, PASSWORD_DEFAULT);

  $stmt = $mysqli->prepare("INSERT INTO users (username,password,full_name,role) VALUES (?,?,?,?)");
  $stmt->bind_param('ssss', $username, $hash, $fullname, $role);

  if ($stmt->execute()) {
    echo "✅ User $username created<br>";
  } else {
    echo "⚠️ Error for $username: " . $mysqli->error . "<br>";
  }
}