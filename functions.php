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
  $rowValue  = implode(", ", $formData);
  
  //As each array is divided by , it fits an insert statement
  $sqlQuery = "INSERT INTO $tableName ($columnName) VALUES ($rowValue);";

  echo $sqlQuery;

  //prepares query 
  $preparedQuery = $dataBaseConnect->prepare($sqlQuery);

  // executes query
  $success = $preparedQuery->execute();

  if($success){
    echo "Yea did it!";
  }else{
    echo" yea didnt do it!";
  }
}

  function readData($dataBaseConnect, $tableName){
    $sqlQuery = "SELECT * FROM $tableName;";
    $returnedQuery = $dataBaseConnect->query($sqlQuery);
    $tableData = [];

    $returnedQuery->execute();

    // $success = $returnedQuery->fetchAll(PDO::FETCH_ASSOC);
  
    
      while($row = $returnedQuery->fetch(PDO::FETCH_ASSOC)){

        $tableData[] = $row;
    //     // echo"Guitar Name: " . $row["guitar_name"] . "<br>" .
    //     //     "Guitar ID: " . $row["guitar_id"] . "<br>" . 
    //     //     "Guitar Year: " . $row["guitar_year"] . "<br>" . 
    //     //     "Guitar Wood: " . $row["guitar_wood"] . "<br>"; 
      }
   
    return $tableData;
  }

?>