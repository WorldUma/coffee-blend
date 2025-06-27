<?php
require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>
<?php
$user_id = $_SESSION['user_id'];
$order_list = $conn->prepare("SELECT * FROM `orders` WHERE `user_id`=?");
$order_list->execute([$user_id]);
$order_list = $order_list->fetchAll(PDO::FETCH_OBJ);
?>
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(<?php echo APPURL ?>images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Orders</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL ?>">Home</a></span> <span>Order List</span></p>
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
                                <th> Name</th>
                                <th>Country</th>
                                <th>Address</th>
                                <th>Town</th>
                                <th>Zipcode</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($order_list > 0): ?>
                                <?php foreach ($order_list as $orders): ?>
                                    <tr class="text-center">
                                        <td class="product-remove"><?= $orders->name ?></td>

                                        <td class="image-prod">
                                            <?= $orders->country ?>
                                        </td>

                                        <td class="product-name">

                                            <p> <?= $orders->address ?></p>
                                        </td>

                                        <td class="price">
                                            <p> <?= $orders->town ?></p>
                                        </td>

                                        <td>
                                            <p> <?= $orders->zipcode ?></p>
                                        </td>

                                        <td class="total">
                                            <p><?= $orders->phone ?></p>
                                        </td>
                                        <td>
                                            <p><?= $orders->email ?></p>
                                        </td>
                                        <td>
                                            <p><?= $orders->total_price ?></p>
                                        </td>
                                        <td>
                                            <p><?= $orders->status ?></p>
                                        </td>
                                        <?php if ($orders->status == 'Delivered'): ?>
                                            <td>
                                                <a href="<?php echo APPURL ?>reviews/add-review.php" class="btn btn-primary">Add Review</a>
                                            </td>
                                        <?php endif ?>
                                    </tr>

                                <?php endforeach ?>
                            <?php else: ?>
                                <td><span>Your Order List is empty</span></td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
<?php require('../includes/footer.php') ?>