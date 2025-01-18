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

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

// Fetch members from the database (linked to member.php)
$membersQuery = "SELECT memberID, Name FROM members ORDER BY Name ASC";
$membersResult = $conn->query($membersQuery);

// Mark attendance
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_attendance'])) {
    $member_name = $_POST['member_name'];
    $class = $_POST['class'];
    $attendance = $_POST['attendance'];
    $date = $_POST['date'];

    // Fetch the memberID based on the selected member name
    $memberIdQuery = "SELECT memberID FROM members WHERE Name = ?";
    $stmt = $conn->prepare($memberIdQuery);
    $stmt->bind_param("s", $member_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $member_id = $row['memberID'];

        // Insert attendance using the fetched memberID
        $insertQuery = "INSERT INTO attendance (member_id, class_name, attendance_status, date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isss", $member_id, $class, $attendance, $date);

        if ($stmt->execute()) {
            $message = "Attendance marked successfully.";
        } else {
            $message = "Failed to mark attendance.";
        }
    } else {
        $message = "Member not found.";
    }
}

// Fetch attendance records
$attendanceQuery = "SELECT members.Name AS member_name, attendance.class_name, attendance.attendance_status, attendance.date 
    FROM attendance 
    JOIN members ON attendance.member_id = members.memberID 
    ORDER BY attendance.date DESC";
$attendanceResult = $conn->query($attendanceQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Attendance Dashboard</title>
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

        .attendance-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .attendance-form label {
            font-size: 16px;
            font-weight: bold;
        }

        .attendance-form select, .attendance-form input, .attendance-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .attendance-form button {
            background-color: rgba(0, 128, 55, 0.9);
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .attendance-form button:hover {
            background-color: rgba(0, 107, 56, 0.9);
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">Instructor Attendance Dashboard</div>
    </header>

    <div class="sidebar">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php">View Members</a>
        <a href="index.php">Home</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="dashboard">
        <h2>Mark Attendance</h2>

        <div class="attendance-form">
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            <form method="post">
                <label for="member_name">Select Member</label>
                <select id="member_name" name="member_name" required>
                    <?php
                    if ($membersResult->num_rows > 0) {
                        while ($row = $membersResult->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['Name']) . "'>" . htmlspecialchars($row['Name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No members available</option>";
                    }
                    ?>
                </select>

                <label for="class">Select Class</label>
                <select id="class" name="class" required>
                    <option value="Morning Yoga">Morning Yoga</option>
                    <option value="Weightlifting Basics">Weightlifting Basics</option>
                    <option value="Cardio Blast">Cardio Blast</option>
                </select>

                <label for="attendance">Attendance</label>
                <select id="attendance" name="attendance" required>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>

                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>

                <button type="submit" name="mark_attendance">Submit Attendance</button>
            </form>
        </div>

        <h2>Attendance Records</h2>
        <table>
            <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Class</th>
                    <th>Attendance</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($attendanceResult->num_rows > 0) {
                    while ($row = $attendanceResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['member_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['attendance_status']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No attendance records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
