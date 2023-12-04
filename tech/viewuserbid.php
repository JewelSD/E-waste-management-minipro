<?php
ob_start();
session_start();
require_once 'config/connect.php';
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

include 'inc/header.php';
include 'inc/nav.php';

// Retrieve data from the ewaste table where the status is 111
$sql = "SELECT * FROM ewaste WHERE status = '000'";
$res = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }

        img {
            width: 100%;
        }

        /* Slideshow container */
        .slideshow-container {
            position: relative;
            max-width: 100%;
        }

        /* Next and previous buttons */
        .prev, .next {
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* Add more CSS rules for styling the table and its elements as needed */
    </style>
</head>
<body>
    <header>
        <!-- Header content with logo and navigation menu -->
    </header>

    <section>
        <br><br><br><h2><br>Your Electronics Listings</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Device Name</th>
                    <th>Device Description</th>
                    <th>Device Category</th>
                    <th>Estimate Price</th>
                    <th>Notes</th>
                    <th>Image</th>
                    <th>Action</th>
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
                    echo "<td><div class='slideshow-container'>";
                    
                    // Loop to display all 7 images
                    for ($i = 1; $i <= 7; $i++) {
                        echo "<img class='image-modal' src='../user/sales/{$row['img' . $i]}' alt='Product Image' style='display:none;'>";
                    }
                    
                    echo "<button class='prev' onclick='plusSlides(-1)'>&#10094;</button>";
                    echo "<button class='next' onclick='plusSlides(1)'>&#10095;</button>";
                    echo "</div></td>";
                    echo "<td>
                    <form action='accept.php' method='post'>
                    <input type='hidden' name='id' value={$row['id']}>
                            <button type='submit' class='btn btn-success'>Accept</button>
                    </form>
                    <form action='reject.php' method='post'>
                    <input type='hidden' name='id' value={$row['id']}>
                            <button type='submit' class='btn btn-danger'>Reject</button>
                    </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Modal for displaying images -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <div class="slideshow-container">
                <!-- Images will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        var slideIndex = 1;

        // Function to open the modal and display the image slideshow
        function openModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
            showSlides(slideIndex);
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        // Function to change slides
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Function to show a specific slide
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        // Function to display the slides
        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName('image-modal');
            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[slideIndex - 1].style.display = 'block';
        }
    </script>
</body>
</html>

