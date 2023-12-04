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
$sql = "SELECT * FROM ewaste WHERE status = '111'";
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
        <br><h2><br><br><font color="#65D269"><b>Your Electronics products thats been accepted</b></font></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Device Name</th>
                    <th>Device Description</th>
                    <th>Estimate Price</th>
                    <th>Notes</th>
                    <th>Phone No:</th>
                    <th>UPI</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['userprice']}</td>";
                    echo "<td>{$row['note']}</td>";
                    echo "<td>
                    <form action='proceesupi.php' method='post'>
                    <input type='text' name='mob' placeholder='Enter your Mobile Number' required>
                    </td>";
                    echo "<td>
                    <input type='text' name='upi' placeholder='Enter you upi id' required>
                    <input type='hidden' name='id' value={$row['id']}></td>";    
                    echo "<td>
                    <button type='submit' class='btn btn-success'>Place pickup</button>
                    </form>
                          </td>";
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
