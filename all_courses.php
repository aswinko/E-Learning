<?php 
// session_start();
include_once('./inc/session.php');

include('./config/db_connect.php');
include_once('./config/functions.php');

$show_all_courses = show_all_courses();

//To count all Courses
$row_count = mysqli_num_rows($show_all_courses);

//fetch the resulting rows as an array
$courses = mysqli_fetch_all($show_all_courses, MYSQLI_ASSOC);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>All Courses</title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>

        <main class="container all_courses" style="background: #fff;">
            <?php if($courses): ?>
                <div class="row pt-4">
                    <div class="col-6">
                        <h4 class="fw-bold">All Courses</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <p class="text-muted fw-bold fs-5"><?php echo htmlspecialchars($row_count); ?> results</p>
                    </div>

                </div>
                <?php foreach($courses as $course): ?>
                    <div class="row pt-2">
                        <div class="col-4 image-container" style="max-width: 18rem;">
                            <img src="./admin/course_resourses/<?php echo htmlspecialchars($course['thumbnail']); ?>" class="img-fluid rounded-start" alt="..." style="width: 640px; height: 9rem;">
                        </div>
                        <div class="col-8">
                            <div class="card-body p-2 m-0">
                                <a class="text-dark m-0" href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&course_title=<?php echo htmlspecialchars($course['title']); ?>">
                                    <h5 class="card-title m-0 p-0"><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p class="card-text m-0 p-0"><?php echo htmlspecialchars($course['description']); ?></p>
                                    <p class="card-text m-0 p-0"><?php echo htmlspecialchars($course['author']); ?></p>
                                    <!-- <p class="card-text p-0 m-0"><small class="text-muted"><?php //echo htmlspecialchars($course['rating']); ?> ⭐ <span>rating</span></small></p> -->
                                    <p class="card-text price fw-bold m-0 p-0">₹<?php echo htmlspecialchars($course['price']); ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h5>No courses available</h5>
            <?php endif; ?>
        </main>


        <?php include('./inc/footer.inc.php'); ?>
    </body>

</html>