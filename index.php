<?php
session_start();
if (isset($_SESSION['account_id'])) { header("Location: dashboard.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NovaBank | Simulated Online Banking</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="landing">
<header class="site-header">
  <a class="brand" href="index.php"><span class="brand-mark">N</span> NovaBank</a>
  <nav><a href="#features">Features</a><a href="login.php">Sign in</a><a class="btn btn-small" href="register.php">Open demo account</a></nav>
</header>
<main>
  <section class="hero">
    <div class="hero-copy">
      <span class="eyebrow">A SAFE SPACE TO LEARN DIGITAL BANKING</span>
      <h1>Your money,<br><span>made simple.</span></h1>
      <p>Explore a simulated online banking experience. Practice checking balances, making transfers, and reviewing transactions — using demo data only.</p>
      <div class="hero-actions"><a class="btn" href="register.php">Create demo account <span>→</span></a><a class="text-link" href="login.php">I already have an account</a></div>
      <div class="trust-note"><span class="status-dot"></span> Educational demo · No real money involved</div>
    </div>
    <div class="hero-visual">
      <div class="visual-glow"></div>
      <div class="bank-card">
        <div class="card-top"><span>NOVABANK</span><span class="chip">▦</span></div>
        <div class="card-chip"></div>
        <div class="card-number">•••• &nbsp; •••• &nbsp; •••• &nbsp; 4829</div>
        <div class="card-bottom"><span>DEMO CUSTOMER</span><strong>VISA</strong></div>
      </div>
      <div class="float-card"><span class="float-icon">↗</span><div><small>Monthly activity</small><strong>All looking good</strong></div><span class="positive">+12.8%</span></div>
      <div class="mini-stat"><small>Available balance</small><strong>₹ 48,250.00</strong><span>Demo preview</span></div>
    </div>
  </section>
  <section class="features section-wrap" id="features">
    <div class="section-heading"><span class="eyebrow">BANKING, WITHOUT THE COMPLEXITY</span><h2>Everything in one place.</h2><p>Try the essential features of a digital bank in a student-friendly project.</p></div>
    <div class="feature-grid">
      <article class="feature-card"><div class="feature-icon">◉</div><h3>Account overview</h3><p>View your simulated balance and account information in one clean dashboard.</p></article>
      <article class="feature-card"><div class="feature-icon">⇄</div><h3>Move money</h3><p>Practice deposits, withdrawals, and transfers between demo accounts.</p></article>
      <article class="feature-card"><div class="feature-icon">▤</div><h3>Track activity</h3><p>Review your transaction history with dates, amounts, and status labels.</p></article>
    </div>
  </section>
</main>
<footer class="footer"><span>© 2026 NovaBank Demo</span><span>Educational simulation only — not a real financial institution.</span></footer>
</body></html>