<?php 
    session_start();
    
    include('./config/db_connect.php');
    include_once('./config/functions.php');

    

    if(isset($_SESSION['user']) && $_SESSION['user'] == true ){
        header("Location: index.php"); 
    }else {
        
        if (isset($_POST['login'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            // $remember = mysqli_real_escape_string($conn, $_POST['remember']);
    
            //check remeber has value or not
            if(isset($_POST['remember'])){
                setcookie('uname', $username, time() + 60*60*24*10, "/");
                setcookie('upass', $password, time() + 60*60*24*10, "/"); 
            } else {
    
            }
            //login function call
            login($username, $password);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <title>Login form</title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>
        

        <main class="container text-center login">
            <div class="row pt-4 d-flex justify-content-center">
                <!-- <div class="col-4"></div> -->
                <div class="col-12 border bg-light rounded-3" style="width: 28rem;">
                    <div class="card-title my-4 ">
                        <h2>Login</h2>
                    </div>
                    <form action="login.php" method="POST">
                        <div class="mb-4">
                            <!-- <label for="name">Username</label> -->
                            <input type="text" class="form-control" name="username" id="name" placeholder="username" value="<?php if(isset($_COOKIE['uname'])) echo $_COOKIE['uname']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password">Password</label>   -->
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php if(isset($_COOKIE['upass'])) echo $_COOKIE['upass']; ?>" required>
                        </div>

                        <div class="form-check mb-4" style="text-align: left;">
                            <input class="form-check-input" type="checkbox" value="1" name="remember" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">Remember me</label>
                        </div>

                        <div class="mb-4">
                            <button type="submit" name="login" class="btn btn-dark form-control">Login</button>
                        </div>
                    </form>
                    <div class="mb-4">
                        <p>Don't have an accout? <a href="signup.php" class="to_signup">Signup</a></p>
                    </div>
                </div>
                <!-- <div class="col-4"></div>  -->
            </div>
        </main>

        <?php include('./inc/footer.inc.php'); ?>
    </body>
</html>