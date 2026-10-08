<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Document Viewer';
require 'includes/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'welcome.txt';

// NOTE: page is concatenated into include() without filtering.
$content = @file_get_contents('pages/' . $page);
if ($content === false) {
    $content = 'Unable to load the requested document.';
}
?>
<div class="panel">
  <h2>Document viewer</h2>
  <p>View shared workspace documents. This tool is not linked from the sidebar;
     it is reachable directly by its path.</p>
  <div class="mono"><?php echo htmlspecialchars($content); ?></div>
</div>
<?php require 'includes/footer.php'; ?>