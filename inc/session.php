<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php"); 
    }
?>

<!-- <script language="javascript">
location.href='index.php';
</script> -->