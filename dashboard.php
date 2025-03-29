<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
}
$conn = new mysqli('localhost', 'root', '', 'parking_db');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_no = $_POST['vehicle_no'];
    $owner_name = $_POST['owner_name'];
    $conn->query("INSERT INTO vehicles (vehicle_no, owner_name) VALUES ('$vehicle_no', '$owner_name')");
}
$result = $conn->query("SELECT * FROM vehicles WHERE exit_time IS NULL");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<div class="container">
    <form method="post">
        <h2>Park a Vehicle</h2>
        <input type="text" name="vehicle_no" placeholder="Vehicle Number" required>
        <input type="text" name="owner_name" placeholder="Owner Name" required>
        <button type="submit">Park Vehicle</button>
    </form>
    <table>
        <tr><th>ID</th><th>Vehicle No</th><th>Owner</th><th>Entry Time</th><th>Action</th></tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['vehicle_no'] ?></td>
                <td><?= $row['owner_name'] ?></td>
                <td><?= $row['entry_time'] ?></td>
                <td><a href="checkout.php?id=<?= $row['id'] ?>">✔ Checkout</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
