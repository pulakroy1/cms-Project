<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>

<?php
if (isset($_POST['submit'])) {
    
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    if(empty($username) ||empty($password)){
        $_SESSION['ErrorMessage']=" All fields must be field out";
        Redirect_to("Login.php");
    } 

    else{
        $Found_Account=Login_Attempt($username,$password);
        $_SESSION['User_Id']=$Found_Account['id'];
        $_SESSION['Username']=$Found_Account['username'];

        if($Found_Account){
            $_SESSION['successmessage']="Welcome {$_SESSION['Username']}";
            Redirect_to("dashboard.php");
        }
        else{
            $_SESSION['ErrorMessage']="username/ password not valid";
            Redirect_to("Login.php");
        }
        

    }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Admin</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/adminstyle.css">

    <style>
        body{
            background-color:#ffffff;
        }
    </style>
</head>
<body>
<div style="height: 10px;background: #27aae1;"></div>
        <nav id="pk" class="navbar navbar-dark navbar-expand-md ">
            <div class="container">
                <div class="navbar-header">
                    <a href="#showcase" class="navbar-brand">Pulak Roy pk</a>
                </div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"          data-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav"></div>
            </div><!--ending container-->
        </nav><!--ending nav tag-->
    <div style="height: 10px;background: #27aae1;"></div>
    <div class="container">
        <div class="row">
        <div class="col-sm-4"></div>
            <div class="col-sm-offset-3 col-sm-4">
            <div><?Php echo message();
                    echo successmessage();
                  ?>
                </div><br><br>
                <h1>Welcome Back!</h1>
                
                <div class="form-group">
                    <form action="Login.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="Username">Username:</label>
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="username">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input class="form-control" type="password" name="Password" id="passwoed" placeholder="Password">
                        </div>
                        <input class="btn btn-info btn-block mt-2" type="submit" name="submit" value="Login">
                    </fieldset>
                    </form>
                </div>
                    
                
            </div><!--ending of col-4-->
            <div class="col-sm-4"></div>
    </div><!--ending of row-->
</div><!--ending of container-->
    
</body>
</html>