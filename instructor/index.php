<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teach Now</title>
        
     <?php include("./links.inc.php"); ?>

</head>
<body>
    
  <?php include("./header.inc.php"); ?>

  <!-- //hero section -->
  <main class="container-fluid p-0 instructor">
    <div class="card text-bg-dark d-flex">
        <img src="https://img.freepik.com/free-photo/lifestyle-beauty-fashion-people-emotions-concept-young-asian-female-office-manager-ceo-with-pleased-expression-standing-white-background-smiling-with-arms-crossed-chest_1258-96634.jpg?w=1380&t=st=1664383862~exp=1664384462~hmac=2f9b88bde43b4bd5b8d1d155a71c219011c26e1609abb9a80ccc62c5bcd92587" class="card-img" alt="...">
        <div class="card-img-overlay">
            <h5 class="card-title fs-1 fw-bold">Come Teach with Us</h5>
            <p class="desc card-text fs-5 w-25">Become an instructor and change lives — including your own</p>
            <a class="btn btn-dark py-2 px-4 fw-bold" href="./login.php" role="button">Get Started</a>
        </div>
    </div>
  </main>

  <!-- //instructor facility -->
  <div class="container instructor-facility text-center my-5">
    <div class="row mb-5 pb-4">
      <h2 class="fw-bold fs-1">So many reasons to start</h2>
    </div>
    <div class="row ">
      <div class="col-md-4 ">
        <div class="">
          <img class="img-fluid icon" src="../assets/icons/abc.png" alt="image..">
          <h4 class="fs-5 fw-bold">Teach your way</h4>
          <p class="mx-5 fs-6 lh-base">Publish the course you want, in the way you want, and always have control of your own content.</p>
        </div>
      </div>
      <div class="col-md-4">
        <img class="img-fluid icon" src="../assets/icons/book.png" alt="image..">
        <h4 class="fs-5 fw-bold">Inspire learners</h4>
        <p class="mx-5 fs-6 lh-base">Teach what you know and help learners explore their interests, gain new skills, and advance their careers.</p>
      </div>
      <div class="col-md-4">
        <img class="img-fluid icon" src="../assets/icons/best-seller.png" alt="image..">
        <h4 class="fs-5 fw-bold">Get rewarded</h4>
        <p class="mx-5 fs-6 lh-base">Expand your professional network, build your expertise, and earn money on each paid enrollment.</p>
      </div>
    </div>
  </div>

<!-- by numbers section -->
<div class="container-fluid bg-primary text-light mt-4">
  <!-- <div class="container-md container-fluid m-5"> -->
    <div class="row text-center p-5">
      <div class="col-md-3">
        <h2 class="fw-bold fs-1 mb-0">10+</h2>
        <p class="">Students</p> 
      </div>
      <div class="col-md-3">
        <h2 class="fw-bold fs-1 mb-0">100+</h2>
        <p class="">Enrollements</p> 
      </div>
      <div class="col-md-3">
        <h2 class="fw-bold fs-1 mb-0">20+</h2>
        <p class="">Countries</p> 
      </div>
      <div class="col-md-3">
        <h2 class="fw-bold fs-1 mb-0">1000+</h2>
        <p class="">Courses</p> 
      </div>
    </div>
  <!-- </div> -->
</div>

<!-- instructor remember section -->
<div class="container-fluid instructor-remember" style="background-color: #EEEEEE;">
  <div class="container text-center my-5 py-4">
    <div class="row">
      <div class="col-12">
        <h5 class="fs-1 fw-bold p-1 instruct-heading">Become an instructor today</h5>
        <p class="fs-4 fw-normal" style="width: 40%; margin: 1.5rem auto 2.4rem;">Join one of the world’s largest online learning marketplaces.</p>
        <a class="btn btn-dark py-2 px-5 rounded-0 fw-bold fs-6" href="./login.php" role="button">Get Started</a>
      </div>
    </div>
  </div>
</div>


  <?php include('../inc/footer.inc.php') ?>


<!-- ===========link bootstrap============= -->
<script src="../assets/js/bootstrap.js" type="text/javascript"></script>


</body>
</html>