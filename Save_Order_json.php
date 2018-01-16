<?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $inp = file_get_contents('orders.json');
     $tempArray = json_decode($inp, true);
     
      array_push( $tempArray ['orders'], $_POST['neworder'][0]);
    $jsonData = json_encode($tempArray);
    
    if (json_decode($jsonData) != null)
          {
    $fp = fopen('orders.json', 'w');
     fwrite($fp, $jsonData);
  fclose($fp);
          }
     
  }
