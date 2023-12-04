<?php
ob_start();
session_start();
require_once 'config/connect.php';
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

$msg="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($product_id > 0) {
        // Update the status to 999 for the specified product ID
        $sql = "UPDATE ewaste SET status = 'canceled' WHERE id = $product_id";
        $res = mysqli_query($connection, $sql);

        if ($res) {
            // Successfully updated the status
            $msg = "Product Canceled";
            echo "<script>alert('$msg')</script>";
            header('location: viewupi.php'); // Redirect back to the original page
        } else {
            // Error handling if the status update fails
            echo "Failed to update the status.";
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
