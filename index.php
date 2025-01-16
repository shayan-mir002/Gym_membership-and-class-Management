<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_membership";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // If not logged in, allow access to the login/signup pages.
    $is_logged_in = false;
} else {
    // If logged in, get the user's name and mark the user as logged in
    $is_logged_in = true;
    $loggedInUser = $_SESSION['user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Membership and Class Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url(GA.jpg);
            background-size: 100% auto;
            color: #333333;
        }

        header {
            background-color: rgba(0, 128, 55, 0.9);
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        nav {
            background-color: rgba(0, 77, 38, 0.9);
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: #ffffff;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            background-color: rgba(0, 107, 56, 0.9);
            transition: background-color 0.3s;
        }

        .container {
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            margin: 20px auto;
            border-radius: 10px;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #ffffff;
        }

        h2 {
            color: #004d26;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            color: #333333;
        }

        table th, table td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #008037;
            color: #ffffff;
        }

        .form-group {
            margin: 10px 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            background-color: #ffffff;
            color: #333333;
        }

        .form-group button {
            background-color: #008037;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .form-group button:hover {
            background-color: #006b38;
            transition: background-color 0.3s;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: rgba(0, 77, 38, 0.9);
            color: #ffffff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
<header>
    <h1>Gym Membership and Class Management</h1>
</header>

<nav>
    <div class="sidebar">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="index.php">Home</a>

        <?php if (!$is_logged_in): ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        <?php endif; ?>

        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php">View Members</a>

        <?php if ($is_logged_in): ?>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
    <?php if ($is_logged_in): ?>
        <h2>Welcome, <?php echo htmlspecialchars($loggedInUser); ?>!</h2>
        <p>Your health and fitness journey starts here. Explore our classes, instructors, and top-notch gym equipment!</p>
    <?php else: ?>
        <h2>Welcome to our Gym Membership Portal</h2>
        <p>Please sign in or sign up to get started.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Gym Membership and Class Management. All rights reserved.</p>
</footer>

</body>
</html>
