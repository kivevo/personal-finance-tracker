<?php
include 'db_connect.php';

$user_id = 1; // Replace with the logged-in user's ID
$sql = "SELECT
          t.id, t.date, t.description, t.amount, c.name AS category_name
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
  <title>Transactions - Personal Finance Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <!-- Navigation menu -->
  </header>

  <main>
    <div class="container">
      <h1>Transactions</h1>
      <table class="transactions-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo date('Y-m-d', strtotime($row['date'])); ?></td>
              <td><?php echo $row['description']; ?></td>
              <td><?php echo number_format($row['amount'], 2); ?></td>
              <td><?php echo $row['category_name']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer>
    <!-- Footer content -->
  </footer>

  <script src="script.js"></script>
</body>
</html>