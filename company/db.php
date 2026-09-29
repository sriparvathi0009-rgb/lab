<?php
$conn = new mysqli("127.0.0.1", "root", "Sri2026@PU", "company_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>