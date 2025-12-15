<?php
// donate.php
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Us - Gematria Calculator</title>
    <meta name="description" content="Support Gematria Calculator. Your donations help us maintain and improve our free tools.">
    
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    
    <script src="https://www.paypal.com/sdk/js?client-id=BAAvfy_YmvRt7Gf6kYjuQYACVCI8P-hPXIWtqxqmI8K3EfERJl_X1EXGs-xI1LKylkKVWHHXZL4B948PiE&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>

    <style>
        .donate-section {
            padding: 1rem 1rem;
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .donate-card {
            background: var(--background-alt, #ffffff);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            max-width: 600px;
            width: 100%;
            text-align: center;
            border: 1px solid var(--border-color, #eee);
        }
        .donate-card h1 {
            margin-bottom: 1rem;
            color: var(--primary-color, #333);
        }
        .donate-card p {
            margin-bottom: 2rem;
            line-height: 1.6;
            color: var(--text-color, #555);
        }
    </style>
</head>
<body>

    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    
    <div class="container">
        <section class="donate-section">
            <div class="donate-card">                                
                <div id="paypal-container-5TS6RTE42SKQS" style="margin-top: 1rem; max-width: 300px; margin-left: auto; margin-right: auto;"></div>
                <script>
                  paypal.HostedButtons({
                    hostedButtonId: "5TS6RTE42SKQS",
                  }).render("#paypal-container-5TS6RTE42SKQS")
                </script>
            </div>
        </section>

        <footer class="footer">
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
            </div>
        </footer>
    </div>

    <script src="/scripts/index.js"></script>
</body>
</html>