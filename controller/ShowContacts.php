<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/11/17
 * Time: 4:14 PM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $sql = "SELECT users.*  FROM users";
    if($conn->query($sql)) {

        $result = $conn->query($sql);
        $contactList = array();
        while (($row = $result->fetch_assoc()) != null) {
            $contactList[] = $row;
        }
        $params["contactList"] = $contactList;
        $params["message"] = "";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError( "Could not view contacts! Try again!");
    }

    $conn->close();

}