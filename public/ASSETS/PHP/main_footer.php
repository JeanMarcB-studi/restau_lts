</body>
<!-- ........................ THIS IS THE END :o) ............................... -->

<article class="container-fluid">

  <div class="row justify-content-center">
    <div class="col-12 col-sm-9 col-lg-6 px-5  ">
      
      <h2 class="mt-0 mb-2 text-center ">
        Horaires d'ouverture :
      </h2>

      <p class="text-center py-2 mySecondBackColor">      
        <?php  include "ASSETS/PHP/show_open_hours.php"; ?>
      </p>
    </div>
  </div>

</article>



<!-- In order to show the current page on Header Menu -->
<?php echo '<script>', "let currentPage = '$current'",'</script>'; ?>
<script src="ASSETS/JVS/script.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>