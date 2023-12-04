<?php
include "config.php";
include "config/connect.php";
$oid = $_POST['oid'];
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog">
		<div class="page_header text-center">
			<h2> Delivery - Order View </h2>
			<!-- <p>Do you want to cancel Order?</p> -->
		</div>

		<div class="container">
			<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th></th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>

					<?php

					if (isset($_POST['oid']) & !empty($_POST['oid'])) {
						$oid = $_POST['oid'];
					} else {
						header('location: my-account.php');
					}
					$ordsql = "SELECT * FROM orders WHERE id ='$oid'";
					$ordres = mysqli_query($connection, $ordsql);
					$ordr = mysqli_fetch_assoc($ordres);

					$orditmsql = "SELECT * FROM orderitems o JOIN products p WHERE o.pid=p.id and o.orderid=$oid";
					$orditmres = mysqli_query($connection, $orditmsql);
					while ($orditmr = mysqli_fetch_assoc($orditmres)) {
						?>
						<tr>
							<td>
								<a href="single.php?id=<?php echo $orditmr['pid']; ?>">
									<?php echo substr($orditmr['name'], 0, 25); ?>
								</a>
							</td>
							<td>
								<?php echo $orditmr['pquantity']; ?>
							</td>
							<td>
								₹
								<?php echo $orditmr['productprice']; ?>/
								<?php echo $orditmr['unit']; ?>
							</td>
							<td>

							</td>
							<td>
								₹
								<?php echo number_format($orditmr['productprice'] * $orditmr['pquantity'], 2); ?>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Total
						</td>
						<td>
							₹
							<?php echo number_format($ordr['totalprice'], 2); ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Status
						</td>
						<td>
							<?php echo $ordr['orderstatus']; ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
							Order Placed On
						</td>
						<td>
							<?php echo $ordr['timestamp']; ?>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
</section>

<?php include 'inc/footer.php' ?>