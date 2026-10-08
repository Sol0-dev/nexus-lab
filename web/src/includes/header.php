<?php
$NAV = array(
    'index.php'   => array('Dashboard', 'M3.75 13.5l10.5-11.25L12 10.5V21h-4.5v-7.5H3.75z'),
    'invoice.php' => array('Invoices', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'),
    'profile.php' => array('My Profile', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'),
    'ping.php'    => array('Diagnostics', 'M13 10V3L4 14h7v7l9-11h-7z'),
);
$CURRENT = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($PAGE_TITLE) ? htmlspecialchars($PAGE_TITLE) : 'Nexus Office Portal'; ?></title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="app">
  <aside class="sidebar">
    <div class="brand">
      <span class="brand-mark">N</span>
      <span class="brand-name">Nexus Office</span>
    </div>
    <nav class="nav">
      <?php foreach ($NAV as $href => $item): ?>
        <a class="nav-link <?php echo $CURRENT === $href ? 'active' : ''; ?>" href="<?php echo $href; ?>">
          <span class="nav-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo $item[1]; ?>"/></svg></span>
          <?php echo $item[0]; ?>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="sidebar-foot">
      <span class="dot"></span> All systems nominal
    </div>
  </aside>
  <main class="main">
    <header class="topbar">
      <div class="page-title"><?php echo isset($PAGE_TITLE) ? htmlspecialchars($PAGE_TITLE) : 'Dashboard'; ?></div>
      <div class="user-chip">
        <span class="avatar"><?php echo isset($_SESSION['user']) ? strtoupper(substr($_SESSION['user'], 0, 1)) : '?'; ?></span>
        <span><?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']) : 'Guest'; ?></span>
        <?php if (!empty($_SESSION['uid'])): ?>
          <a class="logout" href="logout.php">Sign out</a>
        <?php endif; ?>
      </div>
    </header>
    <section class="content">