<?php
$conn = new mysqli("127.0.0.1", "root", "Sri2026@PU", "company_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$salary = $_POST['salary'];

$sql = "INSERT INTO employees (name, email, department, salary) 
        VALUES ('$name', '$email', '$department', '$salary')";

if ($conn->query($sql) === TRUE) {
    echo "<h3>Data Inserted Successfully!</h3>";
    echo "<a href='display.php'>View All Employees</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>