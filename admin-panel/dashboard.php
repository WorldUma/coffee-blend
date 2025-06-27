<?php require("../config.php");
//var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>


<?php require("layouts/header.php"); ?>
<?php require("layouts/navbar.php") ?>

<?php
require("../config/config.php");
$count = $conn->prepare("SELECT count(*) as product_count FROM `products`");
$count->execute();
$product_count = $count->fetchColumn();

$orders_count = $conn->prepare("SELECT count(*) as orders_count FROM `orders`");
$orders_count->execute();
$order_count = $orders_count->fetchColumn();

$booking_count = $conn->prepare("SELECT count(*) as booking_count FROM `bookings`");
$booking_count->execute();
$book_item_count = $booking_count->fetchColumn();

?>
<div class="d-flex flex-row justify-content-between mb-3">
    <?php if (!isset($_SESSION['admin_name'])):  ?>

        <div class="alert alert-info" style="position: absolute; top:50%; left:50%;transform: translate3d(-50%,-50%, 0);" role="alert">
            Please login for credential contact admin.
        </div>
    <?php else: ?>
        <?php require("layouts/sidebar.php") ?>

        <div class="p-2 flex-fill mx-2 border text-center" style="height: 150px;">
            <div class="container">
                <h4>Products</h4>
                <p><?= $product_count ?></p>
            </div>
        </div>
        <div class="p-2 flex-fill mx-2 border text-center" style="height: 150px;">
            <div class="container">
                <h4>Orders</h4>
                <p><?= $order_count ?></p>
            </div>
        </div>
        <div class="p-2 flex-fill mx-2 border text-center" style="height: 150px;">
            <div class="container">
                <h4>Bookings</h4>
                <p><?= $book_item_count ?></p>
            </div>
        </div>
    <?php endif ?>
</div>