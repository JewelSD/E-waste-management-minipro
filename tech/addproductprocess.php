<?php
session_start();
require_once 'config/connect.php';

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
    $img1_name = $_FILES['img1']['name'];
    $img1_tmp_name = $_FILES['img1']['tmp_name'];
    $img1_extension = pathinfo($img1_name, PATHINFO_EXTENSION);
    $img1_path = $location . $img1_name;

    // Additional images
    $img2_name = $_FILES['img2']['name'];
    $img2_tmp_name = $_FILES['img2']['tmp_name'];
    $img2_extension = pathinfo($img2_name, PATHINFO_EXTENSION);
    $img2_path = $location . $img2_name;

    $img3_name = $_FILES['img3']['name'];
    $img3_tmp_name = $_FILES['img3']['tmp_name'];
    $img3_extension = pathinfo($img3_name, PATHINFO_EXTENSION);
    $img3_path = $location . $img3_name;

    $img4_name = $_FILES['img4']['name'];
    $img4_tmp_name = $_FILES['img4']['tmp_name'];
    $img4_extension = pathinfo($img4_name, PATHINFO_EXTENSION);
    $img4_path = $location . $img4_name;

    $img5_name = $_FILES['img5']['name'];
    $img5_tmp_name = $_FILES['img5']['tmp_name'];
    $img5_extension = pathinfo($img5_name, PATHINFO_EXTENSION);
    $img5_path = $location . $img5_name;

    $img6_name = $_FILES['img6']['name'];
    $img6_tmp_name = $_FILES['img6']['tmp_name'];
    $img6_extension = pathinfo($img6_name, PATHINFO_EXTENSION);
    $img6_path = $location . $img6_name;

    // Handle each image individually
    if (
        move_uploaded_file($img1_tmp_name, $img1_path) &&
        move_uploaded_file($img2_tmp_name, $img2_path) &&
        move_uploaded_file($img3_tmp_name, $img3_path) &&
        move_uploaded_file($img4_tmp_name, $img4_path) &&
        move_uploaded_file($img5_tmp_name, $img5_path) &&
        move_uploaded_file($img6_tmp_name, $img6_path)
    ) {
        // Images uploaded successfully

        // Construct the SQL query with all image paths
        $sql = "INSERT INTO `products`(`name`, `description`, `catid`, `price`, `img1`, `img2`, `img3`, `img4`, `img5`, `thumb`) VALUES ('$devicename', '$description', '$category', '$userprice', '$img1_path', '$img2_path', '$img3_path', '$img4_path', '$img5_path', '$img6_path')";

        $res = mysqli_query($connection, $sql);

        if ($res) {
            // Product created successfully
            header('location: addproduct.php');
        } else {
            $fmsg = "Failed to create the product: " . mysqli_error($connection);
        }
    } else {
        $fmsg = "Failed to upload one or more images.";
    }
}

?>
