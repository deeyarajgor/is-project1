<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT id, full_name, password_hash FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        $_SESSION['full_name'] = $user['full_name'];
        header('Location: dashboard.php');
        exit;
    }
    $msg = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html><head><title>Log in</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card">
<h2>Log in</h2>
<?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>
<form method="POST" action="login.php">
  <label>Username</label><input name="username" required>
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Log in</button>
</form>
<p>No account? <a href="signup.php">Sign up</a></p>
</div></body></html>
