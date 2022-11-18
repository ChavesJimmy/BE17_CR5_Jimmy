<?php
session_start();
require_once '../components/db_connect.php';
//POST METHOD FOR ADOPTION TABLE
$class = 'd-none';
if ($_POST) {
    $Userid=$_POST['fk_user_id'];
    $date=date('d M Y');
    $id=$_POST['id'];
    $sqlUpdate="UPDATE animals SET status ='adopted' WHERE animal_id = $id"; 
    $sql = "INSERT INTO pet_adoption (fk_user_id, fk_animal_id , adoption_date) VALUES ('$Userid','$id','$date')";

    if (mysqli_query($connect, $sql) === true) {
      if(mysqli_query($connect,$sqlUpdate) === true){
        $class = "alert alert-success";
        $message = "The pet was successfully adopted";
        header("refresh:3;url=../User_Home/details.php?id={$id}");}
    } else {
        $class = "alert alert-danger";
        $message = "Error while adopting pet : <br>" . $connect->error;
        header("refresh:3;url=../User_Homedetails.php?id={$id}");
    }

    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Adopt pet</title>
    <?php require_once '../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>