<!DOCTYPE html>
<html lang="fr">
  
<!-- ---------------------- T H E    H  E  A  D--------------------- -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="_bootstrap/bootstrap.css"> -->
  
  <!-- myCSS -->
  <link rel="stylesheet" href="ASSETS/CSS/style.css">
  <link rel="stylesheet" href="ASSETS/CSS/animate.css">

  
  <title><?= $title ?></title>
  <meta name="description" content= "<?= $descr ?>">
  <!-- <link rel="shortcut icon" type="image/x-icon" href="icon.png"> -->
</head>
<!-- ---------------------- END  OF  H  E  A  D--------------------- -->

<body>
  
  <!-- BIBLIOTHEQUE-------- -->
  <?php require_once "ASSETS/PHP/biblio.php"; ?>
  
<!-- ---------------------- H  E  A  D  E  R ---------------------- -->

<header class="myHead">
  <div class="container-fluid myHeader g-0">
  
    <!-- H E A D E R -->
    <div class="row align-items-center w-100 p-0 g-0">
      
      <!-- 1 )  LOGO & TITLE -->
      <div class="col-5 col-sm-4 h-100 my-3">
          <!-- logo -->
          <span class="d-block p-0">
            <a href="index.php">
              <div class="img myLogo m-auto p-0">
              </div>            
            </a>              
          </span>
          <!-- title -->
          <span class="d-block p-1">
            <div class = "myRestau text-center">
              RESTAURANT
            </div>       
            <div class="myTitle text-center " >
              Quai Antique
            </div>
          </span>
      </div>
    
      <!-- 2 )  NAVIGATION MENU  -->
      <div class="col-7 col-sm-8 m-0 p-0">
        <!-- NAVIGATION BAR -->
        <nav class="navbar navbar-expand-sm navbar-dark p-0 my-0">
          <div class="container-fluid p-0 p-sm-5">
            
            <!-- B U T T O N  on MOBILE -->
            <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation" id="btonCollapse">
              <span class="navbar-toggler-icon ">
              </span>
            </button>
            
            <!-- M E N U ITEMS -->
            <nav class="ms-auto m-0 my-6 p-0">
              <div class="collapse navbar-collapse p-0" id="myNavbar">
                <ul class="navbar-nav mx-2 align-items-center justify-content-center">

                  <!-- GET MENUS FROM SUB MODULE -->
                  <?php require "nav_items.php" ?>
                
                </ul>
              </div>
            </nav>
          </div>
        </nav>
      </div>
    </div>
  </div> 
</header>

<!-- add some space here because the Header curtain effect -->
<div class="myBlock">  
</div>


<!-- ---------------------- END  H  E  A  D  E  R ----------------- -->
