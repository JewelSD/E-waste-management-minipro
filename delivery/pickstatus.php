<?php
include "config.php";
include "config/connect.php";

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

$msg = "";
$uname = $_SESSION['uname'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($product_id > 0) {
        // Update the status to 'picked' and set the 'picked_by' field
        $sql = "UPDATE ewaste SET status = 'picked', picked_by = ? WHERE id = ?";
        $stmt = mysqli_prepare($connection, $sql);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, 'si', $uname, $product_id);

            // Execute the statement
            $res = mysqli_stmt_execute($stmt);

            if ($res) {
                // Successfully updated the status
                $msg = "Picked up";
                echo "<script>alert('$msg');</script>";
                header('location: pickup.php'); // Redirect back to the original page
            } else {
                // Error handling if the status update fails
                $msg = "Status update Failed!";
                echo "<script>alert('$msg');</script>";
                echo "Failed to update the status.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Error handling if the statement preparation fails
            echo "Failed to prepare the statement.";
        }
    } else {
        // Invalid or missing product ID
        echo "Invalid product ID.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>
