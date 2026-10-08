<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'My Profile';
require 'includes/header.php';

// The displayed role is read directly from a client-side cookie.
$role = isset($_COOKIE['role']) ? $_COOKIE['role'] : 'staff';
$is_super = ($role === 'superuser');
?>
<div class="grid">
  <div class="card">
    <div class="stat-label">Username</div>
    <div class="stat-value" style="font-size:20px;"><?php echo htmlspecialchars($_SESSION['user']); ?></div>
    <div class="stat-note">member since 2024</div>
  </div>
  <div class="card">
    <div class="stat-label">Current role</div>
    <div class="stat-value" style="font-size:20px;"><?php echo htmlspecialchars($role); ?></div>
    <div class="stat-note">
      <?php if ($is_super): ?>
        <span class="badge badge-danger">Elevated</span>
      <?php else: ?>
        <span class="badge badge-ok">Standard</span>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="panel">
  <h2>Role-based access</h2>
  <?php if ($is_super): ?>
    <div class="alert alert-ok">
      Access granted to the admin panel. Lab flag: FLAG{c00k13_f0rg3ry_4dm1n}
    </div>
  <?php else: ?>
    <div class="alert alert-warn">Access restricted. This area is for superusers only.</div>
  <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>