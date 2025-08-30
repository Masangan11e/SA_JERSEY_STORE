
# PayFast on Render (PHP + Apache, Docker)

This repo is prepped for Render hosting. Secrets come from environment variables.

## Files
- `Dockerfile` — PHP 8.2 + Apache
- `.render.yaml` — defines a Web Service on Render
- `config.php` — reads PayFast creds + URLs from env vars
- `checkout.php`, `itn.php`, `success.php`, `cancel.php`, `index.html`

## Quick Start
1) Set env vars on Render (same keys as in `.env.example`):
   - `PF_BASE_URL` (`https://sandbox.payfast.co.za` for testing)
   - `PF_MERCHANT_ID`, `PF_MERCHANT_KEY`, `PF_PASSPHRASE`
   - `PF_RETURN_URL`, `PF_CANCEL_URL`, `PF_NOTIFY_URL`
2) Deploy to Render (connect GitHub repo with these files).
3) Browse to `/` and click **Buy** to test.
4) Check server logs for ITN posts; for production, persist ITNs to a database.

## Going Live
- Switch `PF_BASE_URL` to `https://www.payfast.co.za`
- Use live merchantId/key/passphrase
