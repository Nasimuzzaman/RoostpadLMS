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
    $emailOfAdder = $params["emailOfAdder"];
    $tokenOfAdder = $params["tokenOfAdder"];
    $name = $params["name"];
    $email = $params["email"];
    $contact = $params["contact"];
    $password = $params["password"];
    $designation = $params["designation"];
    $role = $params["role"];
    $holiday = $params["holiday"];
    $gender = $params["gender"];

    $sqlInfo = ("SELECT token, role FROM users WHERE email = '$emailOfAdder'") or exit(mysqli_error());
    $res = $conn->query($sqlInfo);

    if(mysqli_num_rows($res) && $res->fetch_assoc()["token"] == $tokenOfAdder && $res->fetch_assoc()["role"] != "Employee") {
        $sql = "INSERT INTO users (name, email, contact, password, designation, role, holiday, gender) VALUES ('$name', '$email', '$contact', '$password', '$designation', '$role', '$holiday', '$gender')";

        $sql2 = ("SELECT email FROM users WHERE email = '$email'") or exit(mysqli_error());
        $select = $conn->query($sql2);
        if(mysqli_num_rows($select)) {
            $params["message"] = "User Already in Exists";
            $params["statusCode"] = 409;
            $params["error"] = "Conflict";
            exit("User Already in Exists");
            $conn->close();
        }

        if($conn->query($sql)) {
            $params["message"] = "User added successfully";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            printError( "Could not add user! Try again!");
        }
    } else {
        $params["message"] = "Permission denied";
        $params["statusCode"] = 403;
        $params["error"] = "You don't have sufficient permission";
        exit("Permission denied");
    }

    $conn->close();

}