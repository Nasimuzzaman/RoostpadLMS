<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/15/17
 * Time: 11:07 AM
 */

require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $email = $params["email"];
    $password = $params["password"];

    $sql = "UPDATE users SET users.password = '$password' WHERE users.email = '$email'";

    $sql2 = ("SELECT email FROM users WHERE email = '$email'") or exit(mysqli_error());
    $select = $conn->query($sql2);

    if(mysqli_num_rows($select)) {
        if($conn->query($sql)) {
            $params["message"] = "Password recovered successfully";
            $params["statusCode"] = 200;
            $params["error"] = "";
            echo json_encode($params);
        } else {
            printError( "Could not update user! Try again!");
        }
    } else {
        exit("This email does not exist in the server");
    }

    $conn->close();

}