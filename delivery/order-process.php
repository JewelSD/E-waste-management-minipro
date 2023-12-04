<?php
include "config.php";
include "config/connect.php";
$uid = $_POST['uid'];
$oid = $_POST['oid'];
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>

<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
					<div class="page_header text-center">
						<h2>Order Processing</h2>
						<!-- <p>Do you want to cancel Order?</p> -->
					</div>

<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="billing-details">

				<table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Address 1</th>
						<th>Address 2</th>
						<th>City </th>
						<th>Zip </th>
						<th>Mobile</th>
						<th>zip</th>
						<th>Item</th>
					</tr>
				</thead>
				<tbody>

				<?php
					$ordsql = "SELECT * FROM usersmeta WHERE uid='$uid'";
					$ordres = mysqli_query($connection, $ordsql);
					while($ordr = mysqli_fetch_assoc($ordres)){
				?>
					<tr>
						<td>
							<?php echo $ordr['firstname']; ?>
						</td>
						<td>
							<?php echo $ordr['lastname']; ?>
						</td>
						<td>
							<?php echo $ordr['address1']; ?>			
						</td>
						<td>
							<?php echo $ordr['address2']; ?>			
						</td>
						<td>
							<?php echo $ordr['city']; ?>			
						</td>
						<td>
							<?php echo $ordr['zip']; ?>			
						</td>
						<td>
							<?php echo $ordr['mobile']; ?>
							<a href="<?php echo $ordr['mobile']; ?>">📞</a>
						</td>
						<td>
							<?php echo $ordr['zip']; ?>
						</td>
						<td>
						<?php echo '<form action = "order_product.php" method = "post" >
                        <input name = "oid" type="hidden" value = '.$oid.'>
                        <input type = submit class="btn-success" value ="View Basket">
                        </form>' ?>
						</td>
						
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<form action="update-status.php" method="post" style="padding-top: 50px; padding-bottom: 50px;">	

						<div class="space30"></div>
							<label class="">Order Status </label>
							<select name="status" class="form-control">
								<option value="">Select Status</option>
								<option value="In Progress">In Progress</option>
								<option value="Dispatched">Dispatched</option>
								<option value="Delivered">Delivered</option>
							</select>
						<input type="hidden" name="orderid" value="<?php echo $oid; ?>">		 
						<div class="space30"></div>
					<input type="submit" class="button btn-lg" value="Update Order Status">
					</div>
				</div>
				
			</div>
		
		</div>		
</form>	

		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
