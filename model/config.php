<?php
/**
 * Created by PhpStorm.
 * User: Nasim
 * Date: 07-Oct-17
 * Time: 2:41 PM
 */

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'roostpaddb');

function printError($errorMessage) {
    $response             = new stdClass();
    $response->statusCode = 404;
    $response->error      = $errorMessage;
    $response->message    = "";
    echo json_encode($response);
    exit(0);
}

function getConfirmationToken($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string     = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
