<?php
    session_start();

    if(!isset($_SESSION['instructor_email'])){
        header("Location: ../login.php"); 
    }

    include("../../config/db_connect.php");
    include_once("../../config/functions.php");
    
    $show_category = show_category();
    $category = mysqli_fetch_all($show_category, MYSQLI_ASSOC);

    $instructor_email = $_SESSION['instructor_email']; 
    if(isset($_GET['edit'])) {
        $edit_id = mysqli_real_escape_string($conn, $_GET['edit']);
        $edit_sql = "SELECT * FROM courses WHERE course_id = '$edit_id' && instructor_email = '$instructor_email'";
        $edit_result = mysqli_query($conn, $edit_sql);
        $placeholder_row = mysqli_fetch_assoc($edit_result);

        $category_id = $placeholder_row['category_id'];

        //fetching category name
        $select_category = "SELECT * FROM category WHERE category_id = '$category_id'";
        $category_result = mysqli_query($conn, $select_category);
        $category_row = mysqli_fetch_assoc($category_result);
        $category_name_placeholder = $category_row['category_name'];
        $category_id_placeholder = $category_row['category_id'];
    }else {
        header("Location: ./manage_course.php");
    }
    // echo $placeholder_row['thumbnail'];
    
    
if(isset($_POST['submit'])){
    $course_title = $_POST['course_title'];
    // $author_name = $_SESSION['instructor_email'];
    // $course_rating = $_POST['course_rating'];
    $course_price = $_POST['course_price'];
    $course_keywords = $_POST['course_keywords'];
    $course_category = $_POST['course_category'];
    $course_description = $_POST['course_description'];
    $course_status = 'pending';
    
    //access image
    $thumbnail = $_FILES['thumbnail']['name']; 
    //get old thumbnail
    $old_thumbnail = $_POST['old_thumbnail'];
    //access image temp name
    $temp_thumbnail = $_FILES['thumbnail']['tmp_name']; 


     //access lecture 1
     $lecture1 = $_FILES['lecture1']['name']; 
     //access old lecture 1
     $old_lecture1 = $_POST['old_lecture1']; 
     //access lecture 1 temp name
     $temp_lecture1 = $_FILES['lecture1']['tmp_name']; 
     //access lecture 1  size
     $lecture1_size = $_FILES['lecture1']['size']; 



     //access lecture 2
     $lecture2 = $_FILES['lecture2']['name']; 
     //access old lecture 2
     $old_lecture2 = $_POST['old_lecture2']; 
     //access lecture2 temp name
     $temp_lecture2 = $_FILES['lecture2']['tmp_name']; 
     //access lecture 2 size
     $lecture2_size = $_FILES['lecture2']['size']; 


     //access lecture 3
     $lecture3 = $_FILES['lecture3']['name']; 
     //access old lecture 3
     $old_lecture3 = $_POST['old_lecture3']; 
     //access lecture 3 temp name
     $temp_lecture3 = $_FILES['lecture3']['tmp_name']; 
     //access lecture 3 size
     $lecture3_size = $_FILES['lecture3']['size']; 

     //access lecture 4
     $lecture4 = $_FILES['lecture4']['name']; 
     //access old lecture 4
     $old_lecture4 = $_POST['old_lecture4']; 
     //access lecture 4 temp name
     $temp_lecture4 = $_FILES['lecture4']['tmp_name'];
     //access lecture 4 size
     $lecture4_size = $_FILES['lecture4']['size'];

     //access lecture 5
     $lecture5 = $_FILES['lecture5']['name']; 
     //access old lecture 5
     $old_lecture5 = $_POST['old_lecture5']; 
     //access lecture1 temp name
     $temp_lecture5 = $_FILES['lecture5']['tmp_name']; 
     //access lecture 5 size
     $lecture5_size = $_FILES['lecture5']['size']; 

     //access lecture 6
     $lecture6 = $_FILES['lecture6']['name']; 
     //access old lecture 6
     $old_lecture6 = $_POST['old_lecture6']; 
     //access lecture 6 temp name
     $temp_lecture6 = $_FILES['lecture6']['tmp_name'];
     //access lecture 6 size
     $lecture6_size = $_FILES['lecture6']['size']; 

    //  $vid1 = $_FILES['lecture1'];


    //fetch instructor name
    // $instructor_email = $_SESSION['instructor_email'];
    // $instruct_name_sql = "SELECT * FROM instructor WHERE email = '$instructor_email'";
    // $result_instruct_name = mysqli_query($conn, $instruct_name_sql);
    // $instruct_row = mysqli_fetch_assoc($result_instruct_name);
    // $author_name = $instruct_row['name'];
    //


    //the field is null then consider old image  
    if ($thumbnail != ''){
        $update_thumbnail = $_FILES['thumbnail']['name'];
    }else {
        $update_thumbnail = $old_thumbnail;
    }

    if($lecture1 != ''){
        $update_lecture1 = $lecture1; 
    }else {
        $update_lecture1 = $old_lecture1;
    }
    if($lecture2 != ''){
        $update_lecture2 = $lecture2; 
    }else {
        $update_lecture2 = $old_lecture2;
    }
    if($lecture3 != ''){
        $update_lecture3 = $lecture3; 
    }else {
        $update_lecture3 = $old_lecture3;
    }
    if($lecture4 != ''){
        $update_lecture4 = $lecture4; 
    }else {
        $update_lecture4 = $old_lecture4;
    }
    if($lecture5 != ''){
        $update_lecture5 = $lecture5; 
    }else {
        $update_lecture5 = $old_lecture5;
    }
    if($lecture6 != ''){
        $update_lecture6 = $lecture6; 
    }else {
        $update_lecture6 = $old_lecture6;
    }
    

     if ($course_title == '' or $course_category == '' or $course_description == '' or $course_keywords == '' 
        or $course_price == '' or ($old_thumbnail or $thumbnail) == ''){
        // $course_title == '' or $course_category == '' or $course_description == '' or $course_keywords == '' 
        // or $course_price == '' or $thumbnail == '' or $lecture1 == '' or $lecture2 == '' or $lecture3 == '' 
        // or $lecture4 == '' or $lecture5 == '' or $lecture6 == ''
        
         echo "<script>alert('Please insert all columns.')</script>";
         // exit();
         
    }else {
        // if($type !='mp4' && $type !='MP4' && $type !='flv')
        // {
        // $message ="Video Format Not Supported";
        //  }
        // else
        //  {}
            //  print_r($vid1);
            update_courses($temp_thumbnail, $course_title, $old_thumbnail, $update_thumbnail,
            $course_price, $course_description, $course_keywords, $course_category, $course_status, 
            $lecture1, $lecture2, $lecture3, $lecture4, $lecture5, $lecture6, 
            $update_lecture1, $update_lecture2, $update_lecture3, $update_lecture4, $update_lecture5, $update_lecture6,
            $old_lecture1, $old_lecture2, $old_lecture3, $old_lecture4, $old_lecture5, $old_lecture6,
            $temp_lecture1, $temp_lecture2, $temp_lecture3, $temp_lecture4, $temp_lecture5, $temp_lecture6, $edit_id);
           
            header("Location: ./manage_course.php");
         
    }


    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
          
          <!-- Custom css file -->
   <link rel="stylesheet" href="../../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="container-fluid shadow-sm">
        <ul class="m-0 p-3">
            <li class="text-end"><a href="javascript:history.go(-1)"><i class="fa-solid fa-xmark text-dark fs-2 fw-bold"></i></a></li>
        </ul>
    </div>
    <div class="container d-flex justify-content-center mt-5">
        <!-- <div class="row">
            <div class="col-12">
                <h2>Edit your Course</h2>
            </div>
        </div> -->
        <div class="row shadow">
            <div class="col-12 ps-5 p-2" styl="background: #F6F6F6;">
                <h2>Edit your Course</h2>
                <form class="w-auto" action="" method="post" enctype="multipart/form-data">
                    <div class="my-3 w-75 fw-bold ps-4">
                        <label for="exampleFormControlInput1" class="form-label">Course Title</label>
                        <input name="course_title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="course title" value="<?php echo htmlspecialchars($placeholder_row['title']); ?>">
                    </div>
                    <div class="row w-75 fw-bold ps-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput4" class="form-label">Course Price(Rupees)</label>
                                <input name="course_price" type="text" class="form-control" id="exampleFormControlInput4" placeholder="course price" value="<?php echo htmlspecialchars($placeholder_row['price']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 fw-bold">
                                <label for="category" class="form-label">Choose a Category</label>
                                <select name="course_category" id="category" class="course_category form-select">
                                    <?php if($category): ?>
                                        <option value="">Select a Category</option>
                                        <?php foreach($category as $categories): ?>
                                            <option value="<?php echo htmlspecialchars($categories['category_id']); ?>" <?=$category_id_placeholder == $categories['category_id'] ? 'selected' : '' ?> ><?php echo htmlspecialchars($categories['category_name']); ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">no categories</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 w-75 fw-bold ps-4">
                        <label for="exampleFormControlInput5" class="form-label">Course Keywords</label>
                        <input name="course_keywords" type="text" class="form-control" id="exampleFormControlInput5" placeholder="course keywords" value="<?php echo htmlspecialchars($placeholder_row['course_keywords']); ?>">
                    </div>
                    <div class="mb-3 w-75 fw-bold ps-4">
                        <label for="formFile" class="form-label">Upload your Course Thumbnail</label>
                        <div class="row">
                            <div class="col-10 d-flex align-items-center">
                                <input name="old_thumbnail" class="form-control" type="hidden" id="formFile" value="<?php echo htmlspecialchars($placeholder_row['thumbnail']); ?>">
                                <input name="thumbnail" class="form-control" type="file" id="formFile">
                                <span class="fs-6 fw-normal ps-1" value="<?php echo htmlspecialchars($placeholder_row['thumbnail']); ?>"><?php echo htmlspecialchars($placeholder_row['thumbnail']); ?></span>
                            </div>
                            <div class="col-2">
                                <img style="width: 100px !important; height: 60px;" class="w-25" src="../../admin/course_resourses/thumbnail/<?php echo htmlspecialchars($placeholder_row['thumbnail']); ?>" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="row w-75 ps-4">
                        <label class="form-label fw-bold">Upload 6 lectures <span class="fw-normal">(support only .mp4)</span> </label>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture1" class="form-label">Lecture 1</label>
                                <input name="lecture1" class="form-control" type="file" id="lecture1">
                                <input name="old_lecture1" class="form-control" type="hidden" id="lecture1" value="<?php echo htmlspecialchars($placeholder_row['lecture1']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture1']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture2" class="form-label">Lecture 2</label>
                                <input name="lecture2" class="form-control" type="file" id="lecture2">
                                <input name="old_lecture2" class="form-control" type="hidden" id="lecture2" value="<?php echo htmlspecialchars($placeholder_row['lecture2']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture2']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row w-75 ps-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture3" class="form-label">Lecture 3</label>
                                <input name="lecture3" class="form-control" type="file" id="lecture3">
                                <input name="old_lecture3" class="form-control" type="hidden" id="lecture3" value="<?php echo htmlspecialchars($placeholder_row['lecture3']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture3']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture4" class="form-label">Lecture 4</label>
                                <input name="lecture4" class="form-control" type="file" id="lecture4">
                                <input name="old_lecture4" class="form-control" type="hidden" id="lecture4" value="<?php echo htmlspecialchars($placeholder_row['lecture4']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture4']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row w-75 ps-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture5" class="form-label">Lecture 5</label>
                                <input name="lecture5" class="form-control" type="file" id="lecture5">
                                <input name="old_lecture5" class="form-control" type="hidden" id="lecture5" value="<?php echo htmlspecialchars($placeholder_row['lecture5']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture5']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lecture6" class="form-label">Lecture 6</label>
                                <input name="lecture6" class="form-control" type="file" id="lecture6">
                                <input name="old_lecture6" class="form-control" type="hidden" id="lecture6" value="<?php echo htmlspecialchars($placeholder_row['lecture6']); ?>" >
                                <p><?php echo htmlspecialchars($placeholder_row['lecture6']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 w-75 fw-bold ps-4">
                        <label for="exampleFormControlTextarea1" class="form-label">Course Description</label>
                        <textarea name="course_description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo htmlspecialchars($placeholder_row['title']); ?></textarea>
                    </div>
                    <div class="mb-3 ps-4">
                        <button type="submit" name="submit" class="btn btn-dark px-5 py-2 fw-bold">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>

<!-- ==================== sweet alert =============================  -->
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