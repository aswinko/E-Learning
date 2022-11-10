<?php
    session_start();

    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }

    include("../../config/db_connect.php");
    include_once("../../config/functions.php");

    // $instructor_email = $_SESSION['instructor_email']; 
    if(isset($_GET['edit'])) {
        $edit_id = mysqli_real_escape_string($conn, $_GET['edit']);
        $edit_sql = "SELECT * FROM category WHERE category_id = '$edit_id'";
        $edit_result = mysqli_query($conn, $edit_sql);
        $placeholder_row = mysqli_fetch_assoc($edit_result);

        $category_id = $placeholder_row['category_id'];
        $category_name = $placeholder_row['category_name'];
        $category_icon = $placeholder_row['category_icon'];
    }else {
        header("Location: ./update_category.php");
    }
    // echo $placeholder_row['thumbnail'];
    
    
if(isset($_POST['submit'])){
   
    $category_name = $_POST['category_name'];
    $category_icon = $_POST['category_icon'];
    

     if ($category_name == '' or $category_icon == ''){
         echo "<script>alert('Please insert all columns.')</script>";
         
    }else {
            update_category($category_name, $category_icon, $category_id);
            header("Location: ./update_category.php");
    }


    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
          
          <!-- Custom css file -->
   <link rel="stylesheet" href="../../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
        <div class="container-fluid shadow-sm">
            <ul class="m-0 p-3">
                <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
            </ul>
        </div>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row shadow">
            <div class="col-12 p-5" styl="background: #F6F6F6;">
                <h2>Edit Category</h2>
                <form action="" method="post" class="">
                <div class="my-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="<?php echo htmlspecialchars($category_name); ?>" placeholder="Category name" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Category Icon (only from Bootstrap Icons) || eg: bi bi-code-square</label>
                    <input type="text" name="category_icon" class="form-control" value="<?php echo htmlspecialchars($category_icon); ?>" placeholder="Category icon" required>
                </div>
                
                <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-dark">SUBMIT</button>
                </div>
            </form>
            </div>
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