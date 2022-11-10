<?php 
    session_start();
    // include('../../config/functions.php');
    // include('../../config/db_connect.php');

    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <?php include('./links.inc.php'); ?>
</head>
<body>
    <?php include('./sidebar.php'); ?>

    <main class="container mt-5 admin-container">
        <h2 class="pb-4">Manage Category</h2>

        <div class="container mt-1 pt-1">
            <div class="row bg-light p-5 text-center">
                
                <div class="col-12 col-lg-5 border p-1 mb-4 mb-lg-0 me-5 me-xl-5 shadow">
                    <h5 class="fs-4 fs-light p-4">Insert Category</h5>
                    <a class="btn btn-dark py-2 mb-4 rounded-0" href="./insert_category.php" role="button">Insert category</a>
                </div>

                <div class="col-12 col-lg-5 border p-1 shadow ms-0 ms-xl-5">
                    <h5 class="fs-4 fs-light p-4">Update Category</h5>
                    <a class="btn btn-dark py-2 mb-4 rounded-0" href="./update_category.php" role="button">Update category</a>
                </div>

            </div>
        </div>

    </main>


    <?php include('./footer.inc.php'); ?>
</body>
</html>