<?php

session_start();
if(!isset($_SESSION['admin_username'])){
    header("Location: ../login.php"); 
}

include('../../config/db_connect.php');

if(isset($_GET['view'])){
    $order_id = mysqli_real_escape_string($conn, $_GET['view']);
    
    //get purchased courses corresponding order id
    $purchase_query = "SELECT * FROM purchased_courses WHERE order_id = '$order_id'";
    $purchase_res = mysqli_query($conn, $purchase_query);
    $purchased = mysqli_fetch_all($purchase_res, MYSQLI_ASSOC);
}else {
    header("Location: ./manage_orders.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <?php include('./links.inc.php'); ?>
</head>
<body class="body-pd">


    <div class="container-fluid shadow-sm">
        <ul class="m-0 p-3">
            <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
        </ul>
    </div>
    
    <div class="container manage-course" style="z-index: 0; padding: 0 10rem;">
        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="">Purchased Courses</h2>
            </div>
        </div>
        <div class="row p-0 d-flex flex-row">

            <?php if($purchase_res): ?>
                <?php  if(mysqli_num_rows($purchase_res) > 0): ?>
                    <?php foreach($purchased as $purchase): ?>
                        <?php 
                            $course_id = $purchase['course_id'];
                            $query = "SELECT * FROM courses WHERE course_id = '$course_id'";
                            $result = mysqli_query($conn, $query);
                            $course = mysqli_fetch_all($result, MYSQLI_ASSOC);    
                        ?>
                        <?php foreach($course as $row): ?>

                            <div class="row border border-2 px-2 mb-4" >
                                <div class="col-2 image-container pt-4 p-0 px-1" style="max-width: 8rem;">
                                <img src="<?php $row['thumbnail'] != null ? print '../course_resourses/thumbnail/'. $row['thumbnail'] : print '../../assets/img/unchecked.png' ?>" class="card-img-top img-fluid" alt="..." style="width: 640px; height: 4rem;">
                                </div>
                                <div class="col-6 p-0">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 p-0 lh-sm mb-1"><?php echo htmlspecialchars($row['title']); ?></h5>
                                        <p class="card-text m-0 p-0 fw-normal lh-md" style="font-size: .74rem !important;"><?php echo htmlspecialchars($row['description']); ?></p>
                                        <p class="card-text fw-semibold m-0 p-0" style="font-size: .8rem !important;"><?php echo htmlspecialchars($row['author']); ?></p>
                                        <!-- <p class="card-text m-0 p-0 text-muted" style="font-size: .8rem !important;"><small class="text-muted"><?php //echo $course_rating; ?>⭐<span>rating</span></small></p> -->
                                    </div>
                                </div>
                                
                                <div class="col-2 p-0">
                                    <p class="mt-4 fs-5"><i class="bi bi-currency-rupee text-info"></i><?php echo htmlspecialchars($row['price']); ?><i class="bi bi-tag-fill text-info ps-1"></i></p>
                                </div>
                                <div class="col-2">
                                    <a href="delete_purchased_course.php?purchase_del=<?php echo htmlspecialchars($row['course_id']); ?>" class="btn text-danger m-0 p-0 d-flex justify-content-end mt-4" style="font-size: .9rem;">Remove</a>
                                </div>
                            </div>
                        <?php endforeach;  ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no courses! <a href="" class="btn btn-dark rounded-0" role="button" style="background-color: #CF0A0A;">Create now</a></h2> -->
                <?php endif; ?>
            <?php //else: ?>
                <!-- <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no courses! <a href="" class="btn rounded-0" role="button" style="background-color: #DD5353;">Create now</a></h2> -->
            <?php endif; ?>




        </div>
    </div>
    
    <?php include('./footer.inc.php'); ?> 

</body>
</html>