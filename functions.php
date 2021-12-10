<?php



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
  $sqlQuery = "SELECT * FROM $tableName;";
  $returnedQuery = $dataBaseConnect->query($sqlQuery);
  $tableData = [];

  $returnedQuery->execute();

    while($row = $returnedQuery->fetch(PDO::FETCH_ASSOC)){
      $tableData[] = $row;
    }
 
  return $tableData;
}

function updateData($dataBaseConnect, $tableName, $dataArray, $idKey, $idValue){
   //Implodes the array that holds table column names that match column names in sql
  //Implodes the array that's holding form data to be used as data in MySQl table


  $sqlQuery = "UPDATE $tableName SET $columnName = '$rowValue' WHERE $idKey = $idValue;";

    //prepares query 
    $preparedQuery = $dataBaseConnect->prepare($sqlQuery);

    // executes query
    $success = $preparedQuery->execute();
    if($success){

      echo "you did it!";
    }
    else{
      echo "didnt work!<br><br>";
      echo $sqlQuery;
    }
}

function getData($dataArray, $dataID, $dataKey){
  $return = array_search($dataID, array_column($dataArray, $dataKey)); 
  if($productID >= 0){
    return $dataArray[$return];
  }
  else return null;
}
?>