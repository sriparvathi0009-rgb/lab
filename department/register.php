<?php 
include 'db.php'; 
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color:green;'>Registration successful! <a href='login.php'>Login here</a></p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let pass = document.forms["regForm"]["password"].value;
            if (pass.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <header><h1>Department Registration</h1></header>
    <?php include 'nav.php'; ?>

    <div class="container" style="max-width:400px;">
        <h2>User Registration</h2>
        <?= $message; ?>
        <form name="regForm" action="register.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>