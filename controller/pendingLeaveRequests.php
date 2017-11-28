<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/28/17
 * Time: 5:15 PM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];
    $token = $params["token"];

    $sqlInfo = ("SELECT token, role FROM users WHERE email = '$email'") or exit(mysqli_error());
    $info = $conn->query($sqlInfo);

    $data = $info->fetch_assoc();

    if($data["token"] == $token && $data["role"] == "CTO") {
        $sql = "SELECT requests.*, users.name from requests LEFT JOIN users ON requests.email = users.email WHERE requests.status = 'pending'";

        if($conn->query($sql)) {

            $result = $conn->query($sql);
            $pendingRequests = array();
            while (($row = $result->fetch_assoc()) != null) {
                $pendingRequests[] = $row;
            }
            $params["contactList"] = $pendingRequests;
            $params["message"] = "";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            printError( "Could not get pending requests! Try again!");
        }
    } else {
        $params["message"] = "Permission denied";
        $params["statusCode"] = 403;
        $params["error"] = "You don't have sufficient permission";
    }

    $conn->close();
}