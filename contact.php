<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Service Organization - Contact Us</title>
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
        <section class="contact" id="contact">
            <div class="container">
                <h2 class="heading">Contact Us</h2>
                <form action="contact_process.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required aria-label="Name">
                    </div>
                    <div class="form-group">
                        <label for="contact-method">Preferred Contact Method</label>
                        <select id="contact-method" name="contact-method" class="form-control" required aria-label="Preferred Contact Method">
                            <option value="email">Email</option>
                            <option value="phone">Phone Number</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email-phone">Email or Phone Number</label>
                        <input type="text" id="email-phone" name="email-phone" class="form-control" required aria-label="Email or Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="5" required aria-label="Message"></textarea>
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
