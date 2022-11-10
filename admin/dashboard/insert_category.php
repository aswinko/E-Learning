<?php

include("../../config/db_connect.php");
include("../../config/functions.php");

if(isset($_POST['submit'])){
    $category_name = $_POST['category_name'];
    $category_icon = $_POST['category_icon'];
    insert_category($category_name, $category_icon);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
     <?php include('./links.inc.php'); ?>
</head>
<body>
    <?php //include('./sidebar.php'); ?>
    <div class="container-fluid shadow-sm">
        <ul class="m-0 p-3">
            <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
        </ul>
    </div>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row border shadow-sm p-5">
            <h2>Insert Category</h2>
            <form action="" method="post" class="">
                <div class="my-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" placeholder="Category name" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Category Icon (only from Bootstrap Icons) || eg: bi bi-code-square</label>
                    <input type="text" name="category_icon" class="form-control" placeholder="Category icon" required>
                </div>
                
                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
   
    <?php include('./footer.inc.php'); ?>
</body>
</html>