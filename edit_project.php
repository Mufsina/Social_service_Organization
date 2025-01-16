<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch project data
    $query = "SELECT * FROM projects WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $project = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $img = $_POST['img'];
        $title = $_POST['title'];
        $alt = $_POST['alt'];

        // Update project data
        $query = "UPDATE projects SET img = ?, title = ?, alt = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $img, $title, $alt, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: projects.php?message=" . urlencode("Project updated successfully."));
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: projects.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5f0;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 50px;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2f776f;
        }
        .btn-primary {
            background-color: #4b9c8e;
            border-color: #4b9c8e;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #2f776f;
            border-color: #2f776f;
        }
        .form-group label {
            color: #2f776f;
            font-weight: 600;
        }
        .image-preview {
            margin-top: 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Project</h1>
        <form method="POST" action="edit_project.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="img">Image URL</label>
                <input type="text" id="img" name="img" class="form-control" value="<?php echo htmlspecialchars($project['img']); ?>" required oninput="updateImagePreview()">
                <img id="imagePreview" src="<?php echo htmlspecialchars($project['img']); ?>" alt="Image Preview" class="img-thumbnail image-preview">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alt">Alt Text</label>
                <input type="text" id="alt" name="alt" class="form-control" value="<?php echo htmlspecialchars($project['alt']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Project</button>
            <a href="projects.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateImagePreview() {
            const imgInput = document.getElementById('img');
            const imgPreview = document.getElementById('imagePreview');
            imgPreview.src = imgInput.value;
        }
    </script>
</body>
</html>
