<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'flutterdev';

$connection = mysqli_connect($server, $user, $pass, $db);

if (mysqli_connect_errno()) {
    printf('Connection Error', mysqli_connect_error());
} else {
    return mysqli_select_db($connection, $db);
}

?>