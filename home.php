<?php
include 'connect.php';
// Fetch projects from the database
$projects = []; // Ensure you fetch projects data from your database here.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Service Organization - Home</title>
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
                            <a href="join_volunteer.php"><i class="fa fa-user-plus"></i> Join as Volunteer</a>
                            <a href="volunteer_opportunities.php"><i class="fa fa-briefcase"></i> Volunteer Opportunities</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-btn"> Events</button>
                        <div class="dropdown-content">
                        <a href="Upcoming_Events.php">Upcoming_Events</a>
                        <a href="Done_Events.php">Done_Events</a>
                        
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
        <section class="home" id="home">
            <div class="content">
                <h1>Hope lights the way</h1>
                <a href="#donate" class="main-menu__donate-btn" aria-label="Donate"><i class="fa fa-heart"></i> Donate</a>
            </div>
        </section>

        <section class="about" id="about">
            <div class="container">
                
                <div class="row align-items-center">
                    <div class="col-md-6 image">
                        <img src="about.png" class="w-100 mb-5 mb-md-0" alt="About Hope">
                    </div>
                    <div class="col-md-6 content">
                    <h2 class="heading">About Us</h2>
                        <p>Welcome to Hope, a social organization committed to fostering positive change in society. At Hope, our core mission is to construct a meaningful bridge between the privileged and underprivileged, with a special focus on empowering the youth. Through collaborative efforts, we aspire to create a better world, where opportunities are shared, and every individual has the chance to thrive.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="donate" id="donate">
            <div class="container">
                <h2 class="heading">Make a Difference</h2>
                <div class="row">
                    <!-- Left Side: Donation Form -->
                    <div class="col-md-6">
                        <h3>Donate Now</h3>
                        <form id="donation-form" method="POST" action="donate.php">
                            <div class="form-group">
                                <label for="name">Your Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="donation-amount">Donation Amount:</label>
                                <input type="number" id="donation-amount" name="donation-amount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Donate Now</button>
                        </form>
                    </div>
                    <!-- Right Side: Donation Information -->
                    <div class="col-md-6">
                        <h3>Why Donate?</h3>
                        <p>Your donation helps us empower communities and build a brighter future. Together, we can make a significant impact on those in need.</p>
                        <ul>
                            <li>Support education for underprivileged children.</li>
                            <li>Provide medical aid to those in need.</li>
                            <li>Help in disaster relief efforts and rehabilitation.</li>
                        </ul>
                        <p>Your generosity is making a difference. Thank you for your support!</p>
                    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.getElementById("menu-btn").addEventListener("click", function() {
            document.querySelector(".nav").classList.toggle("active");
        });
    </script>
</body>
</html>

