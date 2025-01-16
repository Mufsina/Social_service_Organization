<?php
include 'connect.php'; // Database connection

// Enable error reporting to catch any issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch event details based on the ID
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $result = mysqli_query($con, "SELECT * FROM events WHERE id = $event_id");

    if ($result) {
        $event = mysqli_fetch_assoc($result);
    } else {
        echo "Event not found.";
        exit;
    }
}

// Handle form submission to update an existing event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $event_date = mysqli_real_escape_string($con, $_POST['event_date']);
    $status = $_POST['status'];

    // Handle image upload
    $img = $event['img']; // Keep the existing image unless a new one is uploaded
    if ($_FILES['img']['error'] == 0) {
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES['img']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
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

    // Update event details in the database
    $query = "UPDATE events SET title='$title', description='$description', img='$img', event_date='$event_date', status='$status' WHERE id=$event_id";

    if (mysqli_query($con, $query)) {
        echo "Event updated successfully!";
    } else {
        echo "Error updating event: " . mysqli_error($con);
    }
}
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

h1 {
    text-align: center;
    color: #2f776f;
    margin-top: 20px;
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
</style>
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>

    <form action="edit_events.php?id=<?php echo $event['id']; ?>" method="POST" enctype="multipart/form-data">
        <label for="title">Event Title</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required><br><br>

        <label for="description">Event Description</label><br>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea><br><br>

        <label for="event_date">Event Date</label><br>
        <input type="datetime-local" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required><br><br>

        <label for="status">Status</label><br>
        <select name="status" id="status">
            <option value="upcoming" <?php echo $event['status'] == 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
            <option value="done" <?php echo $event['status'] == 'done' ? 'selected' : ''; ?>>Done</option>
        </select><br><br>

        <label for="img">Event Image</label><br>
        <input type="file" id="img" name="img"><br><br>

        <button type="submit">Update Event</button>
        <a href="events.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </form>
</body>
</html>
