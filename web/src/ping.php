<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Network Diagnostics';
require 'includes/header.php';

$output = '';
$target = '127.0.0.1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target = $_POST['ip'] ?? '127.0.0.1';
    // NOTE: the value is concatenated directly into a shell command.
    $output = shell_exec('ping -c 3 ' . $target);
}
?>
<div class="panel">
  <h2>Connectivity tester</h2>
  <p>Enter a host to run a standard ICMP reachability check against it.</p>
  <form method="POST" action="ping.php">
    <label for="ip">Target host</label>
    <input type="text" id="ip" name="ip" value="<?php echo htmlspecialchars($target); ?>" placeholder="127.0.0.1">
    <button class="btn" type="submit">Run check</button>
  </form>

  <?php if ($output !== null): ?>
    <div class="mono" style="margin-top:16px;"><?php echo htmlspecialchars($output); ?></div>
  <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>