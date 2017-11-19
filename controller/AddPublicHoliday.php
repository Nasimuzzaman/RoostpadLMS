<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/19/17
 * Time: 11:17 AM
 */

require_once '../model/config.php';

if ($conn->connect_error == false) {

    $jsonBody = file_get_contents('php://input');
    $params = json_decode($jsonBody);
    $params = (array)$params;
    $date = $params["date"];
    $description = $params["description"];

    $sql = "INSERT INTO publicHoliday (date, description) VALUES ('$date', '$description')";

    $sql2 = ("SELECT date FROM publicHoliday WHERE date = '$date'") or exit(mysqli_error());

    $select = $conn->query($sql2);

    if (mysqli_num_rows($select)) {
        $params["message"] = "Date Already in Exists";
        $params["statusCode"] = 300;
        $params["error"] = "Date Already in Exists";
        exit("Date Already in Exists");
    }

    if ($conn->query($sql)) {
        $params["message"] = "Date added successfully";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError("Could not add user! Try again!");
    }

    $conn->close();

}