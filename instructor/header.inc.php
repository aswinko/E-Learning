<?php

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand ps-4 heading" href="../index.php">E Learning</a>
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
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

          <ul class="navbar-nav d-flex pe-0 m-2">
            
            <li class="nav-item px-3">
              <a class="nav-link active nav-field" aria-current="page" href="index.php">
                Home
              </a>
            </li>
            <li class="nav-item px-3">
              <a class="nav-link nav-field" style="color: #000;" href="../">
                Student
              </a>
            </li>
            
          
            <?php  if(isset($_SESSION['instructor_email']) && $_SESSION['instructor_email'] == true ): ?>
              <!-- <li class="nav-item">
                <div class="dropdown nav-field">
                  <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <i class="bi bi-person-circle text-dark fs-4"></i> Profile
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-md-start">
                    <li><a class="dropdown-item" href="./dashboard/">Dashboard</a></li>
                    <li class="bg-danger"><a class="dropdown-item bg-danger text-light" href="./dashboard/logout.php">Logout</a></li>
                    
                  </ul>
                </div>
              </li> -->
              <!-- <li class="nav-item"></li>
              <li class="nav-item"></li> -->
                <li class="nav-item ">
                  <a class="nav-link active nav-field" aria-current="page" href="./dashboard/">Dashboard</a>  
                </li>

            <?php else: ?>
                <li class="nav-item ">
                  <a href="login.php" class="login btn btn-outline-primary rounded-pill nav-field">Login</a>
                </li>
                <li class="nav-item ms-2 p-2">
                  <a href="signup.php" class="signup btn btn-outline-primary rounded-pill nav-field">Signup</a>
                </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>