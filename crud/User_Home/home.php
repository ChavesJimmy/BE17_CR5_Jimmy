<?php
session_start();
require_once '../components/db_connect.php';

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
// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$id=$row['user_id'];

// select animals details - procedural style
$tbody="";
$sql="SELECT * FROM animals";
$resAnimal = mysqli_query($connect, $sql);
$rowAnimal = mysqli_fetch_array($resAnimal, MYSQLI_ASSOC);
if (mysqli_num_rows($resAnimal)  > 0) {
    while ($rowAnimal = mysqli_fetch_array($resAnimal, MYSQLI_ASSOC)) {
    
    $tbody .= "
    <div class='card rounded col-sm-10 col-md-5 col-lg-3 m-auto p-1' id='petcard''>
  <img src='". $rowAnimal['image']. "' class='card-img-top rounded' id='imgCard'>
  <div class='card-body'>
    <h5 class='card-title'>Name : ".$rowAnimal['name']."</h5>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>Breed: ".$rowAnimal['breed']."</li>
    <li class='list-group-item'>Location: ".$rowAnimal['address']."</li>
    <li class='list-group-item'>Details : <a class='btn btn-warning' href='details.php?id=".$rowAnimal['animal_id']."'>Go to details</a></li>
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
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <link rel="stylesheet" href="../style/styleHome.css">
    <?php require_once "../components/boot.php";?>
</head>

<body>
    <div class="container">
        <div class="hero row">
            <img class="col-4" id="profil" src="<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
            <p class=" col-8 m-auto">Hi <?php echo $row['first_name'] . " " . $row['last_name']."<br>
            ".$row['email']; ?></p>
            <div id="btns"> <br><a class="btn btn-danger" href="logout.php?logout">Sign Out</a> <br>
        <a class="btn btn-success" href="updateUser.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a></div>
        </div>

        <h1>Our animals</h1>
        <div id="btns2">
        <a class="btn btn-dark" href="./senior.php">Senior animals</a>
        <a class="btn btn-primary" href="./junior.php">Junior animals</a></div>
        <div class="row" id="main">
            <?php echo $tbody ?>
        </div>
       
    </div>
</body>
</html>