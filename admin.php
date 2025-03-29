<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}
$conn = new mysqli('localhost', 'root', '', 'parking_db');
$result = $conn->query("SELECT SUM(price) AS total_profit FROM vehicles WHERE MONTH(exit_time) = MONTH(CURDATE())");
$profit = $result->fetch_assoc()['total_profit'];
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<div class="container">
    <h2>Monthly Profit: ₹<?= number_format($profit, 2) ?></h2>
    <a href="dashboard.php">Back to Dashboard</a>
</div>
