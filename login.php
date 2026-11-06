<?php
session_start();
require_once "functions.php";
if (isset($_SESSION["account_id"])) { header("Location: dashboard.php"); exit; }
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    verify_csrf();
    $email = strtolower(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";
    foreach (load_accounts() as $a) {
        if ($a["email"] === $email && password_verify($password, $a["password"])) {
            $_SESSION["account_id"] = $a["id"];
            header("Location: dashboard.php"); exit;
        }
    }
    $error = "Email or password is incorrect.";
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Sign in | NovaBank</title><link rel="stylesheet" href="style.css"></head>
<body class="auth-page"><a class="brand auth-brand" href="index.php"><span class="brand-mark">N</span> NovaBank</a><div class="auth-layout"><div class="auth-aside"><span class="eyebrow">WELCOME BACK</span><h1>Your demo banking space is ready.</h1><p>Sign in to review your balance, try a transaction, or explore your activity.</p><div class="aside-note">✦ &nbsp; Secure session-based demo login</div></div>
<div class="auth-card"><a class="back-link" href="index.php">← Back to home</a><h2>Sign in</h2><p class="muted">Enter your demo account details.</p>
<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post"><?= csrf_field() ?><label>Email address<input type="email" name="email" placeholder="you@example.com" required></label><label>Password<input type="password" name="password" placeholder="Your password" required></label><button class="btn full" type="submit">Sign in →</button></form>
<p class="auth-switch">New to NovaBank? <a href="register.php">Create an account</a></p></div></div><p class="disclaimer">Educational simulation only. Never use real banking passwords here.</p></body></html>