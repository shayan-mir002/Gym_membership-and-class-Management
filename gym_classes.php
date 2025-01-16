<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gym_membership");

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Default query for all classes
$query = "SELECT * FROM class";

// If a search term is provided, filter the classes by name or type
if (isset($_POST['classFilter']) && !empty($_POST['classFilter'])) {
    $filter = '%' . $conn->real_escape_string($_POST['classFilter']) . '%';
    $query .= " WHERE cl_name LIKE ? OR cl_schedul LIKE ?";
}

$stmt = $conn->prepare($query);

if (isset($filter)) {
    $stmt->bind_param("ss", $filter, $filter);
}

$stmt->execute();
$result = $stmt->get_result();
// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
    $loggedInUser = $_SESSION['user_name'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Classes</title>
    <style>
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
            max-width: 800px;
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

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-bar input {
            width: 70%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #008037;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #006b38;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #cccccc;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #008037;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
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
        <h1>Gym Classes</h1>
    </header>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Home</a>

      

        <a href="gym_classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php" class="active">Instructors</a>
        <a href="member.php">View Members</a>

        
    </nav>

    <div class="dashboard">
        <h2>Available Classes</h2>
        <form action="gym_classes.php" method="POST" class="search-bar">
            <input type="text" name="classFilter" placeholder="Search for a class..." value="<?php echo isset($_POST['classFilter']) ? $_POST['classFilter'] : ''; ?>">
            <button type="submit">Search</button>
        </form>

        <table id="classesTable">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Class Schedule</th>
                    <th>Instructor</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['cl_name']}</td>
                            <td>{$row['cl_schedul']}</td>
                            <td>{$row['instructor_name']}</td>
                            
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No classes found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Gym Membership and Class Management. All rights reserved.</p>
    </footer>

    <?php
    // Close the connection
    $conn->close();
    ?>
</body>
</html>
