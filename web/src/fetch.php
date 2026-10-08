<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Webhook Tester';
require 'includes/header.php';

$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'] ?? '';
    // NOTE: the URL is fetched directly with no allowlist.
    $output = @file_get_contents($url);
    if ($output === false) {
        $output = 'Could not fetch the supplied URL.';
    }
}
?>
<div class="panel">
  <h2>Webhook tester</h2>
  <p>Paste a URL and the server will fetch it for you. Useful for validating
     integration endpoints. This tool is not linked from the sidebar.</p>
  <form method="POST" action="fetch.php">
    <label for="url">URL to fetch</label>
    <textarea id="url" name="url" placeholder="https://hooks.example.com/endpoint"></textarea>
    <button class="btn" type="submit">Fetch</button>
  </form>

  <?php if ($output !== ''): ?>
    <div class="mono" style="margin-top:16px;"><?php echo htmlspecialchars($output); ?></div>
  <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>