<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location:home.php");
    exit;
}
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location:index.php");
    exit;
}
//update
$class = 'd-none';
if ($_POST) {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $image = $_POST['image'];
    $vaccinated = $_POST['vaccinated'];
    $description = $_POST['description'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $id= $_POST['id'];
    $sql = "UPDATE animals SET description = '$description', size = '$size', age = '$age',vaccinated = '$vaccinated',breed = '$breed',status='$status', name = '$name',  image = '$image', address = '$address' WHERE animal_id = $id";
    
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        header("refresh:3;url=../updatePet.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        header("refresh:3;url=../updatePet.php?id={$id}");
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
    <title>Add pet</title>
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