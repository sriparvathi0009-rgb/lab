<?php 
include 'db.php'; 
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $message = "<p style='color:green;'>Login Successful! Welcome " . $user['name'] . "</p>";
        } else {
            $message = "<p style='color:red;'>Invalid Password!</p>";
        }
    } else {
        $message = "<p style='color:red;'>No account found with this email!</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Department Login</h1></header>
    <?php include 'nav.php'; ?>

    <div class="container" style="max-width:400px;">
        <h2>User Login</h2>
        <?= $message; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>