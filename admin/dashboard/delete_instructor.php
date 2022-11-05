<?php 
    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }
    
    include('../../config/db_connect.php');


    if (isset($_GET['deleted'])){
        $instructor_id = mysqli_real_escape_string($conn, $_GET['deleted']);
        $delete_query = "DELETE FROM instructor WHERE id = '$instructor_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        header("Location: ./manage_instructor.php");
    }

?>