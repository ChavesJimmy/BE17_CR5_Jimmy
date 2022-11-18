<?php 
session_start();
require_once "../components/db_connect.php";
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["admin"])) {
    $backBtn = "dashboard.php";
}
// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$Userid=$row['user_id'];

$id=$_GET['id'];
$date=date('d M Y');
$tbody="";
$tbody2="";

$resAnimal = mysqli_query($connect, "SELECT * FROM animals WHERE animal_id =$id");
$rowAnimal = mysqli_fetch_array($resAnimal, MYSQLI_ASSOC);
if($rowAnimal['status'] == 'available'){
$tbody = "<div class='card mb-3''>
  <div class='row'>
    <div class='col-md-12'>
      <img src='".$rowAnimal['image']."' class='rounded mywidth'>
    </div>
    <div class='col-md-12 m-1 text'>
      <div class='card-body'>
        <h5 class='card-title'>".$rowAnimal['name']."</h5>
        <p class='card-text'>Description : ".$rowAnimal['description']."</p>
        <p class='card-text'>Size : ".$rowAnimal['size']."</p>
        <p class='card-text'>Age : ".$rowAnimal['age']."</p>
        <p class='card-text'>Vaccinated : ".$rowAnimal['vaccinated']."</p>
        <p class='card-text'>Status : ".$rowAnimal['status']."</p>
        </div>
    </div>
  </div>
</div>";
$tbody2="<button name='submit' class='btn btn-success d-block m-auto w-50' type='submit' >Adopt ".$rowAnimal['name']."</button>" ;
}
else{$tbody = "<div class='card mb-3''>
  <div class='row'>
  <div class='col-md-12'>
    <img src='".$rowAnimal['image']."' class='rounded mywidth'>
  </div>
  <div class='col-md-12 m-1 text'>
    <div class='card-body'>
      <h5 class='card-title'>".$rowAnimal['name']."</h5>
      <p class='card-text'>Description : ".$rowAnimal['description']."</p>
      <p class='card-text'>Size : ".$rowAnimal['size']."</p>
      <p class='card-text'>Age : ".$rowAnimal['age']."</p>
      <p class='card-text'>Vaccinated : ".$rowAnimal['vaccinated']."</p>
      <p class='card-text'>Status : ".$rowAnimal['status']."</p>
        <p class='card-text'>Pet already adopted</p>
        </div>
    </div>
  </div>
</div>";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Details about <?= $rowAnimal['name'] ?></h1>
    <?php require_once "../components/boot.php" ?>
    <link rel="stylesheet" href="../style/styleHome.css">
    <title>Details</title>
</head>
<body>
    <?php echo $tbody ?>
    
    <form method="post" action="../actions/a_Adopt.php" enctype="multipart/form-data">        
                    <input type="hidden" name="fk_animal_id" value="<?php echo $id ?>"/><br>
                    <input type="hidden" name="fk_user_id" value="<?php echo $Userid?>"/><br>
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                 
                    <?php echo $tbody2 ?>

        </form>
        <br>
        <br>
        <a class="btn btn-warning btnback" href='<?php echo $backBtn ?>'>BACK</a>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>

</body>
</html>