<?php require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>
<?php
$user_id = $_SESSION['user_id'];
$book_list = $conn->prepare("SELECT * FROM `bookings` WHERE `user_id` = ? ");
$book_list->execute([$user_id]);
$book_list = $book_list->fetchAll(PDO::FETCH_OBJ);

?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Cart</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Booking List</span></p>
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($book_list > 0): ?>
                                <?php foreach ($book_list as $book_item): ?>
                                    <tr class="text-center">
                                        <td class="product-remove"><?= $book_item->firstname ?></td>

                                        <td class="image-prod">
                                            <?= $book_item->lastname ?>
                                        </td>

                                        <td class="product-name">

                                            <p><?= $book_item->date ?></p>
                                        </td>

                                        <td class="price"><?php
                                                            if (!empty($book_item->time)) {
                                                                $time = DateTime::createFromFormat('H:i:s', $book_item->time);
                                                                if ($time) {
                                                                    echo $time->format('g:i A');
                                                                } else {
                                                                    echo "Invalid time format";
                                                                }
                                                            } else {
                                                                echo "Time not set";
                                                            }
                                                            ?>
                                        </td>

                                        <td>
                                            <p><?= $book_item->phone ?></p>
                                        </td>

                                        <td class="total">
                                            <p><?= $book_item->message ?></p>
                                        </td>
                                        <td>
                                            <p><?= $book_item->status ?></p>
                                        </td>
                                        <?php if ($book_item->status == 'Done'): ?>
                                            <td>
                                                <a href="<?php echo APPURL ?>reviews/add-review.php" class="btn btn-primary">Add Review</a>
                                            </td>
                                        <?php endif ?>
                                    </tr>

                                <?php endforeach ?>
                            <?php else: ?>
                                <td><span>Your Booking Table is empty</span></td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<?php require('../includes/footer.php') ?>