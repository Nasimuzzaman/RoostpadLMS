<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/14/17
 * Time: 2:49 PM
 */

require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];

    $sql = "DELETE FROM users WHERE users.email = '$email'";
    $sql2 = "DELETE FROM leave_requests WHERE leave_requests.email = '$email'";

    //    $sql = "DELETE FROM users WHERE users.email = '$email'; DELETE FROM leave_requests WHERE leave_requests.email = '$email'";


    if($conn->query($sql) && $conn->query($sql2)) {

        $params["message"] = "User deleted successfully successfully";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);

    } else {
        printError( "Could not delete user! Try again!");
    }

    $conn->close();

}