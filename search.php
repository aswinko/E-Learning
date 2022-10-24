<?php 
// session_start();
// include_once('./inc/session.php');
session_start();

include('./config/db_connect.php');
include_once('./config/functions.php');


if(isset($_GET['search_submit'])){

    $search_data = $_GET['search_data'] or die("something wrong!");

    $search_course = search_course($search_data);
    
    //To count all Courses
    $row_count = mysqli_num_rows($search_course);
    
    //fetch the resulting rows as an array
    $courses = mysqli_fetch_all($search_course, MYSQLI_ASSOC);
}

// print_r($search_data);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Search your course</title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>
        

        <main class="container all_courses" style="background: #fff;">
            <?php if($courses): ?>
                <div class="row pt-4">
                    <!-- <div class="col-6"> 
                        <h4 class="fw-bold">All Courses</h4>
                    </div> -->
                    <div class="col-12 d-flex justify-content-end">
                        <p class="text-muted fw-bold fs-5 text-end"><?php echo htmlspecialchars($row_count); ?> results</p>
                    </div>

                </div>
                <?php foreach($courses as $course): ?>
                    <div class="row pt-2">
                        <div class="col-4 image-container" style="max-width: 18rem;">
                            <img src="./admin/course_resourses/<?php echo htmlspecialchars($course['thumbnail']); ?>" class="img-fluid rounded-start" alt="..." style="width: 640px; height: 9rem;">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <a class="text-dark" href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&course_title=<?php echo htmlspecialchars($course['title']); ?>">
                                    <h5 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($course['description']); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($course['author']); ?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo htmlspecialchars($course['rating']); ?> ⭐ <span>rating</span></small></p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h5 class="p-4 mt-4 px-0 fw-bold fs-4">Sorry, we couldn't find any results for "<span class="fw-bold"><?php echo htmlspecialchars($search_data); ?></span>"</h5>
                <h4 class="p-4 px-0 pt-0 fs-5 fw-bold">Try adjusting your search. Here are some ideas:</h4>
                <ul style="list-style-type:disc !important" class="p-4 mx-4 pt-0 fw-normal">
                    <li>Make sure all words are spelled correctly</li>
                    <li>Try different search terms</li>
                    <li>Try more general search terms</li>
                </ul>
            <?php endif; ?>
        </main>


        <?php include('./inc/footer.inc.php'); ?>
    </body>
</html>