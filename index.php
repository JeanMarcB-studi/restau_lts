<?php 
  $current = "accueil";
  $title = "Restaurant Quai Antique";
  $descr = "Soyez les bienvenus sur le site de notre Restaurant Quai Antique";
  
  require_once 'ASSETS/PHP/main_header.php';
?>


<!-- -----------------------   M A I N  CONTENT   ----------------  -->
<main>


<div class="myImages">
  <img src="ASSETS/data/homeRoom.jpg" class="myImages" alt="" srcset="">
</div>



<article class="container-fluid container-lg mb-3 p-sm-3 g-0">
  <div class="row justify-content-center w-100 g-0 p-2">
        
    <div class="col-12 col-sm p-5">
      <h1 class="mb-2 mb-sm-5">
        Bienvenue au Quai Antique
      </h1>
      <div class="w-sm-50  m-auto">
        Le Chef asiatique Arno Mi-Chang est un passionné des produits et des producteurs de la Savoie. C’est pourquoi il a choisi d’ouvrir son troisième restaurant dans ce département. <br><br>
        Le Quai Antique est l’endroit idéal pour découvrir la richesse de la gastronomie savoyarde, entièrement revisitée. Venez vivre une expérience culinaire inoubliable dans un cadre chaleureux et convivial.
      </div>
    </div>
    
    <div class="col-12 col-sm align-self-center">
      <div class="card myContainer myStickers  m-auto">
        <img src="ASSETS/data/homeChief.jpg" class="myImages w-100" alt="" srcset="">
      </div>
    </div>
    
  </div>
</article>

<div class="my-divider my-4"></div>

<!--       
  Plus encore que ses deux autres restaurants, Le Quai Antique est la promesse d’un voyage dans l’univers culinaire du Chef Michant. Sa passion pour les produits locaux et sa maîtrise des techniques culinaires se reflètent dans chaque plat.
  
  Le Quai Antique, vous invite à découvrir une expérience gastronomique unique, à travers une cuisine sans artifice.
  Au déjeuner comme au dîner, vous pourrez déguster des créations originales et savoureuses, élaborées à partir des meilleurs ingrédients de la région. Le Chef Michant travaille en étroite collaboration avec les producteurs locaux pour vous offrir une cuisine authentique revisitée et de qualité.
  
    
  Nous vous attendons avec impatience pour vous faire découvrir les saveurs de la Savoie à travers la cuisine du Chef Arno Mi-Chang. -->
  
  <!-- <div>
    <img src="ASSETS/data/homeChief.jpg" class="myImages" alt="" srcset="">
  </div>  -->
  
  <article class="container-fluid">
    
    <div class="row justify-content-center">
      <div class="col-12 col-sm-9 col-lg-6 px-5  ">
      
      <h2 class="mt-0 mb-2">
        Au déjeuner comme au dîner...
      </h2>
      <p>
      Le Chef Mi-Chang travaille en étroite collaboration avec les producteurs locaux. Vous pourrez déguster chez nous des créations originales et savoureuses, élaborées à partir des meilleurs ingrédients de la région. 
      </p>
      </div>
    </div>
  
  <div class="row justify-content-center">
    
    <div class="col-12 col-sm-6 col-xl-4 p-3 myStickers">
      <div class="card myContainer">
        <img src="ASSETS/data/sp1.jpg" class="myImages">
        <div class="myOverlay">
          <div class="myTextImg">Sa célèbre fondue savoyarde entièrement revisitée</div>
        </div>
      </div>
    </div>
    
  <div class="col-12 col-sm-6 col-xl-4 p-3 myStickers">
    <div class="card myContainer">
      <img src="ASSETS/data/sp2.jpg" class="myImages">
      <div class="myOverlay">
        <div class="myTextImg">Une délicieuse raclette transformée par les soins du Chef</div>
      </div>
    </div>
  </div>
  
  <div class="col-12 col-sm-6 col-xl-4 p-3 myStickers">
    <div class="card myContainer">
      <img src="ASSETS/data/sp3.jpg" class="myImages">
      <div class="myOverlay">
        <div class="myTextImg">Un vin blanc de savoie aux senteurs exotiques de litchi.</div>
      </div>
    </div>
  </div>
  
</div>
</article>

<div class="my-divider my-4"></div>

<article class="container-fluid">

  <div class="row justify-content-center">
    <div class="col-12 col-sm-9 col-lg-6 px-5  ">
      
      <h2 class="mt-0 mb-2">
        Mieux vaut réserver...
      </h2>
      <p>      
      Attention, notre succès ne se dément pas et les places sont limitées ! Aussi, pensez à réserver dès maintenant pour être sûr de pouvoir profiter de cette expérience gastronomique unique. 
      </p>
    </div>
  </div>

  <div class="row justify-content-center ">
    <div class="col text-center py-0">        
      <!-- <a class="nav-link ps-2 pe-0 p-sm-2 mx-lg-3 myBtonBook" href="booking.php"> -->
      <a class="bton nav-link d-block p-2 myBtonBook mx-auto" href="booking.php" role="button">
        RESERVER
      </a>
    </div>
  </div>      

  <div class="row justify-content-center">
    <div class="col-12 col-sm-9 col-lg-6 py-5 align-self-center myStickers">
      <img src="ASSETS/IMG/logo.png" class="myImages w-100" alt="" srcset="">
    </div>
  </div>

</article>

</main>
<!-- -----------------------   END MAIN  CONTENT   ----------------  -->


<!-- -----------------------    F O O T E R        ----------------  -->
<!-- -----------------------    end  FOOTER        ----------------  -->

<?php require_once "ASSETS/PHP/main_footer.php"; ?>