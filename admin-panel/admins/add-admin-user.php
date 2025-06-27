<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>
<?php
require("../../config/config.php");
if (isset($_POST['submit']) && $_POST) {

    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user = $conn->prepare("INSERT INTO `coffee-shop-admins`(name,password) VALUES(:name,:password)");
    if ($user->execute(['name' => $name, 'password' => $password])) {
        $success = "User Created Succesfully !!!";
    } else {
        $success = "Something wrong ...";
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

            <div class="container w-75">
                <h3> Create Admin User</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-3">Create Admin</button>
                </form>
            </div>
            <?php if (isset($success)): ?>
                <div class="alert alert-primary" role="alert">
                    <?= $success ?>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>