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

 $admin="Pulak Roy";
 $image=$_FILES["image"]["name"];
 $target="upload/".basename( $_FILES["image"]["name"]);

 


    
        global $connection;
        $DeleteFormUrl=$_GET['Delete'];
        $Query="DELETE FROM admin_panel WHERE id='$DeleteFormUrl'";
        $Execute=mysqli_query($connection,$Query);
        move_uploaded_file($_FILES["image"]["tmp_name"],$target);

        if($Execute){
            $_SESSION['successmessage']="Post Deleted Successfully";
            Redirect_to("Dashboard.php");

        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong!try again";
            Redirect_to("dashboard.php");
        }




}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Post</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/adminstyle.css">
</head>
<body>
<div class="container-fluid">
<div class="row">
    <div class="col-sm-2">
        
        <ul id="side_menue"  class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
        </ul>
    </div><!--ending of col-2-->

    <div class="col-sm-10">
        <h1>Delete Post</h1>
        <div><?Php echo message();
            echo successmessage();
            ?>
        </div>
<div>
    <?php 
        
        $searchqueryParameter = $_GET['Delete'];
        $connection;
        $query = "SELECT * FROM admin_panel WHERE id='$searchqueryParameter'";
        $Execute = mysqli_query($connection,$query);

        while($DataRows=mysqli_fetch_array($Execute)){
            $titleToBeUpdaate = $DataRows['title'];
            $categoryToBeUpdaate = $DataRows['category'];
            $imageToBeUpdaate = $DataRows['image'];
            $postToBeUpdaate = $DataRows['post'];

        }


    
    
    
    ?>
    <form action="DeletePost.php?Delete=<?php echo $searchqueryParameter; ?>"method="post"enctype="multipart/form-data" >
        <fieldset>
            <div class="form-group">
                <label for="title">Title:</label>
                <input disabled value="<?php echo $titleToBeUpdaate?>" class="form-control" type="text"name="title" id="title" placeholder=" Update Title">
            </div> 

            <div class="form-group">
                <span class="fieldinfo">Existing category:</span>
                <?php echo $categoryToBeUpdaate; ?><br>
                <label  for="category">Category:</label>
                    <select disabled class="form-control" name="category" id="category">
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
                <span class="fieldinfo">Existing image:</span>
               <img src="upload/<?php echo $imageToBeUpdaate; ?>" alt="not found image" width="150px" height=70px;><br>
                <label for="imageSelect">Select Image:</label>
                <input disabled class="form-control" type="file" name="image" id="imageSelect">
            </div>

            <div class="form-group">

                <label for="postarea">Post:</label>
                <textarea disabled class="form-control" name="post" id="postarea">
                   <?php echo $postToBeUpdaate; ?> 
                </textarea>
                <br>
            </div>

            <div>
                <input class="btn btn-danger btn-block mt-2" type="submit"name="submit"value="Delete Post">
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