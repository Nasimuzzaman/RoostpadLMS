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

        </div>


        <div class="col-sm-9">
            <div class="wrapper">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="../controller/login.php" method="post">
                    <div class="form-group">
                        <label>Email:<sup>*</sup></label>
                        <input type="text" name="email"class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password:<sup>*</sup></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
