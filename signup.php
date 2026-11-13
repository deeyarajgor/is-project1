<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $full_name === '' || $email === '' || $password === '') {
        $msg = 'Please fill in all required fields.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $conn->prepare("INSERT INTO users (username, full_name, email, course, password_hash) VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssss', $username, $full_name, $email, $course, $hash);
            $stmt->execute();
            $msg = 'Account created! <a href="login.php">Log in here</a>.';
        } catch (mysqli_sql_exception $e) {
            $msg = ($e->getCode() == 1062) ? 'That username or email already exists.' : 'Database error.';
        }
    }
}
?>
<!DOCTYPE html>
<html><head><title>Sign up</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card">
<h2>Sign up</h2>
<?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>
<form method="POST" action="signup.php">
  <label>Username</label><input name="username" required>
  <label>Full name</label><input name="full_name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Course</label><input name="course">
  <label>Password</label><input type="password" name="password" required>
  <button type="submit">Create account</button>
</form>
<p>Already registered? <a href="login.php">Log in</a></p>
</div></body></html>
