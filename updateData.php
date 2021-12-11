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

require('databaseConnect.php');
require('functions.php');
//-----------------------------------Client Variables and logic
$clientTable = 'clients';
$dataFromTable = readData($db_connect, $clientTable);
$clientTableColumn = array('companyName', 'businessNumber', 'clientFirstName', 'clientLastName', 'phoneNumber', 'cellNumber', 'carriers', 'hstNumber', 'website', 'status');

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

//Fills form in with already entered data
$idFromData = getData($dataFromTable, $_GET['id'], 'clientID');

$id = $idFromData['clientID'];
$companyName = $idFromData['companyName'];
$businessNumber = $idFromData['businessNumber'];
$firstName = $idFromData['clientFirstName'];
$lastName = $idFromData['clientLastName'];
$phoneNumber = $idFromData['phoneNumber'];
$cellNumber = $idFromData['cellNumber'];
$carriers = $idFromData['carriers'];
$hstNumber = $idFromData['hstNumber'];
$website = $idFromData['website'];
$status = $idFromData['status'];

//Updates Data from form to table

if(isset($_POST['update'])){
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

    $rowData =  array($companyName, $businessNumber, $firstName, $lastName, $phoneNumber, $cellNumber, $carriers, $hstNumber, $website, $status);

    updateData($db_connect, $clientTable, $rowData, $clientTableColumn, 'clientID', $_GET['id']);

    //page refresh to ensure update happened, directs back to home page. 
    echo "<meta http-equiv='refresh' content='0'>";
    echo "<script>window.location.href='main.php';</script>";
  }   
      
}

//------------------------Notification Manager variables and logic 
$notifyTable = 'notificationManager';
$notifyData = readData($db_connect, $notifyTable);

$notifyColumn = array('notifyName', 'notifyType', 'notifyStatus');

$notifyID = '';
$notifyName = '';
$notifyType = '';
$notifyStatus = '';

//Fills form in with already entered data

$notifyIDFromData = getData($notifyData, $_GET['notifyID'], 'notificationID');

$id = $notifyIDFromData['notificationID'];
$notifyName = $notifyIDFromData['notifyName'];
$notifyType = $notifyIDFromData['notifyType'];
$notifyStatus = $notifyIDFromData['notifyStatus'];

