<?php
include 'db.php';

$id = 0;
$name = "";
$email = "";
$phone = "";
$address = "";
$update_mode = false;

// 1. ADD NEW CONTACT
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("INSERT INTO contacts (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')");
    header("Location: index.php");
    exit();
}

// 2. DELETE CONTACT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM contacts WHERE id=$id");
    header("Location: index.php");
    exit();
}

// 3. EDIT CONTACT (Fetch data into form)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update_mode = true;
    $result = $conn->query("SELECT * FROM contacts WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    }
}

// 4. UPDATE EXISTING CONTACT
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $conn->query("UPDATE contacts SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Management System</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let phone = document.forms["contactForm"]["phone"].value;
            if (isNaN(phone) || phone.length < 10) {
                alert("Please enter a valid phone number (at least 10 digits).");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <header>
        <h1>Contact Management System</h1>
    </header>

    <div class="container">
        <!-- ADD / EDIT FORM -->
        <h2><?= $update_mode ? "Edit Contact" : "Add New Contact"; ?></h2>
        
        <form name="contactForm" action="index.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" value="<?= $name; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= $email; ?>" required>
            </div>

            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phone" value="<?= $phone; ?>" required>
            </div>

            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" value="<?= $address; ?>" required>
            </div>

            <?php if ($update_mode == true): ?>
                <button type="submit" name="update" style="background:#007bff;">Update Contact</button>
                <a href="index.php" style="margin-left: 10px; color: #666; text-decoration: none;">Cancel</a>
            <?php else: ?>
                <button type="submit" name="save">Save Contact</button>
            <?php endif; ?>
        </form>

        <hr style="margin-top: 30px;">

        <!-- CONTACTS LIST TABLE -->
        <h2>All Contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['address']}</td>
                                <td>
                                    <a href='index.php?edit={$row['id']}' class='btn-edit'>Edit</a>
                                    <a href='index.php?delete={$row['id']}' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this contact?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No contacts found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>