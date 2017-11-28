<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/27/17
 * Time: 7:50 PM
 */

require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $days = $params["days"];

    $sql = "INSERT INTO requests (days) VALUES ('$days')";

    if ($conn->query($sql)) {
        $params["message"] = "Request added successfully";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError("Request cannot be added");
    }
    $conn->close();

}