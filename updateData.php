<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <meta name="description" content="assingment4">
    <meta name="author" content="Benjamin Sarras">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php 

require('databaseConnect.php');
require('functions.php');
$table = 'clients';
$dataFromTable = readData($db_connect, $table);

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

$page = 'updateData.php';

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

    updateData($db_connect, $table, $rowData, $clientTableColumn, 'clientID', $_GET['id']);
  }           
}
?>

<body>
<div class="jumbotron text-center">
    <h1>APPLICATION</h1>
    <p>MONKEY STRONG TOGETHER</p>
</div>

<div class="container">

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

    </ul>


    <div class="tab-content">
        <div class="tab-pane container active"  id="principal">
            <form role="form" action="main.php" method="POST">
                <div class="form-group"> <label for="username">
                        <h6>Company Name:</h6>
                    </label> <input type="text" name="companyName" value="<?= $companyName ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Business number:</h6>
                    </label> <input type="text" name="businessNumber" value="<?= $businessNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Contact's first name:</h6>
                    </label> <input type="text" name="firstName" value="<?= $firstName ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Contact's last name:</h6>
                    </label> <input type="text" name="lastName" value="<?= $lastName ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Phone number:</h6>
                    </label> <input type="text" name="phoneNumber" value="<?= $phoneNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Cell number:</h6>
                    </label> <input type="text" name="cellNumber" value="<?= $cellNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Carriers:</h6>
                    </label> <input type="text" name="carriers" value="<?= $carriers ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>HST number:</h6>
                    </label> <input type="text" name="hstNumber" value="<?= $hstNumber ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Website:</h6>
                    </label> <input type="text" name="website" value="<?= $website ?>" required class="form-control "> </div>
                <div class="form-group"> <label for="username"></label>
                    <h6>Status:</h6>
                    <label class="radio-inline"> <input type="radio" name="status" value="yes" <?php if('yes' === $idFromData['status']){ echo 'checked';}?>> Active </label>
                    <label class="radio-inline"> <input type="radio" name="status" value="no" <?php if('no' === $idFromData['status']){ echo 'checked';}?> class="ml-5">Inactive </label>
                </div>
                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-dark">Update</button>
                </div>
            </form>

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
      </tr>
      <?php foreach($dataFromTable as $key => $data): ?>
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



        <div class="tab-pane container fade" id="nav_insert">
            <form role="form" onsubmit="event.preventDefault()">
                <div class="form-group"> <label for="username">
                        <h6>Name (to identify the notification):</h6>
                    </label> <input type="text" name="username" placeholder="Name:" required class="form-control "> </div>
                <div class="form-group"> <label for="username"></label>
                    <h6>Notification Type:</h6>
                    <label class="radio-inline"> <input type="radio" name="optradio" > E-mail </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">SMS </label>
                </div>

                <div class="form-group"> <label for="username"></label>
                    <h6>Status:</h6>
                    <label class="radio-inline"> <input type="radio" name="optradio" checked> Disable </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">Enable </label>
                </div>


            </form>

        </div>



        <div class="tab-pane container fade" id="nav_update">
            <form role="form" onsubmit="event.preventDefault()">
                <div class="form-group"> <label for="username">
                        <h6>Client ID:</h6>
                    </label> <input type="text" name="username" placeholder="ID:" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Notification  ID:</h6>
                    </label> <input type="text" name="username" placeholder="Notification ID:" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>START DATE/TIME:</h6>
                    </label>
                    <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>

                <div class="form-group"> <label for="username"></label>
                    <h6>Frequency:</h6>
                    <label class="radio-inline"> <input type="radio" name="optradio" > 30 </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" > 120 </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" >365 </label>
                </div>

                <div class="form-group"> <label for="username"></label>
                    <h6>Status:</h6>
                    <label class="radio-inline"> <input type="radio" name="optradio" checked> Active </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">Inactive </label>
                </div>


            </form>

        </div>


        <div class="tab-pane container fade" id="nav_delete">
            <form role="form" onsubmit="event.preventDefault()">


                <div class="form-group"> <label for="username">
                        <h6>First name:</h6>
                    </label> <input type="text" name="username" placeholder=" First name:" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Last name:</h6>
                    </label> <input type="text" name="username" placeholder="Last name:" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>EMAIL:</h6>
                    </label> <input type="text" name="username" placeholder="EMAIL:" required class="form-control "> </div>
                <div class="form-group"> <label for="username">
                        <h6>Cell number:</h6>
                    </label> <input type="text" name="username" placeholder="Cell number:" required class="form-control "> </div>

                <div class="form-group"> <label for="username">
                        <h6>Position:</h6>
                    </label>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Position
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Manager</a></li>
                            <li><a href="#">Senior Accountant</a></li>
                            <li><a href="#">Junior Accountant</a></li>
                            <li><a href="#">Chartered Accountant</a></li>
                            <li><a href="#">Book Keeper</a></li>

                        </ul>
                    </div>
                </div>

                <div class="form-group"> <label for="username">
                        <h6>Password:</h6>
                    </label> <input type="text" name="username" placeholder="Password:" required class="form-control "> </div>
                <!-- Picture?               -->
                <div class="form-group"> <label for="username"></label>
                    <h6>Status:</h6>
                    <label class="radio-inline"> <input type="radio" name="optradio" checked> Active </label>
                    <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">Inactive </label>
                </div>
            </form>
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
