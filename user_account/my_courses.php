<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My courses</title>

           <!-- Custom css file -->
   <link rel="stylesheet" href="../assets/style.css">

    <!-- ==================Link bootstrap ================== -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <!-- =================bootstrap icons================== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- =========== font awesome =========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    </head>
    <body>
        
    <?php include('./sidebar.php'); ?>

    <main class="container">
        w
    </main>



     <!-- Compiled and minified JavaScript -->
     <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

        <!-- ===========link bootstrap============= -->
        <script src="../assets/js/bootstrap.js" type="text/javascript"></script>

        <script src="../assets/style.js" type="text/javascript"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php 
            if(isset($_SESSION['order_status']) && $_SESSION['order_status'] != ''){
        ?>
            <script>
                swal({
                    title: "<?php echo htmlspecialchars($_SESSION['order_status']); ?>",
                    // text: "",
                    icon: "<?php echo htmlspecialchars($_SESSION['order_status_code']); ?>",
                    button: "Done",
            });
            </script>
        <?php
                unset($_SESSION['order_status']);
            }

        ?>
    </body>
</html>