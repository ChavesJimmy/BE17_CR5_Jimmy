<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['admin'];
$status = 'admin';
$sql = "SELECT * FROM users WHERE status != '$status'";
$sql2 = "SELECT * FROM users WHERE user_id=$id";

$result = mysqli_query($connect, $sql);
$result2 = mysqli_query($connect, $sql2);
//this variable will hold the body for the table
$tbody = '';
$tbody2 = '';
$rowImage = $result2->fetch_array(MYSQLI_ASSOC);
$image=$rowImage['picture'];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src=' ".$row['picture']."' alt=" . $row['first_name'] . "/></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['email'] . "</td>
            <td><a href='updateUser.php?id=" . $row['user_id'] . "'><button class='btn btn-primary btn-sm m-auto' type='button'>Edit</button></a>
            <a href='deleteUser.php?id=" . $row['user_id'] . "'><button class='btn btn-danger btn-sm m-auto' type='button'>Delete</button></a></td>
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
    <title>Adm-Dashboard</title>
    <?php require_once 'components/boot.php' ?>
    <link rel="stylesheet" href="./style/styleDash.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 admin">
                <img  class="Image" src="<?php echo $image ?>">
                <p class="">Admin</p>
                <a class="w-50 m-1 btn btn-danger" href="logout.php?logout">Sign Out</a>
            </div>
            <div class="col-12 menu w-100">
                <h1>Menu</h1>
                <a class="btn btn-success" href="dashUser.php">Manage Users</a><br>
                <a class="btn btn-dark" href="dashAdoption.php">See Pet Adoptions</a><br>
                <a class="btn btn-warning" href="dashAddPet.php">Add Pets</a><br>
                <a class="btn btn-info" href="dashUpPets.php">Manage Pets</a><br>


            </div>
            </div>
        </div>
    </div>
</body>
</html>