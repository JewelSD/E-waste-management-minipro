<?php
	// Include config file
	require_once 'user/config/config.php';

	// Define variables and initialize with empty values
	$username = $password = $confirm_password = "";

	$email_err = $username_err = $address_err = $password_err = $confirm_password_err = "";

	// Process submitted form data
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Check if username is empty
		if (empty(trim($_POST['username']))) {
			$username_err = "Please enter a username.";

			// Check if username already exist
		} else {

			// Prepare a select statement
			$sql = 'SELECT id FROM users WHERE username = ?';

			if ($stmt = $mysql_db->prepare($sql)) {
				// Set parmater
				$param_username = trim($_POST['username']);

				// Bind param variable to prepares statement
				$stmt->bind_param('s', $param_username);

				// Attempt to execute statement
				if ($stmt->execute()) {
					
					// Store executed result
					$stmt->store_result();

					if ($stmt->num_rows == 1) {
						$username_err = 'This username is already taken.';
					} else {
						$username = trim($_POST['username']);
					}
				} else {
					echo "Oops! ${$username}, something went wrong. Please try again later.";
				}
				// Close statement
				$stmt->close();
			} else {
				// Close db connction
				$mysql_db->close();
			}
		}

		// Validate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "Password must have atleast 6 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }
    
	    // Validate confirm password
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Please confirm password.";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "Password did not match.";
	        }
	    }

	    // Check input error before inserting into database

	    if (empty($username_err) && empty($password_err) && empty($confirm_err)) {

	    	// Prepare insert statement
			
			$email = $_POST['email'];
			$address = $_POST['address'];

			$sql = "INSERT INTO users (username, email, address, password) VALUES (?, '$email','$address', ?)";

			if ($stmt = $mysql_db->prepare($sql)) {

				// Set parmater
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Created a password

				// Bind param variable to prepares statement
				$stmt->bind_param('ss', $param_username, $param_password);

				// Attempt to execute
				if ($stmt->execute()) {
					// Redirect to login page
					header('location: ./login.php');
					// echo "Will  redirect to login page";
				} else {
					echo "Something went wrong. Try signing in again.";
				}

				// Close statement
				$stmt->close();	
			}

			// Close connection
			$mysql_db->close();
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Edevice-Marketplace</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">	
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>
	<!-- header section start -->
	<div class="header_section">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="index.html"><img src="images/EDM.png"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.html">HOME</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#about">ABOUT</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#products">PRODUCTS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><img src="images/search-icon.png"></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#reg">REGISTER</a>
                </li>
              </ul>
            </div>
        </nav>
	</div>
	<!-- header section end -->
  <!-- banner section start -->
  <div class="banner_section layout_padding">
    <div class="container">
      <div id="my_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-6">
                <h1 class="video_text">EDEVICE MARKETPLACE</h1>
                <h1 class="controller_text">refurbished products</h1>
                <p class="banner_text">Get premium refurbished products from our store and be a part of this recycling era</p>
                <div class="shop_bt"><a href="login.php">Shop Now</a></div>
              </div>
              <div class="col-md-6">
                <div class="image_1"><img src="images/img-1.png"></div>
            </div>
          </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-6">
                <h1 class="video_text">Refurbished mobilephones</h1>
                <h1 class="controller_text">1 Year Assurance</h1>
                <p class="banner_text">Hasel free services for every device brought from our website door pickup and dop package for all mobilephones </p>
                <div class="shop_bt"><a href="login.php">Shop Now</a></div>
              </div>
              <div class="col-md-6">
                <div class="image_1"><img src="images/Apple-iPhone-11.png"></div>
            </div>
          </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-6">
                <h1 class="video_text">Sell your Devices</h1>
                <h1 class="controller_text">Best Pricing</h1>
                <p class="banner_text">Sell products direct to technitians and get discount refurbished products</p>
                <div class="shop_bt"><a href="login.php">Shop Now</a></div>
              </div>
              <div class="col-md-6">
                <div class="image_1"><img src="images/img-2.png"></div>
            </div>
          </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- banner section end -->
  <!-- about section start -->
  <div class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="image_2"><img src="images/img-2.png"></div>
        </div>
        <div class="col-md-6">
          <h1 class="about_text" id="about">ABOUT</h1>
          <p class="lorem_text">The e-Device Marketplace is an innovative platform aimed at restoring and refurbishing electronic devices contributed by users</p>
          <div class="shop_bt_2"><a href="login.php">Read More</a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- about section end -->
  <!-- product section start -->
  <div class="product_section layout_padding">
    <div class="container">
      <div class="product_text">Our <span style="color: #5ca0e9;">products</span></div>
      <p class="long_text">Yes they are used products but what if we assure service and maintanace why buy new?</p>
      <div class="product_section_2">
        <div class="row">
          <div class="col-md-6">
            <div class="image_2"><img src="images/Apple-iPhone-11.png"></div>
            <div class="price_text">Price ₹ <span style="color: #3a3a38;">15,000</span></div>
            <h1 class="game_text">Iphone X</h1>
            <p class="long_text">The iPhone X display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally</p>
          </div>
          <div class="col-md-6">
            <div class="image_2"><img src="images/s22.png"></div>
            <div class="price_text">Price ₹ <span style="color: #3a3a38;">35,000</span></div>
            <h1 class="game_text">Samsun Galaxy S22 Ultra</h1>
            <p class="long_text"> The Samsung Galaxy S22 Ultra is the headliner of the S22 series. It's the first S series phone to include Samsung's S Pen. Specifications are top-notch including 6.8-inch Dynamic AMOLED display with 120Hz refresh rate, Snapdragon 8 Gen 1 processor, 5000mAh battery, up to 12gigs of RAM, and 1TB of storage</p>
          </div>
        </div>
      </div>
      <div class="see_main">
        <div class="see_bt"><a href="login.php">See More</a></div>
      </div>
    </div>
  </div>
  <!-- product section end -->
  <!-- video section start -->
  <div class="video_section layout_padding" id="products">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="video_text_2">VR</h1>
          <h1 class="controller_text_2">remoto control</h1>
          <p class="banner_text_2">We are planning to make the next gen with todays resourses reparing old smart phones to cheap VR</p>
          <div class="shop_bt"><a href="login.php">Shop Now</a></div>
        </div>
        <div class="col-md-6">
          <div class="image_4"><img src="images/img-4.png"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- video section end -->
  <!-- testimonial section start -->

  <!-- testimonial section end -->
  <!-- contact section start -->
  <div class="contact_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="email_box">
                    <div class="input_main">
                       <div class="container">
                       <section class="container wrapper">
			<h2 class="display-4 pt-3" id="reg">Sign Up</h2>
        	<p class="text-center">Please fill in your credentials.</p>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        		<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
        			<label for="username">Username</label>
        			<input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
        			<span class="help-block"><?php echo $username_err;?></span>
        		</div>
				<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
        			<label for="email">Email</label>
        			<input type="email" name="email" id="username" class="form-control" value="<?php echo $username ?>" required>
        			<span class="help-block"><?php echo $email_err;?></span>
        		</div>
				<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
        			<label for="address">Address</label>
        			<input type="text" name="address" id="username" class="form-control" value="<?php echo $username ?>" required>
        			<span class="help-block"><?php echo $address_err;?></span>
        		</div>
        		<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
        			<label for="password">Password</label>
        			<input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
        			<span class="help-block"><?php echo $password_err; ?></span>
        		</div>

        		<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
        			<label for="confirm_password">Confirm Password</label>
        			<input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
        			<span class="help-block"><?php echo $confirm_password_err;?></span>
        		</div>

        		<div class="form-group">
        			<input type="submit" style="border-radius: 7px; padding: 10px;" class="btn btn-block btn-outline-success" value="Submit">
        			<input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
        		</div>
        		<p>Already have an account? <a href="login.php">Login here</a>.</p>
        	</form>
		</section>
                       </div>                   
                    </div>
                 </div>
        </div>
        <div class="col-md-6">
          <div class="image_6"><img src="images/img-6.png"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- contact section end -->
  <!-- footer section start -- >
  <div class="section_footer ">
      <div class="container"> 
         
      <div class="social_icon">
        <ul>
          <li><a href="https://www.linkedin.com/in/bestin-s-j-791b07251"><img src="images/fb-icon.png"></a></li>
          <li><a href="https://www.linkedin.com/in/bestin-s-j-791b07251"><img src="images/twitter-icon.png"></a></li>
          <li><a href="https://www.linkedin.com/in/bestin-s-j-791b07251"><img src="images/linkdin-icon.png"></a></li>
          <li><a href="https://www.linkedin.com/in/bestin-s-j-791b07251"><img src="images/instagram-icon.png"></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- footer section end -->
  <!-- copyright section start -->
  <div class="copyright_section">
    <div class="container">
      <p class="copyright_text">Copyright 2020 All Right Reserved By <!--<a href="https://www.linkedin.com/in/bestin-s-j-791b07251">--> Jewel</p>
    </div>
  </div>
  <!-- copyright section end -->
  <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
    $(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
        });
    </script>
</body>
</html>