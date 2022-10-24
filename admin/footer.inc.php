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