<?php
// Initialize payment data (simulate manual entry)
$paymentHistory = [];

// Handle form submission for new payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member = $_POST['member'];
    $membership = $_POST['membership'];
    $amount = $_POST['amount'];

    // Add the new payment to the history
    $paymentHistory[] = [
        'Name' => $member,
        'Membership_Type' => $membership,
        'AMOUNT' => $amount
    ];
}

// Handle delete action (example: deleting the last entry)
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    // Remove the payment record at the specified index
    unset($paymentHistory[$deleteIndex]);
    // Re-index the array to fix keys
    $paymentHistory = array_values($paymentHistory);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: rgba(0, 128, 55, 0.9);
            color: #ffffff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header .brand {
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: rgba(0, 77, 38, 0.9);
            position: fixed;
            top: 55px;
            left: 0;
            padding-top: 25px;
            color: #ffffff;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 5px;
            transition: background 0.3s ease;
        }

        .sidebar a:hover {
            background-color: rgba(0, 107, 56, 0.9);
        }

        .sidebar .active {
            background-color: rgba(0, 107, 56, 0.9);
        }

        .dashboard {
            margin-left: 250px;
            padding: 20px;
            margin-top: 65px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: rgba(0, 107, 56, 0.9);
            color: white;
        }

        .membership-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .membership-form h2 {
            margin-bottom: 10px;
            color: #004d26;
        }

        .membership-form label {
            font-size: 16px;
            font-weight: bold;
        }

        .membership-form input, .membership-form select, .membership-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .membership-form button {
            background-color: rgba(0, 128, 55, 0.9);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .membership-form button:hover {
            background-color: rgba(0, 107, 56, 0.9);
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">Gym Dashboard</div>
    </header>

    <div class="sidebar">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="index.php">Home</a>
        
        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php">View Members</a>
    </div>

    <div class="dashboard">
        <h2>Payment History</h2>
        <table id="paymentHistoryTable">
            <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Membership Type</th>
                    <th>Amount Paid</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display payment history from manual input
                foreach ($paymentHistory as $index => $payment) {
                    echo "<tr>
                            <td>" . htmlspecialchars($payment['Name']) . "</td>
                            <td>" . ucfirst(htmlspecialchars($payment['Membership_Type'])) . "</td>
                            <td>$" . htmlspecialchars($payment['AMOUNT']) . "</td>
                            <td><a href='monthly_fee.php?delete=$index'>Delete</a></td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="membership-form">
            <h2>Add Payment</h2>
            <form action="monthly_fee.php" method="POST">
                <label for="member">Member Name</label>
                <input type="text" id="member" name="member" required>

                <label for="membership">Membership Type</label>
                <select id="membership" name="membership">
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="vip">VIP</option>
                </select>

                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" required>

                <button type="submit">Add Payment</button>
            </form>
        </div>
    </div>

</body>
</html>
