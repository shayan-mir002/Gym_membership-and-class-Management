<?php
session_start(); // Start the session

// Logout logic
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Destroy the session and redirect to the login page
    session_destroy();
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_membership"; // Make sure to use the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all members from the database
$sql = "SELECT * FROM members";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
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

        .search-bar input {
            padding: 5px;
            font-size: 1em;
        }

        .search-bar button {
            background-color: rgba(0, 107, 56, 0.9);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile p {
            margin-right: 10px;
        }

        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .logout {
            background-color: rgba(255, 69, 58, 0.9);
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .logout:hover {
            background-color: rgba(255, 69, 58, 1);
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: rgba(0, 77, 38, 0.9);
            position: fixed;
            top: 55px; /* Adjusted to be below the header */
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
            margin-left: 250px; /* Adjusted to account for the sidebar width */
            padding: 20px;
            margin-top: 65px; /* Adjusted to create space for the fixed header */
        }

        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #004d26;
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
        <div class="profile">
            <p>Admin</p>
            <img src="uni.jpeg" alt="Profile Picture">
            <a href="member.php?action=logout" class="logout">Logout</a>
        </div>
    </header>

    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Home</a>
        
        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php" class="active">View Members</a>
    </div>

    <div class="dashboard">
        <h2>Members List</h2>
        <table>
            <thead>
                <tr>
                    
                    <th>Members Name</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                // Display each member from the database
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No members found</td></tr>";
                }
                ?>
            </tbody>
        </table>

       
            
    <?php
    // Handle form submission for adding new members
    if (isset($_POST['submit_member'])) {
        
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        

        // Insert new member into the database
        $insert_query = "INSERT INTO members ( Name, Email, join_date)
                         VALUES ( '$name', '$email')";

        if ($conn->query($insert_query) === TRUE) {
            echo "<script>alert('New member added successfully'); window.location.href = 'member.php';</script>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
