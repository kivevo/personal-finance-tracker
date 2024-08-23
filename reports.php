<?php
include 'db_connect.php';

$user_id = 1; // Replace with the logged-in user's ID
$sql = "SELECT
          t.date, t.amount, c.name AS category_name
        FROM transactions t
        JOIN categories c ON t.category_id = c.id
        WHERE t.user_id = ?
        ORDER BY t.date DESC";
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
  <title>Reports - Personal Finance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navigation menu -->
  </header>

  <main>
    <div class="container">
      <h1>Reports</h1>
      <div class="report-container">
        <canvas id="monthlySpendingChart"></canvas>
        <canvas id="categorySpendingChart"></canvas>
      </div>
    </div>
  </main>

  <footer>
    <!-- Footer content -->
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="script.js"></script>
</body>
</html>