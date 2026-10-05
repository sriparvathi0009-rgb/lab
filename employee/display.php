<?php
$conn = new mysqli("127.0.0.1", "root", "Sri2026@PU", "company_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 80%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2>Stored Employee Records</h2>
    <a href="index.html">+ Add New Employee</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Salary ($)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["department"] . "</td>
                            <td>$" . $row["salary"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
<?php $conn->close(); ?>