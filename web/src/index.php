<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Dashboard';
require 'includes/header.php';
?>
<div class="grid">
  <div class="card">
    <div class="stat-label">Active users</div>
    <div class="stat-value">1,284</div>
    <div class="stat-note">across 9 teams</div>
  </div>
  <div class="card">
    <div class="stat-label">Open invoices</div>
    <div class="stat-value">37</div>
    <div class="stat-note">this quarter</div>
  </div>
  <div class="card">
    <div class="stat-label">System health</div>
    <div class="stat-value">98.4%</div>
    <div class="stat-note"><span class="badge badge-ok">Operational</span></div>
  </div>
  <div class="card">
    <div class="stat-label">Support tickets</div>
    <div class="stat-value">12</div>
    <div class="stat-note">2 escalated</div>
  </div>
</div>

<div class="panel">
  <h2>Recent activity</h2>
  <table>
    <tr><th>Time</th><th>Event</th><th>User</th><th>Status</th></tr>
    <tr><td>09:41</td><td>Invoice reviewed</td><td>nova</td><td><span class="badge badge-ok">Done</span></td></tr>
    <tr><td>09:12</td><td>Document exported</td><td>admin</td><td><span class="badge badge-ok">Done</span></td></tr>
    <tr><td>08:55</td><td>Network probe</td><td>system</td><td><span class="badge badge-warn">Pending</span></td></tr>
    <tr><td>08:20</td><td>Profile updated</td><td>maya</td><td><span class="badge badge-info">Audited</span></td></tr>
  </table>
</div>

<div class="panel">
  <h2>System notes</h2>
  <p>Quarterly security review is scheduled for next week. The operations team
     is rotating the backup credentials ahead of the audit, and several legacy
     tools are being re-evaluated for removal from the workspace.</p>
</div>
<?php require 'includes/footer.php'; ?>