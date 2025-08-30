
<?php
require __DIR__.'/config.php';

// Example order data; in real life derive from cart/DB
$amount    = isset($_GET['amount']) ? number_format((float)$_GET['amount'], 2, '.', '') : '800.00';
$item_name = isset($_GET['item']) ? substr($_GET['item'], 0, 100) : 'Football Jersey';

$payload = [
    'merchant_id'  => $PF_MERCHANT_ID,
    'merchant_key' => $PF_MERCHANT_KEY,
    'return_url'   => $RETURN_URL,
    'cancel_url'   => $CANCEL_URL,
    'notify_url'   => $NOTIFY_URL,
    'amount'       => $amount,
    'item_name'    => $item_name,
];

$payload['signature'] = pf_signature($payload, $PF_PASSPHRASE);
$process_url = $PF_BASE_URL . '/eng/process';
?>
<!doctype html>
<html>
  <head><meta charset="utf-8"><title>Redirecting to PayFast…</title></head>
  <body>
    <p>Redirecting to PayFast…</p>
    <form id="pfForm" action="<?= htmlspecialchars($process_url) ?>" method="post">
      <?php foreach ($payload as $k => $v): ?>
        <input type="hidden" name="<?= htmlspecialchars($k) ?>" value="<?= htmlspecialchars($v) ?>">
      <?php endforeach; ?>
      <noscript><button type="submit">Continue</button></noscript>
    </form>
    <script>document.getElementById('pfForm').submit();</script>
  </body>
</html>
