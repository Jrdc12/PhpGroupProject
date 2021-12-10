<?php
session_start();
include 'functions.php';
checkLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <meta name="description" content="assingment1">
    <meta name="author" content="Benjamin Sarras">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS1.css">
    <style>







    </style>

</head>
<body>


<div class="wrapper fadeInDown">
    <div id="formContent">

        <form method="post">
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="login" value="admin">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="password" value="123456">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>


    </div>
</div>




<script src=https://my.gblearn.com/js/loadscript.js></script>

</body>






</html>

<?php
echo "<hr>";
show_source(__FILE__);
?>
