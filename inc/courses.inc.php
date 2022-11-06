<?php 
    include('./config/db_connect.php');
    include_once('./config/functions.php');


    //fetch the normal resulting rows as an array
    $show_course = show_course();
    $courses_normal = mysqli_fetch_all($show_course, MYSQLI_ASSOC);



    //fetch the random resulting rows as an array
    $show_random_course = show_random_course();
    $courses_random = mysqli_fetch_all($show_random_course, MYSQLI_ASSOC);   


    //close connection
    mysqli_close($conn);

    // print_r($courses);

?>

 <!-- ============course section starts================ -->
 <section class="course pt-4" id="course">
        <h2 class="py-4 ps-4 fw-bold">Courses to get you started</h2>
        <div class="container border">
            <h2 class="">A broad selection of courses</h2>
            <div class="row">
                <div class="col-12 mb-4">
                    <?php if($courses_normal): ?>
                        <div class="carousel" data-flickity='{ "groupCells": true  }'>
                            <!-- <div class="carousel" data-flickity='{ "groupCells": true, "wrapAround": true }'>  for infinite scroll -->
                            <?php foreach($courses_normal as $course): ?>
                                <div class="carousel-cell">
                                    <a href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&course_title=<?php echo htmlspecialchars($course['title']); ?>" class="text-dark">
                                        <img class="thumbnail" src="./admin/course_resourses/thumbnail/<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="....">
                                        <p class="title fw-bold pt-2" style="line-height: 1.1;"><?php echo htmlspecialchars($course['title']); ?></h4>
                                        <p class="author fw-normal pt-1"><?php echo htmlspecialchars($course['author']); ?></p>
                                        <!-- <p class="rating fw-light"><?php //echo htmlspecialchars($course['rating']); ?> ⭐ <span>rating</span></p> -->
                                        <p class="price fw-bold">₹<?php echo htmlspecialchars($course['price']); ?></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else: ?>
                        <h5>No courses available</h5>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <h2>Course your choice</h2>
                <div class="col-12">
                    <?php if($courses_random): ?>
                        <div class="carousel" data-flickity='{ "groupCells": true  }'>
                            <!-- <div class="carousel" data-flickity='{ "groupCells": true, "wrapAround": true }'>  for infinite scroll -->
                            <?php foreach($courses_random as $course): ?>
                                <div class="carousel-cell">
                                    <a href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&course_title=<?php echo htmlspecialchars($course['title']); ?>" class="text-dark">
                                        <img class="thumbnail" src="./admin/course_resourses/thumbnail/<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="....">
                                        <p class="title fw-bold pt-1" style="line-height: 1.1;"><?php echo htmlspecialchars($course['title']); ?></h4>
                                        <p class="author fw-normal"><?php echo htmlspecialchars($course['author']); ?></p>
                                        <!-- <p class="rating fw-light"><?php //echo htmlspecialchars($course['rating']); ?> ⭐ <span>rating</span></p> -->
                                        <p class="price fw-bold">₹<?php echo htmlspecialchars($course['price']); ?></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else: ?>
                        <h5>No courses available</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- ============course section ends================ -->