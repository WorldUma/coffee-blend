<?php require('../includes/header.php') ?>
<?php require('../config/config.php') ?>
<?php

$user_id = $_SESSION['user_id'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $delete_cart = $conn->prepare("DELETE  FROM cart WHERE id = ? AND user_id = ?");
    $delete_cart->execute([$id, $user_id]);
    header("location:cart.php");
    exit;
} else {
    //delete cart after the payment done
    $delete = $conn->prepare("DELETE  FROM cart WHERE  user_id = ?");
    $delete->execute([$user_id]);
    unset($_SESSION['order_in_progress']);
    header("location:cart.php");

    exit;
}
