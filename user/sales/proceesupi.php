<?php
ob_start();
session_start();
require_once '../config/connect.php';

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: login.php');
}

$alertMessage = ""; // Initialize an empty alert message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $upi = $_POST['upi'];
    // Sanitize and validate mobile number
    $mob = isset($_POST['mob']) ? $_POST['mob'] : '';

    // Validate mobile number
    if (!preg_match('/^\d{10}$/', $mob)) {
        // Invalid mobile number format
        $alertMessage = "Invalid mobile number format. Please enter a 10-digit mobile number.";
        // Additional handling if needed
    } else {
        // Valid mobile number format, proceed with further processing
        $mob = mysqli_real_escape_string($connection, $mob);

        // Continue with the rest of your code...

        // Define a regular expression pattern for a valid UPI
        $upi_pattern = '/^[a-zA-Z0-9.-]{2,64}@[a-zA-Z]{2,64}$/';

        if ($product_id > 0) {
            // Validate the UPI
            if (preg_match($upi_pattern, $upi)) {
                // UPI is in a valid format

                // Update the status to 555 and add the UPI for the specified product ID
                $sql = "UPDATE ewaste SET status = '555', upi = '$upi', mob = '$mob' WHERE id = $product_id";

                $res = mysqli_query($connection, $sql);

                if ($res) {
                    // Successfully updated the status
                    $alertMessage = "UPI and Mobile added successfully; payment will be transferred to your account.";
                    // Redirect back to the original page
                    header('location: acceptedproducts.php');
                    exit; // Don't forget to exit after redirection
                } else {
                    // Error handling if the status update fails
                    $alertMessage = "Failed to update the status.";
                }
            } else {
                // Invalid UPI format
                $alertMessage = "Invalid UPI format. Please enter a valid UPI ID.";
            }
        } else {
            // Invalid or missing product ID
            $alertMessage = "Invalid product ID.";
        }
    }
} else {
    // Invalid request method
    $alertMessage = "Invalid request method.";
}

// JavaScript to show the alert
if (!empty($alertMessage)) {
    echo "<script>alert('$alertMessage');</script>";
}
?>
