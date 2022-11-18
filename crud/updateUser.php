<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "User_Home/home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["admin"])) {
    $backBtn = "Admin_Dash/dashboard.php";
}

//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $address = $data['address'];
        $picture = $data['picture'];
        $phone = $data['phone_number'];

    }
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone_number'];
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    $sql = "UPDATE users SET first_name = '$f_name', last_name = '$l_name', email = '$email', address = '$address', picture = '$picture', phone_number = '$phone' WHERE user_id = $id";
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        header("refresh:3;url=updateUser.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        header("refresh:3;url=updateUser.php?id={$id}");
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>
        <h2>Update infos user</h2>
        <img class='img-thumbnail rounded-circle' src='<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        <form method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $f_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $l_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class="form-control" type="text" name="address" placeholder="address" value="<?php echo $address ?>" /></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input class="form-control" type="text" name="phone_number" placeholder="phone_number" value="<?php echo $phone ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="text" name="picture" value="<?php echo $picture ?>" placeholder="enter image url"/></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['user_id'] ?>" />

                    <td><button name="submit" class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="<?php echo $backBtn ?>"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>