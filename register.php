<?php
session_start();
require_once "functions.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    verify_csrf();
    $name = trim($_POST["name"] ?? "");
    $email = strtolower(trim($_POST["email"] ?? ""));
    $phone = preg_replace('/\D+/', '', $_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";
    if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($phone) !== 10 || strlen($password) < 6) {
        $error = "Enter a name, valid email, 10-digit mobile number, and password with at least 6 characters.";
    } else {
        $accounts = load_accounts();
        foreach ($accounts as $a) if ($a["email"] === $email) $error = "An account with this email already exists.";
        if (!$error) {
            $id = "NB" . random_int(10000000, 99999999);
            $accounts[] = ["id"=>$id,"name"=>$name,"email"=>$email,"phone"=>$phone,"password"=>password_hash($password, PASSWORD_DEFAULT),"balance"=>10000.00,"created"=>date("Y-m-d H:i:s")];
            save_accounts($accounts);
            $_SESSION["account_id"] = $id;
            header("Location: dashboard.php"); exit;
        }
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Create account | NovaBank</title><link rel="stylesheet" href="style.css"><script defer src="script.js"></script></head>
<body class="auth-page"><a class="brand auth-brand" href="index.php"><span class="brand-mark">N</span> NovaBank</a>
<div class="auth-layout"><div class="auth-aside"><span class="eyebrow">GET STARTED</span><h1>A smarter way to practice banking.</h1><p>Create a demo profile and explore the dashboard. Your starting balance is simulated and has no cash value.</p><div class="aside-note">✦ &nbsp; Designed for learning web technologies</div></div>
<div class="auth-card"><a class="back-link" href="index.php">← Back to home</a><h2>Create your account</h2><p class="muted">It takes less than a minute.</p>
<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="validate-form">
<?= csrf_field() ?>
<label>Full name<input name="name" type="text" placeholder="e.g. Hari Charan" required maxlength="80"></label>
<label>Email address<input name="email" type="email" placeholder="you@example.com" required></label>
<label>Mobile number<input name="phone" type="tel" placeholder="10-digit mobile number" inputmode="numeric" pattern="[0-9]{10}" required></label>
<label>Password<input name="password" type="password" placeholder="At least 6 characters" minlength="6" required></label>
<button class="btn full" type="submit">Create demo account →</button>
</form><p class="auth-switch">Already registered? <a href="login.php">Sign in</a></p>
</div></div><p class="disclaimer">Demo project only. Do not enter real banking credentials or sensitive financial information.</p></body></html>