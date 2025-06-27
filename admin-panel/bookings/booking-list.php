<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>
<?php

require("../../config/config.php");
$base = "SELECT * FROM `bookings`";
$bookings = $conn->prepare($base);
$bookings->execute();
$booking_list = $bookings->fetchAll(PDO::FETCH_OBJ);

//update the booking status
if (isset($_POST['submit']) && $_POST) {
    $booking_id = $_POST['booking_id'];
    $where = "WHERE id=:id";
    $id = $conn->prepare($base . "" . $where);
    $id->execute(["id" => $booking_id]);
    $booking_item_id = $id->fetchColumn();
    if ($booking_item_id) {
        $update_status = $conn->prepare("UPDATE `bookings` SET `status` = 'Done' WHERE id=$booking_id");
        $update_status->execute();
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
            <div class="container">
                <h3> Order list</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Message</th>
                            <th scope="col">User Name</th>
                            <th scope="col">status</th>
                            <th class="col-2">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($booking_list) && $booking_list): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($booking_list as $booking_item): ?>

                                <tr>

                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $booking_item->firstname . '' . '' . $booking_item->lastname ?></td>
                                    <td><?= $booking_item->date ?></td>
                                    <td><?= isset($booking_item->time) ? date('g:ia', strtotime($booking_item->time)) : '' ?></td>
                                    <td><?= $booking_item->phone ?></td>
                                    <td><?= $booking_item->message ?></td>
                                    <td><?= $booking_item->user_id ?></td>
                                    <td><?= $booking_item->status ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="booking_id" value="<?= $booking_item->id ?>">
                                            <button type="submit" name="submit" class="btn btn-warning">Update Status</button>
                                        </form>

                                    </td>
                                    <td><a href="<?= BASEPATH ?>bookings/delete-booking.php?booking_id=<?= $booking_item->id ?>" class="btn btn-danger">Delete</a></td>

                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td>No Bookings</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


        </div>
    <?php endif; ?>
</div>