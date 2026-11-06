# NovaBank — Simulated Online Banking Portal

A responsive educational mini-project built with HTML, CSS, JavaScript, and PHP.

## Features
- Demo account registration and login (passwords are hashed).
- Dashboard with simulated account balance and account number.
- Deposit, withdrawal, and transfer practice flows.
- Transaction history with client-side search.
- PHP server-side validation, session login, CSRF form tokens, and JSON file storage.
- Responsive desktop and mobile interface.

## Requirements
- PHP 7.4+ (PHP 8+ recommended)
- XAMPP, WAMP, MAMP, or PHP built-in development server

## Run using XAMPP
1. Extract the `online_banking_portal` folder.
2. Copy it into your XAMPP `htdocs` folder.
3. Start **Apache** from the XAMPP Control Panel.
4. Open `http://localhost/online_banking_portal/`.
5. Select **Open demo account**, register with test details, and explore the dashboard.

## Run using PHP's built-in server
Open a terminal in this project folder and run:
```bash
php -S localhost:8000
```
Then visit `http://localhost:8000/`.

## How to test
1. Register a demo account. It starts with a fictional balance of ₹10,000.
2. Use Deposit to add simulated funds.
3. Use Withdraw to subtract simulated funds.
4. Use Transfer to record a simulated transfer. This demo records the recipient account number as a transaction note; it does not send funds to another account.
5. View all activity in Transactions and use the search field.

## Project files
- `index.php` — landing page
- `register.php`, `login.php`, `logout.php` — account access
- `dashboard.php` — account overview
- `transfer.php` — deposit, withdrawal, and transfer
- `transactions.php` — transaction history
- `functions.php` — shared PHP helpers and JSON storage
- `style.css` — responsive styling
- `script.js` — client-side validation and transaction search
- `data/` — JSON data files (created/updated while using the app)

## Important safety note
This is a classroom simulation only. It is not connected to a bank, payment gateway, UPI, or financial network. Do not use real bank credentials, real account numbers, or sensitive personal information. The starting balance and all transactions are fictional. For a production banking system, professional security review, a database, HTTPS, access controls, audit logging, and regulatory compliance would be required.
