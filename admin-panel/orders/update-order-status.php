<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>

<?php require("../../config/config.php"); ?>
<?php

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 'null';

if (!$order_id) {
    $message = 'Order id should not be NULL OR EMPTY';
} else {

    $order = $conn->prepare("SELECT * FROM `orders` WHERE id=:id");
    $order->execute(['id' => $order_id]);
    if (!$order) {
        $message = "Order Not Found";
    }
    if (isset($_POST['submit']) && $_POST) {
        $status = $_POST['status'];
        $update = $conn->prepare("UPDATE orders SET status = :status WHERE id=:id; ");
        $update->execute(['status' => $status, 'id' => $order_id]);
        header("location:" . BASEPATH . "orders/order-list.php");
    }
}


?>

<div class="d-flex flex-row justify-content-between mb-3">
    <?php if (!isset($_SESSION['admin_name'])):  ?>

        <div class="alert alert-info" style="position: absolute; top:50%; left:50%;transform: translate3d(-50%,-50%, 0);" role="alert">
            Please login for credential contact admin.
        </div>
    <?php else: ?>
        <?php require("../layouts/sidebar.php"); ?>

        <div class="p-4" style="flex-grow: 1;">
            <form action="" method="POST" class="form-control">
                <div class="container mt-3">
                    <h3 class="pb-3"> Update Order Status</h3>
                    <select class="form-select" name="status" aria-label="Default select example">

                        <option value="Pending">Pending</option>
                        <option value="Delivered">Delivered</option>

                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-5">Update</button>
            </form>

        </div>
    <?php endif ?>
    <?php if (isset($message)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $message ?>
        </div>
    <?php endif ?>
</div>