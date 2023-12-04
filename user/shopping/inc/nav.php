<style>
	/* Set the background color of .menu-wrap to black */
.menu-wrap {
    background-color: #000; /* Black background color */
    transition: background-color 0.3s ease; /* Add transition for smooth color change */
}

/* Add hover effect with animation */
.menu-wrap:hover {
    background-color: grey; /* Change to your preferred hover color code */
}

/* Style the navigation menu shape */
.sf-menu li {
    display: inline-block;
    position: relative; /* Add relative positioning */
    margin-right: 20px;
}

/* Style the dropdown menu to work downwards */
/* Style the dropdown menu background color */
.sf-menu ul {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff; /* Default background color */
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    transition: background-color 0.3s ease; /* Add transition for smooth color change */
}

/* Change the background color when the dropdown is hovered */
.sf-menu li:hover ul {
    background-color: #000; /* Change to black background color on hover */
}


.sf-menu li:hover ul {
    display: block;
}
		/* Basic styling for the navigation menu */
.sf-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.sf-menu li {
    display: inline-block;
    margin-right: 20px; /* Adjust spacing between menu items */
}

.sf-menu a {
    text-decoration: none;
    color: #333; /* Text color */
    font-weight: bold;
    transition: color 0.3s ease; /* Smooth color transition on hover */
}

.sf-menu a:hover {
    color: #ff6600; /* Change color on hover */
}

/* Add icons to menu items */
.sf-menu li a:before {
    content: "\f105"; /* Use the appropriate Font Awesome icon code */
    font-family: FontAwesome;
    margin-right: 5px; /* Adjust spacing between icon and text */
}

/* Style the dropdown menu */
.sf-menu ul {
    display: none; /* Hide by default */
    position: absolute;
    background-color: #fff; /* Background color for dropdown */
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); /* Add shadow effect */
}

.sf-menu li:hover ul {
    display: block; /* Show on hover */
}
</style>		
		<div class="menu-wrap">
				<div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="#">Shop</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
						<?php
							$catsql = "SELECT * FROM category";
							$catres = mysqli_query($connection, $catsql);
							while($catr = mysqli_fetch_assoc($catres)){
						 ?>
							<li><a href="index.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
						<?php } ?>
						</ul>
					</li>
					<li>
						<a href="#">My Account</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="my-account.php">My Orders</a></li>
							<li><a href="edit-address.php">Update Address</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
					<li>
					    <a href="#">Sell</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="../sales/sale.php">Apply sales</a></li>
							<li><a href="#">Accepted products</a></li>
							<li><a href="#">Rejected Products</a></li>
						</ul>
					</li>
				</ul>
				<div class="header-xtra">
				<?php $cart = $_SESSION['cart']; ?>
					<div class="s-cart">
						<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em><?php
								echo count($cart); ?></em></div>

						<div class="cart-info">
							<small>You have <em class="highlight"><?php
								echo count($cart); ?> item(s)</em> in your shopping bag</small>
							<br>
							<br>
							<?php
								//print_r($cart);
								$total = 0;
								foreach ($cart as $key => $value) {
									//echo $key . " : " . $value['quantity'] ."<br>";
									$navcartsql = "SELECT * FROM products WHERE id=$key";
									$navcartres = mysqli_query($connection, $navcartsql);
									$navcartr = mysqli_fetch_assoc($navcartres);

								
							 ?>
							<div class="ci-item">
								<img src="../../crm/manager/<?php echo $navcartr['thumb']; ?>" width="70" alt=""/>
								<div class="ci-item-info">
									<h5><a href="single.php?id=<?php echo $navcartr['id']; ?>"><?php echo substr($navcartr['name'], 0 , 20); ?></a></h5>
									<p><?php echo $value['quantity']; ?> x ₹  <?php echo $navcartr['price']; ?>/<?php echo $navcartr['unit']; ?></p>
									<div class="ci-edit">
										<!-- <a href="#" class="edit fa fa-edit"></a> -->
										<a href="delcart.php?id=<?php echo $key; ?>" class="edit fa fa-trash"></a>
									</div>
								</div>
							</div>
							<?php 
							$total = $total + ($navcartr['price']*$value['quantity']);
							} ?>
							<div class="ci-total">Subtotal: ₹  <?php echo $total; ?></div>
							<div class="cart-btn">
								<a href="cart.php">View Bag</a>
								<a href="checkout.php">Checkout</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</header>