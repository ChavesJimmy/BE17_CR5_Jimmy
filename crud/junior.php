<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["admin"])) {
    $backBtn = "dashboard.php";
}
// 
// select animals details - procedural style
$tbody="";
$resAnimal = mysqli_query($connect, "SELECT * FROM animals WHERE age<8");
$rowAnimal = mysqli_fetch_array($resAnimal, MYSQLI_ASSOC);
if (mysqli_num_rows($resAnimal)  > 0) {
    while ($rowAnimal = mysqli_fetch_array($resAnimal, MYSQLI_ASSOC)) {
    
    $tbody .=  "
    <div class='card rounded col-sm-10 col-md-5 col-lg-3 m-auto p-2' id='petcard''>
  <img src='". $rowAnimal['image']. "' class='card-img-top rounded' id='imgCard'>
  <div class='card-body'>
    <h5 class='card-title'>Name : ".$rowAnimal['name']."</h5>
  </div>
  <ul class='list-group list-group-flush'>
    <li >Breed: ".$rowAnimal['breed']."</li><br>
    <li >Location: ".$rowAnimal['address']."</li><br>
    <li >Details : <a class='btn btn-warning' href='details.php?id=".$rowAnimal['animal_id']."'>Go to details</a></li>
  </ul>
  
</div>
    ";}
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junior</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="./style/styleHome.css">
</head>

<body>
    <div class="container">

        <h1>Our Junior animals</h1>
        <div class="row" id="main">
            <?php echo $tbody ?>
        </div>
    </div>
    <a class="btn btn-warning btnback" href='<?php echo $backBtn ?>'>BACK</a>

</body>
</html>