if(isset($_POST['update2'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $notifyName = $_POST['notifyName'];
    $notifyType = $_POST['notifyType'];
    $notifyStatus = $_POST['notifyStatus'];

    $notifyData =  array($notifyName, $notifyType, $notifyStatus);

    updateData($db_connect, $notifyTable, $notifyData, $notifyColumn, 'notificationID', $_GET['notifyID']);

    echo "<meta http-equiv='refresh' content='0'>";
    echo "<script>window.location.href='main.php';</script>";
  }
}

//-----------------------------Client's Notification Manager variables and logic
$clientNotifyTable = 'clientNotification';
$clientNotifyData = readData($db_connect, $clientNotifyTable);

$clientNotifyColumn = array('client', 'notification', 'startTime', 'frequency', 'status');

$clientNotifyID = '';
$client = '';
$notification = '';
$startTime = '';
$frequency = '';
$status = '';

//Fills form with already entered data

$clientNotifyIDFromData = getData($clientNotifyData, $_GET['clientNotifyID'], 'clientNotifyID');

$clientNotifyID = $clientNotifyIDFromData['clientNotifyID'];
$client = $clientNotifyIDFromData['client'];
$notification = $clientNotifyIDFromData['notification'];
$startTime = $clientNotifyIDFromData['startTime'];
$frequency = $clientNotifyIDFromData['frequency'];
$status = $clientNotifyIDFromData['status'];

if(isset($_POST['update3'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $client = $_POST['client'];
    $notification = $_POST['notification'];
    $startTime = $_POST['startTime'];
    $frequency = $_POST['frequency'];
    $clientStatus = $_POST['clientStatus'];

    $clientNotifyData = array($client, $notification, $startTime, $frequency, $clientStatus);

    updateData($db_connect, $clientNotifyTable, $clientNotifyData, $clientNotifyColumn, 'clientNotifyID', $_GET['clientNotifyID'] );

    //reload to ensure update
    echo "<meta http-equiv='refresh' content='0'>";
    //returns to home page
    echo "<script>window.location.href='main.php';</script>";
  }
}

//---------------------------Employee Variables and Logic

$employeeTable = 'employee';
$employeeData = readData($db_connect, $employeeTable);

$employeeColumn = array('firstName', 'lastName', 'email', 'cellNumber', 'position', 'password', 'status');

$employeeID = '';
$firstName = '';
$lastName = ''; 
$email = ''; 
$employeeCell = ''; 
$position = ''; 
$password = '';
$employeeStatus = ''; 

//Fills form with already entered data

$employeeIDFromData = getData($employeeData, $_GET['employeeID'], 'employeeID');

$employeeID = $employeeIDFromData['employeeID'];
$firstName = $employeeIDFromData['firstName'];
$lastName = $employeeIDFromData['lastName']; 
$email = $employeeIDFromData['email']; 
$employeeCell = $employeeIDFromData['cellNumber']; 
$position = $employeeIDFromData['position']; 
$password = $employeeIDFromData['password'];
$employeeStatus = $employeeIDFromData['employeeStatus']; 



if(isset($_POST['update4'])){
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName']; 
    $email = $_POST['email']; 
    $employeeCell = $_POST['employeeCell']; 
    $position = $_POST['position']; 
    $password = $_POST['password'];
    $employeeStatus = $_POST['employeeStatus']; 

    $employeeRowData = array($firstName, $lastName, $email, $employeeCell, $position, $password, $employeeStatus);

    updateData($db_connect, $employeeTable, $employeeRowData, $employeeColumn, 'employeeID', $_GET['employeeID'] );

    //reload to ensure update
    echo "<meta http-equiv='refresh' content='0'>";

    //returns to home page
    echo "<script>window.location.href='main.php';</script>";
  }
}
?>

<body>
<div class="jumbotron text-center">
    <h1>APPLICATION</h1>
    <p>MONKEY STRONG TOGETHER</p>
</div>

<div class="container">
<!-- Nav Block -->
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

<!-- Client Manager Block - Prepopulated -->
    <div class="tab-content">
        <div class="tab-pane container active"  id="principal">
            <form   method="POST">
                <div class="form-group"> <label>
                        Company Name:
                    </label> <input type="text" name="companyName" value="<?= $companyName ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Business number:
                    </label> <input type="text" name="businessNumber" value="<?= $businessNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Contact's first name:
                    </label> <input type="text" name="firstName" value="<?= $firstName ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Contact's last name:
                    </label> <input type="text" name="lastName" value="<?= $lastName ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Phone number:
                    </label> <input type="text" name="phoneNumber" value="<?= $phoneNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Cell number:
                    </label> <input type="text" name="cellNumber" value="<?= $cellNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Carriers:
                    </label> <input type="text" name="carriers" value="<?= $carriers ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        HST number:
                    </label> <input type="text" name="hstNumber" value="<?= $hstNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                        Website:
                    </label> <input type="text" name="website" value="<?= $website ?>" required class="form-control "> </div>
                <div class="form-group"> <label></label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="status" value="active" <?php if('active' === $idFromData['status']){ echo 'checked';}?>> Active </label>
                    <label class="radio-inline"> <input type="radio" name="status" value="inactive" <?php if('inactive' === $idFromData['status']){ echo 'checked';}?> class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-dark">Update</button>
                </div>
            </form>
<!-- Client Table Block -->
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
        </td>
      </tr>

      <?php endforeach; ?>
    </table>
    <?php else: ?>
      <h3> No Data to Display </h3>
    <?php endif; ?>
    </div>

<!-- Notification Block - Prepopulated -->
    <div class="tab-pane container fade" id="nav_insert">
            <form  method="post">
                <div class="form-group"> <label>
                        Name (to identify the notification):
                    </label> <input type="text" name="notifyName" value="<?= $notifyName ?>"required class="form-control "> </div>
                <div class="form-group"> <label></label>
                    Notification Type:
                    <label class="radio-inline"> <input type="radio" name="notifyType" value="email" <?php if('email' === $notifyIDFromData['notifyType']){echo 'checked';}?> > E-mail </label>
                    <label class="radio-inline"> <input type="radio" name="notifyType" value="sms" <?php if('sms' === $notifyIDFromData['notifyType']){echo 'checked';}?> class="ml-5">SMS </label>
                </div>
                <div class="form-group"> <label></label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="notifyStatus" value="disable" <?php if('disable' === $notifyIDFromData['notifyStatus']){echo 'checked';}?>> Disable </label>
                    <label class="radio-inline"> <input type="radio" name="notifyStatus" value="enable" <?php if('enable' === $notifyIDFromData['notifyStatus']){echo 'checked';}?> class="ml-5">Enable </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="update4" class="btn btn-dark">Update</button>
                </div>
            </form>
<!-- Notification Table Block -->
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
                    <a class="btn btn-dark" href="updateData.php?id=<?= $employeeID ?>" role="button">Update</a>
                  </td>
                </tr>
              <?php endforeach; ?>  
              </table>
              <?php else: ?>
                <h3> NO DATA TO DISPLAY </h3>
              <?php endif; ?>
        </div>


<!-- Client Notification Manager Block - Prepopulated -->
<!-- Client Notification Block -->
<div class="tab-pane container fade" id="nav_update">
            <form  method="POST">
                <div class="form-group"> <label>
                        Client ID:
                    </label> <input type="text" name="client" value=<?= $client ?> required class="form-control "> </div>
                <div class="form-group"> <label>
                        Notification  ID:
                    </label> <input type="text" name="notification" value=<?= $notification ?> required class="form-control "> </div>
                <div class="form-group"> <label>
                        START DATE/TIME:
                    </label>
                    <input type="date" name="startTime" min="2021-12-10"  value=<?= $startTime ?> class="form-control" required>  
                  </div>

                <div class="form-group"> <label></label>
                    Frequency:
                    <label class="radio-inline"> <input type="radio" name="frequency" value="30" <?php if('30' === $clientNotifyIDFromData['frequency']){echo 'checked';}?>  > 30 </label>
                    <label class="radio-inline"> <input type="radio" name="frequency" value="120" <?php if('120' === $clientNotifyIDFromData['frequency']){echo 'checked';}?>  > 120 </label>
                    <label class="radio-inline"> <input type="radio" name="frequency" value="365" <?php if('365' === $clientNotifyIDFromData['frequency']){echo 'checked';}?>  >365 </label>
                </div>

                <div class="form-group"> <label></label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="clientStatus" value="active" <?php if('active' === $clientNotifyIDFromData['status']){echo 'checked';}?> > Active </label>
                    <label class="radio-inline"> <input type="radio" name="clientStatus" value="inactive" <?php if('inactive' === $clientNotifyIDFromData['status']){echo 'checked';}?> class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="update3" class="btn btn-dark"  >Update</button>
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
                  <th>Action</th>
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
                    </label> <input type="text" name="firstName" value="<?= $firstName ?>" required class="form-control"> </div>
                <div class="form-group"> 
                  <label>
  
                        Last name:
                    </label> <input type="text" name="lastName" value="<?= $lastName ?>" required class="form-control"> </div>
                <div class="form-group"> 
                  <label>
  
                        EMAIL:
                    </label> <input type="text" name="email" value="<?= $email ?>" required class="form-control"> </div>
                <div class="form-group"> 
                  <label>
  
                        Cell number:
                    </label> <input type="text" name="employeeCell" value="<?= $employeeCell ?>" required class="form-control "> </div>

                <div class="form-group"> 
                  <label>
  
                        Position:
                    </label>
                    <div class="form-group">
                        <select name="position" class="form-select form-select-lg">
                          <option value="manager" <?php if('manager' === $employeeIDFromData['position']){echo 'selected';}?>>Manager</option>
                          <option value="senior" <?php if('senior' === $employeeIDFromData['position']){echo 'selected';}?>>Senior Accountant</option>
                          <option value="junior" <?php if('junior' === $employeeIDFromData['position']){echo 'selected';}?>>Junior Accountant</option>
                          <option value="chartered" <?php if('chartered' === $employeeIDFromData['position']){echo 'selected';}?>>Chartered Accountant</option>
                          <option value="bookkeeper" <?php if('bookkeeper' === $employeeIDFromData['position']){echo 'selected';}?>>Book Keeper</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"> 
                  <label>
  
                        Password:
                    </label> <input type="text" name="password" value="<?= $password ?>" required class="form-control "> </div>
                <div class="form-group"> <label>
                </label>
                    Status:
                    <label class="radio-inline"> <input type="radio" name="employeeStatus" value="active" <?php if('active' === $employeeIDFromData['status']){echo 'checked';}?>> Active </label>
                    <label class="radio-inline"> <input type="radio" name="employeeStatus" value="inactive" <?php if('inactive' === $employeeIDFromData['status']){echo 'checked';}?>class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                <button type="submit" name="update4" class="btn btn-dark">Submit</button>
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
