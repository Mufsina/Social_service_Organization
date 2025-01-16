<?php
include 'connect.php'; // Database connection

// Fetch events from the database
$result = mysqli_query($con, "SELECT * FROM events ORDER BY event_date DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #e8f5f0;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 40px auto;
            width: 80%;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #2f776f;
            text-align: center;
        }

        .btn {
            border-radius: 20px;
            background: #4b9c8e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #3a8474;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            background: #4b9c8e;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination a.active {
            background: #2f776f;
        }

        .pagination a:hover {
            background: #3a8474;
        }
    </style>
    <title>Admin Panel - Manage Events</title>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>

        <h2>Event List</h2>
        <a href="add_events.php" class="btn">Add New Event</a><br><br>

        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Event Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result) {
                while ($event = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($event['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['event_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($event['status']) . "</td>";
                    echo "<td>
                        <a href='edit_events.php?id=" . $event['id'] . "'>Edit</a> | 
                        <a href='delete_events.php?id=" . $event['id'] . "' onclick='return confirm(\"Are you sure you want to delete this event?\")'>Delete</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No events found.</td></tr>";
            }
            ?>
            <a href="dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </table>
    </div>
</body>
</html>

