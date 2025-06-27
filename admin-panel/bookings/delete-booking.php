<?php
require("../../config.php");
const BASEPATH = APPURL . 'admin-panel/';
require("../../config/config.php");
$booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : NULL;
if ($booking_id) {
    $booking_item = $conn->prepare("SELECT * FROM `bookings` WHERE id=:id");
    if ($booking_item->execute(["id" => $booking_id])) {
        $del_id = $conn->prepare("DELETE From bookings WHERE id=:id");
        $del_id->execute(["id" => $booking_id]);
        header("location:" . BASEPATH . "bookings/booking-list.php");
    }
}
