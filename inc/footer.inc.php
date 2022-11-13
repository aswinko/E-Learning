<footer class="container-fluid  text-center text-muted" style="background: #222831;">  
  <div class="container">
    <div class="row pt-4">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="">
          <h4 class="text-light">E learning</h4>
          <ul>
            <li>
              <span>Tech support:</span>
              <a href="tel:+91 5678965320" class="btn text-muted">+91 5678965320</a>
            </li>
            <li>
              <span>Email:</span>
              &nbsp;aswinko479@gmail.com
            </li>
            <li>
              <span>Address:</span>
              india
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
          <div>
              <h3 class="text-light">Information</h3>
              <ul class="custom-links">
                <li><a href="about.html" class="btn text-muted">About Us</a></li>
                <li><a href="terms-conditions.html" class="btn py-0 text-muted">Terms & Conditions</a></li>
                <li><a href="privacy-policy.html" class="btn py-0 text-muted">Privacy Policy</a></li>
                <li><a href="privacy-policy.html" class="btn py-0 text-muted">Refund Policy</a></li>
                <li><a href="terms-conditions.html" class="btn py-0 text-muted">Cookie Policy</a></li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Copyright -->
  <div class="container-fluid text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="">Aswin K.O</a>
  </div>
  <!-- Copyright -->
</footer>






<!-- Compiled and minified JavaScript -->
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>

<script type='text/javascript'>
    $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>


<!-- ===========link bootstrap============= -->
<script src="assets/js/bootstrap.js" type="text/javascript"></script>

<!-- ================= carousel ================ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>


<!-- ==================== sweet alert =============================  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
?>
    <script>
        swal({
            title: "<?php echo htmlspecialchars($_SESSION['status']); ?>",
            // text: "",
            icon: "<?php echo htmlspecialchars($_SESSION['status_code']); ?>",
            button: "Done",
    });
    </script>
<?php
        unset($_SESSION['status']);
    }

?>