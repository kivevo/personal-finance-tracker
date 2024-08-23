<?php
// Start the session
session_start();

// Include the database connection file
include 'db_connect.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Get the updated values from the form
$username = $_POST['username'];
$email = $_POST['email'];

// Prepare the SQL query
$sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $username, $email, $user_id);

// Execute the query
if ($stmt->execute()) {
    // Update the session with the new username
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    header("Location: index.php");
    exit;
} else {
    echo "Error updating profile: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
