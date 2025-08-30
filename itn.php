
<?php
require __DIR__.'/config.php';

function log_itn($msg) {
    error_log('[ITN] ' . $msg);
}

// 1) Grab POST
$data = $_POST;

// 2) Verify signature
$received_sig = $data['signature'] ?? '';
$calc_sig     = pf_signature($data, $PF_PASSPHRASE);
if (!hash_equals($calc_sig, $received_sig)) {
    log_itn('Invalid signature');
    http_response_code(400);
    exit('Invalid signature');
}

// 3) TODO: Validate against your order DB (amount, status, etc.)

// 4) Log status
$status = $data['payment_status'] ?? 'unknown';
$amount = $data['amount_gross']  ?? '0.00';
$pf_id  = $data['pf_payment_id'] ?? 'n/a';

log_itn("Valid ITN: pf_payment_id=$pf_id status=$status amount=$amount");
http_response_code(200);
echo 'OK';
