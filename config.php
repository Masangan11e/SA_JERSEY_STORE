
<?php
// Load PayFast config from environment variables (set these in Render)
$PF_BASE_URL    = rtrim(getenv('PF_BASE_URL') ?: 'https://sandbox.payfast.co.za', '/');
$PF_MERCHANT_ID = getenv('PF_MERCHANT_ID') ?: '';
$PF_MERCHANT_KEY= getenv('PF_MERCHANT_KEY') ?: '';
$PF_PASSPHRASE  = getenv('PF_PASSPHRASE') ?: '';

$RETURN_URL = getenv('PF_RETURN_URL') ?: '';
$CANCEL_URL = getenv('PF_CANCEL_URL') ?: '';
$NOTIFY_URL = getenv('PF_NOTIFY_URL') ?: '';

// Helper: create a PayFast signature (MD5 of sorted, urlencoded fields + optional passphrase)
function pf_signature(array $data, ?string $passphrase = null): string {
    ksort($data);
    $pairs = [];
    foreach ($data as $key => $val) {
        if ($key === 'signature') continue;
        if ($val === '' || $val === null) continue;
        $pairs[] = $key . '=' . urlencode(trim((string)$val));
    }
    if ($passphrase !== null && $passphrase !== '') {
        $pairs[] = 'passphrase=' . urlencode($passphrase);
    }
    $query = implode('&', $pairs);
    return md5($query);
}
