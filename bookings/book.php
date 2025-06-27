<?php require('../includes/header.php') ?>
<?php require('../includes/navbar.php') ?>
<?php require('../config/config.php') ?>

<?php
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    if (
        empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['date']) || empty($_POST['time']) ||
        empty($_POST['phone']) || empty($_POST['message'])
    ) {
        echo "<script> alert('one or more than one fields are required.')</script>";
    } else {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        // $date = $_POST['date'];
        //$time = $_POST['time'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        $dateInput = $_POST['date'];
        $date = DateTime::createFromFormat('n/j/Y', $dateInput);
        if ($date) {
            $dateFormatted = $date->format('Y-m-d'); // ✅ correct format for DB
        }

        $timeInput = $_POST['time']; // e.g., '5:00pm' or '7:30am'
        $time = DateTime::createFromFormat('g:ia', strtolower($timeInput));
        if ($time) {
            $timeFormatted = $time->format('H:i:s'); // ✅ correct format for DB
        }

        $today = new DateTime();
        $today->setTime(0, 0); // optional: ignore current time

        if ($date > $today) {
            $conn = $conn->prepare("INSERT INTO bookings(firstname,lastname,date,time,phone,message,user_id) VALUES 
            (:firstname,:lastname,:date,:time,:phone,:message,:user_id)");
            $conn->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'date' => $dateFormatted,
                'time' => $timeFormatted,
                'phone' => $phone,
                'message' => $message,
                'user_id' => $user_id,
            ]);
            header('location:' . APPURL . '');
        } else {
            header('location:' . APPURL . '');
        }
    }
}
