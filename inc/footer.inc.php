<footer class="container-fluid bg-dark text-secondary text-center">  
  <div class="container">
    <div class="row pt-4">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div>
          <h4>E learning</h4>
          <ul>
                <li>
                  <span>Tech support:</span>
                  <a href="tel:+91 5678965320">+91 5678965320</a>
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
              <h3>Information</h3>
              <ul class="custom-links">
                <li><a href="about.html">About Us</a></li>
                <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                <li><a href="privacy-policy.html">Refund Policy</a></li>
                <li><a href="terms-conditions.html">Cookie Policy</a></li>
              </ul>
          </div>
      </div>

      <!-- <div class="col-lg-4 col-md-4 col-sm-12">
          <div>
              <h3>Information</h3>
              <ul class="custom-links">
                <li><a href="about.html">About Us</a></li>
                <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                <li><a href="privacy-policy.html">Refund Policy</a></li>
                <li><a href="terms-conditions.html">Cookie Policy</a></li>
              </ul>
          </div>
      </div> -->
    </div>
  </div>
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