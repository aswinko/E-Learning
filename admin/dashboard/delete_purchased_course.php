<?php 
    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }
    
    include('../../config/db_connect.php');


    if (isset($_GET['purchase_del'])){
        $course_id = mysqli_real_escape_string($conn, $_GET['purchase_del']);
        $delete_query = "DELETE FROM purchased_courses WHERE course_id = '$course_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        header("Location: ./manage_orders.php");
    }

?>