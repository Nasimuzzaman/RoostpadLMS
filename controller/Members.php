<?php
/**
 * Created by PhpStorm.
 * User: nasimuzzaman
 * Date: 10/11/17
 * Time: 4:14 PM
 */

include_once '../model/config.php';

class members {


    public static function showMembers() {
        global $con;

        $sql = "SELECT users.name, users.username, users.designation, users.role  FROM users";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo 'Name <td>' . $row['name'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['designation'] . '</td>';
            echo '<td>' . $row['role'] . '</td>';
            echo "</tr>";
        }
    }
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
            <?php
                echo "todo..";
            ?>
        </div>
    </div>
</div>

</body>
</html>