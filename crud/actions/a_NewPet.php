<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location:../User_Home/home.php");
    exit;
}
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location:index.php");
    exit;
}
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

    $sql = "INSERT INTO animals (description, size, age, vaccinated, breed, status, name, image, address) VALUES ('$description', '$size', '$age', '$vaccinated', '$breed', '$status', '$name', '$image', '$address')";


    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The pet below was successfully added <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $breed </td>
            </tr></table><hr>";
    } else {
        $class = "danger";
        $message = "Error while adding pet. Try again: <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../Admin_Dash/dashAddPet.php ");
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