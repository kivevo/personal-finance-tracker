<?php
include 'db_connect.php';

$user_id = 1; // Replace with the logged-in user's ID
$sql = "SELECT
          username, email
        FROM users
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - Personal Finance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navigation menu -->
  </header>

  <main>
    <div class="container">
      <h1>Settings</h1>
      <div class="settings-container">
        <form action="update_profile.php" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">
          </div>
          <button type="submit" class="btn">Update Profile</button>
        </form>
      </div>
    </div>
  </main>

  <footer>
    <!-- Footer content -->
  </footer>

  <script src="script.js"></script>
</body>
</html>