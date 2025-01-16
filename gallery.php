<?php
// Sample data array with categories (this could be dynamically fetched from a database)
$gallery_image = [
    ["img" => "1.jpg", "alt" => "Gallery Image 1", "category" => "Nature"],
    ["img" => "4.webp", "alt" => "Gallery Image 2", "category" => "Projects"],
    ["img" => "3.jpeg", "alt" => "Gallery Image 3", "category" => "Events"],
    ["img" => "1.jpg", "alt" => "Gallery Image 4", "category" => "Nature"],
    ["img" => "5.jpg", "alt" => "Gallery Image 5", "category" => "Projects"],
    ["img" => "8.jpeg", "alt" => "Gallery Image 6", "category" => "Events"],
    ["img" => "9.jpg", "alt" => "Gallery Image 7", "category" => "Nature"],
    ["img" => "10.jpg", "alt" => "Gallery Image 8", "category" => "Projects"],
    ["img" => "11.jpg", "alt" => "Gallery Image 9", "category" => "Events"],
    ["img" => "12.jpg", "alt" => "Gallery Image 10", "category" => "Nature"],
];

// Simulate pagination (in a real app, fetch images from the database based on the page)
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$images_per_page = 6;  // Number of images to show per page
$start_index = ($page - 1) * $images_per_page;
$images_to_display = array_slice($gallery_image, $start_index, $images_per_page);

// Return images as JSON if the page is being fetched via AJAX (for "Load More" functionality)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page'])) {
    echo json_encode([
        'images' => $images_to_display
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Advanced Features</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.0/css/lightgallery.min.css">
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
        <section class="gallery" id="gallery">
            <div class="container">
                <h2 class="heading text-center my-5">Our Gallery</h2>

                

                <!-- Image Gallery -->
                <div class="row" id="image-gallery">
                    <!-- Dynamically loaded images will go here -->
                </div>

                <!-- Load More Button -->
                <div id="load-more" class="text-center my-5">
                    <button class="btn btn-primary" id="load-more-btn">Load More</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.0/js/lightgallery.min.js"></script>
    <script src="script.js" defer></script>

    <script>
        // Variables to keep track of the current page
        let currentPage = 1;

        // Function to fetch images
        function loadImages(page) {
            fetch(`gallery.php?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const gallery = document.getElementById('image-gallery');

                    data.images.forEach(image => {
                        const imgDiv = document.createElement('div');
                        imgDiv.classList.add('col-md-4', 'mb-4', 'gallery-item', image.category);

                        imgDiv.innerHTML = `
                            <div class="card shadow">
                                <a href="${image.img}" data-lightbox="gallery" data-title="${image.alt}">
                                    <img src="${image.img}" class="card-img-top zoomable-image" alt="${image.alt}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">${image.alt}</h5>
                                </div>
                            </div>
                        `;

                        gallery.appendChild(imgDiv);
                    });
                });
        }

        // Load initial images
        loadImages(currentPage);

        // Handle Load More button click
        document.getElementById('load-more-btn').addEventListener('click', () => {
            currentPage++;  // Increment the page number
            loadImages(currentPage);  // Load more images

            // Optionally disable the button if there are no more images (or other condition)
            // document.getElementById('load-more-btn').disabled = true;
        });
    </script>
</body>
</html>
