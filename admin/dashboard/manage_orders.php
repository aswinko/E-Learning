<?php

    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("Location: ../login.php"); 
    }

    include('../../config/db_connect.php');

    //get user order informations
    $order_query = "SELECT * FROM user_orders ORDER BY order_id DESC";
    $order_result = mysqli_query($conn, $order_query);
    $orders = mysqli_fetch_all($order_result, MYSQLI_ASSOC);
    $order_count = mysqli_num_rows($order_result);
    $num = 1;

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <?php include('./links.inc.php'); ?>
</head>
<body class="body-pd">


    <!-- =====================sidebar===================== -->
    <?php include('./sidebar.php'); ?>
    <!-- ====================sidebar ends================= -->



    
    <div class="container manage-course" style="z-index: 0;">
        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="">Manage orders</h2>
            </div>
        </div>
        <?php if($order_count): ?>
            <div class="row mb-2 py-3 border border-secondary bg-dark text-white shadow-sm d-flex flex-row text-center align-items-center rounded-3">
                <div class="col-1">Sl no</div>
                <div class="col-1">Username</div>
                <div class="col-2">Amount due</div>
                <div class="col-2">Invoice no</div>
                <div class="col-2">Order status</div>
                <div class="col-2">Order date</div>
                <div class="col-2">Action</div>
            </div>
            <?php foreach($orders as $order): ?>
                <?php 
                    $user_id = $order['user_id'];
                    $user_query = "SELECT * FROM user WHERE id = '$user_id'";
                    $user_res = mysqli_query($conn, $user_query);
                    $users = mysqli_fetch_all($user_res, MYSQLI_ASSOC);

                 ?>
                <?php foreach($users as $user_name): ?>
                    <div class="row mb-2 py-2 border shadow-sm d-flex flex-row text-center align-items-center rounded-3">
                        <div class="col-1"><?php echo $num++; ?></div>
                        <div class="col-1"><?php echo htmlspecialchars($user_name['username']) ?></div>
                        <div class="col-2">₹<?php echo htmlspecialchars($order['amount_due']) ?></div>
                        <div class="col-2"><?php echo htmlspecialchars($order['invoice']) ?></div>
                        <div class="col-2"><?php echo htmlspecialchars($order['order_status']) ?></div>
                        <div class="col-2"><?php echo htmlspecialchars($order['order_date']) ?></div>
                        <div class="col-2">
                            <a href="./view_order_details.php?view=<?php echo htmlspecialchars($order['order_id']) ?>" class="btn btn-danger fs-6" role="button">view details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>

        <?php else: ?>
            <h2>No orders yet.</h2>
        <?php endif; ?>
        
        
    </div>
    
    <?php include('./footer.inc.php'); ?> 

</body>
</html>