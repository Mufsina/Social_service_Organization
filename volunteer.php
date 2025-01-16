<?php
// Include the database connection
include 'connect.php';

$errors = [];
$success_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $contact = htmlspecialchars(trim($_POST['contact']));
    $skills = htmlspecialchars(trim($_POST['skills']));

    // Validate form input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($contact)) {
        $errors[] = "Email or phone number is required.";
    }
    if (empty($skills)) {
        $errors[] = "Skills are required.";
    }

    // If no errors, proceed to insert data into the database
    if (empty($errors)) {
        // Prepare the SQL query
        $stmt = $con->prepare("INSERT INTO volunteers (name, contact, skills) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $contact, $skills);

        if ($stmt->execute()) {
            $success_message = "Thank you for volunteering, $name. We appreciate your support.";
        } else {
            $errors[] = "Failed to submit your details. Please try again later.";
        }

        // Close the statement
        $stmt->close();
    }
    
    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer with Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <a href="home.php" class="logo">Hope</a>
                <nav class="nav">
                    <a href="home.php">Home</a>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Projects</button>
                        <div class="dropdown-content">
                            <a href="projects.php"> Done Projects</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Volunteer</button>
                        <div class="dropdown-content">
                            <a href="join_volunteer.php">Join as Volunteer</a>
                            <a href="volunteer_opportunities.php"> Volunteer Opportunities</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Events</button>
                        <div class="dropdown-content">
                            <a href="Upcoming_Events.php">Upcoming_Events</a>
                            <a href="Done_Events.html">Done_Events</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> About</button>
                        <div class="dropdown-content">
                            <a href="gallery.php">Gallery</a>
                            <a href="vision-mission.html">Vision & Mission</a>
                            <a href="about.html">About Us</a>
                        </div>
                    </div>
                    <a href="contact.php">Contact Us</a>
                </nav>
                <a href="donate.php" class="main-menu__donate-btn"><i class="fa fa-heart"></i> Donate</a>
                <div id="menu-btn" class="fas fa-bars"></div>
            </div>
        </div>
    </header>

    <main>
        <section class="volunteer" id="volunteer">
            <div class="container">
                <h2 class="heading">Volunteer with Us</h2>

                <!-- Display errors if any -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Display success message -->
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success">
                        <p><?php echo htmlspecialchars($success_message); ?></p>
                    </div>
                <?php endif; ?>

                <form action="volunteer.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required aria-label="Name">
                    </div>
                    <div class="form-group">
                        <label for="contact">Email or Phone Number</label>
                        <input type="text" id="contact" name="contact" class="form-control" required aria-label="Email or Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="skills">Skills</label>
                        <textarea id="skills" name="skills" class="form-control" rows="4" required aria-label="Skills"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="contact-details">
            <i class="fas fa-phone"></i> 123-456-7890
            <i class="fas fa-envelope"></i> info@hope.org
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2025 Hope Organization. All Rights Reserved.</p>
    </footer>

    <script src="script.js" defer></script>
</body>
</html>
