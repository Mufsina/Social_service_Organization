<?php
include 'connect.php';

// Default pagination variables
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search functionality
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($con, $_GET['search']);
}

// Fetch total projects for pagination
$total_projects_query = "SELECT COUNT(*) as total FROM projects WHERE title LIKE '%$search_query%'";
$total_projects_result = mysqli_query($con, $total_projects_query);
$total_projects = mysqli_fetch_assoc($total_projects_result)['total'];
$total_pages = ceil($total_projects / $limit);

// Fetch projects with pagination and search
$projects_query = "SELECT * FROM projects WHERE title LIKE '%$search_query%' LIMIT $start, $limit";
$projects = mysqli_query($con, $projects_query);
if (!$projects) {
    die("Error fetching projects: " . mysqli_error($con));
}

// Export to CSV
if (isset($_GET['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="projects.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Title', 'Alt Text', 'Image']);
    $csv_query = "SELECT * FROM projects";
    $csv_result = mysqli_query($con, $csv_query);
    while ($row = mysqli_fetch_assoc($csv_result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #e8f5f0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 40px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #2f776f;
        }

        .btn {
            border-radius: 20px;
        }

        table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
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
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Manage Projects</h1>

        <!-- Search Bar -->
        <form method="GET" class="form-inline mb-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search by title" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="?export=1" class="btn btn-success ml-2">Export CSV</a>
        </form>

        <!-- Add Project Button -->
        <a href="add_project.php" class="btn btn-primary mb-3">Add New Project</a>

        <!-- Projects Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Alt Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($projects)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><img src="<?php echo $row['img']; ?>" alt="<?php echo $row['alt']; ?>" class="img-thumbnail" style="width: 100px;"></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['alt']; ?></td>
                    <td>
                        <a href="edit_project.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="delete_project.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_query); ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>

        <a href="index.php" class="btn btn-primary mt-3">Back to Admin Panel</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
