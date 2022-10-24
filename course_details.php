<?php
    include("./config/db_connect.php");
    include_once('./config/functions.php');

    session_start();


    if (isset($_GET['course_id'])){

        $id = mysqli_real_escape_string($conn, $_GET['course_id']);

        //fetch result in array format
        $course_details = show_course_details($id);
        $course = mysqli_fetch_assoc($course_details);
        $course_id = $course['course_id'];
        $instructor_email = $course['instructor_email'];
        
        //close connection
        // mysqli_close($conn);

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
                                    <!-- <p class="rating fw-light mb-1">(<?php //echo htmlspecialchars($course['rating']); ?>) <sup>⭐</sup> <span>rating</span></p> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-md container-fluid mt-md-5 mt-4 p-md-4">
                        <div class="row d-flex flex-wrap">
                            <div class="col-md-8 p-1 p-md-2">
                                <div  class="thumbnail" style="max-width: 42rem;">
                                    <!-- <?php //if($course_status == 'completed'): ?>
                                        <video id="vid" class="vid" width="100%" controls>
                                            <source id="lec-1" src="./admin/course_resourses/<?php //echo htmlspecialchars($course['lecture1']); ?>">
                                        </video>
                                    <?php //else: ?>
                                            <img class="w-100" src="./admin/course_resourses/<?php //echo htmlspecialchars($course['thumbnail']); ?>" alt="..." style="height: 26.4rem; ">
                                    <?php //endif; ?> -->
                                    <video id="vid" class="vid" width="100%" controls>
                                        <source id="lec-1" src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture1']); ?>">
                                    </video>
                                    <!-- cart button -->
                                    <div class="mt-3 d-flex justify-content-md-end justify-content-between">
                                        <a name="add_to_cart" href="?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&add_to_cart=<?php echo htmlspecialchars($course['course_id']); ?>" 
                                            class="btn btn-primary fs-6 " style="background: #071E3D; padding: .8rem 5rem;">Add to cart</a>
                                        <!-- <a role="button" href="#" class="btn btn-primary fs-6 mx-4 py-2 px-4" style="background: #071E3D;">Buy now</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 video-contents">
                                <div class="row border shadow mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;" >
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn-lec1" class="px-5 btn  w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture1']); ?>">Lecture 1</button>
                                    </div>
                                </div>
                                <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_lec2" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture2']); ?>">Lecture 2</button>
                                    </div>
                                </div>
                                <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_lec3" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture3']); ?>">Lecture 3</button>
                                    </div>
                                </div>
                                <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_lec4" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture4']); ?>">Lecture 4</button>
                                    </div>
                                </div>
                                <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_lec5" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture5']); ?>">Lecture 5</button>
                                    </div>
                                </div>
                                <div class="row shadow border mb-4 d-flex justify-content-center" style="background: #071E3D; height: 60px; border-radius: 20px;">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_lec6" class="px-5 btn w-100 text-white" data-src="./admin/course_resourses/<?php echo htmlspecialchars($course['lecture6']); ?>">Lecture 6</button>
                                    </div>
                                </div>
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
                                <p class="fw-normal"><?php echo htmlspecialchars($course['title']); ?></p>
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
                                <img class="instructor-prof-course rounded-circle" src="./assets/img/ammu.jpg" alt="..." style="width: 75px; height: 75px;">
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