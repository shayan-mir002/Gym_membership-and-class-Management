<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');

    // Check for empty fields
    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required!');</script>";
        exit;
    }

    // Database connection
    $conn = new mysqli("localhost", "root", "", "gym_membership");

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepared statement to insert data
    $sql = "INSERT INTO members (Name, Email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            // Store user data in session and redirect to homepage after successful signup
            $_SESSION['user_name'] = $name;
            echo "<script>
                    alert('Welcome, $name!');
                    window.location.href = 'index.php'; // Redirect to homepage
                  </script>";
        } else {
            echo "<script>alert('Error: Could not execute query.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: Could not prepare statement.');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('gym.jpeg') no-repeat center center fixed;
            background-size: cover;
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
            max-width: 450px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #004d26;
            margin-bottom: 20px;
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
            font-weight: bold;
            color: #333333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #008037;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }

        .form-group button:hover {
            background-color: #006b38;
        }

        .form-group .login-link {
            margin-top: 10px;
            text-align: center;
        }

        .form-group .login-link a {
            color: #008037;
            text-decoration: none;
            font-weight: bold;
        }

        .form-group .login-link a:hover {
            text-decoration: underline;
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
        <h1>Sign Up</h1>
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

    <!-- Signup Form -->
    <div class="container">
        <h2>Create Your Account</h2>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="signup-name">Full Name:</label>
                <input type="text" id="signup-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="signup-email">Email:</label>
                <input type="email" id="signup-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password:</label>
                <input type="password" id="signup-password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
            <div class="form-group login-link">
                <p>Already have an account? <a href="login.php">Sign In</a></p>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Gym Membership and Class Management. All rights reserved.</p>
    </footer>

   