<?php

session_start();
if(!isset($_SESSION['admin_username'])){
    header("Location: ../login.php"); 
}

include('../../config/db_connect.php');


// $instructor_email = $_SESSION['instructor_email'];
$query = "SELECT * FROM courses ORDER BY course_id";
$result = mysqli_query($conn, $query);
$course = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
        
          <!-- Custom css file -->
   <link rel="stylesheet" href="../../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="body-pd">


    <!-- =====================sidebar===================== -->
    <?php include('./sidebar.php'); ?>
    <!-- ====================sidebar ends================= -->



    
    <div class="container" style="z-index: 0;">
        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="">Manage Your Courses</h2>
            </div>
        </div>
        <div class="row">

            <?php if($result): ?>
                <?php  if(mysqli_num_rows($result) > 0): ?>
                    <?php foreach($course as $row): ?>

                        <div class="col-md-6 col-xl-3 mb-4">
                            
                            <a href="../course_details.php?course_id=<?php echo htmlspecialchars($row['course_id']); ?>&course_title=<?php echo htmlspecialchars($row['title']); ?>" class="text-dark">
                                <div class="card pb-4" style="width: 18rem; height: 15rem;">
                                    <img src="<?php $row['thumbnail'] != null ? print '../course_resourses/'. $row['thumbnail'] : print '../../assets/img/unchecked.png' ?>" class="card-img-top" alt="...">
                                    <div class="card-body p-2">
                                        <p class="card-text title fs- fw-bold pt-1 lh-sm w-100" style="font-size: .9rem;"><?php echo htmlspecialchars($row['title']); ?></p>
                                         <p class="card-text author fs-6 fw-normal pt-1 lh-sm" style="width: 90%"><?php echo htmlspecialchars($row['author']); ?></p>
                                        <!-- <p class="card-text rating fw-light pt-1" style="width: 90%"><?php //echo htmlspecialchars($row['rating']); ?> <span>rating</span></p>
                                        <p class="card-text price fw-bold pt-1" style="width: 90%">₹<?php //echo htmlspecialchars($row['price']); ?></p> -->
                                    </div>
                                    <div class="row d-flex align-items-end">
                                        <!-- edit courses -->
                                        <div class="col-6 text-start">
                                            <a class="btn" href="./edit_course.php?edit=<?php echo htmlspecialchars($row['course_id']); ?>" role="button"><i class="fa-regular fa-pen-to-square text-dark"></i></a>
                                        </div>
                                        <!-- Delete courses -->
                                        <div class="col-6 text-end">
                                            <a class="btn" href="delete_course?deleted=<?php echo htmlspecialchars($row['course_id']); ?>" role="button"><i class="fa-regular fa-trash-can text-dark"></i></i></i></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach;  ?>
                <?php else: ?>
                    <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no courses! <a href="./create_course.php" class="btn btn-dark rounded-0" role="button" style="background-color: #CF0A0A;">Create now</a></h2>
                <?php endif; ?>
            <?php else: ?>
                <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no courses! <a href="./create_course.php" class="btn rounded-0" role="button" style="background-color: #DD5353;">Create now</a></h2>
            <?php endif; ?>




        </div>
    </div>
    

</body>
</html>