<?php
    include('./config/db_connect.php');
    include_once('./config/functions.php');
    session_start();

    if(isset($_SESSION['user']) && $_SESSION['user'] == true ){
        $user = $_SESSION["user"];
        $sql = "SELECT * FROM cart_details WHERE user_name = '$user'";
        $select_cart= mysqli_query($conn, $sql);
        $loop = mysqli_fetch_array($select_cart);
        $course_id = $loop['course_id'];
        
        if (isset($_POST['remove_item'])) {

            //call delete cart item function
            delete_cart_item($course_id);
        }
    

        $user = $_SESSION['user'];
        $get_user = "SELECT * FROM `user` WHERE username = '$user'";
        $result_get_user = mysqli_query($conn ,$get_user);
        $run_query = mysqli_fetch_array($result_get_user);
        $user_id = $run_query['id'];

        if(isset($_POST['checkout'])) {

            if (isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];
            }
        
            //getting user id
            $user = $_SESSION['user'];
            $get_ip_add = getIPAddress();
            $total_price = 0;
            $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add' AND user_name = '$user'";
            $result = mysqli_query($conn, $cart_query);
        
            $invoice_number = mt_rand();
            $status = 'pending';
            $count_course = mysqli_num_rows($result);
        
            while ($row = mysqli_fetch_array($result)){
                $course_id = $row['course_id'];
                $select_course = "SELECT * FROM courses WHERE course_id = '$course_id'";
                $result_course = mysqli_query($conn, $select_course);
                while ($row_course_price = mysqli_fetch_array($result_course)) {
                    $price_table = array($row_course_price['price']);
                    // $course_price = $row_course_price['price'];
                    $array_course_values = array_sum($price_table);
                    $total_price += $array_course_values;
                } 
                // $row = mysqli_fetch_array($result);
                // $total_courses_id = explode(',', $course_id);
                // echo $total_courses_id;
                // echo ",";
                // echo print_r(array($row['course_id']));

            } 
        
            //getting quantity from cart
            // $get_cart = "SELECT * FROM cart_details";
            // $run_cart = mysqli_query($conn, $get_cart);
            // $get_item_quantity = mysqli_fetch_array($run_cart);
            // $quantity = $get_item_quantity['quantity'];
            // if ($quantity == 0) {
            //     $quantity = 1;
            // }
        
            // insert into users orders
            $insert_orders = "INSERT INTO user_orders (user_id, amount_due, invoice, total_courses, 
            order_status, order_date) VALUES ($user_id, $total_price, $invoice_number, $count_course, '$status', NOW())";
            $insert_result = mysqli_query($conn, $insert_orders);
            if ($insert_result) {
                // echo "<script>alert('orders are submitted successfully')</script>";
                // $_SESSION['status'] = "Order placed successfully";
                // $_SESSION['status_code'] = "success";

                $select_orders = "SELECT * FROM user_orders WHERE user_id = $user_id";
                $result_order = mysqli_query($conn, $select_orders);
                while($order_fetch = mysqli_fetch_array($result_order)){
                    $order_id = $order_fetch['order_id'];
                }
                
                header("Location: ./cart/checkout.php?order_id=$order_id");
                // echo "<script>window.open('index.php', '_self')</script>";
            }else{
                // echo "something went wrong!";
                $_SESSION['status'] = "Something went wrong!";
                $_SESSION['status_code'] = "error";
            }

            //orders pending
            // $insert_pending_orders = "INSERT INTO orders_pending (user_id, amount_due, invoice, total_courses, 
            // order_status, order_date) VALUES ($user_id, $total_price, $invoice_number, $count_course, '$status', NOW())";
            // $insert_result = mysqli_query($conn, $insert_orders);

        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Cart</title>
        <?php include('./inc/links.inc.php'); ?>
    </head>

    <body>
        <?php include('./inc/header.inc.php'); ?>
        

        <main class="container " style="background: #fff;">
            <div class="row pt-4">
                <h4 class="fw-semibold fs-1 mb-4">Shopping Cart</h4>
                
                <?php  if(isset($_SESSION['user']) && $_SESSION['user'] == true ): ?>
                    <?php  if(mysqli_num_rows($select_cart) > 0): ?>
                        <!-- <div class="row">
                            <div class="col-12">
                                <p class="text-muted fw-bold fs-5"><?php //echo $cart_item() ?> results</p>
                            </div>
                        </div> -->
                        <div class="col-9 my-4 px-4">
                            <div class="row">
                            <div class="col-12">
                                <p class="text-muted fw-bold fs-5"><?php echo cart_item(); ?> Courses in Cart</p>
                            </div>
                        </div>
                        
                            <?php 
                                $user = $_SESSION['user'];
                                $get_ip_add = getIPAddress();
                                $total_price = 0;
                                $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add' AND user_name = '$user'";
                                $result = mysqli_query($conn, $cart_query);
                                while ($row = mysqli_fetch_array($result)){
                                    $course_id = $row['course_id'];
                                    $select_course = "SELECT * FROM courses WHERE course_id = '$course_id'";
                                    $result_course = mysqli_query($conn, $select_course);
                                    while ($row_course_price = mysqli_fetch_array($result_course)) {
                                        $price_table = array($row_course_price['price']);
                                        $course_price = $row_course_price['price'];
                                        $course_title = $row_course_price['title'];
                                        $course_img = $row_course_price['thumbnail'];
                                        $course_desc = $row_course_price['description'];
                                        $course_author = $row_course_price['author'];
                                        $course_rating = $row_course_price['rating'];
                                        $array_course_values = array_sum($price_table);
                                        $total_price += $array_course_values;
                            ?>
                                    
                                            <div class="row border border-2 px-2 mb-4">
                                                <div class="col-2 image-container pt-4 p-0 px-1" style="max-width: 8rem;">
                                                    <img src="./admin/course_resourses/thumbnail/<?php echo $course_img; ?>" class="img-fluid" alt="..." style="width: 640px; height: 4rem;">
                                                </div>
                                                <div class="col-6 p-0">
                                                        <a class="text-dark m-0 " href="course_details.php?course_id=<?php echo $course_id; ?>&course_title=<?php echo $course_title; ?>">
                                                            <div class="card-body">
                                                                <h5 class="card-title m-0 p-0 lh-sm mb-1"><?php echo $course_title; ?></h5>
                                                                <p class="card-text m-0 p-0 fw-normal lh-md" style="font-size: .74rem !important;"><?php echo $course_desc; ?></p>
                                                                <p class="card-text fw-semibold m-0 p-0" style="font-size: .8rem !important;"><?php echo $course_author; ?></p>
                                                                <p class="card-text m-0 p-0 text-muted" style="font-size: .8rem !important;"><small class="text-muted"><?php echo $course_rating; ?>⭐<span>rating</span></small></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                
                                                <div class="col-2 p-0">
                                                    
                                                    <form action="" method="post">
                                                        <input name="remove_item" type="submit" value="Remove" class="btn mt-4 text-danger" style="font-size: 1rem;">
                                                    </form>
                                                    <a href="#" class="btn text-info" style="font-size: .9rem;">Move to whishlist</a>
                                                </div>
                                                <div class="col-2">
                                                    <p class="m-0 p-0 d-flex justify-content-end mt-4 fs-5"><i class="bi bi-currency-rupee text-info"></i><?php echo $course_price; ?><i class="bi bi-tag-fill text-info ps-1"></i></p>
                                                </div>
                                            </div>

                            <?php } } ?>
                        </div>

                        <div class="col-3 mt-4 p-0 px-4">
                            <p class="fs-3 d-flex flex-column mt-4 mb-0 pt-1 fw-bold">Order total:</p>
                            <span class="fs-2 fw-bold d-flex align-items-center mt-0 mb-4"><i class="bi bi-currency-rupee text-dark fs-1 fw-bold mx-0"></i><?php echo $total_price; ?></span>
                            <form action="" method="post">
                                <input type="submit" name="checkout" class="btn btn-info rounded-0 text-white fs-5 mt-1" value="Checkout" style="padding: 10px 6rem;">
                            </form>
                            <!-- <a href="./cart/checkout.php" class="btn btn-info rounded-0 text-white fs-5 mt-1" style="padding: 10px 6rem;">Checkout</a> -->
                        </div>
                    <?php else: ?>
                        <div class="col-12 p-4 border border-2 d-flex justify-content-center mb-4">
                            <div>
                                <img src="./assets/icons/search_icon.svg" class="mb-4 img-fluid" alt="" style="width: 400px;">
                                <p class="fw-normal fs-6 mx-4">Your cart is empty. Keep shopping to find a course!</p>
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="index.php" class='btn btn-info d'>Keep Shopping</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                        
                <?php else: ?>
                    <div class="col-12 p-4 border border-2 d-flex justify-content-center mb-4">
                        <div>
                            <img src="./assets/icons/search_icon.svg" class="mb-4 img-fluid" alt="" style="width: 400px;">
                            <p class="fw-normal fs-6 mx-4">Your cart is empty. Keep shopping to find a course!</p>
                            <div class="col-12 d-flex justify-content-center">
                                <a href="index.php" class='btn btn-info d'>Keep Shopping</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                        
            </div>
                
        </main>

        <?php include('./inc/footer.inc.php'); ?>

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