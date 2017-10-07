<?php
/**
 * Created by PhpStorm.
 * User: Nasim
 * Date: 07-Oct-17
 * Time: 2:39 PM
 */

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>