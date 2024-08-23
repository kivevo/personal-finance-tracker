<?php
include 'db_connect.php';

$user_id = 1; // Replace with the logged-in user's ID
$sql = "SELECT
          name, start_date, end_date, total_amount
        FROM budgets
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
  <title>Budgets - Personal Finance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navigation menu -->
  </header>

  <main>
    <div class="container">
      <h1>Budgets</h1>
      <div class="budget-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
          <div class="budget-item">
            <h3><?php echo $row['name']; ?></h3>
            <p>Start Date: <?php echo date('Y-m-d', strtotime($row['start_date'])); ?></p>
            <p>End Date: <?php echo date('Y-m-d', strtotime($row['end_date'])); ?></p>
            <p>Total Amount: $<?php echo number_format($row['total_amount'], 2); ?></p>
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