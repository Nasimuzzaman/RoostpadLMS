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
<div class="outer">
    <div class="middle">
        <div class="inner">

            <h1>The Content</h1>

            <p>Once upon a midnight dreary...</p>

        </div>
    </div>
</div>
</body>
</html>
