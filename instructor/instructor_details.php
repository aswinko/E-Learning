<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../login.php"); 
    }
    include('../config/db_connect.php');
    include('../config/functions.php');

    if (isset($_GET['instructor_id'])){
        $instruct_id = mysqli_real_escape_string($conn, $_GET['instructor_id']);

        $instruct_sql = "SELECT * FROM instructor WHERE id = '$instruct_id'";
        $result = mysqli_query($conn, $instruct_sql);
        $instructor_details = mysqli_fetch_assoc($result);
        $instructor_email = $instructor_details['email'];


        $course_query = "SELECT * FROM courses where instructor_email = '$instructor_email'";
        $course_result = mysqli_query($conn, $course_query);
        $course = mysqli_fetch_all($course_result, MYSQLI_ASSOC);
        // echo $instructor_details['name'];
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Instructor Details</title>
        <?php include('./links.inc.php'); ?>
    </head>

    <body>
        <?php //include('../inc/header.inc.php'); ?>
        <div class="container-fluid shadow-sm">
            <ul class="m-2 p-2">
                <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
            </ul>
        </div>


        <main class="container my-4" style="padding: 0 16rem;">
            <?php if($instructor_details): ?>
                <div class="row text-en">
                    <p class="fw-bold fs-3 text-muted">Instructor</p>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img class="rounded-circle" src="../assets/img/ammu.jpg" alt="" style="width: 200px; height: 200px;">
                        
                    </div>
                    <div class="col-md-6 mt-5">
                        <h2 class="fw-bold my-2"><?php echo htmlspecialchars($instructor_details['name']); ?></h2>
                        <h4 class="sub-heading fw-bold text-muted"><?php echo htmlspecialchars($instructor_details['bio']); ?></h4>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h4 class="">About me</h4>
                        <p class="" style="width: 90%;"><?php echo htmlspecialchars($instructor_details['about_me']); ?></p>
                    </div>
                </div>
                <div class="row mt-5">
                    <h4>My Courses</h4>
                </div>
                <div class="row mt-4">
                    <?php if($course_result): ?>
                        <?php  if(mysqli_num_rows($course_result) > 0): ?>
                            <?php foreach($course as $row): ?>
                                <div class="col-md-6 col-6">
                                    <a href="../course_details.php?course_id=<?php echo htmlspecialchars($row['course_id']); ?>&course_title=<?php echo htmlspecialchars($row['title']); ?>" class="text-dark">
                                        <div class=" pb-4" style="width: 18rem; height: 18rem;">
                                            <img src="../admin/course_resourses/<?php echo htmlspecialchars($row['thumbnail']); ?>" class="card-img-top" alt="..." style="height: 10rem;">
                                            <div class="card-body p-1">
                                                <p class="card-text title fs- fw-bold pt-1 lh-sm w-100" style="font-size: .9rem;"><?php echo htmlspecialchars($row['title']); ?></p>
                                                <p class="card-text author fs-6 fw-normal pt-1 lh-sm" style="width: 90%"><?php echo htmlspecialchars($row['author']); ?></p>
                                                <p class="card-text rating fw-light pt-1" style="width: 90%"><?php echo htmlspecialchars($row['rating']); ?> <span>rating</span></p>
                                                <p class="card-text price fw-bold pt-1" style="width: 90%">₹<?php echo htmlspecialchars($row['price']); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach;  ?>
                        <?php else: ?>
                            <h2>You have no courses!</h2>
                        <?php endif; ?>
                    <?php else: ?>
                        <h2>You have no courses!</h2>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h2>No records found</h2>
            <?php endif; ?>
        </main>

        <?php include('../inc/footer.inc.php'); ?>
        <script type='text/javascript'>
            $(document).ready(function(){
            $('.sidenav').sidenav();
        });
        </script>


        <!-- ===========link bootstrap============= -->
        <script src="../assets/js/bootstrap.js" type="text/javascript"></script>
    </body>
</html>