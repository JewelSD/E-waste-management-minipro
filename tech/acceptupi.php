<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
ob_start();
session_start();
require_once 'config/connect.php';

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: login.php');
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($product_id > 0) {
        // Update the status to 999 for the specified product ID
        $sql = "UPDATE ewaste SET status = 'paid' WHERE id = $product_id";
        $res = mysqli_query($connection, $sql);

        if ($res) {
            // Successfully updated the status
            $msg = "Payment done Successfully";

            // Use PHP to generate JavaScript code for Swal
            $swalScript = "<script>
                Swal.fire({
                    title: '$msg',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'viewupi.php';
                });
            </script>";

            // Output the generated JavaScript code
            echo $swalScript;
        } else {
            // Error handling if the status update fails
            $msg = "Payment Failed";

            // Use PHP to generate JavaScript code for Swal
            $swalScript = "<script>
                Swal.fire({
                    title: '$msg',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";

            // Output the generated JavaScript code
            echo $swalScript;

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

</body>
</html>
