<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/14/17
 * Time: 2:34 PM
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

    $conn->close();

}