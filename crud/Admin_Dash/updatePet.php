<?php
session_start();
require_once '../components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "../User_Home/home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["admin"])) {
    $backBtn = "dashboard.php";
}

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $breed = $data['breed'];
        $image = $data['image'];
        $vaccinated = $data['vaccinated'];
        $description = $data['description'];
        $age = $data['age'];
        $size = $data['size'];
        $status = $data['status'];
        $address = $data['address'];

    }
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
    <?php require_once '../components/boot.php' ?>
    <link rel="stylesheet" href="../style/styleDash.css">
</head>

<body>
    <div class="container">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>
        <h2>Change infos of  <?= $name?></h2>
        <img class='id' src='<?php echo $image ?>' alt="<?php echo $name ?>">
        <form method="post" action="../actions/a_UpPet.php" enctype="multipart/form-data">
        <table class='table myTable'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Pet name" value="<?=$name ?>"/></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Pet breed" value="<?=$breed ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="address" placeholder="Pet address" value="<?=$address ?>" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Pet Age" value="<?=$age ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="number" name="size" placeholder="Pet size" value="<?=$size ?>" /></td>
                </tr>
                <tr>
                    <th>Vaccinated</th>
                    <td><select name="vaccinated" value="<?=$vaccinated ?>">
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                    </select></td>
                </tr>
                <tr>
                    <th>Description <br>
                (no special characters allowed (ex: ", !, ...))</th>
                    <td><textarea name="description" cols="30" rows="10"  ><?=$description ?></textarea></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="text" name="image" placeholder="Pet image(url)" value="<?=$image ?>"/></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><select name="status" value="<?=$status ?>">
                        <option value="available">available</option>
                        <option value="adopted">adopted</option>
                    </select></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['animal_id'] ?>" />

                    <td><button class='btn btn-success' type="submit">Edit Pet</button></td>
                    
                    <td><a href="<?= $backBtn?>"><button class='btn btn-warning' type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>