<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>
<?php
require("../../config/config.php");

$products = $conn->prepare("SELECT * FROM `products`");
$products->execute();
$product_list = $products->fetchAll(PDO::FETCH_OBJ); ?>
<div class="d-flex flex-row justify-content-between mb-3">
    <?php if (!isset($_SESSION['admin_name'])):  ?>
        <div class="alert alert-info" style="position: absolute; top:50%; left:50%;transform: translate3d(-50%,-50%, 0);" role="alert">
            Please login for credential contact admin.
        </div>
    <?php else: ?>
        <?php require("../layouts/sidebar.php"); ?>
        <div class="p-4" style="flex-grow: 1;">
            <div class="container">
                <h3> Product list</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> Name</th>
                            <th scope="col"> Image</th>
                            <th scope="col"> Description</th>
                            <th scope="col"> Category</th>
                            <th scope="col"> Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($product_list) && $product_list): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($product_list as $product): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $product->name ?></td>
                                    <td><img src="<?= APPURL ?>images/<?= $product->image ?>" style="height:40px;width: 30px;"></td>
                                    <td><?= $product->description ?></td>
                                    <td><?= $product->category ?></td>
                                    <td><?= $product->price ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td>No Products</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
</div>