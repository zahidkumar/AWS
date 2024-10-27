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
