<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 11/11/17
 * Time: 11:46 AM
 */

include_once '../model/config.php';

if ($conn->connect_error == false) {

    $sql = "SELECT leave_requests.*, users.name from leave_requests LEFT JOIN users ON leave_requests.email = users.email WHERE leave_requests.status = 'pending'";


    if($conn->query($sql)) {

        $result = $conn->query($sql);
        $pendingRequests = array();
        while (($row = $result->fetch_assoc()) != null) {
            $pendingRequests[] = $row;
        }
        $params["contactList"] = $pendingRequests;
        $params["message"] = "";
        $params["statusCode"] = 200;
        $params["error"] = "";
        echo json_encode($params);
    } else {
        printError( "Could not get pending requests! Try again!");
    }

    $conn->close();

}