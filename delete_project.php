<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare a delete statement
    $query = "DELETE FROM projects WHERE id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $message = "Project deleted successfully.";
        } else {
            $message = "Error: Could not execute the delete operation.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error: Could not prepare the delete statement.";
    }

    // Close the connection
    mysqli_close($con);

    // Redirect to the projects admin page with a message
    header("Location: projects.php?message=" . urlencode($message));
    exit();
} else {
    // Redirect if no ID is provided
    header("Location: projects.php");
    exit();
}
?>