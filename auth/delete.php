<?php

header("Access-Control-Allow-Origin:*");
header("Control-Type: application/json");
header("Access-Control-Allow-Method: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require_once '../connections.php';
require_once 'function.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "DELETE") {

    $deleteUsers = deleteUsers($_GET);
    echo $deleteUsers;

} else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];
    header('HTTP:/1.0 405 Method Not Allowed');
    echo json_encode($data);
}


?>