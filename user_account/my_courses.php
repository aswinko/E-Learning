<?php 
    session_start();
    include('../config/db_connect.php');
    include_once('../config/functions.php');

    if(!isset($_SESSION['user'])){
        header("Location: ../login.php"); 
    }


    //get user id from current user
    $user = $_SESSION['user'];
    // echo "<h1>hhhhhhhhhhhhhh " . $user . " hhhhhhhhhh</h1>";
    $user_query = "SELECT * FROM user WHERE username = '$user'";
    $user_res = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_res);
    $user_id = $user_row['id'];

    //get purchased courses
    $purchase_query = "SELECT * FROM purchased_courses WHERE user_id = '$user_id'";
    $purchase_res = mysqli_query($conn, $purchase_query);
    $purchased = mysqli_fetch_all($purchase_res, MYSQLI_ASSOC);


    // $query = "SELECT * FROM purchased_courses WHERE user_id = '$user_id'";
    // $result = mysqli_query($conn, $query);
    // $course = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My courses</title>

           <!-- Custom css file -->
   <link rel="stylesheet" href="../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    </head>
    <body>
        
    <?php include('./sidebar.php'); ?>

    <main class="container manage-course">
        
        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="">My Courses</h2>
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
                            <div class="col-sm-6 col-md-4 col-xl-3 mx-0 mb-4 p-0 ">
                                <a href="../course_details.php?course_id=<?php echo htmlspecialchars($row['course_id']); ?>&course_title=<?php echo htmlspecialchars($row['title']); ?>" class="text-dark">
                                    <div class="card pb-4">
                                        <img src="<?php $row['thumbnail'] != null ? print '../admin/course_resourses/thumbnail/'. $row['thumbnail'] : print '../../assets/img/unchecked.png' ?>" class="card-img-top" alt="..." style="">
                                        <div class="card-body p-2">
                                            <p class="card-text title fs- fw-bold pt-1 lh-sm w-100" style="font-size: .9rem;"><?php echo htmlspecialchars($row['title']); ?></p>
                                            <p class="card-text author fs-6 fw-normal pt-1 lh-sm" style="width: 90%"><?php echo htmlspecialchars($row['author']); ?></p>
                                            <!-- <p class="card-text rating fw-light pt-1" style="width: 90%"><?php //echo htmlspecialchars($row['rating']); ?> <span>rating</span></p> -->
                                            <p class="card-text price fw-bold pt-1" style="width: 90%">₹<?php echo htmlspecialchars($row['price']); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;  ?>
                    <?php endforeach;  ?>
                <?php else: ?>
                    <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no Purchased courses! <a href="../all_courses.php" class="btn btn-dark rounded-0" role="button" style="background-color: #CF0A0A;">Buy now</a></h2>
                <?php endif; ?>
            <?php else: ?>
                <h2 class="ms-md-5 ms-1 fs-2 fw-normal">You have no Purchased courses! <a href="../all_courses.php" class="btn rounded-0" role="button" style="background-color: #DD5353;">Buy now</a></h2>
            <?php endif; ?>
        </div>

    </main>


     <!-- Compiled and minified JavaScript -->
     <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

        <!-- ===========link bootstrap============= -->
        <script src="../assets/js/bootstrap.js" type="text/javascript"></script>

        <script src="../assets/style.js" type="text/javascript"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php 
            if(isset($_SESSION['order_status']) && $_SESSION['order_status'] != ''){
        ?>
            <script>
                swal({
                    title: "<?php echo htmlspecialchars($_SESSION['order_status']); ?>",
                    // text: "",
                    icon: "<?php echo htmlspecialchars($_SESSION['order_status_code']); ?>",
                    button: "Done",
            });
            </script>
        <?php
                unset($_SESSION['order_status']);
            }

        ?>
    </body>
</html>