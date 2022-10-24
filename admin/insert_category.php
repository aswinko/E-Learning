<?php

include("../config/db_connect.php");
include("../config/functions.php");

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
     <!-- ==================Link bootstrap ================== -->
     <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2>Insert Category</h2>
        <div class="row">
            <form action="" method="post">
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
    <!-- ==================== sweet alert =============================  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
?>
    <script>
        swal({
            title: "<?php echo htmlspecialchars($_SESSION['status']); ?>",
            // text: "",
            icon: "<?php echo htmlspecialchars($_SESSION['status_code']); ?>",
            button: "Done",
    });
    </script>
<?php
        unset($_SESSION['status']);
    }

?>
</body>
</html>