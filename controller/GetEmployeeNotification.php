<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/19/17
 * Time: 10:58 AM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];

    $sql = "SELECT leave_requests.*, users.holiday from leave_requests LEFT JOIN users ON leave_requests.email = users.email WHERE leave_requests.email = '$email'";


    if ($conn->query($sql)) {

        $result = $conn->query($sql);
        $notifications = array();
        while (($row = $result->fetch_assoc()) != null) {
            $notifications[] = $row;
        }
        $params["notificationList"] = $notifications;
        $params["message"] = "";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError("Could not get pending requests! Try again!");
    }

    $conn->close();

}