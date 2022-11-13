<?php

    session_start();
    include('./config/db_connect.php');
    include_once('./config/functions.php');


    if(isset($_SESSION['user']) && $_SESSION['user'] == true ){
        header("Location: index.php"); 
    }else {

        $username = $password = $email = $phone = $fullname = '';
        $errors = array('username' => '', 'password' => '', 'email' => '', 'phone' => '', 'fullname' => '')  ;
    
        if (isset($_POST['signup'])){
    
            if(empty($_POST['username'])){
                $errors['username'] = 'Username is required.';
            }else {
                $username = $_POST['username'];
                if(!preg_match('/^[a-zA-Z0-9\s]+$/', $username)){
                    $errors['username'] = 'Username must be letters and numbers only.';
                }
            }

            if(empty($_POST['fullname'])){
                $errors['fullname'] = 'Fullname is required.';
            }else {
                $fullname = $_POST['fullname'];
                if(!preg_match('/^[a-zA-Z\s]+$/', $fullname)){
                    $errors['fullname'] = 'Fullname must be letters.';
                }
            }
    
    
            if(empty($_POST['password'])){
                $errors['password'] = 'Password is required.';
            }else {
                $password = $_POST['password'];
                if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)){
                    $errors['password'] = 'Password contain atleast eight characters, one letter, one number and one special character.';
                }
            }
    
            if(empty($_POST['email'])){
                $errors['email'] = 'Email is required.';
            }else {
                $email = $_POST['email'];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = 'Email must be a valid email address.';
                }
            }

            if(empty($_POST['phone'])){
                $errors['phone'] = 'Phone number is required.';
            }else {
                $phone = $_POST['phone'];
                if(!preg_match('/^[0-9]{10}$/', $phone)){
                    $errors['phone'] = 'Phone number must be 10 digits.';
                }
            }
    
            if(array_filter($errors)){
    
            }else {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                
                //signup function call
                signup($username, $password, $email, $phone, $fullname);
            }
    
    
    
            // $username = $_POST['username'];
            // $password = $_POST['password'];
            // $email = $_POST['email'];
    
            // if($username != '' && $password != '' && $email != ''){
                
            //     $sql = "INSERT INTO user(username, password, email) VALUES ('$username', '$password', '$email')";
        
            //     $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
            //     if($res){
            //         // echo "Successfully registered";
            //         header("Location: login.php");
            //     }
        
            //     mysqli_close($conn);
            // }else {
            //     echo '<script>alert("Please fill all the fields")</script>';
            // }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration form</title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>
        
    
        <main class="container text-center signup mb-5">
            <div class="row pt-4 d-flex justify-content-center">
                <!-- <div class="col-4"></div> -->
                <div class="col-12 border bg-light rounded-3" style="width: 28rem;">
                    <div class="card-title my-4 ">
                        <h2>Signup</h2>
                    </div>
                    <form action="signup.php" method="POST">
                    <div class="mb-4">
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo htmlspecialchars($fullname); ?>" placeholder="Fullname">
                            <!-- <label for="name">Username</label> -->
                            <div class="text-danger"><?php echo $errors['fullname']; ?></div>
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control" name="username" id="name" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username">
                            <!-- <label for="name">Username</label> -->
                            <div class="text-danger"><?php echo $errors['username']; ?></div>
                        </div>
                        <div class="mb-4">    
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email">
                            <div class="text-danger"><?php echo $errors['email']; ?></div>
                        </div>
                        <div class="mb-4">    
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Phone number">
                            <div class="text-danger"><?php echo $errors['phone']; ?></div>
                        </div>
                        <div class="mb-4">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                            <div class="text-danger"><?php echo $errors['password']; ?></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" name="signup" class="btn btn-dark form-control">Signup</button>
                        </div>
                    </form>
                    <div class="mb-4">
                        <p>Already have an account? <a href="login.php" class="to_login">Login</a></p>
                    </div>
                </div>
                <!-- <div class="col-4"></div>  -->
            </div>
        </main>
        
        <?php include('./inc/footer.inc.php'); ?>
    </body>
        
</html>