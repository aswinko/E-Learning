<?php 
    session_start();
    include('../config/db_connect.php');
    include_once('../config/functions.php');

    // echo $_SESSION['instructor_name'];

    if(isset($_SESSION['instructor_email']) && $_SESSION['instructor_email'] == true ){
        header("Location: index.php"); 
    }else {

        $instructor_name = $instructor_password = $instructor_email = $instructor_phone = '' ;
        $errors = array('instructor_name' => '', 'instructor_password' => '', 'instructor_email' => '', 'instructor_phone' => '' )  ;
    
        if (isset($_POST['signup'])){
    
            if(empty($_POST['instructor_name'])){
                $errors['instructor_name'] = 'Name is required.';
            }else {
                $instructor_name = $_POST['instructor_name'];
                if(!preg_match('/^[a-zA-Z\s]+$/', $instructor_name)){
                    $errors['instructor_name'] = 'Name must be letters only.';
                }
            }
    
            if(empty($_POST['instructor_password'])){
                $errors['instructor_password'] = 'Password is required.';
            }else {
                $instructor_password = $_POST['instructor_password'];
                if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $instructor_password)){
                    $errors['instructor_password'] = 'Password contain atleast eight characters, one letter, one number and one special character.';
                }
            }
    
            if(empty($_POST['instructor_email'])){
                $errors['instructor_email'] = 'Email is required.';
            }else {
                $instructor_email = $_POST['instructor_email'];
                if(!filter_var($instructor_email, FILTER_VALIDATE_EMAIL)){
                    $errors['instructor_email'] = 'Email must be a valid email address.';
                }
            }

            if(empty($_POST['instructor_phone'])){
                $errors['instructor_phone'] = 'Phone number is required.';
            }else {
                $instructor_phone = $_POST['instructor_phone'];
                if(!preg_match('/^[0-9]{10}$/', $instructor_phone)){
                    $errors['instructor_phone'] = 'Phone number must be 10 digits.';
                }
            }
    
            if(array_filter($errors)){
    
            }else {
                $instructor_name = mysqli_real_escape_string($conn, $_POST['instructor_name']);
                $instructor_password = mysqli_real_escape_string($conn, $_POST['instructor_password']);
                $instructor_email = mysqli_real_escape_string($conn, $_POST['instructor_email']);
                $instructor_phone = mysqli_real_escape_string($conn, $_POST['instructor_phone']);
                
                //signup function call
                instructor_signup($instructor_name, $instructor_password, $instructor_email, $instructor_phone);
            }

        }
    }
    

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration form</title>
        <?php include('./links.inc.php'); ?>
    </head>

    <body>
        <?php include('./header.inc.php'); ?>
        
    
        <main class="container home text-center">
            <div class="row pt-4 d-flex justify-content-center">
                <!-- <div class="col-4"></div> -->
                <div class="col-12 border bg-light rounded-3" style="width: 28rem;">
                    <div class="card-title my-4 ">
                        <h2>Signup</h2>
                    </div>
                    <form action="signup.php" method="POST">
                        <div class="mb-4">
                            <input type="text" class="form-control" name="instructor_name" id="name" value="<?php echo htmlspecialchars($instructor_name); ?>" placeholder="Name">
                            <!-- <label for="name">Username</label> -->
                            <div class="text-danger"><?php echo $errors['instructor_name']; ?></div>
                        </div>
                        <div class="mb-4">    
                            <input type="text" class="form-control" name="instructor_email" id="email" value="<?php echo htmlspecialchars($instructor_email); ?>" placeholder="Email">
                            <div class="text-danger"><?php echo $errors['instructor_email']; ?></div>
                        </div>
                        <div class="mb-4">    
                            <input type="text" class="form-control" name="instructor_phone" id="phone" value="<?php echo htmlspecialchars($instructor_phone); ?>" placeholder="Phone number">
                            <div class="text-danger"><?php echo $errors['instructor_phone']; ?></div>
                        </div>
                        <div class="mb-4">
                            <input class="form-control" type="password" name="instructor_password" id="password" placeholder="Password">
                            <div class="text-danger"><?php echo $errors['instructor_password']; ?></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" name="signup" class="btn btn-dark form-control">Signup</button>
                        </div>
                    </form>
                    <div class="mb-4">
                        <p>Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
                <!-- <div class="col-4"></div>  -->
            </div>
        </main>
        
        <?php include('../inc/footer.inc.php'); ?>
    </body>
        
</html>