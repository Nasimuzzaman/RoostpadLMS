<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/23/17
 * Time: 6:53 PM
 */


require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $name = $params["name"];
    $email = $params["email"];
    $contact = $params["contact"];
    $password = $params["password"];
    $designation = $params["designation"];
    $role = $params["role"];
    $holiday = $params["holiday"];
    $gender = $params["gender"];

    $sql = "INSERT INTO users (name, email, contact, password, designation, role, holiday, gender) VALUES ('$name', '$email', '$contact', '$password', '$designation', '$role', '$holiday', '$gender')";
    if($conn->query($sql)) {
        $params["message"] = "User added successfully";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError( "Could not add user! Try again!");
    }

    $conn->close();

}