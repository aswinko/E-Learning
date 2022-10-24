<?php 
// include('session.php');
    session_start();

    // echo $_SESSION['user'];
    
 ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>E Learning</title>
        <?php include('./inc/links.inc.php') ?>
    </head>

    <body>
        
        <?php include('./inc/header.inc.php'); ?>
        
        <section class="home bg-primary text-light h-100 pb-4" style="height: 600px;">
        <div class="container">

            <div class="row align-items-center pt-4 mt-4">

                <div class="col-lg-6 col-md-12">
                    <h2>Grow Your Skill with us.</h2>
                    <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad eos
                    cupiditate adipisci, ipsam architecto facilis porro a possimus alias
                    delectus.
                    </p>
                    <a href="login.php" class="btn btn-danger">Get started</a>
                </div>
                <div class="col-lg-6 col-md-12 py-4 mt-4 mb-4 ">
                    
                    <img src="assets/icons/stud1.svg" class="w-auto h-100 align-items-center justify-content-center "/>
                </div>
            </div>
        </section>
        
        <!-- =========== course section starts=========== -->
        <?php include('./inc/courses.inc.php'); ?>
        <!-- =========== course section ends=========== -->

        <!-- =========== category section starts=========== -->
        <?php include('./inc/categories.inc.php'); ?>
        <!-- =========== category section ends=========== -->
        
        <!-- ===============Instructor section starts=========== -->
        <?php include('./inc/instructor.inc.php'); ?>
        <!-- ===============Instructor section ends============= -->

        
        
        <?php include('./inc/footer.inc.php'); ?>
    </body>
    
</html>