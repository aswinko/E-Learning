<?php 
    session_start();
    
    include('../config/db_connect.php');
    include_once('../config/functions.php');

    if(!isset($_SESSION['user'])){
        header("Location: ../login.php"); 
    }

    $username = $_SESSION['user'];
    $user_query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $profile_img = $row['profile_img'];
    $fullname = $row['fullname'];
    $bio = $row['bio'];
    $email = $row['email'];
    $mobile = $row['phone'];
    $address = $row['address'];


    //profile update
    if(isset($_POST['profile_btn'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $update_query = "UPDATE user SET fullname = '$fullname', email = '$email', bio = '$bio', phone = '$mobile', address = '$address' WHERE id = $user_id";
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
    <title>User | profile</title>

           <!-- Custom css file -->
   <link rel="stylesheet" href="../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    </head>

    <body class="body-pd">
        
        <?php include('./sidebar.php'); ?>

        <main class="profile-body">
            <main class="container">
                <div class="main-body mt-5">
                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <div class="card profile shadow-lg p-1">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <form action="" class="profile-form" id="profile-form" method="post" enctype='multipart/form-data'>
                                            <div class="position-relative pt-1 image-upload">
                                                <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1" style="width: 200px; height: 200px; background: #DC5F00;"> -->
                                                <img src="<?php $profile_img !== null ? print '../admin/course_resourses/profile_img/user/' . $profile_img : print '../assets/img/user.png' ?>" alt="Admin" class="rounded-circle p-1" style="width: 200px; height: 200px; background: #DC5F00; object-fit: cover;">
                                                <!-- <button type='file' name="img" class="btn p-0">    -->
                                                <div class="profile-round">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">
                                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['username']); ?>">
                                                    <input type="file" id="profile_img" name="profile_img" class="imgfile" accept=".jpeg, .jpg, .png">
                                                    <i class="fa-solid fa-pen text-light"></i>
                                                </div>
                                                <!-- </button> -->
                                            </div>
                                            <div class="mt-3">
                                                <h4><?php $fullname != null ? print htmlspecialchars($fullname) : print 'Name' ?></h4>
                                                <p class="text-secondary mb-1 bio"><?php $bio != null ? print htmlspecialchars($bio) : print 'Bio' ?></p>
                                                <p class="text-muted font-size-sm mb-1 email"><?php $email != null ? print htmlspecialchars($email) : print 'Email' ?></p>
                                                <p class="text-muted font-size-sm mb-1 phone"><?php $mobile != null ? print htmlspecialchars($mobile) : print 'Phone number' ?></p>
                                                <p class="text-muted font-size-sm mb-1 address"><?php $address != null ? print htmlspecialchars($address) : print 'Address' ?></p>
                                                <!-- <button class="btn btn-primary">Follow</button>
                                                <button class="btn btn-outline-primary">Message</button> -->
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-3">
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-8">
                            <div class="card profile shadow-lg p-5">
                                <div class="card-body">
                                    <form action="" class="profile-form" method="post" enctype='multipart/form-data'>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="fullname" type="text" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="email" type="text" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Bio</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="bio" type="text" class="form-control" value="<?php echo htmlspecialchars($bio); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="mobile" type="text" class="form-control" value="<?php echo htmlspecialchars($mobile); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="address" type="text" class="form-control" value="<?php echo htmlspecialchars($address); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary pt-2">
                                                <input type="submit" name="profile_btn" class="btn px-4 text-white" value="Save Changes" style="background-color: #DC5F00;">
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
        <script src="../assets/js/bootstrap.js" type="text/javascript"></script>

        <script src="../assets/style.js" type="text/javascript"></script>

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
                $query = "UPDATE user SET profile_img = '$newImageName' WHERE id = $user_id";
                mysqli_query($conn, $query);
                move_uploaded_file($tmpName, '../admin/course_resourses/profile_img/user/' . $newImageName);
                echo
                "
                <script>
                document.location.href = '';
                </script>
                ";
            }
        }
    ?>


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
