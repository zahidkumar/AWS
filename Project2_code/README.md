Create a Database and Table:

Connect to your MySQL instance using a MySQL client.
Run the following SQL to create a database and a table:
CREATE DATABASE mydatabase;
USE mydatabase;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255)
);

Step 2: Create the Web Form
Create an index.html file:

html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
</head>
<body>
    <h1>User Information Form</h1>
    <form action="submit.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
Step 3: Handle Form Submission with PHP
Create a submit.php file:

php
Copy code
<?php
$servername = "your-rds-endpoint";
$username = "your-username";
$password = "your-password";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, address) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $address);

// Set parameters and execute
$name = $_POST['name'];
$address = $_POST['address'];
$stmt->execute();

echo "New record created successfully";

$stmt->close();
$conn->close();
?>
Step 4: Test Your Form
Upload both files (index.html and submit.php) to your web server (you could use AWS EC2 or any other hosting service).
Access the index.html form via your browser.
Fill out the form and submit it to see if it successfully stores the data in your RDS MySQL database.
