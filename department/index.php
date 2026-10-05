<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Department Portal - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Computer Science Department</h1></header>
    <?php include 'nav.php'; ?>

    <div class="container">
        <h2>Welcome to the Department Portal</h2>
        <p>This is the official portal for student and faculty registrations.</p>

        <h3>Registered Members Table</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
            $result = $conn->query("SELECT id, name, email FROM users");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No members registered yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>