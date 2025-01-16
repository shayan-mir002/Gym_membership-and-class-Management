<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('gym.jpeg') no-repeat center center fixed;
            background-size: 100% auto;
            color: #333333;
        }

        header {
            background-color: rgba(0, 128, 55, 0.9);
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
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
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #004d26;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 10px;
            background-color: #008037;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .form-group button:hover {
            background-color: #006b38;
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
        <h1>Member Registration</h1>
    </header>

    <nav>
        <div class="sidebar">
            <a href="dashboard.php" class="active">Dashboard</a>
        </div>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>
        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php">View Members</a>
    </nav>

    <!-- Login Form -->
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Gym Membership and Class Management. All rights reserved.</p>
    </footer>

    <?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "gym_membership");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check user credentials
    $sql = "SELECT Name FROM members WHERE Email = ? AND Password = ?"; // Assuming passwords are stored in plain text
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password); // Bind email and password
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Name'];

        // Store username in session and redirect to homepage
        $_SESSION['user_name'] = $name;

        echo "<script>
                alert('Welcome, $name!');
                window.location.href = 'index.php'; // Redirect to homepage
              </script>";
    } else {
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
