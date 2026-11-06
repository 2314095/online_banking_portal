<?php
// Shared helpers for the simulated banking project.
define("DATA_FILE", __DIR__ . "/data/accounts.json");
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8"); }
function load_accounts() {
    if (!file_exists(DATA_FILE)) return [];
    $data = json_decode(file_get_contents(DATA_FILE), true);
    return is_array($data) ? $data : [];
}
function save_accounts($accounts) {
    file_put_contents(DATA_FILE, json_encode(array_values($accounts), JSON_PRETTY_PRINT), LOCK_EX);
}
function current_account() {
    if (empty($_SESSION["account_id"])) { header("Location: login.php"); exit; }
    foreach (load_accounts() as $a) if ($a["id"] === $_SESSION["account_id"]) return $a;
    session_destroy(); header("Location: login.php"); exit;
}
function update_account($updated) {
    $accounts = load_accounts();
    foreach ($accounts as $i => $a) if ($a["id"] === $updated["id"]) { $accounts[$i] = $updated; break; }
    save_accounts($accounts);
}
function load_transactions($id) {
    $file = __DIR__ . "/data/transactions_" . preg_replace('/[^A-Za-z0-9]/', '', $id) . ".json";
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}
function add_transaction($id, $transaction) {
    $items = load_transactions($id);
    array_unshift($items, $transaction);
    $file = __DIR__ . "/data/transactions_" . preg_replace('/[^A-Za-z0-9]/', '', $id) . ".json";
    file_put_contents($file, json_encode(array_slice($items, 0, 200), JSON_PRETTY_PRINT), LOCK_EX);
}
function csrf_token() {
    if (empty($_SESSION["csrf"])) $_SESSION["csrf"] = bin2hex(random_bytes(32));
    return $_SESSION["csrf"];
}
function csrf_field() { return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">'; }
function verify_csrf() {
    if (!hash_equals($_SESSION["csrf"] ?? "", $_POST["csrf"] ?? "")) { http_response_code(403); exit("Invalid form token. Please go back and try again."); }
}
function money($amount) { return "₹" . number_format((float)$amount, 2); }
function flash($message, $type="success") { $_SESSION["flash"] = ["message"=>$message,"type"=>$type]; }
function show_flash() {
    if (!empty($_SESSION["flash"])) { $f=$_SESSION["flash"]; echo '<div class="alert '.e($f["type"]).'">'.e($f["message"]).'</div>'; unset($_SESSION["flash"]); }
}
