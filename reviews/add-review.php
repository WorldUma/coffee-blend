<?php require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: http://localhost/coffee-blend');
    exit;
}

if (isset($_POST['submit'])) {
    // Check required fields
    if (empty($_POST['review'])) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $review = $_POST['review'];
        $username = $_SESSION['username'];

        $addReview = $conn->prepare('INSERT INTO `reviews`(review,username) VALUES(:review,:username)');
        $addReview->execute([
            'review' => $review,
            'username' => $username
        ]);
        echo "<script>alert('Review added Successfully !!!');window.location.href = '" . APPURL . "';</script>";
    }
}

?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">ADD REVIEW</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="add-review.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Add Review</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input type="text" name="review" class="form-control" placeholder="Write review here ...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="radio">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary py-3 px-4">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require('../includes/footer.php') ?>