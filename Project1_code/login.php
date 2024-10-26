<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$username=$_POST['username'];
	$password=$_POST['password']
	
	$stmt=$pdo->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute([$username]);
	$user=$stmt->fetch();
	
	if ($user && password_verify($password, $user['password'])) {
       $_SESSION['user_id'] = $user['id'];
       header('Location: welcome.php');
       exit;
	}esle{
		$error='invalid credentials';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LOGIN</title>
</head>
<body>
<form method="post">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
<?php if (!empty($error)) echo '<p>' . $error . '</p>'; ?>
</body>
</html>	