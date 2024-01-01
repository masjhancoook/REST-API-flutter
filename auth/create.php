<?php

header("Access-Control-Allow-Origin:*");
header("Control-Type: application/json");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require_once("function.php");

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'POST') {

    $insert = json_decode(file_get_contents('php://input'), true);
    echo $insert;

    if (empty($insert)) {

        $storeUsers = storeUsers($_POST);

    } else {

        $storeUsers = storeUsers($insert);
    }

    echo $storeUsers;

} else {

    $data = [
        'Status' => 405,
        'Message' => $requestMethod . ' Method Not Allowed',
    ];
    header('HTTP:/1.0 405 Method Not Allowed');
    echo json_encode($data);

}

?>