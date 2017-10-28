<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/23/17
 * Time: 6:53 PM
 */


require_once '../model/config.php';

/*function add_member() {

    global $conn;
    if (isset($_POST['add_member'])) {
        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $Contact = $_POST['contact'];
        $Password = $_POST['password'];
        $Designation = $_POST['designation'];
        $Role = $_POST['role'];
        $Holiday = $_POST['holiday'];
        $Gender = $_POST['gender'];



        $sql_check = "SELECT * FROM users WHERE email = '$Email'";
        $res_check = mysqli_query($conn, $sql_check);

        if ($row = mysqli_fetch_assoc($res_check)) {
            printError( "UserName Allready Exist...!!!");
        } else {
            $sql = "INSERT INTO `users`(`id`, `name`, `email`, `contact`, `password`, `token`, `designation`, `role`, `holiday`, `gender`) VALUES ('', $name, $email, $contact, $password, '', $designation, $role, $holiday, $gender)";
            $resust = mysqli_query($conn, $sql);
            if ($resust) {
                echo "<script>alert('Member added succesfully...!!!')</script>";
            }
        }
    }

}
echo add_member();
*/

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