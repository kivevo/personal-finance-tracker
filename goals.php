<?php
include 'db_connect.php';

$user_id = 1; // Replace with the logged-in user's ID
$sql = "SELECT
          name, target_amount, current_amount
        FROM goals
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goals - Personal Finance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navigation menu -->
  </header>

  <main>
    <div class="container">
      <h1>Financial Goals</h1>
      <div class="goal-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="goal-item">
            <h3><?php echo $row['name']; ?></h3>
            <div class="progress-bar">
              <div class="progress" style="width: <?php echo ($row['current_amount'] / $row['target_amount']) * 100; ?>%;"></div>
            </div>
            <p><?php echo number_format($row['current_amount'], 2); ?> / Ksh. <?php echo number_format($row['target_amount'], 2); ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>

  <footer>
    <!-- Footer content -->
  </footer>

  <script src="script.js"></script>
</body>
</html>