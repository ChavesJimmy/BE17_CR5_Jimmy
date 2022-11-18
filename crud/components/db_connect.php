<?php

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "be17_cr5_animal_adoption_jimmy";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
// } else {
//     echo "Successfully Connected";
}