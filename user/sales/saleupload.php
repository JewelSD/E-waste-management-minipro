<?php
session_start();
require_once '../config/connect.php';

if (!isset($_SESSION['customer']) || empty($_SESSION['customer'])) {
    header('location: login.php');
}

$uid = $_SESSION['customerid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $devicename = mysqli_real_escape_string($connection, $_POST['productname']);
    $description = mysqli_real_escape_string($connection, $_POST['productdescription']);
    $category = mysqli_real_escape_string($connection, $_POST['productcategory']);
    $userprice = mysqli_real_escape_string($connection, $_POST['productprice']);
    $notes = mysqli_real_escape_string($connection, $_POST['productnotes']);

    $location = "uploads/";

    // Main product image
    $main_image_name = $_FILES['productimage']['name'];
    $main_image_tmp_name = $_FILES['productimage']['tmp_name'];
    $main_image_extension = pathinfo($main_image_name, PATHINFO_EXTENSION);
    $main_image_path = $location . $main_image_name;

    // Additional images
    $front_image_name = $_FILES['frontimage']['name'];
    $front_image_tmp_name = $_FILES['frontimage']['tmp_name'];
    $front_image_extension = pathinfo($front_image_name, PATHINFO_EXTENSION);
    $front_image_path = $location . $front_image_name;

    $back_image_name = $_FILES['backimage']['name'];
    $back_image_tmp_name = $_FILES['backimage']['tmp_name'];
    $back_image_extension = pathinfo($back_image_name, PATHINFO_EXTENSION);
    $back_image_path = $location . $back_image_name;

    $left_side_image_name = $_FILES['leftsideimage']['name'];
    $left_side_image_tmp_name = $_FILES['leftsideimage']['tmp_name'];
    $left_side_image_extension = pathinfo($left_side_image_name, PATHINFO_EXTENSION);
    $left_side_image_path = $location . $left_side_image_name;

    $right_side_image_name = $_FILES['rightsideimage']['name'];
    $right_side_image_tmp_name = $_FILES['rightsideimage']['tmp_name'];
    $right_side_image_extension = pathinfo($right_side_image_name, PATHINFO_EXTENSION);
    $right_side_image_path = $location . $right_side_image_name;

    $working_image_name = $_FILES['workingimage']['name'];
    $working_image_tmp_name = $_FILES['workingimage']['tmp_name'];
    $working_image_extension = pathinfo($working_image_name, PATHINFO_EXTENSION);
    $working_image_path = $location . $working_image_name;

    $more_image_name = $_FILES['moreimage']['name'];
    $more_image_tmp_name = $_FILES['moreimage']['tmp_name'];
    $more_image_extension = pathinfo($more_image_name, PATHINFO_EXTENSION);
    $more_image_path = $location . $more_image_name;

    // Handle each image individually
    if (
        move_uploaded_file($main_image_tmp_name, $main_image_path) &&
        move_uploaded_file($front_image_tmp_name, $front_image_path) &&
        move_uploaded_file($back_image_tmp_name, $back_image_path) &&
        move_uploaded_file($left_side_image_tmp_name, $left_side_image_path) &&
        move_uploaded_file($right_side_image_tmp_name, $right_side_image_path) &&
        move_uploaded_file($working_image_tmp_name, $working_image_path) &&
        move_uploaded_file($more_image_tmp_name, $more_image_path)
    ) {
        // Images uploaded successfully

        // Construct the SQL query with all image paths
        $sql = "INSERT INTO `ewaste`(`id`, `u_id`, `name`, `description`, `cat_id`, `userprice`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `note`, `status`, `time`)
                VALUES (null, '{$_SESSION['customer']}', '$devicename', '$description', '$category', '$userprice', '$main_image_path', '$front_image_path', '$back_image_path', '$left_side_image_path', '$right_side_image_path', '$working_image_path', '$more_image_path', '$notes', '000', NOW())";

        $res = mysqli_query($connection, $sql);

        if ($res) {
            // Product created successfully
            $_SESSION['success_message'] = 'Product created successfully';

            echo "<!DOCTYPE html>
                <html>
                <head>
                   
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                </head>
                <body bgcolor='#98E4FF'>
                    <div class='container'>
                        <div class='page'>";

            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: '{$_SESSION['success_message']}',
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'sale.php'; 
                    });
                 </script>";

            unset($_SESSION['success_message']);

            echo "</div>
                    </div>
                </body>
                </html>";
            exit;
        } else {
            $fmsg = "Failed to create the product: " . mysqli_error($connection);
        }
    } else {
        $fmsg = "Failed to upload one or more images.";
    }
}

?>
