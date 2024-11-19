<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    background-color: #f4f6fa;
}

.container {
    display: flex;
    width: 100%;
    height: 100vh;
}

.sidebar {
    width: 250px;
    background-color: #5636d3;
    color: white;
    padding: 20px;
}

.logo {
    text-align: center;
    margin-bottom: 30px;
    font-size: 24px;
}

.menu {
    list-style: none;
}

.menu li {
    padding: 15px 10px;
    margin: 10px 0;
    cursor: pointer;
    background-color: #6848e2;
    border-radius: 8px;
    font-size: 18px;
}

.menu li.active {
    background-color: #7856f5;
}

.main-content {
    flex: 1;
    padding: 30px;
    background-color: #f4f6fa;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

header h2 {
    font-size: 26px;
    font-weight: 600;
    color: #3c3c3c;
}

.search-bar input {
    padding: 10px;
    border-radius: 20px;
    border: none;
    background-color: #e4e8f1;
    width: 200px;
}

.stats-cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.stats-cards .card {
    flex: 1;
    padding: 20px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.stats-cards .card h3 {
    font-size: 24px;
    color: #5636d3;
}

.transaction-history, .balance-section {
    margin-bottom: 30px;
}

.transaction-history h3, .balance-section h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: #3c3c3c;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    text-align: left;
    padding: 15px;
    border-bottom: 1px solid #e4e8f1;
}

.completed {
    color: green;
}

.reviewed {
    color: red;
}

.side-panel {
    width: 300px;
    background-color: white;
    padding: 20px;
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
}

.user-info {
    text-align: center;
    margin-bottom: 30px;
}

.avatar {
    width: 80px;
    height: 80px;
    background-color: #e4e8f1;
    border-radius: 50%;
    margin: 0 auto 10px;
}

.user-info h4 {
    margin-bottom: 20px;
    font-size: 18px;
    color: #3c3c3c;
}

.credit-card {
    background-color: #7856f5;
    padding: 20px;
    color: white;
    border-radius: 12px;
}

.schedule-payments, .recent-payments {
    margin-bottom: 30px;
}

.schedule-payments h4, .recent-payments h4 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #3c3c3c;
}

.schedule-payments ul, .recent-payments ul {
    list-style: none;
}

.schedule-payments li, .recent-payments li {
    display: flex;
    justify-content: space-between;
    padding:
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Google Font for styling -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h1>Finance</h1>
            </div>
            <ul class="menu">
                <li class="active">Dashboard</li>
                <li>Card</li>
                <li>Transactions</li>
                <li>Goals</li>
                <li>Settings</li>
            </ul>
        </div>

        <div class="main-content">
            <header>
                <h2>Dashboard</h2>
                <p>Hi James, Good Morning!</p>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
            </header>

            <div class="stats-cards">
                <div class="card">
                    <h3>$597</h3>
                    <p>Shopping Debit & Credit Card</p>
                </div>
                <div class="card">
                    <h3>$875</h3>
                    <p>Transfer Other Country</p>
                </div>
                <div class="card">
                    <h3>$1380</h3>
                    <p>Investment & Insurance</p>
                </div>
                <div class="card">
                    <h3>$1200</h3>
                    <p>Kids Education & Hobbies</p>
                </div>
            </div>

            <div class="transaction-history">
                <h3>Transaction History</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>James Smith</td>
                            <td>Graphic Design</td>
                            <td>29/06/22</td>
                            <td>$259.50</td>
                            <td class="completed">Completed</td>
                        </tr>
                        <tr>
                            <td>Robert William</td>
                            <td>Photo Editing</td>
                            <td>25/06/22</td>
                            <td>$490.00</td>
                            <td class="reviewed">Reviewed</td>
                        </tr>
                        <tr>
                            <td>Linda Brown</td>
                            <td>Financial Planner</td>
                            <td>21/06/22</td>
                            <td>$374.00</td>
                            <td class="completed">Completed</td>
                        </tr>
                        <tr>
                            <td>Michael Brown</td>
                            <td>Architect Services</td>
                            <td>17/06/22</td>
                            <td>$842.00</td>
                            <td class="completed">Completed</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="balance-section">
                <h3>Balance</h3>
                <div class="chart">
                    <!-- Chart Placeholder -->
                </div>
            </div>
        </div>

        <div class="side-panel">
            <div class="user-info">
                <div class="avatar"></div>
                <h4>James Smith</h4>
                <div class="credit-card">
                    <p>Available Funds: <strong>$75,389.25</strong></p>
                    <p>CREDIT</p>
                    <p>Expires: 01/23</p>
                    <p>CVV: 123</p>
                </div>
            </div>

            <div class="schedule-payments">
                <h4>Schedule Payments</h4>
                <ul>
                    <li>Home Cleaning <span>$417</span> <span>12 hrs - Pending</span></li>
                    <li>Kids Education <span>$136</span> <span>2 Days - Pending</span></li>
                    <li>Car Insurance <span>$258</span> <span>3 Days - Pending</span></li>
                </ul>
            </div>

            <div class="recent-payments">
                <h4>Recent Payments</h4>
                <ul>
                    <li>Electric Bill <span>$221</span> <span>30/07/22 - Completed</span></li>
                    <li>Water Bill <span>$189</span> <span>21/07/22 - Completed</span></li>
                    <li>Home Internet Bill <span>$75</span> <span>19/07/22 - Completed</span></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
