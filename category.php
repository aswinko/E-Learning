<?php
    session_start();
    include('./config/db_connect.php');
    include_once('./config/functions.php');

    if(isset($_GET['category_id'])) {
        $category_id = $_GET['category_id']; 
        $select_category_query = "SELECT category_id, category_name FROM category where category_id = '$category_id'";
        $result_category = mysqli_query($conn, $select_category_query); 
        $category_name = mysqli_fetch_assoc($result_category);   
        
        $show_all_courses = show_courses_category($category_id);
    
        //To count all Courses
        $row_count = mysqli_num_rows($show_all_courses);

        $courses = mysqli_fetch_all($show_all_courses, MYSQLI_ASSOC);
        mysqli_close($conn);
    }
    
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Category </title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>
        

        <main class="container all_courses" style="background: #fff;">
            <?php if($courses): ?>
                <div class="row pt-4">
                    <div class="col-6">
                        <h4 class="fw-bold"><?php echo htmlspecialchars($category_name['category_name']); ?></h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <p class="text-muted fw-bold fs-5"><?php echo htmlspecialchars($row_count); ?> results</p>
                    </div>

                </div>
                <?php foreach($courses as $course): ?>
                    <div class="row pt-2">
                        <div class="col-4 image-container" style="max-width: 18rem;">
                            <img src="./admin/course_resourses/thumbnail/<?php echo htmlspecialchars($course['thumbnail']); ?>" class="img-fluid rounded-start" alt="..." style="width: 640px; height: 9rem;">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <a class="text-dark" href="course_details.php?course_id=<?php echo htmlspecialchars($course['course_id']); ?>&course_title=<?php echo htmlspecialchars($course['title']); ?>">
                                    <h5 class="card-title my-0"><?php echo htmlspecialchars($course['title']); ?></h5>
                                    <p class="card-text my-0" style="margin: 2px 0px !important;"><?php echo htmlspecialchars($course['description']); ?></p>
                                    <p class="card-text my-0 text-muted" style="margin: 0 !important;"><?php echo htmlspecialchars(ucwords($course['author'])); ?></p>
                                    <p class="card-text fs-5 my-0" >₹ <?php echo htmlspecialchars($course['price']); ?></p>
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