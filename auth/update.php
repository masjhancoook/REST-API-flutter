<?php

header("Access-Control-Allow-Origin:*");
header("Control-Type: application/json");
header("Access-Control-Allow-Method: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require_once("function.php");

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'PUT') {

    $insert = json_decode(file_get_contents('php://input'), true);
    echo $insert;

    if (empty($insert)) {

        $updateUsers = updateUsers($_PUT, $_GET);

    } else {

        $updateUsers = updateUsers($insert, $_GET);
    }

    echo $updateUsers;

} else {

    $data = [
        'Status' => 405,
        'Message' => $requestMethod . ' Method Not Allowed',
    ];
    header('HTTP:/1.0 405 Method Not Allowed');
    echo json_encode($data);

}

?>