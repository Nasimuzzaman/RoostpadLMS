<?php
/**
 * Created by PhpStorm.
 * User: Nasim
 * Date: 07-Oct-17
 * Time: 2:36 PM
 */

// Include config file
require_once '../model/config.php';

if ($conn->connect_error == false) {
    $jsonBody = file_get_contents('php://input');
    $params   = json_decode($jsonBody);
    $params   = (array)$params;
    $email    = $params["email"];
    $password = $params["password"];




    //$password = sha1($password);
    $sql      = "SELECT * FROM users WHERE email = '$email'";
    $result   = $conn->query($sql);

    if ($result->num_rows == 1) {


        $data = new stdClass();
        $row  = $result->fetch_assoc();
        if ($password == $row["password"]) {
            $token = getConfirmationToken(100);
            $sql   = "UPDATE users SET token = '$token' WHERE email = '$email'";
            if ($conn->query($sql) == TRUE) {
                $row["token"]      = $token;
                $row["id"] = (int)$row["id"];
                $row["statusCode"] = 200;
                $row["error"]      = "";
                //unset($row["password"]);
                $row["message"] = "Logged in successfully!";

                $sql2 = "SELECT users.email from users where users.role = 'CTO'";
                $res = $conn->query($sql2);
                if($res) {
                    $row2  = $res->fetch_assoc();
                    $row["emailOfCTO"] = $row2["email"];
                } else {
                    echo "Error";
                }


                echo json_encode($row);
            } else {
                printError("Could not generate token! Try again.");
            }

        } else {
            printError("Email or password do not match.");
        }



    } else {
        printError("Oops! Something went wrong!");
    }

    $conn->close();
}