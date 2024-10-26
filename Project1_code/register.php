<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $username = $_POST['username'];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
   if ($stmt->execute([$username, $password])) {
       header('Location: login.php');
       exit;
   } else {
       $error = 'Registration failed';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
</head>
<body>
<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Register</button>
</form>
<?php if (!empty($error)) echo '<p>' . $error . '</p>'; ?>
</body>
</html>