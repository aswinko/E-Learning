<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] == true ){
    include('../config/functions.php');
    include('../config/db_connect.php');


    // $user_ip = getIPAddress();
    $user = $_SESSION['user'];
    $get_user = "SELECT * FROM `user` WHERE username = '$user'";
    $result_get_user = mysqli_query($conn ,$get_user);
    $run_query = mysqli_fetch_array($result_get_user);
    $user_id = $run_query['id'];

    //getting cart details and course total price
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
            $array_course_values = array_sum($price_table);
            $total_price += $array_course_values;
        } 
    }

    //getting order details
    if (isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];

        $select_order_data = "SELECT * FROM user_orders WHERE order_id = $order_id && user_id = '$user_id'";
        $result = mysqli_query($conn, $select_order_data);
        // $get_user_order = mysqli_fetch_array($result);
        // $total_courses = $get_user_order['total_courses'];
        if($result){

        }else{
            echo "console.log('error')";
            header("Location: ../cart.php");
        }
        $row_fetch = mysqli_fetch_array($result);
        $invoice = $row_fetch['invoice'];
        $amount = $row_fetch['amount_due'];
    }else {
        header("Location: ../cart.php");
    }

    //form validation
    $state = $country = $payment = "";
    $errors = array('state' => '', 'country' => '', 'payment' => '')  ;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if (empty($_POST["country"])) {
            $errors['country'] = "Country is required";
        } else {
            // $country = test_input($_POST["country"]);
        }
        if (empty($_POST["state"])) {
            $errors['state'] = "State is required";
        } else {
            // $state = test_input($_POST["state"]);
        }
        if (empty($_POST["payment"])) {
            $errors['payment'] = "payment is required";
        } else {
            // $payment = test_input($_POST["payment"]);
        }

        if(array_filter($errors)){

        }else {


            //inserting user payments 
            $country = $_POST['country'];
            $state = $_POST['state'];
            $payment_mode = $_POST['payment'];

            $insert_payment = "INSERT INTO `user_payment` (order_id, invoice_number, amount, 
            payment_mode, country, state, date) VALUES ($order_id, $invoice, $amount, '$payment_mode', 
            '$country', '$state', NOW())";

            $result_payment = mysqli_query($conn, $insert_payment);
            if($result_payment) {
                $update_orders = "UPDATE `user_orders` SET order_status = 'complete' WHERE order_id = $order_id";
                $result_update = mysqli_query($conn, $update_orders);


                $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add' AND user_name = '$user'";
                $result = mysqli_query($conn, $cart_query);
                while ($row = mysqli_fetch_array($result)){
                    $course_id = $row['course_id'];

                    /*the lines are to be insert order id and purchased courses id and 
                    corresponding userid in purchased_courses table */
                    $sq = "INSERT INTO purchased_courses (order_id, course_id, user_id, purchase_status) VALUES ($order_id, $course_id, $user_id, 'success')";
                    $sq_res = mysqli_query($conn, $sq);
                    if($sq_res){
                        // echo "success";
                    }else {
                        echo mysqli_error($conn);
                    }
                }


                if($result_update) {
                    // echo "success";

                    //delete items from cart when payment is success
                    $empty_cart = "DELETE FROM `cart_details` where user_name = '$user'";
                    $result_delete_cart = mysqli_query($conn, $empty_cart);

                    $_SESSION['order_status'] = "Order placed successfully";
                    $_SESSION['order_status_code'] = "success";
                    
                    echo "<script>window.open('../user_account/my_courses.php', '_self')</script>";
                }else {
                    // echo "error";
                }
            }else {
                $_SESSION['order_status'] = "Something went wrong";
                $_SESSION['order_status_code'] = "error";
            }
            // echo "done";
        }

    }

    //validation function
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>


    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Checkout</title>
            <!-- Custom css file -->
            <link rel="stylesheet" href="../assets/style.css">

            <!-- ==================Link bootstrap ================== -->
            <link rel="stylesheet" href="../assets/css/bootstrap.css">
            
            <?php include('../inc/links.inc.php'); ?>
        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand ps-4 heading" href="../index.php">E Learning</a>

                    <ul class="navbar-nav d-flex pe-0 m-2">
                    
                        <li class="nav-item ">
                            <a class="nav-link active nav-field" aria-current="page" href="../cart.php">
                            Close
                            </a>
                        </li>
                    </ul>
            </div>
            </nav>
            
            <main class="container" style="background: #fff;">
                <form action="" method="post">
                    <div class="row my-5">
                        <h2 class="fw-bold">Checkout</h2>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 mb-md-5">
                            <div class="row">
                                <h4 class="fw-semibold">Billing Address</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country-select">Country</label>
                                    <span class="error text-danger fs-6 fw-light">* <?php echo $errors['country']; ?></span>
                                    <select class="form-select mt-2" id="country-select" aria-label="" name="country" required>
                                        <option value="">Please select...</option>
                                        <option value="India">India</option>
                                        <!-- <option value="America">America</option> -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="country-select">State</label>
                                    <span class="error text-danger fs-6 fw-light">* <?php echo $errors['state']; ?></span>
                                    <select class="form-select mt-2" id="country-select" aria-label="" name="state" required>
                                        <option value="">Pleace select...</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Mumbai">Mumbai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row my-4">
                                <h4 class="">Payment Method</h4>
                            </div>
                            <div class="row border">
                                <div class="form-check py-3 ps-5">
                                    <input class="form-check-input" type="radio" name="payment" id="cod" value="cod">
                                    <label class="form-check-label ms-2 fw-bold" for="cod">
                                        COD
                                    </label>
                                    <span class="error text-danger fs-6 fw-light">* <?php echo $errors['payment']; ?></span>
                                </div>
                            </div>
                            <div class="row border">
                                <div class="form-check py-3 ps-5">
                                    <input class="form-check-input" type="radio" name="payment" id="card" value="card" disabled>
                                    <label class="form-check-label ms-2 fw-bold" for="card">
                                        Credit/Debit Card
                                    </label>
                                </div>
                            </div>
                            <div class="row border">
                                <div class="form-check py-3 ps-5">
                                    <input class="form-check-input" type="radio" name="payment" id="UPI" value="upi" disabled>
                                    <label class="form-check-label ms-2 fw-bold" for="UPI">
                                        UPI
                                    </label>
                                </div>
                            </div>
                            <div class="row border">
                                <div class="form-check py-3 ps-5">
                                    <input class="form-check-input" type="radio" name="payment" id="net_banking" value="net_banking" disabled>
                                    <label class="form-check-label ms-2 fw-bold" for="net_banking">
                                        Net Banking
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 ms-md-5 d-flex flex-column">
                            <p class="fs-3 d-flex flex-column mt-4 mb-0 pt-1 fw-bold">Summary</p>
                            <div class="row my-4 d-flex flex-row">
                                <div class="col-6">  
                                    <p class="fs-5 d-flex px-0 mb-0 pt-1 fw-bold">Total: </p>
                                </div>
                                <div class="col-6">
                                    <span class="fs-5 fw-bold d-flex justify-content-end align-items-center px-0 mt-0"><i class="bi bi-currency-rupee text-dark fs-5 fw-bold mx-0"></i><?php echo $total_price; ?></span>
                                </div>
                            </div>
                            <input type="submit" name="confirm_order" class="btn btn-info rounded-0 text-white fs-6 fw-bold mt-1 mb-5" style="padding: 10px 4rem;" value="Complete Checkout" >
                        </div>
                    </div>
                </form>
            </main>

            <?php include('../inc/footer.inc.php'); ?>
            <!-- ===========link bootstrap============= -->
            <script src="../assets/js/bootstrap.js" type="text/javascript"></script>
        </body>

    </html>
<?php }else{ ?>
    <?php header("Location: ../login.php"); ?>
<?php } ?>