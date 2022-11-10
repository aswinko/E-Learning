<?php
    session_start();
    include('../../config/functions.php');
    include('../../config/db_connect.php');

    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }

    $show_category = show_category();

    $category = mysqli_fetch_all($show_category, MYSQLI_ASSOC);

    mysqli_close($conn);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructor</title>
    <?php include('./links.inc.php'); ?>
</head>
<body>
    <?php //include('./sidebar.php'); ?>

    <div class="container-fluid shadow-sm">
        <ul class="m-0 p-3">
            <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
        </ul>
    </div>

    <main class="container my-5 admin-container">
        <h2 class="pb-4">Manage Category</h2>
        <?php if($category): ?>
           <?php foreach($category as $categories): ?> 
                <div class="row mb-2 py-2 border shadow-sm d-flex flex-row text-center align-items-center rounded-3">
                    <div class="col-1 col-md-3"><?php echo htmlspecialchars($categories['category_id']); ?></div>
                    <div class="col-3"><?php echo htmlspecialchars($categories['category_name']); ?></div>
                    <div class="col-2"><i class="text-dark fs-2 fw-bold <?php echo $categories['category_icon'] ?>"></i></div>
                    <div class="col-2">
                        <a class="btn" href="./edit_category.php?edit=<?php echo htmlspecialchars($categories['category_id']); ?>" role="button">
                            <i class="fa-regular fa-pen-to-square text-secondary fs-5 fw-bold"></i>
                        </a>    
                    </div>
                    <div class="col-2">
                        <a class="btn" href="./delete_category.php?deleted=<?php echo htmlspecialchars($categories['category_id']); ?>" role="button">
                            <i class="fa-regular fa-trash-can text-secondary fs-5 fw-bold"></i></div>
                        </a>    
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>No records found.</h2>
        <?php endif; ?>
    </main>


    <?php include('./footer.inc.php'); ?>
</body>
</html>