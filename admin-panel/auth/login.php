<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php
require("../../config/config.php");
if (isset($_SESSION['admin_name'])) {
    header('Location: ' . BASEPATH . 'dashboard.php');
}

if (isset($_POST['submit']) && $_POST) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $user = $conn->prepare("SELECT * FROM `coffee-shop-admins` WHERE name = :name");
    $user->bindParam(":name", $name);
    $user->execute();
    $admin_user = $user->fetch(PDO::FETCH_ASSOC);

    if ($admin_user) {
        if (password_verify($password, $admin_user['password'])) {
            $_SESSION['admin_name'] = $admin_user['name'];
            header('Location: ' . BASEPATH . 'dashboard.php');
        } else {
            $error = "Invalid name or password";
        }
    } else {
        $error = "User Not Found";
    }
}

?>
<div class="container  justify-content-center mt-5 w-25">
    <h3>Admin Login </h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

        </div>
        <div class="form-group mt-3">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <button type="submit" name="submit" class="btn btn-primary mt-3">Login</button>
    </form>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif ?>
</div>