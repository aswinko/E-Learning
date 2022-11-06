<?php
    session_start();
    include('../../config/functions.php');
    include('../../config/db_connect.php');

    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }

    $show_instructor = show_instructor();

    $instructors = mysqli_fetch_all($show_instructor, MYSQLI_ASSOC);

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
    <?php include('./sidebar.php'); ?>

    <main class="container mt-5 admin-container">
        <h2 class="pb-4">Manage Instructor</h2>
        <?php if($instructors): ?>
           <?php foreach($instructors as $instructor): ?> 
                <div class="row mb-2 py-2 border shadow-sm d-flex flex-row text-center align-items-center rounded-3">
                    <div class="col-1 col-md-2"><?php echo htmlspecialchars($instructor['id']); ?></div>
                    <div class="col-2 p-2">
                        <img src="<?php $instructor['profile_img'] != null ? print '../course_resourses/profile_img/instructor/'. $instructor['profile_img'] : print '../../assets/img/user3.png' ?>" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-2"><?php echo htmlspecialchars($instructor['name']); ?></div>
                    <div class="col-3 px-0"><?php echo htmlspecialchars($instructor['email']); ?></div>
                    <div class="col-3">
                        <a class="btn" href="./delete_instructor.php?deleted=<?php echo htmlspecialchars($instructor['id']); ?>" role="button">
                            <i class="fa-regular fa-trash-can text-dark fs-5 fw-bold"></i></div>
                        </a>    
                    </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>No records found.</h2>
        <?php endif; ?>
    </main>


    <?php include('./footer.inc.php'); ?>
</body>
</html>