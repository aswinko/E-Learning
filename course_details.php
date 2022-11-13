<?php
    include("./config/db_connect.php");
    include_once('./config/functions.php');

    session_start();


    if (isset($_GET['course_id'])){
        
        //get user id from user table
        $user = $_SESSION['user'];
        $get_user = "SELECT * FROM `user` WHERE username = '$user'";
        $result_get_user = mysqli_query($conn ,$get_user);
        $run_query = mysqli_fetch_array($result_get_user);
        $user_id = $run_query['id'];
        
        $id = mysqli_real_escape_string($conn, $_GET['course_id']);

        //fetch result in array format
        $course_details = show_course_details($id);
        $course = mysqli_fetch_assoc($course_details);
        $course_id = $course['course_id'];
        $instructor_email = $course['instructor_email'];
        
        //close connection
        // mysqli_close($conn);

        //check purchased courses or not
        $check_purchase_course_query = "SELECT * FROM purchased_courses WHERE user_id = '$user_id'";
        $purchase_res = mysqli_query($conn, $check_purchase_course_query);
        $purchase_course = mysqli_fetch_all($purchase_res, MYSQLI_ASSOC);
        // $purchased_course_id = $purchased_courses['course_id'];
        $check_course = mysqli_num_rows($purchase_res);
        $confirm_purchased_course = 0;
        foreach($purchase_course as $purchased_course){
            $purchased_course_id = $purchased_course['course_id'];
            if($purchased_course_id == $id){
                $confirm_purchased_course = $id;
            }
        }

        $check_course_in_cart_query = "SELECT * FROM cart_details WHERE user_name = '$user'";
        $cart_res = mysqli_query($conn, $check_course_in_cart_query);
        $cart_row = mysqli_fetch_all($cart_res, MYSQLI_ASSOC);
        $cart_course = 0;
        foreach($cart_row as $in_cart){
            $cart_course_id = $in_cart['course_id'];
            if($cart_course_id == $id){
                $cart_course = $id;
            }
        }

    //    while ($purchased_courses = mysqli_fetch_array($purchase_res)){
    //         $purchased_course_id = $purchased_courses['course_id'];
    //         // echo $purchased_course_id;
    //    }

        //call instructor details function 
        $instructor_information = instructor_details($instructor_email);
        $instruct_details = mysqli_fetch_assoc($instructor_information);

        // echo $instruct_details['name'];

    }

    //call cart function
    cart($course_id);




?>

