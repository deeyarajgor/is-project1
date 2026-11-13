<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html><head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card">
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!</h2>
<p>You are logged in as <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>.</p>
<p><a href="logout.php">Log out</a></p>
</div></body></html>
