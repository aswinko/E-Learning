<?php

include 'db_connect.php';

function search_course($search_data) {
    global $conn;

    // $search_data = $_GET['search_data'];
    $sql ="SELECT course_id, thumbnail, title, author, rating, price, description 
    FROM courses where course_keywords like '%$search_data%'";

    $result = mysqli_query($conn, $sql);

    // $row_count = mysqli_num_rows($result);

    return $result;
}

function show_category()
{
    global $conn;

    $select_category_query = 'SELECT category_id, category_name FROM category';
    $result_category = mysqli_query($conn, $select_category_query);

    return $result_category;
}

function show_course()
{
    global $conn;

    // write query for all courses
    $sql_to_normal_result ='SELECT course_id, thumbnail, title, author, rating, price, category_id 
    FROM courses ORDER BY course_id';
    //make normal query
    $normal_result = mysqli_query($conn, $sql_to_normal_result);

    return $normal_result;
}

function show_random_course()
{
    global $conn;

    //write random query for all courses
    $sql_to_random_result ='SELECT course_id, thumbnail, title, author, rating, price, category_id 
    FROM courses ORDER BY RAND()';
    //make random query
    $random_result = mysqli_query($conn, $sql_to_random_result);

    return $random_result;
}

function show_all_courses()
{
    global $conn;

    $sql ='SELECT course_id, thumbnail, title, author, rating, price, description 
    FROM courses ORDER BY course_id';

    $result = mysqli_query($conn, $sql);

    // $row_count = mysqli_num_rows($result);

    return $result;
}

function show_course_details($id) {

    global $conn;

    $sql = "SELECT course_id, instructor_email, thumbnail, description, title, author, 
    rating, price, lecture1, lecture2, lecture3, lecture4, lecture5, lecture6 
    FROM courses WHERE course_id = '$id' ";

    //get the query result
    $result = mysqli_query($conn, $sql);

    return $result;
}

function show_courses_category($id) {

    global $conn;

    $sql ="SELECT course_id, thumbnail, title, author, rating, price, description 
    FROM courses where category_id = '$id'";

    $result = mysqli_query($conn, $sql);

    // $row_count = mysqli_num_rows($result);

    return $result;
}


function show_instructor(){
    global $conn;

    $query = "SELECT * FROM instructor ORDER BY id";

    $res = mysqli_query($conn, $query);

    return $res;
}

function show_user(){
    global $conn;

    $query = "SELECT * FROM user ORDER BY id";

    $res = mysqli_query($conn, $query);

    return $res;
}

//fetch instructor details 
function instructor_details($instructor_email) {
    global $conn;

    $instruct_sql = "SELECT * FROM instructor where email = '$instructor_email'";
    $result = mysqli_query($conn, $instruct_sql);   
    return $result;
}

// function author_name() {
//     global $conn;

//     $sql = "SELECT * FROM courses";
//     $result = mysqli_query($conn, $sql);
//     $course = mysqli_fetch_all($result, MYSQLI_ASSOC);

//     foreach($course as $courses){
//         $instructor_email = $courses['instructor_email'];
//     }
    
//     $instruct_sql = "SELECT * FROM instructor WHERE email = '$instructor_email'";
//     $result_instruct = mysqli_query($conn, $instruct_sql);


//     return $result_instruct;
//     // $instruct = mysqli_fetch_assoc($result_instruct);
// }

function insert_category($category_name, $category_icon)
{
    global $conn;

    $select_query = "SELECT category_id, category_name, category_icon 
    FROM category WHERE category_name= '$category_name'";

    $result_select = mysqli_query($conn, $select_query);
    if (mysqli_num_rows($result_select) > 0) {
        // echo "<script>alert('This category is already inserted!')</script>";
        $_SESSION['status'] = "This category is already inserted!";
        $_SESSION['status_code'] = "error";
        
    } else {
        $sql = "INSERT INTO category (category_name, category_icon) 
        VALUES ('$category_name', '$category_icon')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            // echo "<script>alert('Category has been successfully inserted.')</script>";
            $_SESSION['status'] = "Category has been successfully inserted.";
            $_SESSION['status_code'] = "success";
        }else {
            $_SESSION['status'] = "Category not inserted.";
            $_SESSION['status_code'] = "error";
        }

        return $result;
    }
}

