<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/26/17
 * Time: 2:24 PM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params   = json_decode($jsonBody);
    $params   = (array)$params;
    $email    = $params["email"];
    $password = $params["password"];
    $newPassword = $params["newPassword"];

    $check_password = "SELECT password FROM users WHERE email = '$email'";
    $result   = $conn->query($check_password);

    if($result->fetch_assoc()["password"] == $password) {
        $sql = "UPDATE users SET password = '$newPassword' WHERE email='$email'";
        if($conn->query($sql)) {
            $params["message"] = "Password changed successfully !";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        }
    } else {
        printError("Current password don't match !");
    }

    $conn->close();
}