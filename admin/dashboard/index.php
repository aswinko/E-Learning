<?php 
    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }




?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin - Login</title>
        <!-- Custom css file -->
        <link rel="stylesheet" href="../../assets/style.css">

        <!-- ==================Link bootstrap ================== -->
        <link rel="stylesheet" href="../../assets/css/bootstrap.css">

        <?php include('../links.inc.php'); ?>
    </head>

    <body>
    <?php include('./sidebar.php'); ?>

    

        
    <!-- ===========link bootstrap============= -->
    <script src="../../assets/js/bootstrap.js" type="text/javascript"></script>
    </body>
</html>