<?php  if(isset($_SESSION['user']) && $_SESSION['user'] == true ): ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Course details</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <?php include('./inc/links.inc.php'); ?>
        </head>

        <body>
            <?php include('./inc/header.inc.php'); ?>

            <main class="course_details">
                <?php if($course): ?>
                    <div class="container-fluid bg-dark">
                        <div class="container text-light">
                            <div class="row ps-sm-4">
                                <div class="col-12 p-4">
                                    <h2 class="title fw-bold d-flex justify-content-left mb-sm-4"><?php echo htmlspecialchars($course['title']); ?></h2>
                                    <p class="description fw-normal mb-2 d-flex flex-wrap"><?php echo htmlspecialchars($course['description']); ?></p>
                                    <p class="author fw-light mb-2"><?php echo htmlspecialchars($course['author']); ?></p>
                                    <p class="rating fw-light mb-1 fs-5">₹ <?php echo htmlspecialchars($course['price']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-md container-fluid mt-md-5 mt-4 p-md-4">
                        <div class="row d-flex flex-wrap">
                            <div class="col-md-8 p-1 p-md-2">
                                <div class="thumbnail" style="max-width: 42rem;">

                                    <?php if($confirm_purchased_course == $id): ?>
                                        <div class="video-container d-flex align-items-center justify-content-center">
                                            <video id="vid" class="vid" poster="./admin/course_resourses/thumbnail/<?php echo htmlspecialchars($course['thumbnail']); ?>" controls controlsList="nodownload">
                                                <source id="lec-1" src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture1']); ?>">
                                            </video>
                                        </div>
                                    <?php else: ?>
                                            <img class="w-100" src="./admin/course_resourses/thumbnail/<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="..." style="height: 26.4rem; ">
                                    <?php endif; ?>

                                    <div class="row mt-3 d-flex flex-row">
                                        <div class="col-6">
                                            <?php if($confirm_purchased_course != $id): ?>
                                                <p class="rating text-start fw-bold mb-1 fs-2">₹ <?php echo htmlspecialchars($course['price']); ?></p> 
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end ">
                                            <!-- check courses in cart or not. if courses in cart then display go to cart btn otherwise add to cart btn -->
                                            <?php if($cart_course == $id): ?>
                                                <a href="./cart.php" class="cart_btn btn btn-dark fs-6 ">Go to cart</a>
                                            <?php else: ?>
                                                <!-- if courses not purchase then display add to cart button -->
                                                <?php if($confirm_purchased_course != $id): ?>
                                                    <a name="add_to_cart" href="?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&add_to_cart=<?php echo htmlspecialchars($course['course_id']); ?>" 
                                                        class="cart_btn btn btn-primary fs-6">Add to cart</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <!-- <a role="button" href="#" class="btn btn-primary fs-6 mx-4 py-2 px-4" style="background: #071E3D;">Buy now</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 video-contents">
                                <?php if($confirm_purchased_course == $id): ?>
                                    <div class="row border shadow mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;" >
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn-lec1" class="px-5 btn  w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture1']); ?>">Lecture 1</button>
                                        </div>
                                    </div>
                                    <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn_lec2" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture2']); ?>">Lecture 2</button>
                                        </div>
                                    </div>
                                    <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn_lec3" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture3']); ?>">Lecture 3</button>
                                        </div>
                                    </div>
                                    <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn_lec4" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture4']); ?>">Lecture 4</button>
                                        </div>
                                    </div>
                                    <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn_lec5" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture5']); ?>">Lecture 5</button>
                                        </div>
                                    </div>
                                    <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button id="btn_lec6" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/lectures/<?php echo htmlspecialchars($course['lecture6']); ?>">Lecture 6</button>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- <p>Advertise Here</p> -->
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Instructor section -->
                    <hr class="mb-4">
                    <div class="container">
                        <div class="row mb-3">
                            <h2 class="fw-bold fs-3">About this course</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="fw-normal fs-4"><?php echo htmlspecialchars($course['title']); ?></p>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <div class="container pb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <p>Description</p>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-normal"><?php echo htmlspecialchars($course['description']); ?></p>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <p>Instructor</p>
                            </div>
                            <div class="col-md-4 d-flex flex-row">
                                <img class="instructor-prof-course rounded-circle" src="<?php $instruct_details['profile_img'] != null ? print './admin/course_resourses/profile_img/instructor/' . $instruct_details['profile_img'] : print './assets/img/user.png' ?>" alt="..." style="width: 75px; height: 75px; object-fit: cover;">
                                <a href="./instructor/instructor_details.php?instructor_id=<?php echo htmlspecialchars($instruct_details['id']); ?>" class=" text-muted">
                                    <p class="fw-bold fs-5 ms-4 mt-3"><?php echo htmlspecialchars($instruct_details['name']); ?></p>
                                    <!-- <p class="fw-bold fs-5 ms-4 mt-2">Hanna Mariya Biju</p> -->
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                <?php else: ?>
                    <h2>Not found!</h2>
                <?php endif; ?>
                
            </main>

            <?php include("./inc/footer.inc.php") ?>
        
            <script type="text/javascript">
                $('button').click(function(e){
                    const videoSource = $(this).attr('data-src')
                    $('video source').attr('src', videoSource)
                    $('video')[0].load()
                });
            </script>
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

<?php else: ?>
    <?php header("Location: login.php"); ?>
<?php endif; ?>