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




<?php 
// 	ob_start();
// 	session_start();
// 	require_once 'config/connect.php';
// if (isset($_SESSION["username"])&&isset($_SESSION["address"])&&isset($_SESSION["email"])&&isset($_SESSION["id"])) 
// {
//     $username = $_SESSION["username"];
//     $address = $_SESSION["address"];
//     $email = $_SESSION["email"];
//     $id = $_SESSION["id"];
//     include 'inc/header.php'; 
//     include 'inc/nav.php'; 
//     $uid = $_SESSION['id'];
//     $cart = $_SESSION['cart'];
//     session_write_close();
// } else {
//     // since the username is not set in session, the user is not-logged-in
//     // he is trying to access this page unauthorized
//     // so let's clear all session variables and redirect him to index
//     session_unset();
//     session_write_close();
//     $url = "./index.php";
//     header("Location: $url");
// }

?>
	
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>My Account</h2>
					</div>
					<div class="col-md-12">

			<h3>Recent Orders</h3>
			<br>
			<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Order</th>
						<th>Date</th>
						<th>Status</th>
						<th>Payment Mode</th>
						<th>Shipping Option</th>
						<th>Total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				<?php
					$ordsql = "SELECT * FROM orders WHERE uid='$uid'";
					$ordres = mysqli_query($connection, $ordsql);
					while($ordr = mysqli_fetch_assoc($ordres)){
				?>
					<tr>
						<td>
							<?php echo $ordr['id']; ?>
						</td>
						<td>
							<?php echo $ordr['timestamp']; ?>
						</td>
						<td>
							<?php echo $ordr['orderstatus']; ?>			
						</td>
						<td>
							<?php echo $ordr['paymentmode']; ?>
						</td>
						<td>
							<?php echo $ordr['shipping']; ?>
						</td>
						<td>
						₹	 <?php echo number_format($ordr['totalprice'],2); ?>
						</td>
						<td>
							<a href="view-order.php?id=<?php echo $ordr['id']; ?>">View</a>
							<?php if($ordr['orderstatus'] != 'Cancelled'){?>
							| <a href="cancel-order.php?id=<?php echo $ordr['id']; ?>">Cancel</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>		

			<br>
			<br>
			<br>

			<div class="ma-address">
						<h3>My Addresses</h3>
						<h4>
						<?php
						$csql = "SELECT address FROM users WHERE id=$uid";
						$cres = mysqli_query($connection, $csql);
						if(mysqli_num_rows($cres) == 1){
							$cr = mysqli_fetch_assoc($cres);
							echo "<p>".$cr['address'] ."</p>";
							
						}
					?>
				</h4>
						<h6>The following addresses will be used on the checkout page by default.</h6>

			<div class="row">
				<div class="col-md-6">
								<h4><a href="edit-address.php">click to edit</a></h4>
				</div>

				<div class="col-md-6">

				</div>
			</div>



			</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
