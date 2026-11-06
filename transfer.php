<?php
session_start(); require_once "functions.php"; $account=current_account(); $error=""; $type=$_GET["type"] ?? "transfer";
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    verify_csrf(); $type=$_POST["type"] ?? "transfer"; $amount=filter_var($_POST["amount"] ?? "", FILTER_VALIDATE_FLOAT); $description=trim($_POST["description"] ?? "");
    if (!$amount || $amount <= 0 || $amount > 1000000) $error="Enter a valid amount greater than ₹0 and up to ₹10,00,000.";
    elseif (in_array($type,["withdraw","transfer"]) && $amount > $account["balance"]) $error="Insufficient demo balance for this transaction.";
    elseif ($type==="transfer" && trim($_POST["recipient"] ?? "")==="") $error="Enter the recipient account number.";
    else {
        $account["balance"] += $type==="deposit" ? $amount : -$amount; update_account($account);
        $label=ucfirst($type); $reference="TXN".strtoupper(bin2hex(random_bytes(4)));
        $desc=$type==="transfer" ? "To account ".trim($_POST["recipient"]) : ($description ?: ($type==="deposit"?"Demo funds added":"Cash withdrawal"));
        add_transaction($account["id"],["type"=>$label,"amount"=>(float)$amount,"description"=>$desc,"date"=>date("d M Y, h:i A"),"reference"=>$reference]);
        flash($label." successful. Reference: ".$reference); header("Location: dashboard.php"); exit;
    }
}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Money transfer | NovaBank</title><link rel="stylesheet" href="style.css"><script defer src="script.js"></script></head><body class="app-body">
<aside class="sidebar"><a class="brand" href="dashboard.php"><span class="brand-mark">N</span> NovaBank</a><div class="side-label">MENU</div><a class="side-link" href="dashboard.php">▦ &nbsp; Overview</a><a class="side-link active" href="transfer.php">⇄ &nbsp; Transfer money</a><a class="side-link" href="transactions.php">▤ &nbsp; Transactions</a><div class="sidebar-bottom"><div class="user-mini"><span class="avatar"><?= e(strtoupper(substr($account["name"],0,1))) ?></span><div><strong><?= e($account["name"]) ?></strong><small>Demo customer</small></div></div><a class="side-link" href="logout.php">↪ &nbsp; Sign out</a></div></aside>
<main class="app-main"><header class="app-top"><div><span class="muted">Account services</span><h1>Move your money</h1></div><span class="demo-pill">DEMO ACCOUNT</span></header><?php show_flash(); ?>
<div class="transfer-layout"><section class="panel transfer-panel"><div class="panel-heading"><div><h3>New transaction</h3><p class="muted">Choose an action and enter the details below.</p></div></div>
<?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
<div class="type-tabs"><a class="<?= $type==="deposit"?"selected":"" ?>" href="transfer.php?type=deposit">＋ Deposit</a><a class="<?= $type==="withdraw"?"selected":"" ?>" href="transfer.php?type=withdraw">− Withdraw</a><a class="<?= $type==="transfer"?"selected":"" ?>" href="transfer.php?type=transfer">⇄ Transfer</a></div>
<form method="post" class="transaction-form" id="transactionForm"><?= csrf_field() ?><input type="hidden" name="type" value="<?= e($type) ?>">
<div class="available-box"><span>Available demo balance</span><strong><?= money($account["balance"]) ?></strong></div>
<?php if ($type==="transfer"): ?><label>Recipient account number<input name="recipient" placeholder="Enter recipient demo account number" required></label><?php endif; ?>
<label>Amount (INR)<div class="amount-input"><span>₹</span><input type="number" name="amount" min="1" max="1000000" step="0.01" placeholder="0.00" required></div></label>
<label>Description (optional)<input name="description" maxlength="100" placeholder="e.g. Monthly savings"></label>
<div class="security-note">ⓘ &nbsp; This transaction only updates your local demo data. No real funds are moved.</div>
<button class="btn full" type="submit">Confirm <?= e($type) ?> →</button></form></section>
<aside class="help-panel"><div class="help-icon">✦</div><h3>Practice with confidence</h3><p>This portal is designed for learning. Use another demo account number when testing transfers; the project records the recipient as a transaction note.</p><div class="help-divider"></div><strong>Current account</strong><p><?= e($account["id"]) ?><br><?= e($account["email"]) ?></p></aside></div><p class="app-disclaimer">Educational simulation only. Not connected to any bank or payment network.</p></main></body></html>