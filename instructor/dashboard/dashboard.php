<?php

session_start();
if(!isset($_SESSION['instructor_email'])){
    header("Location: ../login.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teach Now</title>
        
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

    <?php include('./create_course.inc.php'); ?>
    <?php include('./engage_course.inc.php'); ?>
    <?php include('./manage_course.inc.php'); ?>


    <!-- Compiled and minified JavaScript -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

        
        <!-- ===========link bootstrap============= -->
        <script src="../../assets/js/bootstrap.js" type="text/javascript"></script>
        
        <script src="../../assets/style.js" type="text/javascript"></script>

</body>
</html>