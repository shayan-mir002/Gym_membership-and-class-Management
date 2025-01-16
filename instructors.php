<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_membership";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all instructors from the database
$sql = "SELECT * FROM instructors";
$result = $conn->query($sql);

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_name']);
$loggedInUser = $is_logged_in ? $_SESSION['user_name'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors</title>
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
            background-color: #ffffff;
            margin: 20px auto;
            border-radius: 10px;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #004d26;
        }

        .instructor-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .instructor-card {
            background-color: #fff;
            padding: 20px;
            margin: 15px;
            width: 250px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .instructor-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .instructor-card h3 {
            color: #008037;
        }

        .instructor-card p {
            color: #333;
        }

        .instructor-card .details {
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }

        .instructor-card .contact-btn {
            background-color: #008037;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            margin-top: 15px;
        }

        .instructor-card .contact-btn:hover {
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
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Home</a>

        <?php if (!$is_logged_in): ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        <?php endif; ?>

        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php" class="active">Instructors</a>
        <a href="member.php">View Members</a>

        <?php if ($is_logged_in): ?>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>

    <div class="container">
        <h2>Meet Our Instructors</h2>
        <div class="instructor-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='instructor-card'>";
                    echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p>Specialization: " . htmlspecialchars($row['specialization']) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
                    echo "<p>Phone: " . htmlspecialchars($row['phone']) . "</p>";
                    echo "<div class='details'>";
                    
                    echo "<p>" . nl2br(htmlspecialchars($row['bio'])) . "</p>";
                    echo "</div>";
                   
                    echo "</div>";
                }
            } else {
                echo "<p>No instructors found.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Gym Membership and Class Management. All rights reserved.</p>
    </footer>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
