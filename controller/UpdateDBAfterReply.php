<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/12/17
 * Time: 2:42 PM
 */


require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $id = $params["id"];
    $email = $params["email"];
    $days = $params["days"];
    $status = $params["status"];
    $emailOfAuthor = $params["emailOfAuthor"];
    $tokenOfAuthor = $params["tokenOfAuthor"];

    $sqlInfo = ("SELECT token, role FROM users WHERE email = '$emailOfAuthor'") or exit(mysqli_error());
    $res = $conn->query($sqlInfo);


    $data = $res->fetch_assoc();

    if( $data["token"] == $tokenOfAuthor && $data["role"] == "CTO" ) {
        $sql = "UPDATE leave_requests SET status = '$status' WHERE leave_requests.id = '$id'";

        if($conn->query($sql)) {
            if($status == "accepted") {
                $sql2 = "UPDATE users SET holiday = (holiday - '$days') WHERE users.email = '$email'";
                $conn->query($sql2);
            }
            $params["message"] = "DB Updated successfully";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            printError( "Could not update DB! Try again!");
        }
    }



    $conn->close();

}