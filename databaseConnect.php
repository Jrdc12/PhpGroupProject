<?php
    $db_info = 'mysql:host=127.0.0.1;dbname=f1740151_assignment4';
    $username = 'f1740151';
    $password = 'Archer1422';

    try{
      $db_connect = new PDO($db_info, $username, $password);
    }catch(PDOException $e){
      $error_message = $e->getMessage();
      echo "PDO Database not connected: Error: " . $error_message . "<br>";
      exit();
    }
?>