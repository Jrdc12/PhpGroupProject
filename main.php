<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <meta name="description" content="assingment4">
    <meta name="author" content="Benjamin Sarras">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styling.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php 
session_start();
require('databaseConnect.php');
require('functions.php');

//-----------------------------Client Variables and Logic
$clientTable = 'clients';
$dataFromTable = readData($db_connect, $clientTable);

$clientTableColumn = array('clientID', 'companyName', 'businessNumber', 'clientFirstName', 'clientLastName', 'phoneNumber', 'cellNumber', 'carriers', 'hstNumber', 'website', 'status');

//Variables to be filled from form
$id = '';
$companyName = '';
$businessNumber = '';
$firstName = '';
$lastName = '';
$phoneNumber = '';
$cellNumber = '';
$carriers = '';
$hstNumber = '';
$website = '';
$status = '';


//Data posted from form to create Data

if(isset($_POST['submit'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $companyName = $_POST['companyName'];
    $businessNumber = $_POST['businessNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $cellNumber = $_POST['cellNumber'];
    $carriers = $_POST['carriers'];
    $hstNumber = $_POST['hstNumber'];
    $website = $_POST['website'];
    $status = $_POST['status'];

    $rowData =  array(itemNumberGenerator(), $companyName, $businessNumber, $firstName, $lastName, $phoneNumber, $cellNumber, $carriers, $hstNumber, $website, $status);

    createData($clientTable, $clientTableColumn, $rowData, $db_connect);

    //Refresh page to update the table with all info. 
    echo "<meta http-equiv='refresh' content='0'>";
  }           
}

//Data used to delete out of table
if(isset($_POST['delete'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    deleteData($db_connect, $clientTable, 'clientID', $id);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}


//------------------------Notification Manager variables and logic 
$notifyTable = 'notificationManager';
$notifyData = readData($db_connect, $notifyTable);

$notifyColumn = array('notificationID', 'notifyName', 'notifyType', 'notifyStatus');

$notifyID = '';
$notifyName = '';
$notifyType = '';
$notifyStatus = '';

if(isset($_POST['submit2'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $notifyName = $_POST['notifyName'];
    $notifyType = $_POST['notifyType'];
    $notifyStatus = $_POST['notifyStatus'];

    $notifyData =  array(itemNumberGenerator(), $notifyName, $notifyType, $notifyStatus);

    createData($notifyTable, $notifyColumn, $notifyData, $db_connect);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

//Data used to delete out of table
if(isset($_POST['delete2'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $notifyID = $_POST['notifyID'];
    deleteData($db_connect, $notifyTable, 'notificationID', $notifyID);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}
//-----------------------------Client's Notification Manager variables and logic
$clientNotifyTable = 'clientNotification';
$clientNotifyData = readData($db_connect, $clientNotifyTable);

$clientNotifyColumn = array('clientNotifyID', 'client', 'notification', 'startTime', 'frequency', 'status');

$clientNotifyID = '';
$client = '';
$notification = '';
$startTime = '';
$frequency = '';
$status = '';

if(isset($_POST['submit3'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $client = $_POST['client'];
    $notification = $_POST['notification'];
    $startTime = $_POST['startTime'];
    $frequency = $_POST['frequency'];
    $clientStatus = $_POST['clientStatus'];

    $clientNotifyData = array(itemNumberGenerator(), $client, $notification, $startTime, $frequency, $clientStatus);

    createData($clientNotifyTable, $clientNotifyColumn, $clientNotifyData, $db_connect);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

if(isset($_POST['delete3'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $clientNotifyID = $_POST['clientNotifyID'];
    deleteData($db_connect, $clientNotifyTable, 'clientNotifyID', $clientNotifyID);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

//---------------------------Employee Variables and Logic

$employeeTable = 'employee';
$employeeData = readData($db_connect, $employeeTable);

$employeeColumn = array('employeeID', 'firstName', 'lastName', 'email', 'cellNumber', 'position', 'password', 'status');

$employeeID = '';
$firstName = '';
$lastName = ''; 
$email = ''; 
$employeeCell = ''; 
$position = ''; 
$password = '';
$employeeStatus = ''; 

if(isset($_POST['submit4'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName']; 
    $email = $_POST['email']; 
    $employeeCell = $_POST['employeeCell']; 
    $position = $_POST['position']; 
    $password = $_POST['password'];
    $employeeStatus = $_POST['employeeStatus']; 

    $employeeRowData = array(itemNumberGenerator(), $firstName, $lastName, $email, $employeeCell, $position, $password, $employeeStatus);

    createData($employeeTable, $employeeColumn, $employeeRowData, $db_connect);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}

if(isset($_POST['delete4'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $employeeID = $_POST['employeeID'];
    deleteData($db_connect, $employeeTable, 'employeeID', $employeeID);

    echo "<meta http-equiv='refresh' content='0'>";
  }
}


?>

<body>
<div class="jumbotron text-center">
    <h1>APPLICATION</h1>
    MONKEY STRONG TOGETHE:
</div>

<div class="container">
<!-- Navigation Block -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#principal">Clients Manager</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#nav_insert">Notification Manager</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#nav_update">Client's Notification Manager</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#nav_delete">Employee</a>
        </li>
        <li>
            <a class="nav-link" href="members.html">Members</a>
        </li>
        <li>
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>

<!-- Form for client management, filled out info on submit fills table out -->
    <div class="tab-content">
        <div class="tab-pane container active" id="principal">
            <form  method="POST">
                <div class="form-group"> <label>

                        Company Name:
                    </label> <input type="text" name="companyName" placeholder="Company Name:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Business number:
                    </label> <input type="text" name="businessNumber" placeholder="Business number:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Contact's first name:
                    </label> <input type="text" name="firstName" placeholder=" Contact's first name:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Contact's last name:
                    </label> <input type="text" name="lastName" placeholder="Contact's last name:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Phone number:
                    </label> <input type="text" name="phoneNumber" placeholder="Phone number:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Cell number:
                    </label> <input type="text" name="cellNumber" placeholder="Cell number:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Carriers:
                    </label> <input type="text" name="carriers" placeholder="Carriers:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        HST number:
                    </label> <input type="text" name="hstNumber" placeholder="HST number:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Website:
                    </label> <input type="text" name="website" placeholder="Website:" required class="form-control "> </div>
                <div class="form-group"> <label>

                </label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="status" value="active" checked> Active </label>
                    <label class="radio-inline"> <input type="radio" name="status" value="inactive" class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-dark" onClick="return confirm('Are you sure you want to add?')">Submit</button>
                </div>
            </form>
<!-- Table of data from MySql that was stored as an array -->
    <?php if(count($dataFromTable) > 0): ?>
    <table class="table table-dark table-hover">
      <tr>
        <th>Company Name</th>
        <th>Business Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Cell Number</th>
        <th>Carriers</th>
        <th>HST</th>
        <th>Website</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php foreach($dataFromTable as $key => $data): ?>
      <?php $id = $data['clientID'] ?>
      <tr>
        <td><?= $data['companyName'] ?></td>
        <td><?= $data['businessNumber'] ?></td>
        <td><?= $data['clientFirstName'] ?></td>
        <td><?= $data['clientLastName'] ?></td>
        <td><?= $data['phoneNumber'] ?></td>
        <td><?= $data['cellNumber'] ?></td>
        <td><?= $data['carriers'] ?></td>
        <td><?= $data['hstNumber'] ?></td>
        <td><?= $data['website'] ?></td>
        <td><?= $data['status'] ?></td>
        <td>
          <a class="btn btn-dark" href="updateData.php?id=<?= $id ?>" role="button">Update</a>
          <form method="post" class="buttonInline">
            <input type="hidden" name="id" value=<?=$id?>>
            <button type="submit" name="delete" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</button>
          </form>
        </td>
      </tr>

      <?php endforeach; ?>
    </table>
    <?php else: ?>
      <h3> No Data to Display </h3>
    <?php endif; ?>
  </div>

<!-- Notification Block  -->
        <div class="tab-pane container fade" id="nav_insert">
            <form  method="post">
                <div class="form-group"> <label>

                        Name (to identify the notification):
                    </label> <input type="text" name="notifyName" placeholder="Name:" required class="form-control "> </div>
                <div class="form-group"> <label>

                </label>
                    Notification Type:
                    <label class="radio-inline"> <input type="radio" name="notifyType" value="email" > E-mail </label>
                    <label class="radio-inline"> <input type="radio" name="notifyType" value="sms" class="ml-5">SMS </label>
                </div>
                <div class="form-group"> <label>

                </label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="notifyStatus" value="disable" checked> Disable </label>
                    <label class="radio-inline"> <input type="radio" name="notifyStatus" value="enable" class="ml-5">Enable </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit2" class="btn btn-dark" onClick="return confirm('Are you sure you want to add?')">Submit</button>
                </div>
            </form>
            <?php if(count($notifyData) > 0) : ?>
              <table class="table table-dark table-hover">
                <tr>
                  <th>Name</th>
                  <th>Notification Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            <?php foreach($notifyData as $key => $data2): ?>
            <?php $notifyID = $data2['notificationID'] ?>
                <tr>
                  <td><?= $data2['notifyName'] ?></td>
                  <td><?= $data2['notifyType'] ?></td>
                  <td><?= $data2['notifyStatus'] ?></td>
                  <td>
                    <a class="btn btn-dark" href="updateData.php?notifyID=<?= $notifyID ?>" role="button">Update</a>
                    <form method="post" class="buttonInline">
                      <input type="hidden" name="notifyID" value=<?=$notifyID?>>
                      <button type="submit" name="delete2" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>  
              </table>
              <?php else: ?>
                <h3> NO DATA TO DISPLAY </h3>
              <?php endif; ?>
        </div>
<!-- Client Notification Block -->
        <div class="tab-pane container fade" id="nav_update">
            <form  method="POST">
                <div class="form-group"> <label>

                        Client ID:
                    </label> <input type="text" name="client" placeholder="ID:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        Notification  ID:
                    </label> <input type="text" name="notification" placeholder="Notification ID:" required class="form-control "> </div>
                <div class="form-group"> <label>

                        START DATE/TIME:
                    </label>
                    <input type="date" name="startTime" min="2021-12-10" class="form-control" required>  
                  </div>

                <div class="form-group"> <label>

                </label>
                    Frequency:
                    <label class="radio-inline"> <input type="radio" name="frequency" value="30"  > 30 </label>
                    <label class="radio-inline"> <input type="radio" name="frequency" value="120" > 120 </label>
                    <label class="radio-inline"> <input type="radio" name="frequency" value="365" >365 </label>
                </div>

                <div class="form-group"> <label>

                </label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="clientStatus" value="active"> Active </label>
                    <label class="radio-inline"> <input type="radio" name="clientStatus" value="inactive" class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit3" class="btn btn-dark" onClick="return confirm('Are you sure you want to add?')">Submit</button>
                </div>
            </form>
            <?php if(count($clientNotifyData) > 0) : ?>
              <table class="table table-dark table-hover">
                <tr>
                  <th>Client ID</th>
                  <th>Notification ID</th>
                  <th>Start Day</th>
                  <th>Frequency</th>
                  <th>Status</th>
                  <th>ACtion</th>
                </tr>
            <?php foreach($clientNotifyData as $key => $data3): ?>
            <?php $clientNotifyID = $data3['clientNotifyID'] ?>
                <tr>
                  <td><?= $data3['client'] ?></td>
                  <td><?= $data3['notification'] ?></td>
                  <td><?= $data3['startTime'] ?></td>
                  <td><?= $data3['frequency'] ?></td>
                  <td><?= $data3['status'] ?></td>
                  <td>
                    <a class="btn btn-dark" href="updateData.php?clientNotifyID=<?= $clientNotifyID ?>" role="button">Update</a>
                    <form method="post" class="buttonInline">
                      <input type="hidden" name="clientNotifyID" value=<?=$clientNotifyID?>>
                      <button type="submit" name="delete3" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>  
              </table>
              <?php else: ?>
                <h3> NO DATA TO DISPLAY </h3>
              <?php endif; ?>
        </div>


        <div class="tab-pane container fade" id="nav_delete">
            <form  method="post">
                <div class="form-group"> 
                  <label>
  
                        First name:
                    </label> <input type="text" name="firstName" placeholder=" First name:" required class="form-control "> </div>
                <div class="form-group"> 
                  <label>
  
                        Last name:
                    </label> <input type="text" name="lastName" placeholder="Last name:" required class="form-control "> </div>
                <div class="form-group"> 
                  <label>
  
                        EMAIL:
                    </label> <input type="text" name="email" placeholder="EMAIL:" required class="form-control "> </div>
                <div class="form-group"> 
                  <label>
  
                        Cell number:
                    </label> <input type="text" name="employeeCell" placeholder="Cell number:" required class="form-control "> </div>

                <div class="form-group"> 
                  <label>
  
                        Position:
                    </label>
                    <div class="form-group">
                        <select name="position" class="form-select form-select-lg">
                          <option value="manager">Manager</option>
                          <option value="senior">Senior Accountant</option>
                          <option value="junior">Junior Accountant</option>
                          <option value="chartered">Chartered Accountant</option>
                          <option value="bookkeeper">Book Keeper</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"> 
                  <label>
  
                        Password:
                    </label> <input type="text" name="password" placeholder="Password:" required class="form-control "> </div>
                <!-- Picture?               -->
                <div class="form-group"> <label>

                </label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="employeeStatus" value="active" checked> Active </label>
                    <label class="radio-inline"> <input type="radio" name="employeeStatus" value="inactive" class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                <button type="submit" name="submit4" class="btn btn-dark" onClick="return confirm('Are you sure you want to add?')">Submit</button>
                </div>
            </form>
            <?php if(count($employeeData) > 0) : ?>
              <table class="table table-dark table-hover">
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Cell Number</th>
                  <th>Position</th>
                  <th>Password</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
            <?php foreach($employeeData as $key => $data4): ?>
            <?php $employeeID = $data4['employeeID'] ?>
                <tr>
                  <td><?= $data4['firstName'] ?></td>
                  <td><?= $data4['lastName'] ?></td>
                  <td><?= $data4['email'] ?></td>
                  <td><?= $data4['cellNumber'] ?></td>
                  <td><?= $data4['position'] ?></td>
                  <td><?= $data4['password'] ?></td>
                  <td><?= $data4['status'] ?></td>
                  <td>
                    <a class="btn btn-dark" href="updateData.php?employeeID=<?= $employeeID ?>" role="button">Update</a>
                    <form method="post" class="buttonInline">
                      <input type="hidden" name="employeeID" value=<?=$employeeID?>>
                      <button type="submit" name="delete4" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>  
              </table>
              <?php else: ?>
                <h3> NO DATA TO DISPLAY </h3>
              <?php endif; ?>
        </div>
    </div>
</div>
<script src=https://my.gblearn.com/js/loadscript.js></script>
</body>
</html>

<?php
echo "<hr>";
show_source(__FILE__);
?><?php
