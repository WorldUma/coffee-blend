<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>

<?php
require("../../config/config.php");
$orders = $conn->prepare("SELECT * FROM `orders`");
$orders->execute();
$order_list = $orders->fetchAll(PDO::FETCH_OBJ);

?>
<div class="d-flex flex-row justify-content-between mb-3">
    <?php if (!isset($_SESSION['admin_name'])):  ?>

        <div class="alert alert-info" style="position: absolute; top:50%; left:50%;transform: translate3d(-50%,-50%, 0);" role="alert">
            Please login for credential contact admin.
        </div>
    <?php else: ?>
        <?php require("../layouts/sidebar.php"); ?>

        <div class="p-4" style="flex-grow: 1;">
            <div class="container">
                <h3> Order list</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Address</th>
                            <th scope="col">Town</th>
                            <th scope="col">Zipcode</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($order_list) && $order_list): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($order_list as $order_item): ?>

                                <tr>

                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $order_item->name ?></td>
                                    <td><?= $order_item->country ?></td>
                                    <td><?= $order_item->address ?></td>
                                    <td><?= $order_item->town ?></td>
                                    <td><?= $order_item->zipcode ?></td>
                                    <td><?= $order_item->phone ?></td>
                                    <td><?= $order_item->total_price ?></td>
                                    <td><?= $order_item->user_id ?></td>
                                    <td><?= $order_item->status ?></td>
                                    <td><a href="<?= BASEPATH ?>/orders/update-order-status.php?order_id=<?= $order_item->id ?>" class="btn btn-warning">Update Status</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td>No Order</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


        </div>
    <?php endif; ?>
</div>