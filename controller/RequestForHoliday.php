<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/29/17
 * Time: 2:28 PM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];
    $fromDate = $params["fromDate"];
    $toDate = $params["toDate"];
    $days = $params["days"];
    $message = $params["message"];


    $sql = "INSERT INTO leave_requests (email, from_date, to_date, days, message, seen, status) 
            VALUES ('$email', '$fromDate', '$toDate', '$days', '$message', 0, 'pending')";
    if ($conn->query($sql)) {
        $params["message"] = "Request sent successfully !";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    }
    $conn->close();
}