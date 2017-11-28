<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/28/17
 * Time: 4:53 PM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];
    $token = $params["token"];
    $info = $params["info"];
    $message = $params["message"];
    $days = $params["days"];
    $status = $params["status"];

    $sql2 = ("SELECT token FROM users WHERE email = '$email'") or exit(mysqli_error());
    $select = $conn->query($sql2);

    $sqlGetRole = ("SELECT role FROM users WHERE email = '$email'") or exit(mysqli_error());
    $role = $conn->query($sqlGetRole);

    if(mysqli_num_rows($select) && $select->fetch_assoc()["token"] == $token && mysqli_num_rows($role) && $role->fetch_assoc()["role"] != "CTO") {

        $sql = "INSERT INTO requests (email, info, message, days, status) 
            VALUES ('$email', '$info', '$message', '$days', '$status')";

        if ($conn->query($sql)) {
            $params["message"] = "Request sent successfully !";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            echo "Error";
        }
    } else {
        $params["message"] = "Permission denied";
        $params["statusCode"] = 403;
        $params["error"] = "You don't have sufficient permission";
        echo json_encode($params);
    }

    $conn->close();
}