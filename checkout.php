<?php
$conn = new mysqli('localhost', 'root', '', 'parking_db');
$id = $_GET['id'];
$rate_per_hour = 10;
$vehicle = $conn->query("SELECT * FROM vehicles WHERE id=$id")->fetch_assoc();
$entry_time = strtotime($vehicle['entry_time']);
$exit_time = time();
$hours = ceil(($exit_time - $entry_time) / 3600);
$price = $hours * $rate_per_hour;
$conn->query("UPDATE vehicles SET exit_time=NOW(), price=$price WHERE id=$id");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<div class="container">
    <h2>Checkout Details</h2>
    <p>Vehicle Number: <?= $vehicle['vehicle_no'] ?></p>
    <p>Owner Name: <?= $vehicle['owner_name'] ?></p>
    <p>Entry Time: <?= $vehicle['entry_time'] ?></p>
    <p>Exit Time: <?= date('Y-m-d H:i:s', $exit_time) ?></p>
    <p>Total Hours: <?= $hours ?></p>
    <p>Amount Due: ₹<?= number_format($price, 2) ?></p>
    <a href="dashboard.php">Back to Dashboard</a>
</div>