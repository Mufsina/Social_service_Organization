<?php
include 'connect.php'; // Database connection

// Enable error reporting to catch any issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Handle form submission to add a new event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $event_date = mysqli_real_escape_string($con, $_POST['event_date']);
    $status = $_POST['status'];

    // Handle image upload
    $img = '';
    if ($_FILES['img']['error'] == 0) {
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES['img']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate image type
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                $img = $target_file;
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid image type. Only JPG, JPEG, PNG, GIF allowed.";
        }
    }

    // Insert event into the database
    $query = "INSERT INTO events (title, description, img, event_date, status) 
              VALUES ('$title', '$description', '$img', '$event_date', '$status')";
    
    if (mysqli_query($con, $query)) {
        echo "Event added successfully!";
    } else {
        echo "Error adding event: " . mysqli_error($con);
    }
}

// Fetch events from database
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

h1, h2 {
    text-align: center;
    color: #2f776f;
}

form {
    width: 50%;
    margin: 20px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
    color: #333;
}

input[type="text"],
input[type="datetime-local"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin: 10px 0 20px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

input[type="file"] {
    margin-bottom: 20px;
}

button {
    width: 100%;
    padding: 10px;
    background: #4b9c8e;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #3a8474;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f1f1f1;
}

table tr:hover {
    background-color: #f9f9f9;
}

a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
    <title>Add Event</title>
</head>
<body>
    <h1>Add New Event</h1>
    
    <form action="add_events.php" method="POST" enctype="multipart/form-data">
        <label for="title">Event Title</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Event Description</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>

        <label for="event_date">Event Date</label><br>
        <input type="datetime-local" id="event_date" name="event_date" required><br><br>

        <label for="status">Status</label><br>
        <select name="status" id="status">
            <option value="upcoming">Upcoming</option>
            <option value="done">Done</option>
        </select><br><br>

        <label for="img">Event Image</label><br>
        <input type="file" id="img" name="img"><br><br>

        <button type="submit">Add Event</button>
        <a href="events.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </form>

    <h2>Event List</h2>
    <table border="1">
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
                echo "<td><a href='edit_events.php?id=" . $event['id'] . "'>Edit</a> | 
                              <a href='delete_events.php?id=" . $event['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No events found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
