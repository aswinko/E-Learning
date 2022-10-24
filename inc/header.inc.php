<?php
  include_once("./config/functions.php");
  include("./config/db_connect.php");
  // include("./config/db_connect.php");
  // include("./config/db_connect.php");
  // require_once(__DIR__."/config/db_connect.php");

  // if(isset($_GET['category_id'])) { 
      // $select_category_query = "SELECT category_id, category_name FROM category";
      // $result_category = mysqli_query($conn, $select_category_query); 
      // $category = mysqli_fetch_all($result_category, MYSQLI_ASSOC);

      //fetch the resulting rows as an array
      $show_category = show_category();
      $category = mysqli_fetch_all($show_category, MYSQLI_ASSOC);

      
      // echo $fetch_profile['profile_img'];

      // mysqli_free_result($insert_category);
      // mysqli_close($conn);
  // }

//   if(isset($_GET['category_id'])) {
//     $category_id = $_GET['category_id']; 
//     $select_category_query = "SELECT category_id, category_name FROM category";
//     $result_category = mysqli_query($conn, $select_category_query); 
//     $category = mysqli_fetch_all($result_category, MYSQLI_ASSOC);
//     mysqli_free_result($result_category);
//     mysqli_close($conn);
// }

?>






<!-- ============================Nav section starts====================================  -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand ps-4 heading" href="./index.php">E Learning</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <form class="search-field d-flex me-auto mb-2 mb-lg-0 mx-auto" action="search.php" method="get">
            <input
              class="form-control"
              type="search"
              name="search_data"
              placeholder="Search for course"
              aria-label="Search"
            />
            <button class="search-btn" type="submit" name="search_submit" value="search"><i class="bi bi-search"></i></button>
            <!-- <button class="btn btn-outline-success form-btn" type="submit">Search</button> -->
          </form>

          <ul class="navbar-nav d-flex pe-0 m-2">
            
            <li class="nav-item">
              <a class="nav-link active nav-field" aria-current="page" href="index.php">
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-field" aria-current="page" href="./instructor/" target="_blank">
                Instructor
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-field" style="color: #000;" href="all_courses.php">
                Courses
              </a>
            </li>
            <li class="nav-item pe-1">
                <div class="dropdown nav-field">
                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Categories
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-md-start pe-4 me-4">
                    
                  <!-- Category  -->
                    <?php if($category): ?>
                        <?php foreach($category as $categories): ?>
                          <li><a class="dropdown-item" href="category?category_id=<?php echo htmlspecialchars($categories['category_id']); ?>&category_name=<?php echo htmlspecialchars($categories['category_name']); ?>"><?php echo htmlspecialchars($categories['category_name']); ?></a></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                      <li><a class="dropdown-item" href="#"></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
            </li>
          
            <?php  if(isset($_SESSION['user']) && $_SESSION['user'] == true ): ?>

              <?php
                $username = $_SESSION['user'];
                $profile_query = "SELECT * FROM user Where username = '$username'";
                $profile_res = mysqli_query($conn, $profile_query);
                $fetch_profile = mysqli_fetch_assoc($profile_res);
                $profile_img = $fetch_profile['profile_img'];  
              ?>

              <li class="nav-item">
                <div class="dropdown nav-field ">
                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <!-- <i class="bi bi-person-circle text-dark fs-4"></i>  -->
                    <img class="rounded-circle" src="<?php $profile_img !== null ? print './admin/course_resourses/' . $profile_img : print './assets/img/user.png' ?>" alt="..." style="width: 45px; height: 45px; object-fit: cover;" >
                    Profile
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-md-start">
                    <li><a class="dropdown-item my-2" href="./user_account/profile.php">My Account</a></li>
                    <li><a class="dropdown-item mb-2" href="./user_account/my_courses.php">My Courses</a></li>
                    <li><a class="dropdown-item mb-2" href="./cart.php">My Cart</a></li>
                    <li class="bg-danger"><a class="dropdown-item bg-danger text-light" href="./user_account/logout.inc.php">Logout</a></li>
                    <!-- <li><a class="dropdown-item" href="#">Menu item</a></li> -->
                  </ul>
                </div>
              </li>
            <!-- <li class="nav-item"></li>
            <li class="nav-item"></li> -->

            <?php else: ?>
                <li class="nav-item ">
                  <a href="login.php" class="login btn btn-outline-primary rounded-pill nav-field">Login</a>
                </li>
                <li class="nav-item ms-2 p-2">
                  <a href="signup.php" class="signup btn btn-outline-primary rounded-pill nav-field">Signup</a>
                </li>
            <?php endif; ?>
            <li class="nav-item ps-2">
              <a class="nav-field fs-4" href="cart.php">
                <i class="bi bi-cart3 text-dark fw-bold"></i>
                <?php  if(isset($_SESSION['user']) && $_SESSION['user'] == true ): ?>
                  

                  
                  <?php if(cart_item() > 0): ?>
                    <p class="cart-number text-white mb-1 text-center rounded-circle bg-primary text-dark fs-6"><?php echo cart_item(); ?></p>
                  <?php endif; ?>
                  
                <?php else: ?>
                  
                <?php endif; ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- /* ============================Nav section ends==================================== */ -->
