<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #e8f5f0; /* Mint green background */
            color: #444;
        }

        /* Header */
        .header {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: bold;
            color: #2f776f;
        }

        .header a {
            text-decoration: none;
            color: #4b9c8e;
            margin: 0 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #2f776f;
        }

        /* Container */
        .container {
            margin-top: 40px;
            padding: 20px;
        }

        .card-deck {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        /* Card Styling */
        .card {
            background: linear-gradient(145deg, #d9f3eb, #f0fef9); /* Mint gradient */
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 15px;
            padding: 20px;
            width: 280px;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.2), -8px -8px 15px rgba(255, 255, 255, 0.5);
        }

        .card i {
            font-size: 3rem;
            color: #4b9c8e;
            margin-bottom: 15px;
        }

        .card h5 {
            font-size: 1.5rem;
            color: #2f776f;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .card .btn {
            background-color: #4b9c8e;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .card .btn:hover {
            background-color: #2f776f;
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            text-align: center;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer a {
            text-decoration: none;
            color: #4b9c8e;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #2f776f;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Admin Dashboard</h1>
                <div>
                    <a href="dashboard.php">Home</a>
                    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="card-deck">
            <div class="card">
                <i class="fas fa-project-diagram"></i>
                <h5>Manage Projects</h5>
                <p>Track and organize all projects efficiently.</p>
                <a href="projects.php" class="btn">View Projects</a>
            </div>
            <div class="card">
                <i class="fas fa-calendar-alt"></i>
                <h5>Manage Events</h5>
                <p>Track and organize all events efficiently.</p>
                <a href="events.php" class="btn">View Events</a>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h5>Volunteers</h5>
                <p>View and manage all volunteer activities.</p>
                <a href="volunteers.php" class="btn">View Volunteers</a>
            </div>
            <div class="card">
                <i class="fas fa-donate"></i>
                <h5>Donations</h5>
                <p>View and manage all received donations.</p>
                <a href="donate.php" class="btn">View Donations</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Admin Panel ❤️.</p>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
