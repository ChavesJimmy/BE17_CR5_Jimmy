<?php
session_start();
require_once './components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$result = mysqli_query($connect, "SELECT * FROM animals");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="./style/styleDash.css">
    <title>PHP CRUD | Add Product</title>
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2'>Add a Pet</legend>
        <form action="actions/a_NewPet.php" method="post" enctype="multipart/form-data">
            <table class='table myTable'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Pet name" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Pet breed" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="address" placeholder="Pet address" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Pet Age" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="number" name="size" placeholder="Pet size" /></td>
                </tr>
                <tr>
                    <th>Vaccinated</th>
                    <td><select name="vaccinated">
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                    </select></td>
                </tr>
                <tr>
                    <th>Description <br>
                (no special characters allowed (ex: ", !, ...))</th>
                    <td><textarea name="description" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="text" name="image" placeholder="Pet image(url)"/></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select name="status">
                        <option value="available">available</option>
                        <option value="adopted">adopted</option>
                    </select></td>
                </tr>

                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Product</button></td>
                </tr>
            </table>
        </form>
        <td><a href="index.php"><button class='btn btn-warning d-block m-auto' type="button">Home</button></a></td>

    </fieldset>
</body>
</html>