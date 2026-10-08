<?php
require 'includes/config.php';

if (!empty($_SESSION['uid'])) {
    header('Location: index.php');
    exit;
}

$error = '';
$banner = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // NOTE: credentials are concatenated into the query unfiltered.
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = db()->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['uid']  = $row['id'];
        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        setcookie('role', 'staff', time() + 3600, '/');
        if ($row['role'] === 'superuser') {
            $banner = 'Welcome, Admin. Access granted. Lab flag: FLAG{un10n_byp4ss_l0g1n}';
        } else {
            $banner = 'Welcome back, ' . htmlspecialchars($row['username']) . '.';
        }
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in | Nexus Office Portal</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="auth-logo">
      <span class="brand-mark">N</span>
      <span class="brand-name">Nexus Office</span>
    </div>
    <h2 style="text-align:center; margin-bottom:4px;">Sign in to your workspace</h2>
    <p style="text-align:center; color:var(--muted); font-size:13px; margin-bottom:8px;">Portal access for staff and contractors</p>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($banner): ?>
      <div class="alert alert-ok"><?php echo htmlspecialchars($banner); ?></div>
      <a class="btn btn-block" href="index.php">Continue to dashboard</a>
    <?php else: ?>
      <form method="POST" action="login.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" autocomplete="off" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button class="btn btn-block" type="submit">Sign in</button>
      </form>
    <?php endif; ?>
  </div>
</div>
</body>
</html>