<?php
include 'connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $donation_amount = htmlspecialchars(trim($_POST['donation_amount']));
    $payment_method = htmlspecialchars(trim($_POST['payment_method']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO donations (name, email, donation_amount, payment_method, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $email, $donation_amount, $payment_method, $message);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        $response_message = "Thank you for your donation!";
    } else {
        $response_message = "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Received</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($response_message); ?>
        </div>
        <a href="home.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
