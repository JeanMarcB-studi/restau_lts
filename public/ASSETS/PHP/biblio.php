<?php

//declare (strict_types = 1); // oblige à respecter type/ funct

// CONSTANT
const BR = '<br>';
const PATH_CAROUSEL = './IMG/carroussel/';
const PATH_POSTERS = './IMG/posters/';
// const MOIS = ["ERR","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];

// CONVERT 'YYYY-MM-DD' into French Date
function cvDateFr(string $dateEN): string
{
  $t1 = strpos($dateEN, "-");
  if ($t1)
  {
    // $t2 = strpos($dateEN, "-", $t1 + 1);
    // $t3 = strlen($dateEN);
    // $d = (int)substr($dateEN, $t2 + 1, $t3 -$t2+1);
    // $m = (int)substr($dateEN, $t1 + 1, $t2 - $t1);
    // $a = substr($dateEN, 0, $t1);
    // $dateFR = "$d ".MOIS[$m]." $a";
    
    $dateFR = new IntlDateFormatter('fr_FR',IntlDateFormatter::NONE,IntlDateFormatter::NONE);
    $dateFR->setPattern('EEEE dd MMMM YYYY');
    return $dateFR->format(new DateTime($dateEN));

    // return $dateFR;
  }
  return '';
}


//SHOW IMAGES FOR CAROUSEL
function imagesCarousel(){
  $imgs = scandir (PATH_CAROUSEL);
  $li = '';
    foreach ($imgs as $img){
      if (!is_dir($img)){
        //echo "image : $img"."<br>";
        if ($li ===''){
          $li = "<div class='carousel-item active'>\n";
        } else
        {
          $li.= "<div class='carousel-item'>\n";
        }
        $li.= "\t<img src='".PATH_CAROUSEL."$img' class='d-block w-100' alt='photo spectacle théâtre Jean-Marc Boutaud'>\n";
        $li.= "</div>\n";

        //echo "<xmp>".$li."</xmp><br>"; 
      }
    }
    return($li);
}

//SHOW IMAGES FOR GALERY
function imagesGalery($dir){
  $imgs = scandir ("./IMG/$dir");
  $li = '';
  foreach ($imgs as $img){
    if (!is_dir($img) && ($img !='POSTER.jpg')){
      $li.= "\t <div class='col-12 col-sm-6 col-xl-4 p-1 myStickers myInnerImg'> \n";
      $li.= "\t\t <a href='IMG/$dir/$img' target='_blank' rel='noopener noreferrer'> \n";
      $li.= "\t\t\t <img src='IMG/$dir/$img' class='w-100' alt='photo spectacle théâtre Jean-Marc Boutaud'> \n";
      $li.= "\t\t </a> \n";
      $li.= "\t </div> \n";
    }
  }
  return($li);
}

//SHOW POSTERS
function imagesPosters(){
  $imgs = scandir (PATH_POSTERS);
  sort($imgs);
  
  $li = '';

  foreach ($imgs as $img){
    if (!is_dir($img)){
      $t = strpos($img, '.');
      // echo "t: $t ".BR;
      if ($t){
        // -------- nouvelle affiche -----------
        $li .= "
        <article class='container-md myWidth my-0'>
          <h2 class ='h1'>Nouveau, à l'affiche :</h2>
        </article>
        ";
        
        //prepare Dates
        $myPoster = PATH_POSTERS.$img;
        $enDate = substr($img , 0, $t);
        $myDate = cvDateFr($enDate);
        
        // calculate Nb days to wait
        $today = new DateTime();
        $future = new DateTime($enDate);
        $diff = $future->diff($today)->format("%a");
        if ($diff>0) {
          $wait ="<div class='w-75 mx-auto'>Encore $diff jours à patienter, venez nombreux !</div>";
        }
        
        $li .= "
        <article class='container-fluid my-5 w-100 text-center g-0'>
          <h2 class='myYellow w-75 mx-auto'>$myDate</h2>
          <h3 class='w-75 mx-auto'>Aubagne - Cercle de l'Harmonie</h3>
          <div class='container-md my-4 myWidthSmall g-0'>
            <img src='$myPoster' alt='Affiche du prochain spectacle le $myDate' class ='w-100' srcset=''>
          </div>
          $wait
        </article>
        <br>
        ";
      }
    };
  }
  return($li);
}
/*
 <!-- AFFICHE OF 16 DEC 2022 -->
  <article class="container-fluid my-5 w-100 text-center g-0">
    <h2 class="myYellow w-75 mx-auto">16 Décembre 2022</h2>
    <h3 class="w-75 mx-auto">Aubagne - Cercle de l'Harmonie</h3>
    
    <div class="container-md my-4 myWidthSmall g-0">
      <img src="IMG/Affiche-2022-12-16.jpg" alt="notre affiche" class ="w-100" srcset="">
    </div>
  </article>
  */