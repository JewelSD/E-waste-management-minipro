<?php 
	ob_start();
	session_start();
	require_once '../config/connect.php';
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: ../login.php');	
		exit;
	// since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to login
	}
	
	 else {
    $username = $_SESSION["username"];
    $address = $_SESSION["address"];
    $email = $_SESSION["customer"];
    $id = $_SESSION["id"];
    include 'inc/header.php'; 
    include 'inc/nav.php'; 
    $uid = $_SESSION['id'];
    $cart = $_SESSION['cart'];
    session_write_close();
}

?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2></h2>
						<p>You can order and sell from here</p>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div id="shop-mason" class="shop-mason-4col">

							<?php 
								$sql = "SELECT * FROM products";
								if(isset($_GET['id']) & !empty($_GET['id'])){
									$id = $_GET['id'];
									$sql .= " WHERE catid=$id";
								}
								

								$res = mysqli_query($connection, $sql);
								while($r = mysqli_fetch_assoc($res)){
							?>
								<div class="sm-item isotope-item">
									<div class="product" >
										<div class="product-thumb" style="border-radius: 20px;">
											<img src="../../tech/<?php echo $r['thumb']; ?>" class="img-responsive" width="250px" alt="product_picture">
											<div class="product-overlay">
												<span>
												<a href="single.php?id=<?php echo $r['id']; ?>" class="fa fa-link"></a>
												<a href="single.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a>
													<!-- <a href="addtocart.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a> -->
												</span>					
											</div>
										</div>
										<div class="rating">
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
											<span class="fa fa-star act"></span>
										</div>
										<h2 class="product-title"><a href="single.php?id=<?php echo $r['id']; ?>"><?php echo $r['name']; ?></a></h2>
										<div class="product-price">₹ <?php echo $r['price']; ?>/-<span></span></div>
									</div>
								</div>
							<?php } ?>

								
							</div>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination -->
						<div class="page_nav">
							<a href=""><i class="fa fa-angle-left"></i></a>
							<a href="" class="active">1</a>
							<a href="">2</a>
							<a href="">3</a>
							<a class="no-active">...</a>
							<a href="">9</a>
							<a href=""><i class="fa fa-angle-right"></i></a>
						</div>
						<!-- End Pagination -->
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include 'inc/footer.php' ?>
