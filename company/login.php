<?php 
include 'db.php'; 
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on assigned role
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "<p style='color:red;'>Invalid Email or Password!</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Company Portal - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Company Portal Login</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Registration</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="container" style="max-width:400px;">
        <h2>Account Login</h2>
        <?= $message; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>