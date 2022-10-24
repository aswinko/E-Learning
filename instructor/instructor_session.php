<?php
    session_start();
    if(!isset($_SESSION['instructor_email'])){
        header("Location: login.php"); 
    }
?>
