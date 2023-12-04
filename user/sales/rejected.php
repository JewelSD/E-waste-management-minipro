<?php
ob_start();
session_start();
require_once '../config/connect.php';
if (!isset($_SESSION['customer']) & empty($_SESSION['customer'])) {
    header('location: login.php');
}
$uid = $_SESSION['customerid'];

include 'inc/header.php';
include 'inc/nav.php';

// Retrieve data from the ewaste table where the status is 111
$sql = "SELECT * FROM ewaste WHERE status = '999'";
$res = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        /* styles.css */
        /* Add more CSS rules for styling table and its elements as needed */
    </style>
</head>

<body>
    <header>
        <!-- Header content with logo and navigation menu -->
    </header>

    <section>
        <br><br><h2 style="color:red;"">Your Electronics Thats been Rejected</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Device Name</th>
                    <th>Device Description</th>
                    <th>Device Category</th>
                    <th>Estimate Price</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['cat_id']}</td>";
                    echo "<td>{$row['userprice']}</td>";
                    echo "<td>{$row['note']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <!-- Footer content with contact information -->
    </footer>
</body>

</html>
