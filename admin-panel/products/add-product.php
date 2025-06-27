<?php require("../../config.php"); ?>

<?php //var_dump(APPURL);
const BASEPATH = APPURL . 'admin-panel/';
//var_dump(BASEPATH);
?>
<?php require("../layouts/header.php"); ?>
<?php require("../layouts/navbar.php") ?>

<?php
require("../../config/config.php");
define('APPROOT', $_SERVER['DOCUMENT_ROOT'] . '/coffee-blend/');
//var_dump(APPROOT); //string(15) "C:/xampp/htdocs/coffee-blend/" 
if (isset($_POST['submit']) && $_POST) {
    $productName = $_POST['product_name'];
    $productDesc = $_POST['product_desc'];
    $productCat = $_POST['product_cat'];
    $productPrice = $_POST['product_price'];
    // $target_dir = "" . APPURL . "images/";
    $image_name = basename($_FILES['product_img']['name']);
    // $target_file = $target_dir . $image_name;
    $target_file = APPROOT . "images/" . $image_name;
    // var_dump($target_file); //string(50) "http://localhost/coffee-blend/images/dessert-5.jpg"
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
            //echo "File uploaded successfully.";
            $add_product = $conn->prepare("INSERT INTO products(name,image,description,category,price) VALUES(:name,:image,:description,:category,:price)");
            if ($add_product->execute(
                [
                    'name' => $productName,
                    'image' => $image_name,
                    'description' => $productDesc,
                    'category' => $productCat,
                    'price' => $productPrice


                ]

            )) {
                $message = "Product created successfully";
            }
        } else {
            $message = "There was an error uploading your file.";
        }
    } else {
        $message = "File was not uploaded due to validation errors.";
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
            <h1> Add Products</h1>
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productname">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" required>

                    </div>
                    <div class="form-group">
                        <label for="productdescription">Product Description</label>
                        <textarea name="product_desc" id="" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productimage">Product Image</label>
                        <input type="file" name="product_img" class="form-control" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Product Category</label>
                        <input type="text" name="product_cat" class="form-control" required>
                    </div>
                    <div>
                        <label for="productprice">Product Price</label>
                        <input type="number" name="product_price" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Add Product</button>
                </form>
            </div>
            <?php if (isset($message)): ?>
                <div class="alert alert-primary" role="alert">
                    <?= $message ?>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>