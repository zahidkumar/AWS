<?php
session_start();
if (!isset($_SESSION['user_id'])) {
   header('Location: login.php');
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome</title>
</head>
<body>
<h1>Welcome!</h1>
<a href="logout.php">Logout</a>
</body>
</html>