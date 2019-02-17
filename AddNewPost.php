<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>
<?php confirm_Login(); ?>
<?php
if (isset($_POST['submit'])) {
    
    $title = $_POST['title'];
    $category = $_POST['category'];
    $post = $_POST['post'];

    date_default_timezone_set("Asia/Dhaka");
$currentTime = time();
//$DateTime = strftime("%Y-%m-%d %H:%M:%S",$currentTime );
$DateTime =strftime("%B-%d-%Y %H:%M:%S");
 $DateTime;

 $admin=$_SESSION['Username'];
 
 $image=$_FILES["image"]["name"];
 $target="upload/".basename( $_FILES["image"]["name"]);


    if(empty($title)){
        $_SESSION['ErrorMessage']="Title can not be empty";
        Redirect_to("AddNewPost.php");
    } 

    elseif(strlen($title)<3){
        $_SESSION['ErrorMessage']="Title should be at least 3 character";
        Redirect_to("AddNewPost.php");
    }

    else{
        global $connection;
        $Query="INSERT INTO admin_panel(datetime,title,category,author,image,post) VALUES ('$DateTime','$title','$category','$admin','$image','$post')";
        $Execute=mysqli_query($connection,$Query);
        move_uploaded_file($_FILES["image"]["tmp_name"],$target);

        if($Execute){
            $_SESSION['successmessage']="Post added Successfully";
            Redirect_to("AddNewPost.php");

        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong!try again";
            Redirect_to("AddNewPost.php");
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
    <title>Document</title>

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
        
        <ul id="side_menue" class="nav">
            <li class="nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
            
            <li class="nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
            <li class="active nav-item"><a class="nav-link" href="AddNewPost.php"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="comments.php"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
        </ul>
    </div><!--ending of col-2-->
    <div class="col-sm-10">
        <h1>Add New Post</h1>
        <div><?Php echo message();
            echo successmessage();
            ?>
        </div>

<div>
    <form action="AddNewPost.php"method="post"enctype="multipart/form-data" >
        <fieldset>
            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text"name="title" id="title" placeholder="Title">
            </div> 

            <div class="form-group">
                <label for="category">Category:</label>
                    <select class="form-control" name="category" id="category">
                        <?php 

                            global $connection;
                            $viewquery="SELECT * FROM category ORDER BY datetime desc";
                            $Execute=mysqli_query($connection,$viewquery);

                            while ($DataRows = mysqli_fetch_array($Execute)) {

                            $id = $DataRows['id'];
                            $categoryName = $DataRows['name'];
                        
                        ?>
                        
                        <option><?php echo $categoryName; ?></option>
                        <?php  } ; ?>
                    </select>
            </div> 

            <div class="form-group">
                <label for="imageSelect">Select Image:</label>
                <input class="form-control" type="file" name="image" id="imageSelect">
            </div>

            <div class="form-group">
                <label for="postarea">Post:</label>
                <textarea class="form-control" name="post" id="postarea"></textarea>
                <br>
            </div>

            <div>
                <input class="btn btn-success btn-block mt-2" type="submit"name="submit"value="Add New Post">
                <br>
            </div>
                
        </fieldset>
    </form>
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