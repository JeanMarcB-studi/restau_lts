
<?php

$open_hour = [
["day_num" => 0, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 20, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50],
["day_num" => 1, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 30, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50],
["day_num" => 2, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 50, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50],
["day_num" => 3, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 50, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50],
["day_num" => 5, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 50, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50],
["day_num" => 6, "lunch_start" => '12:00', "lunch_end" => '14:00', "lunch_max" => 50, "dinner_start" => '19:30', "dinner_end" => '23:00', "dinner_max" => 50]
];

$week_day = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];



$old_day = 1;
$init_days = '';
$init_hours ='';

foreach($open_hour as $key => $line) { 
  $day_num =  $line["day_num"];
  $previous = $day_num - 1;
  
  // if previous day not found -> show the closing day
  if ($previous != $old_day && ($day_num > 0))  {
    if ($init_days != '') {
      
      echo $init_days." - ".$init_hours.'<br>';
      $init_days = '';
      $init_hours = '';
    }

    echo $week_day[$previous]." : fermé<br>";
  } 

  $day = "$week_day[$day_num]";
  $hours ='';
  if ($line['lunch_max'] != 0){
    $hours= $line['lunch_start']." - ".$line['lunch_end'];
  }
  if ($line['dinner_max'] != 0){
    $hours .= ($hours != '') ? ' et ' : '';
    $hours .= $line['dinner_start']." à ".$line['dinner_end'];
  }

  if ($init_days != '') {
    if ($hours === $init_hours) {
      //here we have a new day with same opening hours, we add it to the list
      $init_days .= ($init_days != '') ? ', ' : '';
      $init_days .= $day;
    } else {
      //changing hours, time to publish the previous ones
      echo $init_days. " - " . $init_hours.'<br>';
      $init_days = $day;
      $init_hours = $hours;
    }
  } else {
    // init_days empty, I create it
    $init_days = $day;
    $init_hours = $hours;
  }
  $old_day = $day_num;
}

if ($init_days != '') {
  //end of the list - still to publish
  if ($init_days === 'Sam, Dim') {$init_days = 'Week-End';}
  echo $init_days." - ".$init_hours.'<br>';
}
?>