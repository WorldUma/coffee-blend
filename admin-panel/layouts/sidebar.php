<?php require("header.php"); ?>
<?php //require("../config.php");
$current_page = basename($_SERVER['REQUEST_URI']);
//var_dump($current_page);
?>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 250px; height: 100vh;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item ">
                <a href="<?= BASEPATH ?>dashboard.php" class="nav-link text-white <?= ($current_page === 'dashboard.php') ? 'active' : ''; ?> ">Home</a>
            </li>
            <li>
                <a href="<?= BASEPATH ?>admins/add-admin-user.php" class="nav-link text-white <?= ($current_page === 'add-admin-user.php') ? 'active' : ''; ?>">Admins</a>
            </li>
            <li>
                <a href="<?= BASEPATH ?>orders/order-list.php" class="nav-link text-white <?= ($current_page === 'order-list.php')  ? 'active' : ''; ?>">Orders</a>
            </li>
            <li>
                <a href="<?= BASEPATH ?>products/add-product.php" class="nav-link text-white <?= ($current_page === 'add-product.php')  ? 'active' : ''; ?>">Add Product</a>
            </li>
            <li>
                <a href="<?= BASEPATH ?>products/product-list.php" class="nav-link text-white <?= ($current_page === 'product-list.php')  ? 'active' : ''; ?>">Product List</a>
            </li>
            <li>
                <a href="<?= BASEPATH ?>bookings/booking-list.php" class="nav-link text-white <?= ($current_page === 'booking-list.php') ? 'active' : ''; ?>">Bookings</a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <!-- <div class="p-4" style="flex-grow: 1;">
        <h1>Welcome to the Dashboard</h1>
        <p>Put your main content here.</p>
    </div> -->
</div>