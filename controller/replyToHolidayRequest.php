<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/28/17
 * Time: 5:27 PM
 */

require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $id = $params["id"];
    $email = $params["email"];
    $status = $params["status"];
    $emailOfAuthor = $params["emailOfAuthor"];
    $tokenOfAuthor = $params["tokenOfAuthor"];

    $sqlInfo = ("SELECT token, role FROM users WHERE email = '$emailOfAuthor'") or exit(mysqli_error());
    $res = $conn->query($sqlInfo);


    $data = $res->fetch_assoc();

    if( $data["token"] == $tokenOfAuthor && $data["role"] == "CTO" ) {
        $sql = "UPDATE requests SET status = '$status' WHERE requests.id = '$id'";

        if($conn->query($sql)) {
            if($status == "accepted") {

                $sqlDays = "SELECT days FROM requests WHERE requests.id = '$id'";
                $days = $conn->query($sqlDays)->fetch_assoc()["days"];

                $sql2 = "UPDATE users SET holiday = (holiday - $days) WHERE users.email = '$email' ";


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