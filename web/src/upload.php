<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Avatar Upload';
require 'includes/header.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $name = basename($_FILES['avatar']['name']);
    $dest = 'uploads/' . $name;
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dest)) {
        $message = 'Avatar uploaded successfully to ' . $dest . '. Flag: FLAG{up10ad_4nd_3x3c}';
    } else {
        $message = 'Upload failed.';
    }
}
?>
<div class="panel">
  <h2>Avatar upload</h2>
  <p>Update your profile picture. This tool is not linked from the sidebar;
     it is reachable directly by its path.</p>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <label for="avatar">Choose an image</label>
    <input type="file" id="avatar" name="avatar">
    <button class="btn" type="submit">Upload</button>
  </form>

  <?php if ($message): ?>
    <div class="alert alert-ok"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>
</div>
<?php require 'includes/footer.php'; ?>