<?php
	session_start();
	require_once 'config/connect.php';
	
	if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		header('location: login.php');
	}
	
	if (isset($_POST) && !empty($_POST)) {
		$prodname = mysqli_real_escape_string($connection, $_POST['productname']);
		$description = mysqli_real_escape_string($connection, $_POST['productdescription']);
		$category = mysqli_real_escape_string($connection, $_POST['productcategory']);
		$price = mysqli_real_escape_string($connection, $_POST['productprice']);
	
		$imageLocations = []; // Create an array to store image locations
	
		for ($i = 1; $i <= 5; $i++) {
			$imageField = "productimage" . $i;
	
			if (isset($_FILES[$imageField]) && !empty($_FILES[$imageField])) {
				$name = $_FILES[$imageField]['name'];
				$size = $_FILES[$imageField]['size'];
				$type = $_FILES[$imageField]['type'];
				$tmp_name = $_FILES[$imageField]['tmp_name'];
	
				$max_size = 10000000;
				$extension = substr($name, strpos($name, '.') + 1);
	
				if (!empty($name)) {
					if (($extension == "jpg" || $extension == "jpeg") && ($type == "image/jpeg") && ($size <= $max_size)) {
						$location = "uploads/";
						if (move_uploaded_file($tmp_name, $location . $name)) {
							$imageLocations[] = $location . $name; // Store the image location in the array
						} else {
							$fmsg = "Failed to Upload File";
						}
					} else {
						$fmsg = "Only JPG files are allowed and should be less than 1MB";
					}
				}
			}
		}
	
		// Check if at least one image was successfully uploaded
		if (!empty($imageLocations)) {
			// Combine the image locations into a string
			$imageValues = "'" . implode("', '", $imageLocations) . "'";
	
			// Create the thumb image (using the first uploaded image)
			$thumbLocation = "uploads/thumb.jpg";
			copy($imageLocations[0], $thumbLocation);
	
		} else {
			$imageValues = "''"; // If no images were uploaded
			$thumbLocation = ''; // Set thumb location to empty
		}
	
		// Insert data into the database
		$sql = "INSERT INTO products (name, description, catid, price, img1, img2, img3, img4, img5, thumb)
				VALUES ('$prodname', '$description', '$category', '$price', $imageValues, $thumbLocation)";
		$res = mysqli_query($connection, $sql);
	
		if ($res) {
			header('location: products.php');
		} else {
			$fmsg = "Failed to Create Product";
		}
	}
	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
	
<section id="content">
	<div class="content-blog">
		<div class="container">
		<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<form method="post" action="addproductprocess.php" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="Productname">Product Name</label>
			    <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name">
			  </div>
			  <div class="form-group">
			    <label for="productdescription">Product Description</label>
			    <textarea class="form-control" name="productdescription" rows="3"></textarea>
			  </div>

			  <div class="form-group">
			    <label for="productcategory">Product Category</label>
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
			    <label for="productprice">Product Price</label>
			    <input type ="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price">
			  </div>
			  <div class="form-group">
			    <label for="productimage">Product Image1</label>
			    <input type="file" name="img1" id="productimage">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>

			  <!-- Five additional image upload fields -->
			  <div class="form-group">
			    <label for="productimage2">Product Image 2</label>
			    <input type="file" name="img2" id="productimage2">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  <div class="form-group">
			    <label for="productimage3">Product Image 3</label>
			    <input type="file" name="img3" id="productimage3">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  <div class="form-group">
			    <label for="productimage4">Product Image 4</label>
			    <input type="file" name="img4" id="productimage4">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  <div class="form-group">
			    <label for="productimage5">Product Image 5</label>
			    <input type="file" name="img5" id="productimage5">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  <div class="form-group">
			    <label for="productimage5">Product Image 5</label>
			    <input type="file" name="img5" id="productimage5">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>
			  <div class="form-group">
			    <label for="productimage5">Product Image 6</label>
			    <input type="file" name="img6" id="productimage5">
			    <p class="help-block">Only jpg/png are allowed.</p>
			  </div>

			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
		</div>
	</div>
</section>
<?php include 'inc/footer.php' ?>

<?php include 'inc/footer.php' ?>
