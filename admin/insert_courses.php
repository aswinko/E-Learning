<?php
    include("../config/db_connect.php");
    include_once("../config/functions.php");
    
    $show_category = show_category();
    $category = mysqli_fetch_all($show_category, MYSQLI_ASSOC);
    
    
if(isset($_POST['submit'])){
    $course_title = $_POST['course_title'];
    $author_name = $_POST['author_name'];
    $course_rating = $_POST['course_rating'];
    $course_price = $_POST['course_price'];
    $course_keywords = $_POST['course_keywords'];
    $course_category = $_POST['course_category'];
    $course_description = $_POST['course_description'];
    $course_status = 'true';
    
    //access image
    $thumbnail = $_FILES['thumbnail']['name']; 

    //access image temp name
    $temp_thumbnail = $_FILES['thumbnail']['tmp_name']; 

    if ($course_title == '' or $course_category == '' or $course_description == '' or $course_keywords == '' 
        or $course_price == '' or $course_rating == '' or $author_name == '' or $thumbnail == ''){

            echo "<script>alert('Please insert all columns.')</script>";
            // exit();

    }else { 
        insert_courses($temp_thumbnail, $thumbnail, $course_title, $author_name, 
        $course_rating, $course_price, $course_description, $course_keywords, $course_category, 
        $course_status);
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
     <!-- ==================Link bootstrap ================== -->
     <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2>Course Section</h2>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <form class="w-50" action="" method="post" enctype="multipart/form-data">
                    <div class="my-3">
                        <label for="exampleFormControlInput1" class="form-label">Course Title</label>
                        <input name="course_title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="course title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Author Name</label>
                        <input name="author_name" type="text" class="form-control" id="exampleFormControlInput2" placeholder="author name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Course Rating</label>
                        <input name="course_rating" type="text" class="form-control" id="exampleFormControlInput3" placeholder="course rating">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput4" class="form-label">Course Price</label>
                        <input name="course_price" type="text" class="form-control" id="exampleFormControlInput4" placeholder="course price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput5" class="form-label">Course Keywords</label>
                        <input name="course_keywords" type="text" class="form-control" id="exampleFormControlInput5" placeholder="course keywords">
                    </div>
                    <div class="mb-3">
                        <select name="course_category" id="" class="course_category form-select">
                            <option value="">Select a Category</option>
                            <?php if($category): ?>
                                <?php foreach($category as $categories): ?>
                                    <option value="<?php echo htmlspecialchars($categories['category_id']); ?>"><?php echo htmlspecialchars($categories['category_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload your Course Thumbnail</label>
                        <input name="thumbnail" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Course Description</label>
                        <textarea name="course_description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>