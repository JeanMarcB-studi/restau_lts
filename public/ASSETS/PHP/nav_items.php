<?php

$mainMenu = [
  'index.php' => 'Accueil',
  'carte.php' => 'notre Carte',
  'menus.php' => 'nos Menus',
  'booking.php' => 'RESERVER'
];
    
foreach ($mainMenu as $file=>$title)
{
  // Does the menu item correspond to the current page shown?
  $is_active = ($file === basename($_SERVER["SCRIPT_NAME"]));

  if ($title === 'RESERVER'){
    if ($is_active){
      $classMenu = 'myActive';
      $file = "#";
    } else {
      $classMenu = 'bton d-block myBtonBook';      
    }
    
  } else {
    if ($is_active){
      $classMenu = 'myActive';
      $file = "#";
    } else {
      $classMenu = 'myMenu ';
      //$file = basename($_SERVER["SCRIPT_NAME"]);
    }    
  }

?>

  <li class="nav-item mb-1">
    <a class="nav-link px-2 pb-2 mx-lg-2 <?= $classMenu ?>" id="<?=$title;?>" href="<?=$file;?>">
    <?=$title;?>
    </a>
  </li>
 
<?php
}

?>

<!-- NOT TO BE USED FOR THE MOMENT, maybe in the future 
<a class="nav-link myBtonConnect p-0 px-1 m-sm-2 mx-sm-3 " id="menus" href="menus.php">
  <span class="bi bi-person-fill">
    </span>                    
  </a>
-->
                  