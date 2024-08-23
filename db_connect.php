<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_finance_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
