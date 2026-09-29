<?php 
include 'db.php'; 
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain text for simple exam usage
    $role = $_POST['role'];
    $department = $_POST['department'];

    $sql = "INSERT INTO users (name, email, password, role, department) 
            VALUES ('$name', '$email', '$password', '$role', '$department')";
            
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color:green;'>Registration successful! <a href='login.php'>Click here to Login</a></p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Company Portal - Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let pass = document.forms["regForm"]["password"].value;
            if (pass.length < 5) {
                alert("Password must be at least 5 characters long.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <header><h1>Company User Registration</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Registration</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="container" style="max-width:450px;">
        <h2>Create Account</h2>
        <?= $message; ?>
        <form name="regForm" action="register.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Register As (Role):</label>
                <select name="role" required>
                    <option value="employee">Employee</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <input type="text" name="department" required>
            </div>
            <button type="submit">Register Account</button>
        </form>
    </div>
</body>
</html>