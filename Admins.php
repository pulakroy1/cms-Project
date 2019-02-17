<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>
<?php confirm_Login(); ?>
<?php
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    date_default_timezone_set("Asia/Dhaka");
$currentTime = time();
//$DateTime = strftime("%Y-%m-%d %H:%M:%S",$currentTime );
$DateTime =strftime("%B-%d-%Y %H:%M:%S");
 $DateTime;

 $admin=$_SESSION['Username'];


if(empty($username) ||empty($password) ||empty($confirmpassword)){
    $_SESSION['ErrorMessage']="fields must be field out";
    Redirect_to("Admins.php");
} 
else if(strlen($password)<4){
    $_SESSION['ErrorMessage']="At least 4 character are required for password";
    Redirect_to("Admins.php");
}
else if($password!== $confirmpassword){
    $_SESSION['ErrorMessage']="password/ confirmpassword does not match.Try again!";
    Redirect_to("Admins.php");
}
else{
    global $connection;
    $Query="INSERT INTO registration(datetime,username,password,addedby) VALUES ('$DateTime','$username','$passwore','$admin')";
    $Execute=mysqli_query($connection,$Query);

    if($Execute){
        $_SESSION['successmessage']="Admins added Successfully";
        Redirect_to("Admins.php");

    }
    else{
        $_SESSION['ErrorMessage']="Admins failed to add";
        Redirect_to("Admins.php");
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
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav hdru">
                            <li class="nav-item hruli"><a href="index.html" class="nav-link">home</a></li>
                            <li class="nav-item hruli"><a href="blog.php" target="_blank" class="nav-link">blog</a></li>
                            <li class="nav-item hruli"><a href="about.html" class="nav-link">about us</a></li>
                            <li class="nav-item hruli"><a href="#authors" class="nav-link">services</a></li>
                            <li class="nav-item hruli"><a href="#contact" class="nav-link">contact us</a></li>
                            <li class="nav-item hruli"><a href="#services" class="nav-link">feature</a></li>
                        </ul>
                        <form class="navbar-form navbar-right" action="FullPost.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="search" name="search">
                            </div>  
                            <button class="btn btn-default" name="searchButton">Go</button>
                        </form>
                    </div>
            </div><!--ending container-->
        </nav><!--ending nav tag-->
    <div style="height: 10px;background: #27aae1;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
               
            <ul id="side_menue"  class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
                    <li class="nav-item"><a class="nav-link" href="AddNewPost.php"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
                    <li class="active nav-item"><a class="nav-link" href="Admins.php"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
                </ul>
            </div><!--ending of col-2-->
            <div class="col-sm-10">
                <h1>Manage Admin Access</h1>
                <div><?Php echo message();
                    echo successmessage();
                  ?>
                 </div>
                <div class="form-group">
                    <form action="Admins.php"method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="Username">Username:</label>
                            <input class="form-control" type="text"name="username" id="Username" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input class="form-control" type="password"name="password" id="passwoed" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="Confirmpassword">Confirm Password:</label>
                            <input class="form-control" type="password"name="confirmpassword" id="Confirmpassword" placeholder="Retype Same Passwore">
                        </div>
                        <input class="btn btn-success btn-block mt-2" type="submit"name="submit"value="Add New Admin">
                    </fieldset>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sr No.</th>
                            <th>Date & Time</th>
                            <th>Admin Name</th>
                            <th>Added by</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        global $connection;
                        $viewquery="SELECT * FROM registration ORDER BY datetime desc";
                        $Execute=mysqli_query($connection,$viewquery);

                        $srNo=0;

                        while ($DataRows = mysqli_fetch_array($Execute)) {

                            $id = $DataRows['id'];
                            $DateTime = $DataRows['datetime'];
                            $username = $DataRows['username'];
                            $admin = $DataRows['addedby'];
                            $srNo++;
                    
                        ?>

                        <tr>
                            <td><?php echo $srNo; ?> </td>
                            <td><?php echo $DateTime; ?> </td>
                            <td><?php echo $username; ?> </td>
                            <td><?php echo $admin; ?> </td>
                            <td><a href="DeleteAdmin.php?id=<?php echo $id; ?>">
                            <span class="btn btn-danger">Delete</span></a></td>
                        </tr>

                        <?php  } ; ?>

                    </table>
                
                </div>
                
            </div><!--ending of col-10-->
    </div><!--ending of row-->
</div><!--ending of container-->

<div id="footer">
    <div class="fut">
        <p>Them By |Pulak Roy |&copy;2016-2020---All Right Reserved.</p>
        <a style="color:white; text-decoration:none;cursor:pointer; font-weight:bold" href="http://all credit goes to zagib akram"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo nihil, maxime eius <br> ad reprehenderit blanditiis.</p></a>
    </div>
</div><!--ending of id footer div-->
    
</body>
</html>