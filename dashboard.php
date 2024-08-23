<?php
session_start();

// Check if the user is logged in, if not then redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include 'db_connect.php';

// Fetch user's financial summary (income, expenses, savings) from the database
$user_id = $_SESSION["id"];
$sql = "SELECT
          (SELECT SUM(amount) FROM transactions WHERE user_id = ? AND category_id IN (SELECT id FROM categories WHERE type = 'income')) AS income,
          (SELECT SUM(amount) FROM transactions WHERE user_id = ? AND category_id IN (SELECT id FROM categories WHERE type = 'expense')) AS expenses,
          (SELECT SUM(current_amount) FROM goals WHERE user_id = ?) AS savings
        FROM dual";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Fetch the user's financial goals
$sql = "SELECT name, target_amount, current_amount FROM goals WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$goalResult = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="budgets.php">Budgets</a></li>
                <li><a href="goals.php">Goals</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="card">
                <h2>Income, Expenses, and Savings</h2>
                <div class="finance-summary">
                    <div class="finance-item">
                        <h3>Income</h3>
                        <p class="finance-value">Ksh. <?php echo number_format($row['income'], 2); ?></p>
                    </div>
                    <div class="finance-item">
                        <h3>Expenses</h3>
                        <p class="finance-value">Ksh. <?php echo number_format($row['expenses'], 2); ?></p>
                    </div>
                    <div class="finance-item">
                        <h3>Savings</h3>
                        <p class="finance-value">Ksh. <?php echo number_format($row['savings'], 2); ?></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2>Your Financial Goals</h2>
                <div class="goal-container">
                    <?php while ($goal = $goalResult->fetch_assoc()) { ?>
                        <div class="goal-item">
                            <h3><?php echo $goal['name']; ?></h3>
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo ($goal['current_amount'] / $goal['target_amount']) * 100; ?>%;"></div>
                            </div>
                            <p><?php echo number_format($goal['current_amount'], 2); ?> / $<?php echo number_format($goal['target_amount'], 2); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="card">
                <h2>Monthly Reports</h2>
                <div class="report-container">
                    <canvas id="monthlySpendingChart"></canvas>
                    <canvas id="categorySpendingChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Personal Finance Tracker. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>
