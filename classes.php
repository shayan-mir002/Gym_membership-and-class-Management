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
    <script>
        // Redirect to this page automatically after login
        document.addEventListener("DOMContentLoaded", () => {
            const loggedIn = true; // Mock login status. Replace with actual login logic.
            if (loggedIn) {
                window.location.href = "gym_classes.php"; // Update with your backend class page
            }
        });

        // Filter Gym Classes by Name or Type
        function filterClasses() {
            const input = document.getElementById('classFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#classesTable tbody tr');
            rows.forEach(row => {
                const className = row.querySelector('td:first-child').innerText.toLowerCase();
                const classType = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                if (className.includes(input) || classType.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <header>
        <h1>Gym Classes</h1>
    </header>

    <nav>
    <div class="sidebar">
    <a href="dashboard.php" class="active">Dashboard</a></div>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>
        <a href="classes.php">Classes</a>
        <a href="monthly_fee.php">Payment</a>
        <a href="instructors.php">Instructors</a>
        <a href="member.php">View Members</a>
    </nav>


    <div class="container">
        <h2>Available Classes</h2>
        <div class="search-bar">
            <input type="text" id="classFilter" placeholder="Search for a class..." onkeyup="filterClasses()">
            <button onclick="filterClasses()">Search</button>
        </div>
        <table id="classesTable">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Class Type</th>
                    <th>Instructor</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Yoga</td>
                    <td>Mind & Body</td>
                    <td>Jane Doe</td>
                    <td>Mon & Wed 7:00 AM</td>
                </tr>
                <tr>
                    <td>HIIT</td>
                    <td>Strength</td>
                    <td>John Smith</td>
                    <td>Tue & Thu 6:00 PM</td>
                </tr>
                <tr>
                    <td>Zumba</td>
                    <td>Cardio</td>
                    <td>Mary Johnson</td>
                    <td>Fri 5:00 PM</td>
                </tr>
                <tr>
                    <td>Boxing</td>
                    <td>Combat</td>
                    <td>Mike Tyson</td>
                    <td>Sat 10:00 AM</td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Gym Membership and Class Management. All rights reserved.</p>
    </footer>
</body>
</html>
