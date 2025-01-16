<?php
include 'connect.php';

$errors = [];
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars(trim($_POST['id']));
    $name = htmlspecialchars(trim($_POST['name']));
    $contact = htmlspecialchars(trim($_POST['contact']));
    $skills = htmlspecialchars(trim($_POST['skills']));

    // Validate the input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($contact)) {
        $errors[] = "Email or phone number is required.";
    }
    if (empty($skills)) {
        $errors[] = "Skills are required.";
    }

    if (empty($errors)) {
        // Update volunteer data in the database
        $stmt = $con->prepare("UPDATE volunteers SET name=?, contact=?, skills=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $contact, $skills, $id);

        if ($stmt->execute()) {
            $success_message = "Volunteer details updated successfully.";
            header("Location: volunteers.php?message=" . urlencode($success_message));
            exit();
        } else {
            $errors[] = "Failed to update volunteer details. Please try again later.";
        }

        $stmt->close();
    }
} else {
    // Fetch existing volunteer data for editing
    if (isset($_GET['id'])) {
        $id = htmlspecialchars(trim($_GET['id']));
        $stmt = $con->prepare("SELECT * FROM volunteers WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $volunteer = $result->fetch_assoc();
            $name = $volunteer['name'];
            $contact = $volunteer['contact'];
            $skills = $volunteer['skills'];
        } else {
            $errors[] = "Volunteer not found.";
        }

        $stmt->close();
    } else {
        $errors[] = "Volunteer ID is required.";
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Volunteer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Volunteer</h1>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <p><?php echo htmlspecialchars($success_message); ?></p>
            </div>
        <?php endif; ?>
        <form action="edit_volunteer.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Email or Phone Number</label>
                <input type="text" id="contact" name="contact" class="form-control" value="<?php echo isset($contact) ? htmlspecialchars($contact) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="skills">Skills</label>
                <textarea id="skills" name="skills" class="form-control" rows="4" required><?php echo isset($skills) ? htmlspecialchars($skills) : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Volunteer</button>
            <a href="volunteers.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
