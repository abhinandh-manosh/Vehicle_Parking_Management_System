<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'parking_db');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $result = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header('Location: dashboard.php');
    } else {
        echo "<script>alert('Invalid login!');</script>";
    }
}
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<div class="container">
    <form method="post">
        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>