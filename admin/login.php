<?php 
    session_start();
    
    include('../config/db_connect.php');
    include_once('../config/functions.php');

    

    if(isset($_SESSION['admin_username']) && $_SESSION['admin_username'] == true ){
        header("Location: dashboard/index.php"); 
    }else {
        
        if (isset($_POST['login'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            // $remember = mysqli_real_escape_string($conn, $_POST['remember']);
    
            //login function call
            admin_login($username, $password);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <title>Login form</title>
         <!-- Custom css file -->
        <link rel="stylesheet" href="../assets/style.css">

        <!-- ==================Link bootstrap ================== -->
        <link rel="stylesheet" href="../assets/css/bootstrap.css">

        <?php include('./dashboard/links.inc.php'); ?>
    </head>

    <body>

        <main class="container text-center">
            <div class="row pt-5 d-flex justify-content-center">
                <!-- <div class="col-4"></div> -->
                <div class="col-12 border bg-light rounded-3" style="width: 28rem; height: 21rem;">
                    <div class="card-title my-4 ">
                        <h2>Login</h2>
                    </div>
                    <form action="login.php" method="POST" class="mt-5">
                        <div class="mb-4 mt-4">
                            <!-- <label for="name">Username</label> -->
                            <input type="text" class="form-control" name="username" id="name" placeholder="username" value="" required>
                        </div>
                        <div class="mb-5">
                            <!-- <label for="password">Password</label>   -->
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" value="" required>
                        </div>

                        <!-- <div class="form-check mb-4" style="text-align: left;">
                            <input class="form-check-input" type="checkbox" value="1" name="remember" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">Remember me</label>
                        </div> -->

                        <div class="mb-4">
                            <button type="submit" name="login" class="btn btn-dark form-control">Login</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="col-4"></div>  -->
            </div>
        </main>

        
        <!-- ===========link bootstrap============= -->
        <script src="../assets/js/bootstrap.js" type="text/javascript"></script>
        <?php include('./dashboard/footer.inc.php'); ?>
    </body>
</html>