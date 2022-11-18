<?php
session_start();
require_once '../components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: ../User_Home/home.php");
    exit;
}

$id = $_SESSION['admin'];
$status = 'admin';
$sql = "SELECT * FROM animals
ORDER BY age DESC";

$result = mysqli_query($connect, $sql);
//this variable will hold the body for the table
$tbody = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td>
            <img class='id' src='".$row['image']."'/></td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['status'] . "</td>
            <td><a href='updatePet.php?id=" . $row['animal_id'] . "'><button class='btn btn-primary btn-sm m-auto' type='button'>Edit</button></a>
            <a href='deletePet.php?id=" . $row['animal_id'] . "'><button class='btn btn-danger btn-sm m-auto' type='button'>Delete</button></a></td>
         </tr>";}}
    else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm-Dashboard-UpPet</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" href="../style/styleDash.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4 button">
                <a class="w-100 m-1 btn btn-danger" href="dashboard.php">Back</a>
            </div>
            <div class="col-12 mt-2">
                <p class='h2'>Pets</p>

                <table class='myTable'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</body>
</html>