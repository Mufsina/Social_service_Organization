<?php
include 'connect.php'; // Ensure the connection is established

// Fetching done events from the database
$result = mysqli_query($con, "SELECT * FROM events WHERE status = 'done' ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Service Organization - Done Events</title>
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
                            <a href="projects.php"><i class="fa fa-check-circle"></i> Done Projects</a>
                            <a href="upcoming_projects.php"><i class="fa fa-calendar-alt"></i> Upcoming Projects</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Volunteer</button>
                        <div class="dropdown-content">
                            <a href="join_volunteer.php"><i class="fa fa-user-plus"></i> Join as Volunteer</a>
                            <a href="volunteer_opportunities.php"><i class="fa fa-briefcase"></i> Volunteer Opportunities</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Events</button>
                        <div class="dropdown-content">
                            <a href="Upcoming_Events.php">Upcoming Events</a>
                            <a href="Done_Events.php">Done Events</a>
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
        <section class="events" id="events">
            <div class="container">
                <h2 class="heading">Done Events</h2>
                <div class="box-container">
                    <?php
                    if ($result) {
                        while ($event = mysqli_fetch_assoc($result)) {
                            // Event image path
                            $img_path = 'uploads/' . htmlspecialchars($event['img']);
                            
                            // Format event date
                            $formatted_date = date("F j, Y, g:i a", strtotime($event['event_date']));

                            // Check if the image exists, otherwise show a default image
                            if (file_exists($img_path)) {
                                $event_img = $img_path;
                            } else {
                                $event_img = 'default_image.jpg'; // Placeholder image
                            }

                            // Display event details
                            echo '<div class="box">';
                            echo '<img src="' . $event_img . '" class="w-50 mb-3 mb-md-0" alt="' . htmlspecialchars($event['title']) . '">';
                            echo '<h3>' . htmlspecialchars($event['title']) . '</h3>';
                            echo '<p><strong>Date:</strong> ' . $formatted_date . '</p>';
                            echo '<p><strong>Description:</strong> ' . nl2br(htmlspecialchars($event['description'])) . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No done events found.</p>';
                    }
                    ?>
                </div>
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
