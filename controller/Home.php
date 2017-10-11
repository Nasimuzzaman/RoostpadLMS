<?php
/**
 * Created by PhpStorm.
 * User: Nasim
 * Date: 07-Oct-17
 * Time: 2:39 PM
 */

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h4><b>Leave Management System</b></h4>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="Home.php">Home</a></li>
                <li><a href="register.php">Sign Up</a></li>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="Members.php">Members</a></li>
            </ul><br>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..">
                <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
            </div>
        </div>

        <div class="col-sm-9">
            <img src="../images/Leave-Management-System.png" height="600" width="900" alt="Avatar">
        </div>
    </div>
</div>

</body>
</html>
