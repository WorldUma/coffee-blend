<?php require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>

<?php
$product_id = $_GET['product_id'] ??  null;
$user_id = $_SESSION['user_id'];

if ($product_id) {
	$product = $conn->prepare("SELECT * FROM products WHERE id = ?");
	$product->execute([$product_id]);
	$singleProduct = $product->fetch(PDO::FETCH_OBJ);

	if ($singleProduct) {
		$relatedProducts = $conn->prepare("SELECT * FROM products WHERE category = ? AND id != ?");
		$relatedProducts->execute([$singleProduct->category, $singleProduct->id]);
		$allRelatedProducts = $relatedProducts->fetchAll(PDO::FETCH_OBJ);
	}
}


// if (isset($_GET['product_id'])) {
// 	$product_id = $_GET['product_id'];
// 	//var_dump($product_id);
// 	$product = $conn->prepare("SELECT * FROM products WHERE id = ?");
// 	$product->execute([$product_id]);
// 	$singleProduct = $product->fetch(PDO::FETCH_OBJ);
// 	//var_dump($singleProduct);

// 	$relatedProducts = $conn->prepare("SELECT * FROM products WHERE category = ? AND id != ?");
// 	$relatedProducts->execute([$singleProduct->category, $singleProduct->id]);
// 	$allRelatedProducts = $relatedProducts->fetchAll(PDO::FETCH_OBJ);
// 	echo "<pre>";
// 	var_dump($allRelatedProducts);
// 	echo "</pre>";
// }
if (isset($_POST['submit'])) {
	// echo '<pre>';
	// print_r($_POST);
	// echo '</pre>';

	$id = $_POST['product_id'];
	$name = $_POST['name'];
	$image = $_POST['image'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$qty = $_POST['quantity'];
	$user_id = $_SESSION['user_id'];

	$insert_cart = $conn->prepare("INSERT INTO cart(product_id,name,image,description,price,quantity,user_id) VALUES(:product_id,:name,:image,:description,:price,:quantity,:user_id)");
	$insert_cart->execute([
		'product_id' => $id,
		'name' => $name,
		'image' => $image,
		'description' => $description,
		'price' => $price,
		'quantity' => $qty,
		'user_id' => $user_id,
	]);
}

$cart_count = $conn->prepare("SELECT COUNT(id) AS count FROM cart WHERE user_id = ? AND product_id = ? ");
$cart_count->execute([$user_id, $product_id]);
$rows = $cart_count->fetchColumn();
?>

<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Product Detail</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Product Detail</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<?php if (isset($singleProduct) && $singleProduct): ?>
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="<?= APPURL ?>images/<?= $singleProduct->image ?>" class="image-popup"><img src="<?= APPURL ?>images/<?= $singleProduct->image ?>" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?= $singleProduct->name ?></h3>
					<p class="price"><span>$<?= $singleProduct->price ?></span></p>
					<p><?= $singleProduct->description ?></p>

					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">Small</option>
										<option value="">Medium</option>
										<option value="">Large</option>
										<option value="">Extra Large</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="icon-minus"></i>
								</button>
							</span>
							<form action="product-single.php?product_id=<?= $product_id ?>" method="POST">
								<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
								<span class="input-group-btn ml-2">
									<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
										<i class="icon-plus"></i>
									</button>
								</span>
						</div>
					</div>
					<input type="hidden" name="product_id" value="<?= $product_id ?>">
					<input type="hidden" name="name" value="<?= $singleProduct->name ?>">
					<input type="hidden" name="image" value="<?= $singleProduct->image ?>">
					<input type="hidden" name="description" value="<?= $singleProduct->description ?>">
					<input type="hidden" name="price" value="<?= $singleProduct->price ?>">
					<?php if ($rows > 0): ?>
						<p><button type="submit" name="submit" class="btn btn-primary py-3 px-5" disabled>Added to Cart</button></p>
					<?php else: ?>
						<p><button type="submit" name="submit" class="btn btn-primary py-3 px-5">Add to Cart</button></p>
					<?php endif ?>
					</form>
				</div>
			</div>
		<?php else: ?>
			<div class="alert alert-danger">Sorry, this product was not found.</div>
		<?php endif; ?>
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
			<?php if (isset($allRelatedProducts)) { ?>
				<?php foreach ($allRelatedProducts as $allProducts): ?>
					<div class="col-md-3">
						<div class="menu-entry">
							<a href="<?= APPURL ?>images/<?= $allProducts->image ?>" class="img" style="background-image: url(<?= APPURL ?>images/<?= $allProducts->image ?>);"></a>
							<div class="text text-center pt-4">
								<h3><a href="<?= APPURL ?>products/product-single.php?product_id=<?= $allProducts->id ?>"><?= $allProducts->name ?></a></h3>
								<p><?= $allProducts->description ?></p>
								<p class="price"><span>$<?= $allProducts->price ?></span></p>
								<p><a href="<?= APPURL ?>products/product-single.php?product_id=<?= $allProducts->id ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php } ?>
		</div>
	</div>
</section>
<?php require('../includes/footer.php') ?>


</body>

</html>