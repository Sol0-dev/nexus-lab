<?php
require 'includes/config.php';
require_login();
$PAGE_TITLE = 'Invoices';
require 'includes/header.php';

$id = isset($_GET['id']) ? $_GET['id'] : 101;

$invoice = null;
if ($id == 1) {
    $invoice = array(
        'num' => '001',
        'title' => 'CEO Expense Report (Confidential)',
        'amount' => '$12,840.00',
        'note' => 'Flag: FLAG{0bj3c7_l3v3l_4uth}',
    );
} elseif ($id == 100) {
    $invoice = array('num' => '100', 'title' => 'Office Supplies - Q3', 'amount' => '$45.00');
} elseif ($id == 101) {
    $invoice = array('num' => '101', 'title' => 'Office Supplies - Q4', 'amount' => '$52.00');
} elseif ($id == 102) {
    $invoice = array('num' => '102', 'title' => 'Travel Reimbursement', 'amount' => '$312.00');
} elseif ($id == 103) {
    $invoice = array('num' => '103', 'title' => 'Software Licenses', 'amount' => '$1,040.00');
} else {
    $invoice = array('num' => $id, 'title' => 'Unknown invoice', 'amount' => '$0.00');
}
?>
<div class="panel">
  <h2>Invoice #<?php echo $id; ?></h2>
  <table>
    <tr><th>Number</th><td><?php echo $invoice['num']; ?></td></tr>
    <tr><th>Title</th><td><?php echo $invoice['title']; ?></td></tr>
    <tr><th>Amount</th><td><?php echo $invoice['amount']; ?></td></tr>
  </table>
  <?php if (!empty($invoice['note'])): ?>
    <div class="alert alert-warn"><?php echo $invoice['note']; ?></div>
  <?php endif; ?>
</div>

<div class="panel">
  <h2>Invoice index</h2>
  <table>
    <tr><th>ID</th><th>Title</th><th>Open</th></tr>
    <tr><td>100</td><td>Office Supplies - Q3</td><td><a href="invoice.php?id=100">view</a></td></tr>
    <tr><td>101</td><td>Office Supplies - Q4</td><td><a href="invoice.php?id=101">view</a></td></tr>
    <tr><td>102</td><td>Travel Reimbursement</td><td><a href="invoice.php?id=102">view</a></td></tr>
    <tr><td>103</td><td>Software Licenses</td><td><a href="invoice.php?id=103">view</a></td></tr>
  </table>
</div>
<?php require 'includes/footer.php'; ?>