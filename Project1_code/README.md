### Step 1: Create the MySQL Database
1. **Set up your RDS instance**: Make sure you have a MySQL database set up in Amazon RDS.
2. **Create a table** to store user data. You can use the following SQL command:
```sql
CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL
);
```
### Step 2: Create the Login Page
1. **Install PHP** on your EC2 instance if you haven't already:
```bash
sudo yum install php php-mysqlnd
```
2. **Create a directory for your project**:
```bash
mkdir /var/www/html/login
cd /var/www/html/login
```
3. **Create `config.php`** for database connection:
```php
<?php
$host = 'your_rds_endpoint'; // e.g. mydbinstance.abcdefg123456.us-east-1.rds.amazonaws.com
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
   PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
   $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
   throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```
4. **Create `login.php`**:
```php
<?php
session_start();
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
   $stmt->execute([$username]);
   $user = $stmt->fetch();
   if ($user && password_verify($password, $user['password'])) {
       $_SESSION['user_id'] = $user['id'];
       header('Location: welcome.php');
       exit;
   } else {
       $error = 'Invalid credentials';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
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
```
5. **Create `welcome.php`**:
```php
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
```
6. **Create `logout.php`**:
```php
<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
```
### Step 3: Store User Data
To store users in the database, you can create a registration page with a form to insert new users, hashing their passwords:
```php
// In a new file called register.php
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
```
### Step 4: Set Permissions
Ensure that your EC2 instance has the correct permissions to connect to your RDS instance. You may need to adjust security groups and VPC settings.
### Step 5: Test Your Application
1. Open your browser and navigate to your EC2 public IP or domain followed by `/login`.
2. You should see the login page. You can create a user using the registration page.
