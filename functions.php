<?php

function sanitizeGlobals(){
  $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING); //Sanitize and Filter as data passes through $_GET Array.
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //Sanitize and filter as data passes through $_POST Array.
}

function itemNumberGenerator(){
  // Generate random number 5 digits long, pads the left with 0's if need be. 
  $itemNumber = str_pad(mt_rand(0,99999), 5, 0, STR_PAD_LEFT);
 return $itemNumber;
}

//Create data to be INSERT into tables in MySQL
function createData($tableName, $tableColumn, $formData, $dataBaseConnect){

  //Implodes the array that holds table column names that match column names in sql
  //Implodes the array that's holding form data to be used as data in MySQl table
  $columnName = implode(", ", $tableColumn);
  $rowValue  = implode("', '", $formData);
  
  
  //As each array is divided by , it fits an insert statement
  $sqlQuery = "INSERT INTO $tableName ($columnName) VALUES ('$rowValue');";

  echo $sqlQuery;

  //prepares query 
  $preparedQuery = $dataBaseConnect->prepare($sqlQuery);

  // executes query
  $success = $preparedQuery->execute();
}

function readData($dataBaseConnect, $tableName){

  //Performs a select query to get everything out of the table
  $sqlQuery = "SELECT * FROM $tableName;";
  $returnedQuery = $dataBaseConnect->query($sqlQuery);
  //Empty Array Declared
  $tableData = [];

  $returnedQuery->execute();

    //Creates rows out of the data and makes an associative array
    while($row = $returnedQuery->fetch(PDO::FETCH_ASSOC)){

      //array gets filled up
      $tableData[] = $row;
    }
    
    //Returns an array
  return $tableData;
}

function updateData($dataBaseConnect, $tableName, $formData, $tableColumn, $idKey, $idValue){
  //Combines two arrays into one associative array
  $keyValueArray =  array_combine($tableColumn, $formData );

  //Creates MySql syntax for an update
  foreach($keyValueArray as $key => $value){
    $value = "'$value'";
    $arrayToSplit[] = "$key = $value";
  }

  //Splits the array at a , so multiple updates can all happen at the same time
  $updateArray = implode(', ', $arrayToSplit);

  $sqlQuery = "UPDATE $tableName SET $updateArray WHERE $idKey = $idValue;";

    //prepares query 
    $preparedQuery = $dataBaseConnect->prepare($sqlQuery);

    // executes query
    $success = $preparedQuery->execute();
}

function deleteData($dataBaseConnect, $tableName, $idKey, $idValue){

  //Sql Query is written
  $sqlQuery = "DELETE FROM $tableName WHERE $idKey = $idValue;";

  //prepares query
  $preparedQuery = $dataBaseConnect->prepare($sqlQuery);

  //executes query
  $success = $preparedQuery->execute();
}

//Finds a single row in the array created by the tables. 
function getData($dataArray, $dataID, $dataKey){

  //searches array for keys that match the id
  $return = array_search($dataID, array_column($dataArray, $dataKey)); 
  if($productID >= 0){
    //returns array with matches
    return $dataArray[$return];
  }
  else return null;
}

function checkLogin(){
  function checkLogin(){


  if (isset($_POST["login"]) && !isset($_SESSION["login"])){
      //This is the user login that can be used to login
      $logins = [
          "admin" => "123456",
          "jordon" => "jensen",
          "pablo" => "escobar",
          "julio" => "isSick"
      ];
  }

  $password = $_POST["password"];

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);


  // Checking if it is okay
  if (isset($logins[$_POST["login"]])){
      if ($logins[$_POST["login"]] == password_verify($password, $hashed_password)){
          $_SESSION["login"] = $_POST["login"];
      }
  }

  //Redirecting when signed in
  if (isset($_SESSION["login"])){
      header("Location: main.php");
  }
}
?>
