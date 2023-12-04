<?php 
	ob_start();
	session_start();
	require_once '../config/connect.php';
	if(!isset($_SESSION['customer']) & empty($_SESSION['customer'])){
		header('location: login.php');
	}
	$uid = $_SESSION['customerid'];

include 'inc/header.php'; 
include 'inc/nav.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* styles.css */
/* Hero Section */
.hero {
    background-image: url('your-hero-image.jpg'); /* Set your hero image */
    background-size: cover;
    background-position: center;
    color: #fff; /* Text color */
    padding: 10px 0;
    text-align: center;
}

.hero h1 {
    font-size: 36px;
}

.hero p {
    font-size: 18px;
    margin-top: 20px;
}

/* Form Styling */
.upload-section {
    padding: 20px;
}

.upload-section h2 {
    font-size: 24px;
    margin-bottom: 20px;
}
/* Add more CSS rules for styling form elements as needed */

        </style>
</head>
<body>
    <header>
        <!-- Header content with logo and navigation menu -->
    </header>

    <section class="hero">
        <!-- Hero section content -->
    </section>

    <section class="upload-section">
        <h2>Sell Your Electronics</h2>
        <form action="saleupload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Productname">Device Name</label>
        <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name" required>
    </div>
    <div class="form-group">
        <label for="productdescription">Device Description</label>
        <textarea class="form-control" name="productdescription" rows="3"></textarea >
    </div>

    <div class="form-group">
        <label for="productcategory">Device Category</label>
        <select class="form-control" id="productcategory" name="productcategory">
            <option value="">---SELECT CATEGORY---</option>
            <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($connection, $sql);
            while ($r = mysqli_fetch_assoc($res)) {
                ?>
                <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="productprice">Estimate Price</label>
        <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price">
    </div>

    <div class="form-group">
        <label for="productimage">Product Images</label>
        <input type="file" name="productimage" id="productimage" multiple>
        <p class="help-block">Only jpg/png images are allowed.</p>
    </div>

    <div class="form-group">
        <label for="frontimage">Front Image</label>
        <input type="file" name="frontimage" id="frontimage" required>
    </div>

    <div class="form-group">
        <label for="backimage">Back Image</label>
        <input type="file" name="backimage" id="backimage" required>
    </div>

    <div class="form-group">
        <label for="leftsideimage">Left Side Image</label>
        <input type="file" name="leftsideimage" id="leftsideimage" required>
    </div>

    <div class="form-group">
        <label for="rightsideimage">Right Side Image</label>
        <input type= "file" name="rightsideimage" id="rightsideimage" required>
    </div>

    <div class="form-group">
        <label for="workingimage">Working Image</label>
        <input type="file" name="workingimage" id="workingimage" required>
    </div>

    <div class="form-group">
        <label for="moreimage">More Image</label>
        <input type="file" name="moreimage" id="moreimage" required>
    </div>
	<div class="form-group">
        <label for="productprice">Notes</label>
        <input type="text" class="form-control" name="productnotes" id="productnotes" placeholder="Plese fill if you have any notes to be mentioned">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

    </section>

    <footer>
        <!-- Footer content with contact information -->
    </footer>
</body>
</html>
