<?php

require '../connections.php';

function ErrorTrim($message)
{
    $data = [
        'Status' => 422,
        'Message' => $message . ' Unproccessable Entity',
    ];
    header('HTTP:/1.0 442 Unproccessable Entity');
    echo json_encode($data);
    exit();
}


function getUsersList()
{

    global $connection;

    $sql = "SELECT username, password FROM users";
    $query = mysqli_query($connection, $sql);

    if ($query) {

        if (mysqli_num_rows($query) > 0) {

            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $data = [
                'Status' => 200,
                'Message' => 'Ok',
                'Result' => $result,
            ];

            echo json_encode($data);

        } else {
            $data = [
                'Status' => 404,
                'Message' => 'Users Not Found',
            ];
            header('HTTP:/1.0 404 Users Not Found');
            echo json_encode($data);
        }


    } else {
        $data = [
            'Status' => 500,
            'Message' => 'Internal Server Error',
        ];
        header('HTTP:/1.0 500 Internal Server Error');
        echo json_encode($data);
    }
}


// Fetching Data 
function getusersId($getParams)
{
    global $connection;

    if (empty($getParams['id'])) {
        return ErrorTrim('ID not access allowed : ');
    }

    $userID = mysqli_real_escape_string($connection, $getParams['id']);

    $sql = "SELECT * FROM users WHERE userID='$userID'";
    $query = mysqli_query($connection, $sql);
    if ($query) {

        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);

            $data = [
                'Status' => 200,
                'Message' => 'Ok',
                'data' => $result,
            ];
            header('HTTP:/1.0 200 Ok');
            echo json_encode($data);
        } else {
            $data = [
                'Status' => 404,
                'Message' => 'ID not found : ',
            ];
            header('HTTP:/1.0 404 ID not found : ');
            echo json_encode($data);
        }

    } else {

        $data = [
            'Status' => 500,
            'Message' => 'Internal server Error : ',
        ];
        header('HTTP:/1.0 500 Internal server Error');
        echo json_encode($data);
    }
}


// Fungsi Insert Data Users
function storeUsers($usersInput)
{
    global $connection;

    $username = mysqli_real_escape_string($connection, $usersInput['username']);
    $password = mysqli_real_escape_string($connection, $usersInput['password']);

    if (empty($username)) {

        return ErrorTrim('Username not empty : ');

    } elseif (empty($password)) {

        return ErrorTrim('Password not empty : ');

    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $query = mysqli_query($connection, $sql);

        if (!$query) {
            $data = [
                'Status' => 201,
                'Message' => 'Users Create Successfully',
            ];
            header('HTTP:/1.0 201 Users Create Successfully');
            echo json_encode($data);
        }
    }
}


// update Data
function updateUsers($usersInput, $getParams)
{
    global $connection;

    if (!isset($getParams['id'])) {
        return ErrorTrim('ID not found');
    } elseif ($getParams['id'] == null) {
        return ErrorTrim('Enter ID users');
    }

    $id = mysqli_real_escape_string($connection, $getParams['id']);
    $username = mysqli_real_escape_string($connection, $usersInput['username']);
    $password = mysqli_real_escape_string($connection, $usersInput['password']);

    if (empty($username)) {
        return ErrorTrim('Username not empty');
    } elseif (empty($password)) {
        return ErrorTrim('Password not empty');
    } else {
        $sql = "UPDATE users SET username='$username', password='$password' WHERE userID='$id' LIMIT 1";
        $query = mysqli_query($connection, $sql);

        if ($query) {
            $data = [
                'Status' => 201,
                'Message' => 'Users update successfully',
            ];
            header('HTTP:/1.0 201 Users update successfully');
            echo json_encode($data);
        } else {
            $data = [
                'Status' => 500,
                'Message' => 'Internal server error',
            ];
            header('HTTP:/1.0 500 Internal server error');
            echo json_encode($data);
        }
    }
}


// Delete users
function deleteUsers($getParams)
{
    global $connection;

    if (!isset($getParams['id'])) {
        return ErrorTrim('User ID not found');
    } elseif ($getParams['id'] == null) {
        return ErrorTrim('ID Deleted');
    }
    $deleteid = mysqli_real_escape_string($connection, $getParams['id']);
    $sql = "DELETE FROM users WHERE userID='$deleteid' LIMIT 1 ";
    $query = mysqli_query($connection, $sql);

    if ($query) {

        $data = [
            'Status' => 200,
            'Message' => 'Users delete successfully',
        ];
        header('HTTP:/1.0 200 Deleted');
        echo json_encode($data);

    } else {

        $data = [
            'Status' => 404,
            'Message' => 'Users not found',
        ];
        header('HTTP:/1.0 404 Users not found');
        echo json_encode($data);
    }
}

?>