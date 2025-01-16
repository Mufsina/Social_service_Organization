<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $img = $_POST['img'];
    $title = $_POST['title'];
    $alt = $_POST['alt'];

    $query = "INSERT INTO projects (img, title, alt) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $img, $title, $alt);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: projects.php?message=" . urlencode("Project added successfully."));
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
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
        <h1>Add Project</h1>
        <form method="POST" action="add_project.php">
            <div class="form-group">
                <label for="img">Image URL</label>
                <input type="text" id="img" name="img" class="form-control" required oninput="updateImagePreview()">
                <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail image-preview d-none">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alt">Alt Text</label>
                <input type="text" id="alt" name="alt" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Project</button>
            <a href="projects.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateImagePreview() {
            const imgInput = document.getElementById('img');
            const imgPreview = document.getElementById('imagePreview');
            if (imgInput.value) {
                imgPreview.src = imgInput.value;
                imgPreview.classList.remove('d-none');
            } else {
                imgPreview.src = '';
                imgPreview.classList.add('d-none');
            }
        }
    </script>
</body>
</html>
