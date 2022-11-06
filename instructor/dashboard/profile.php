<?php
    session_start(); 

    include('../../config/db_connect.php');
    include('../../config/functions.php');

    if(!isset($_SESSION['instructor_email'])){
        header("Location: ../login.php"); 
    }


    $instructor_email = $_SESSION['instructor_email'];
    $instructor_query = "SELECT * FROM instructor WHERE email = '$instructor_email'";
    $result = mysqli_query($conn, $instructor_query);
    $row = mysqli_fetch_assoc($result);
    $instructor_id = $row['id'];
    $profile_img = $row['profile_img'];
    $name = $row['name'];
    $bio = $row['bio'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $about_me = $row['about_me'];


    //profile update
    if(isset($_POST['profile_btn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $about_me = $_POST['about_me'];

        $update_query = "UPDATE instructor SET name = '$name', email = '$email', bio = '$bio', phone = '$phone', address = '$address', about_me = '$about_me' WHERE id = $instructor_id";
        $update_res = mysqli_query($conn, $update_query);
        // $fetch_profile = mysqli_fetch_assoc($update_res);

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor | profile</title>

        <!-- Custom css file -->
   <link rel="stylesheet" href="../../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      

</head>
<body class="body-pd">
    
     <!-- =====================sidebar===================== -->
     <?php include('./sidebar.php'); ?>
    <!-- ====================sidebar ends================= -->
    <main class="profile-body" style="z-index: 1;">
        <main class="container">
            <div class="main-body mt-1">
                <div class="row">
                    <div class="col-lg-4 m-auto">
                        <div class="card profile bg-transparent border-0">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <form action="" class="profile-form" id="profile-form" method="post" enctype='multipart/form-data'>
                                        <div class="position-relative pt-1 image-upload">
                                            <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1" style="width: 200px; height: 200px; background: #DC5F00;"> -->
                                            <img src="<?php $profile_img !== null ? print '../../admin/course_resourses/profile_img/instructor/' . $profile_img : print '../../assets/img/profile.png' ?>" alt="Admin" class="rounded-circle p-1" style="width: 200px; height: 200px; background: #DD5353; object-fit: cover;">
                                            <!-- <button type='file' name="img" class="btn p-0">    -->
                                            <div class="profile-round">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($instructor_id); ?>">
                                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                                                <input type="file" id="profile_img" name="profile_img" class="imgfile" accept=".jpeg, .jpg, .png">
                                                <i class="fa-solid fa-pen text-light"></i>
                                            </div>
                                            <!-- </button> -->
                                        </div>
                                    </form>
                                </div>
                                <!-- <hr class="my-3"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-8 m-auto">
                        <div class="card profile m-auto bg-transparent border-0">
                            <div class="card-body p-0">
                                <form action="" class="profile-form" method="post" enctype='multipart/form-data'>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">Name</h6>
                                            <input name="name" type="text" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">Email</h6>
                                            <input name="email" type="text" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">Bio</h6>
                                            <input name="bio" type="text" class="form-control" value="<?php echo htmlspecialchars($bio); ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">Mobile</h6>
                                            <input name="phone" type="text" class="form-control" value="<?php echo htmlspecialchars($phone); ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">Address</h6>
                                            <input name="address" type="text" class="form-control" value="<?php echo htmlspecialchars($address); ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h6 class="mb-1">About me</h6>
                                            <textarea class="form-control" name="about_me" id="" cols="54" rows="3"><?php echo htmlspecialchars($about_me); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 text-secondary pt-2">
                                            <input type="submit" name="profile_btn" class="btn px-4 text-white" value="Save Changes" style="background-color: #DD5353;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </main>
    </main>


    <!-- Compiled and minified JavaScript -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

        
    <!-- ===========link bootstrap============= -->
    <script src="../../assets/js/bootstrap.js" type="text/javascript"></script>
    
    <script src="../../assets/style.js" type="text/javascript"></script>



    <!-- //image submit functions -->
    <script type="text/javascript">
        document.getElementById("profile_img").onchange = function(){
            document.getElementById('profile-form').submit();
        }
    </script>

    <?php
        if(isset($_FILES["profile_img"]["name"])){
        $id = $_POST["id"];
        $name = $_POST["name"];

        $imageName = $_FILES["profile_img"]["name"];
        $imageSize = $_FILES["profile_img"]["size"];
        $tmpName = $_FILES["profile_img"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){
                echo
                "
                <script>
                alert('Invalid Image Extension');
                document.location.href = '';
                </script>
                ";
            }
            elseif ($imageSize > 1200000){
                echo
                "
                <script>
                alert('Image Size Is Too Large');
                document.location.href = '';
                </script>
                ";
            }
            else{
                $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;
                $query = "UPDATE instructor SET profile_img = '$newImageName' WHERE id = $instructor_id";
                mysqli_query($conn, $query);
                move_uploaded_file($tmpName, '../../admin/course_resourses/profile_img/instructor/' . $newImageName);
                echo
                "
                <script>
                document.location.href = '';
                </script>
                ";
            }
        }
    ?>


</body>
</html>