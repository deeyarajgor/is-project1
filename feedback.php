<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $rating = (int)($_POST['rating'] ?? 0);
    $message = trim($_POST['message'] ?? '');
    if ($name === '' || $email === '' || $message === '' || $rating < 1 || $rating > 5) {
        $msg = 'Please fill in all fields.';
    } else {
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?,?,?,?)");
        $stmt->bind_param('ssis', $name, $email, $rating, $message);
        $stmt->execute();
        $msg = 'Thank you! Your feedback was saved.';
    }
}
$rows = $conn->query("SELECT name, rating, message, submitted_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body><div class="card" style="width:500px">
<h2>Feedback form</h2>
<?php if ($msg) echo "<div class='msg'>" . htmlspecialchars($msg) . "</div>"; ?>
<form method="POST" action="feedback.php">
  <label>Name</label><input name="name" required>
  <label>Email</label><input type="email" name="email" required>
  <label>Rating</label>
  <select name="rating" required>
    <option value="">Choose...</option>
    <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
  </select>
  <label>Message</label><input name="message" required>
  <button type="submit">Submit</button>
</form>
<h3>Submitted feedback</h3>
<?php while ($r = $rows->fetch_assoc()): ?>
  <p><b><?php echo htmlspecialchars($r['name']); ?></b> (<?php echo (int)$r['rating']; ?>/5):
  <?php echo htmlspecialchars($r['message']); ?><br>
  <small><?php echo $r['submitted_at']; ?></small></p>
<?php endwhile; ?>
<p><a href="dashboard.php">Back to dashboard</a></p>
</div></body></html>
