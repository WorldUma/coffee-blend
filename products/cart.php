<?php



require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>


<?php
$user_id = $_SESSION['user_id'];
$cart_list = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$cart_list->execute([$user_id]);
$cart_list = $cart_list->fetchAll(PDO::FETCH_OBJ);

$total = $conn->prepare("SELECT SUM(price * quantity) AS subtotal FROM `cart` WHERE user_id =?");
$total->execute([$user_id]);
$sub_total = $total->fetchColumn();

//proceed to checkout 
if (isset($_POST['checkout'])) {
	$_SESSION['total_price'] = $_POST['total_price'];
	header('location:checkout.php');
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_count = $stmt->fetchColumn();
// if ($cart_count == 0) {
// 	// Redirect to cart or show a message
// 	header("Location:" . APPURL);
// 	exit;
// }


?>

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Cart</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Cart</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($cart_count > 0): ?>
								<?php foreach ($cart_list as $cart_item): ?>
									<tr class="text-center">
										<td class="product-remove"><a href="delete-cart.php?id=<?= $cart_item->id ?>"><span class="icon-close"></span></a></td>

										<td class="image-prod">
											<div class="img" style="background-image:url(<?php echo APPURL ?>images/<?= $cart_item->image ?>);"></div>
										</td>

										<td class="product-name">
											<h3><?= $cart_item->name ?></h3>
											<p><?= $cart_item->description ?></p>
										</td>

										<td class="price"><?= $cart_item->price ?></td>

										<td>
											<div class="input-group mb-3">
												<input disabled type="text" name="quantity" class="quantity form-control input-number" value="<?= $cart_item->quantity ?>" min="1" max="100">
											</div>
										</td>

										<td class="total"><?= $cart_item->price * $cart_item->quantity ?></td>
									</tr>

								<?php endforeach ?>
							<?php else: ?>
								<td><span>Your cart is empty</span></td>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row justify-content-end">
			<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
				<div class="cart-total mb-3">
					<h3>Cart Totals</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span>$<?= number_format($sub_total, 2) ?></span>
					</p>
					<p class="d-flex">
						<span>Delivery</span>
						<span>$10.00</span>
					</p>
					<p class="d-flex">
						<span>Discount</span>
						<span>$3.00</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span>$<?= Number_format($sub_total + 10.00 - 3.00, 2) ?></span>
					</p>
				</div>
				<form action="cart.php" method="POST">
					<input type="hidden" name="total_price" value="<?= Number_format($sub_total + 10.00 - 3.00, 2) ?>">
					<?php if ($cart_count > 0): ?>
						<button type="submit" name="checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
					<?php endif; ?>
				</form>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section ftco-animate text-center">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Related products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="menu-entry">
					<a href="#" class="img" style="background-image: url(images/menu-4.jpg);"></a>
					<div class="text text-center pt-4">
						<h3><a href="#">Coffee Capuccino</a></h3>
						<p>A small river named Duden flows by their place and supplies</p>
						<p class="price"><span>$5.90</span></p>
						<p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require('../includes/footer.php') ?>

</body>

</html>