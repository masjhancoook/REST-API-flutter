<?php

header("Access-Control-Allow-Origin:*");
header("Control-Type: application/json");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require_once '../connections.php';
require_once 'function.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "GET") {

    if (isset($_GET["id"])) {

        $getusers = getusersId($_GET);
        echo $getusers;

    } else {

        $usersList = getUsersList();
        echo $usersList;

    }
} else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];
    header('HTTP:/1.0 405 Method Not Allowed');
    echo json_encode($data);
}


?>