function insert_courses(
    $temp_thumbnail,
    $thumbnail,
    $course_title,
    $author_name,
    $course_price,
    $course_description,
    $course_keywords,
    $course_category,
    $course_status,
    $lecture1, 
    $lecture2, 
    $lecture3, 
    $lecture4, 
    $lecture5, 
    $lecture6,
    $temp_lecture1,
    $temp_lecture2, 
    $temp_lecture3, 
    $temp_lecture4, 
    $temp_lecture5, 
    $temp_lecture6
) {
    global $conn;
    // echo $author_name;
    $instructor_email = $_SESSION['instructor_email'];
    $sql = "SELECT instructor_email FROM courses WHERE user_name = '$instructor_email'";
    $result_query = mysqli_query($conn, $sql);

    $course_rating = "";
    // move_uploaded_file($temp_thumbnail, "./course_resourses/'$thumbnail'");

    //image upload
    $img_thumb = move_uploaded_file($temp_thumbnail, "C:\wamp64\www\Learning\admin\course_resourses\\thumbnail\\" . $thumbnail);

    //lecture upload
    $lecture_1 = move_uploaded_file($temp_lecture1, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture1);
    $lecture_2 = move_uploaded_file($temp_lecture2, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture2);
    $lecture_3 = move_uploaded_file($temp_lecture3, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture3);
    $lecture_4 = move_uploaded_file($temp_lecture4, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture4);
    $lecture_5 = move_uploaded_file($temp_lecture5, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture5);
    $lecture_6 = move_uploaded_file($temp_lecture6, "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $lecture6);
    if ($img_thumb or $lecture_1 or $lecture_2 or $lecture_3 or 
        $lecture_4 or $lecture_4 or $lecture_5 or $lecture_6) {
        // echo 'File uploaded successfully';
    } else {
        $_SESSION['status'] = "You should select a file to upload !!";
        $_SESSION['status_code'] = "error";
        // echo 'You should select a file to upload !!';
    }

    //insert query
    $insert_course = "INSERT INTO courses (instructor_email, title, author, rating,
                    price, description, date, course_keywords, category_id, thumbnail, 
                    lecture1, lecture2, lecture3, lecture4, lecture5, lecture6, status) 
                    VALUES ('$instructor_email' ,'$course_title', '$author_name', '$course_rating', 
                    '$course_price', '$course_description', NOW() , '$course_keywords', '$course_category', 
                    '$thumbnail', '$lecture1' , '$lecture2' , '$lecture3', '$lecture4', '$lecture5', 
                    '$lecture6', '$course_status')";

    $result_query = mysqli_query($conn, $insert_course);
    if ($result_query) {
        // echo "<script>alert('Sucessfully inserted the Course details.')</script>";
        $_SESSION['status'] = "Sucessfully inserted the Course details.";
        $_SESSION['status_code'] = "success";
    }else{
        $_SESSION['status'] = "Something went Wrong. Try again!";
        $_SESSION['status_code'] = "error";

        // echo "<script>alert('Something went Wrong!')</script>";
        // echo mysqli_error($conn);
    }

    return $result_query;
}


