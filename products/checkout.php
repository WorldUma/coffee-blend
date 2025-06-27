<?php require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>

<?php

// if (isset($_POST['total_price'])) {
// 	$total_price = $_POST['total_price'];
// }
//var_dump($total_price);

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SERVER['HTTP_REFERER'])) {
	header('location: http://localhost/coffee-blend');
	exit;
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
	// Check required fields
	if (
		empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['country']) ||
		empty($_POST['streetaddress']) || empty($_POST['town']) || empty($_POST['zipcode']) ||
		empty($_POST['phone']) || empty($_POST['email'])
	) {
		echo "<script>alert('All fields are required.');</script>";
	} else {
		// Prepare values
		$name = $_POST['firstname'] . " " . $_POST['lastname'];
		$country = $_POST['country'];
		$address = $_POST['streetaddress'];
		$town = $_POST['town'];
		$zipcode = $_POST['zipcode'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$status = 'pending';

		// Sample session values — make sure they exist
		$total_price = $_SESSION['total_price'];
		$user_id = $_SESSION['user_id'];



		$conn = $conn->prepare("INSERT INTO orders 
                (name, country, address, town, zipcode, phone, email, status, total_price, user_id) 
                VALUES 
                (:name, :country, :address, :town, :zipcode, :phone, :email, :status, :total_price, :user_id)");
		$success = $conn->execute([
			'name' => $name,
			'country' => $country,
			'address' => $address,
			'town' => $town,
			'zipcode' => $zipcode,
			'phone' => $phone,
			'email' => $email,
			'status' => $status,
			'total_price' => $total_price,
			'user_id' => $user_id
		]);

		if ($success) {
			$_SESSION['order_in_progress'] = true;
			echo 'Session started: order in progress set.';
			header("Location: payment.php");
			exit;
		}
	}

	// echo "<pre>";
	// print_r($_POST);
	// print_r($_SESSION);
	// echo "</pre>";
}


?>

<style>
	select#country {
		color: black !important;
		background-color: white !important;
	}
</style>
<section class="home-slider owl-carousel">

	<div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center">

				<div class="col-md-7 col-sm-12 text-center ftco-animate">
					<h1 class="mb-3 mt-5 bread">Checkout</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Checout</span></p>
				</div>

			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<form action="checkout.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
					<h3 class="mb-4 billing-heading">Billing Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="firstname">Firt Name</label>
								<input type="text" name="firstname" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" name="lastname" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="country">State / Country</label>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="country" id="country" class="form-control" style="color:black;background-color:white">
										<option value="France">France</option>
										<option value="Italy">Italy</option>
										<option value="Philippines">Philippines</option>
										<option value="South Korea">South Korea</option>
										<option value="Hongkong">Hongkong</option>
										<option value="Japan">Japan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="streetaddress">Street Address</label>
								<input type="text" name="streetaddress" class="form-control" placeholder="House number and street name">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="towncity">Town / City</label>
								<input type="text" name="town" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcodezip">Postcode / ZIP *</label>
								<input type="text" name="zipcode" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" name="phone" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="emailaddress">Email Address</label>
								<input type="text" name="email" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group mt-4">
								<div class="radio">
									<button type="submit" name="submit" value="submit" class="btn btn-primary py-3 px-4">Place an order</button>

								</div>
							</div>
						</div>
					</div>
				</form><!-- END -->


				<!-- 
	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>$20.60</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
		    						<span>$0.00</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Discount</span>
		    						<span>$3.00</span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>$17.60</span>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
								</div>
	          	</div>
	          </div> -->
			</div> <!-- .col-md-8 -->


		</div>

	</div>
	</div>
</section> <!-- .section -->

<?php require('../includes/footer.php') ?>