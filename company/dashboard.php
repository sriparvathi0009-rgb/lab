<?php
include 'db.php';

// Authentication Check
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$user_role = $_SESSION['role'];
$user_name = $_SESSION['name'];

// Role-based logic
if ($user_role === 'employee') {
    $title = "Admin Directory Details";
    $query_role = "admin";
} else {
    $title = "Employee Directory Details";
    $query_role = "employee";
}

$result = $conn->query("SELECT id, name, email, department FROM users WHERE role='$query_role'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - <?= ucfirst($user_role); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Company Portal Dashboard</h1></header>
    
    <div class="container">
        <a href="logout.php" class="logout-btn">Logout</a>
        <h2>Welcome, <?= htmlspecialchars($user_name); ?> (<?= ucfirst($user_role); ?>)</h2>
        <hr>

        <h3><?= $title; ?></h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['department']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No " . $query_role . " records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>