function update_courses(
    $temp_thumbnail,
    $course_title,
    $old_thumbnail,
    $update_thumbnail,
    $course_price,
    $course_description,
    $course_keywords,
    $course_category,
    $course_status,
    $lecture1, 
    $lecture2, 
    $lecture3, 
    $lecture4, 
    $lecture5, 
    $lecture6,
    $update_lecture1,
    $update_lecture2,
    $update_lecture3,
    $update_lecture4,
    $update_lecture5,
    $update_lecture6,
    $old_lecture1,
    $old_lecture2,
    $old_lecture3,
    $old_lecture4,
    $old_lecture5, 
    $old_lecture6,
    $temp_lecture1,
    $temp_lecture2, 
    $temp_lecture3, 
    $temp_lecture4, 
    $temp_lecture5, 
    $temp_lecture6,
    $course_id
) {
    global $conn;
    // echo $author_name;
    // $instructor_email = $_SESSION['instructor_email'];
    // $sql = "SELECT instructor_email FROM courses WHERE user_name = '$instructor_email'";
    // $result_query = mysqli_query($conn, $sql);

    $course_rating = "";
    // move_uploaded_file($temp_thumbnail, "./course_resourses/'$thumbnail'");

    //image upload
    // $img_thumb = move_uploaded_file($temp_thumbnail, "C:\wamp64\www\Learning\admin\course_resourses\\" . $update_filename);

    //old imgae
    // $img_thumb = move_uploaded_file($temp_thumbnail, "C:\wamp64\www\Learning\admin\course_resourses\\" . $old_thumbnail);

    //lecture upload
    // $lecture_1 = move_uploaded_file($temp_lecture1, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture1);
    // $lecture_2 = move_uploaded_file($temp_lecture2, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture2);
    // $lecture_3 = move_uploaded_file($temp_lecture3, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture3);
    // $lecture_4 = move_uploaded_file($temp_lecture4, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture4);
    // $lecture_5 = move_uploaded_file($temp_lecture5, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture5);
    // $lecture_6 = move_uploaded_file($temp_lecture6, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture6);
    // if ($img_thumb or $lecture_1 or $lecture_2 or $lecture_3 or 
    //     $lecture_4 or $lecture_4 or $lecture_5 or $lecture_6) {
    //     // echo 'File uploaded successfully';
    // } else {
    //     // $thumbnail = $old_thumbnail;
    //     // $img_thumb = move_uploaded_file($temp_thumbnail, "C:\wamp64\www\Learning\admin\course_resourses\\" . $old_thumbnail);
    //     // $_SESSION['status'] = "You should select a file to upload !!";
    //     // $_SESSION['status_code'] = "error";
    //     // echo 'You should select a file to upload !!';
    // }

    //insert query
    $update_course = "UPDATE `courses` SET category_id='$course_category', title='$course_title', price='$course_price',
                        description='$course_description', course_keywords='$course_keywords', thumbnail='$update_thumbnail', lecture1='$update_lecture1',
                        lecture2='$update_lecture2', lecture3='$update_lecture3', lecture4='$update_lecture4', lecture5='$update_lecture5', lecture6='$update_lecture6', date=NOW() WHERE course_id='$course_id'";

    $result_query = mysqli_query($conn, $update_course);
    if ($result_query) {
        if($_FILES['thumbnail']['name'] != ''){
            //image upload
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\\thumbnail\\" . $_FILES['thumbnail']['name']);

            // move_uploaded_file($temp_lecture1, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture1);
            // move_uploaded_file($temp_lecture2, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture2);
            // move_uploaded_file($temp_lecture3, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture3);
            // move_uploaded_file($temp_lecture4, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture4);
            // move_uploaded_file($temp_lecture5, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture5);
            // move_uploaded_file($temp_lecture6, "C:\wamp64\www\Learning\admin\course_resourses\\" . $lecture6);
            
            unlink("C:\wamp64\www\Learning\admin\course_resourses\\thumbnail\\" . $old_thumbnail);

            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture1);
            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture2);
            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture3);
            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture4);
            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture5);
            // unlink("C:\wamp64\www\Learning\admin\course_resourses\\" . $old_lecture6);

        }

        if ($_FILES['lecture1']['name'] != ''){
            move_uploaded_file($_FILES['lecture1']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture1']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture1);
        }
        if ($_FILES['lecture2']['name'] != ''){
            move_uploaded_file($_FILES['lecture2']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture2']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture2);
        }
        if ($_FILES['lecture3']['name'] != ''){
            move_uploaded_file($_FILES['lecture3']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture3']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture3);
        }
        if ($_FILES['lecture4']['name'] != ''){
            move_uploaded_file($_FILES['lecture4']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture4']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture4);
        }
        if ($_FILES['lecture5']['name'] != ''){
            move_uploaded_file($_FILES['lecture5']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture5']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture5);
        }
        if ($_FILES['lecture6']['name'] != ''){
            move_uploaded_file($_FILES['lecture6']['tmp_name'], "C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $_FILES['lecture6']['name']);
            unlink("C:\wamp64\www\Learning\admin\course_resourses\lectures\\" . $old_lecture6);
        }

        // echo "<script>alert('Sucessfully inserted the Course details.')</script>";
        $_SESSION['status'] = "Sucessfully updated Course details.";
        $_SESSION['status_code'] = "success";
    }else{
        $_SESSION['status'] = "Something went Wrong. Try again!";
        $_SESSION['status_code'] = "error";

        // echo "<script>alert('Something went Wrong!')</script>";
        // echo mysqli_error($conn);
    }

    return $result_query;
}



function login($username, $password) {

    global $conn;

    $sql = "SELECT username, password FROM user WHERE username = '$username' && password = '$password'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        if($count > 0){

            //created user session
            $_SESSION['user'] = $username;
            
            header('Location: index.php');
            // echo "Successfully logged in";
        }else {
            // echo '<script>alert("Invalid username or password")</script>';
            $_SESSION['status'] = "Invalid Username or Password!";
            $_SESSION['status_code'] = "error";
            // header('location: login.php');
        }
}

function signup($username, $password, $email, $phone) {

    global $conn;

    $sql = "SELECT * FROM user WHERE username = '$username'";
            $result= mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if($num > 0){
                // echo "<script>alert('Username is already exist!')</script>";
                $_SESSION['status'] = "Username is already exist!";
                $_SESSION['status_code'] = "warning";
            }else {

                $sql = "INSERT INTO user(username, password, email, phone) 
                VALUES ('$username', '$password', '$email', '$phone')";

                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
                if($res) {
                    // echo "Successfully registered";
                    header("Location: login.php");
    
                }else{
                    echo 'Query error' . mysqli_error($conn);
                }
            }
}


//instructor login and sign up
function instructor_login($instructor_email, $instructor_password) {

    global $conn;

    $sql = "SELECT email, password, name 
    FROM instructor WHERE email = '$instructor_email' && password = '$instructor_password'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        // echo $email;
        if($count > 0){

            $_SESSION['instructor_email'] = $instructor_email;
            
            header('Location: dashboard/dashboard.php');
            // echo "Successfully logged in";
        }else {
            // echo '<script>alert("Invalid email or password")</script>'";
            $_SESSION['status'] = "Invalid Username or Password!";
            $_SESSION['status_code'] = "error";
            // header('location: login.php');
        }
}

function instructor_signup($instructor_name, $instructor_password, $instructor_email, $instructor_phone) {

    global $conn;

    $sql = "SELECT * FROM instructor WHERE email = '$instructor_email'";
            $result= mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($num > 0){
                
                echo "<script>alert('Email is already exist!')</script>";
            }else {
                
                $sql = "INSERT INTO instructor(name, password, email, phone) 
                VALUES ('$instructor_name', '$instructor_password', '$instructor_email', '$instructor_phone')";

                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($res) {
                    // echo "Successfully registered";
                    header("Location: login.php");
    
                }else{
                    echo 'Query error' . mysqli_error($conn);
                }
            }
}


//Admin Login
function admin_login($admin_username, $admin_password) {

    global $conn;

    $sql = "SELECT username, password FROM admin WHERE 
            username = '$admin_username' && password = '$admin_password'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        // echo $email;
        if($count > 0){

            $_SESSION['admin_username'] = $admin_username;
            
            header('Location: dashboard/index.php');
            // echo "Successfully logged in";
        }else {
            // echo '<script>alert("Invalid email or password")</script>'";
            $_SESSION['status'] = "Invalid Username or Password!";
            $_SESSION['status_code'] = "error";
            // header('location: login.php');
        }
}


function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

//cart function
function cart($course_id) {
    global $conn;
    if(isset($_GET['add_to_cart'])) {
        $user = $_SESSION['user'];
        $ip = getIPAddress();
        $get_course_id = $_GET['add_to_cart'];
        $sql = "SELECT course_id, ip_address, user_name 
        FROM cart_details WHERE ip_address = '$ip' AND course_id = '$get_course_id' AND user_name = '$user'";

        $result_query = mysqli_query($conn, $sql);
        // $cart = cart($get_course_id, $ip);
        $num_rows = mysqli_num_rows($result_query);
        
        if($num_rows > 0) {
            // $_SESSION['goto_cart'] = 'Go to cart';
            // echo "<script>alert('This item is already present in the cart!')</script>";
            $_SESSION['status'] = "This item is already present in the cart!";
            $_SESSION['status_code'] = "warning";

            // echo "<script>window.open('?course_id=$course_id', '_self')</script>"; 
        }else {
            $insert_query = "INSERT INTO cart_details (course_id, ip_address, user_name) 
            VALUES ($get_course_id, '$ip', '$user')";

            $result_query = mysqli_query($conn, $insert_query);
            if($result_query){
                // echo "<script>alert('Item is Successfully added to the cart.')</script>";
                $_SESSION['status'] = "Item is Successfully added to the cart.";
                $_SESSION['status_code'] = "success";

                // echo "<script>window.open('?course_id=$course_id', '_self')</script>"; 
            }
            // $name = 'Add to cart';
        }
        return $result_query;
    }
}

//count cart items
function cart_item() {
    global $conn;

    if(isset($_GET['add_to_cart'])) {
            $user = $_SESSION['user'];
            $ip = getIPAddress();
        //     $get_course_id = $_GET['add_to_cart'];
            $sql = "SELECT course_id, ip_address, user_name FROM cart_details 
            WHERE ip_address = '$ip' AND user_name = '$user'";

            $result_query = mysqli_query($conn, $sql);
            $count_cart_items = mysqli_num_rows($result_query);
    }else {
        $user = $_SESSION['user'];
        $ip = getIPAddress();
        //     $get_course_id = $_GET['add_to_cart'];
            $sql = "SELECT course_id, ip_address, user_name 
            FROM cart_details WHERE ip_address = '$ip' AND user_name = '$user'";

            $result_query = mysqli_query($conn, $sql);
            $count_cart_items = mysqli_num_rows($result_query);
    }

    return $count_cart_items;
}

function delete_cart_item($course_id) {
    global $conn;
    $sql = "DELETE FROM `cart_details` WHERE course_id = '$course_id'";

    $res = mysqli_query($conn, $sql);

    if($res)  {
        echo "<script>window.open('cart.php', '_self')</script>";
    }
    
    return $res;
}

?>
