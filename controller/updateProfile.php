<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/29/17
 * Time: 4:06 PM
 */


require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $name = $params["name"];
    $email = $params["email"];
    $contact = $params["contact"];
    $designation = $params["designation"];
    $role = $params["role"];
    $holiday = $params["holiday"];
    $emailOfAuthor = $params["emailOfAuthor"];
    $tokenOfAuthor = $params["tokenOfAuthor"];

    $sqlInfo = ("SELECT token, role FROM users WHERE email = '$emailOfAuthor'") or exit(mysqli_error());
    $res = $conn->query($sqlInfo);


    $data = $res->fetch_assoc();

    if( $data["token"] == $tokenOfAuthor ) {

        $sql = "UPDATE users SET users.name = '$name', users.contact = '$contact', users.designation = '$designation', 
            users.role = '$role', users.holiday = '$holiday' WHERE users.email = '$email'";

        if($conn->query($sql)) {
            $params["message"] = "User updated successfully";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            printError( "Could not update user! Try again!");
        }
    }

    $conn->close();

}