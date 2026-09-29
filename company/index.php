<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Company Portal - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>TechCorp Enterprise Portal</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Registration</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="container">
        <h2>Welcome to TechCorp Enterprise Portal</h2>
        <p>This is the centralized management portal for Employees and Administrators.</p>
        
        <h3>System Instructions:</h3>
        <ul>
            <li><strong>Employee Login:</strong> Allows employees to view active Administrator profiles and directory contacts.</li>
            <li><strong>Admin Login:</strong> Allows administrators to access and view full Employee records and departments.</li>
        </ul>
    </div>
</body>
</html>