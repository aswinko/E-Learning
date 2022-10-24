<?php 
    session_start();
    include('../config/db_connect.php');
    include('../config/functions.php');

    
    // echo $_SESSION['instructor_email'];

    if(isset($_SESSION['instructor_email']) && $_SESSION['instructor_email'] == true ){
        header("Location: index.php"); 
    }else {
        
        if (isset($_POST['login'])){
            $instructor_email = mysqli_real_escape_string($conn, $_POST['instructor_email']);
            $instructor_password = mysqli_real_escape_string($conn, $_POST['instructor_password']);
            // $remember = mysqli_real_escape_string($conn, $_POST['remember']);
    
            //check remeber has value or not
            if(isset($_POST['instructor_remember'])){
                setcookie('instructor_email', $instructor_email, time() + 60*60*24*10, "/");
                setcookie('instructor_password', $instructor_password, time() + 60*60*24*10, "/"); 
            } else {
    
            }
            //login function call
            instructor_login($instructor_email, $instructor_password);
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
        <title>Instructor | Login form</title>
        <?php include('./links.inc.php'); ?>
    </head>

    <body>
        <?php include('./header.inc.php'); ?>
        

        <main class="container home text-center">
            <div class="row pt-4 d-flex justify-content-center">
                <!-- <div class="col-4"></div> -->
                <div class="col-12 border bg-light rounded-3" style="width: 28rem;">
                    <div class="card-title my-4 ">
                        <h2>Login</h2>
                    </div>
                    <form action="login.php" method="POST">
                        <div class="mb-4">
                            <!-- <label for="name">Username</label> -->
                            <input type="text" class="form-control" name="instructor_email" id="name" placeholder="Email" value="<?php //if(isset($_COOKIE['instructor_email'])) echo $_COOKIE['instructor_email']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password">Password</label>   -->
                            <input type="password" class="form-control" name="instructor_password" id="password" placeholder="password" value="<?php //if(isset($_COOKIE['instructor_password'])) echo $_COOKIE['instructor_password']; ?>" required>
                        </div>

                        <div class="form-check mb-4" style="text-align: left;">
                            <input class="form-check-input" type="checkbox" value="1" name="instructor_remember" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">Remember me</label>
                        </div>

                        <div class="mb-4">
                            <button type="submit" name="login" class="btn btn-dark form-control">Login</button>
                        </div>
                    </form>
                    <div class="mb-4">
                        <p>Don't have an accout? <a href="signup.php">Signup</a></p>
                    </div>
                </div>
                <!-- <div class="col-4"></div>  -->
            </div>
        </main>

        <?php include('../inc/footer.inc.php'); ?>

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