<style>
/* Reset and font */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

body {
    display: flex;
    background-color: #f8f9fd;
}

.sidebar {
    width: 250px;
    padding: 20px;
    background-color: #2f3542;
    color: white;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
}

.menu {
    list-style: none;
}

.menu li {
    padding: 10px;
    font-size: 18px;
    cursor: pointer;
    margin-bottom: 10px;
    color: #ffffff;
    border-radius: 8px;
}

.menu li.active, .menu li:hover {
    background-color: #57606f;
}

.settings {
    position: absolute;
    bottom: 20px;
    width: 100%;
    color: #ffffff;
    text-align: center;
}

.main-content {
    flex: 1;
    padding: 30px;
    background-color: #f1f2f6;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

header h2 {
    font-size: 28px;
    color: #2f3542;
}

.filters {
    margin-bottom: 20px;
}

.filters button {
    background-color: #dfe4ea;
    border: none;
    padding: 10px 20px;
    margin-right: 10px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
}

.filters button.active {
    background-color: #00bcd4;
    color: white;
}

.dashboard-content {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 20px;
}

.card-info, .income-expenses, .money-flow, .recent-transactions {
    background-color: white;
    border-radius: 12px;
    padding: 20px;
    width: 100%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card-info h3, .income-expenses h3, .money-flow h3, .recent-transactions h3 {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
    color: #2f3542;
}

.card-info .card {
    display: flex;
    justify-content: space-between;
}

.card-info .balance {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
}

.income-expenses {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.income-expenses div {
    flex: 1;
    text-align: center;
}

.income-expenses p {
    font-size: 24px;
    font-weight: bold;
    color: #2f3542;
}

.money-flow .chart {
    height: 200px;
    background-color: #f8f9fd;
    border-radius: 12px;
}

.recent-transactions ul {
    list-style: none;
}

.recent-transactions ul li {
    font-size: 16px;
    margin-bottom: 10px;
    color: #2f3542;
}

.notification {
    padding: 15px;
    background-color: #f0f4f7;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.notification button {
    background-color: #00bcd4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS file -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>PAYGUARD</h1>
        </div>
        <ul class="menu">
            <li class="active">Dashboard</li>
            <li>Card</li>
            <li>Transaction</li>
            <li>Reporting</li>
            <li>Account</li>
        </ul>
        <div class="settings">
            <p>Support</p>
            <p>Settings</p>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>Banking Dashboard</h2>
            <p>Welcome back, Shani!</p>
        </header>

        <div class="filters">
            <button>12 months</button>
            <button class="active">30 days</button>
            <button>7 days</button>
            <button>24 hours</button>
        </div>

        <div class="dashboard-content">
            <div class="card-info">
                <h3>Primary account</h3>
                <div class="card">
                    <div class="card-details">
                        <p class="balance">$40,206.20</p>
                        <p class="name">Shani Febrianti</p>
                        <p class="expiry">06/24</p>
                        <p class="card-number">1234 1234 1234 1234</p>
                    </div>
                    <img src="mastercard-logo.png" alt="Mastercard Logo">
                </div>
            </div>

            <div class="income-expenses">
                <div class="total-income">
                    <h3>Total Income</h3>
                    <p>$6,421.10</p>
                    <p class="trend">+2.0%</p>
                </div>
                <div class="total-expense">
                    <h3>Total Expense</h3>
                    <p>$561.35</p>
                </div>
            </div>

            <div class="money-flow">
                <h3>Money Flow</h3>
                <div class="chart">
                    <!-- Placeholder for the chart -->
                </div>
            </div>

            <div class="recent-transactions">
                <h3>Recent Transactions</h3>
                <ul>
                    <li>Internal Payment - $100.00 (VISA)</li>
                    <li>External Payment - $50.00 (MasterCard)</li>
                    <li>Stripe Payment - $200.00</li>
                    <li>Internal Payment - $300.00 (VISA)</li>
                </ul>
            </div>
        </div>

        <div class="notification">
            <p>Used space: Your team has used 80% of your available space.</p>
            <button>Upgrade plan</button>
            <button>Dismiss</button>
        </div>
    </div>
</body>
</html>