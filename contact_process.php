<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $contact_method = mysqli_real_escape_string($con, $_POST['contact-method']);
    $email_phone = mysqli_real_escape_string($con, $_POST['email-phone']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $query = "INSERT INTO contacts (name, contact_method, email_phone, message) VALUES ('$name', '$contact_method', '$email_phone', '$message')";

    if (mysqli_query($con, $query)) {
        $response_message = "Thank you for contacting us! We will get back to you soon.";
    } else {
        $response_message = "There was an error submitting your message. Please try again later.";
    }

    header("Location: contact.php?message=" . urlencode($response_message));
    exit();
} else {
    header("Location: contact.php");
    exit();
}
?>
