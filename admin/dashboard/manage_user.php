<?php 
    session_start();
    include('../../config/functions.php');
    include('../../config/db_connect.php');

    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }

    $show_users = show_user();

    $users = mysqli_fetch_all($show_users, MYSQLI_ASSOC);

    mysqli_close($conn);

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
        <h2 class="pb-4">Manage User</h2>
        <?php if($users): ?>
           <?php foreach($users as $user): ?> 
                <div class="row mb-2 py-2 border shadow-sm d-flex flex-row text-center align-items-center rounded-3">
                    <div class="col-2"><?php echo htmlspecialchars($user['id']); ?></div>
                    <div class="col-2 p-2">
                        <img src="<?php $user['profile_img'] != null ? print '../course_resourses/'. $user['profile_img'] : print '../../assets/img/user2.png' ?>" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-2"><?php echo htmlspecialchars($user['fullname']); ?></div>
                    <div class="col-3 px-0"><?php echo htmlspecialchars($user['email']); ?></div>
                    <div class="col-3">
                    <a class="btn" href="./delete_user.php?deleted=<?php echo htmlspecialchars($user['id']); ?>" role="button">
                            <i class="fa-regular fa-trash-can text-dark fs-5 fw-bold"></i></div>
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