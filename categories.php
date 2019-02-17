<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>
<?php confirm_Login(); ?>
<?php
if (isset($_POST['submit'])) {
    
    $category = $_POST['category'];

    date_default_timezone_set("Asia/Dhaka");
$currentTime = time();
//$DateTime = strftime("%Y-%m-%d %H:%M:%S",$currentTime );
$DateTime =strftime("%B-%d-%Y %H:%M:%S");
 $DateTime;

 $admin=$_SESSION['Username'];


if(empty($category)){
    $_SESSION['ErrorMessage']="fields must be field out";
    Redirect_to("categories.php");
} 
elseif(strlen($category)>99){
    $_SESSION['successmessage']="Too large name for add category";
    Redirect_to("categories.php");
}
else{
    global $connection;
    $Query="INSERT INTO category(datetime,name,creatorname) VALUES ('$DateTime','$category','$admin')";
    $Execute=mysqli_query($connection,$Query);

    if($Execute){
        $_SESSION['successmessage']="Category added Successfully";
        Redirect_to("categories.php");

    }
    else{
        $_SESSION['ErrorMessage']="Category failed to add";
    Redirect_to("categories.php");
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
               
            <ul id="side_menue"  class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
                    <li class="active nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
                    <li class="nav-item"><a class="nav-link" href="AddNewPost.php"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
                </ul>
            </div><!--ending of col-2-->
            <div class="col-sm-10">
                <h1>Manage Categories</h1>
                <div><?Php echo message();
                    echo successmessage();
                  ?>
                 </div>
                <div class="form-group">
                    <form action="categories.php"method="post">
                    <fieldset>
                        <label for="categoryname">Name:</label>
                        <input class="form-control" type="text"name="category" id="categoryname" placeholder="name">
                        <input class="btn btn-success btn-block mt-2" type="submit"name="submit"value="Add New Category">
                    </fieldset>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sr No.</th>
                            <th>Date & Time</th>
                            <th>Category Name</th>
                            <th>Creator Name</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        global $connection;
                        $viewquery="SELECT * FROM category ORDER BY datetime desc";
                        $Execute=mysqli_query($connection,$viewquery);

                        $srNo=0;

                        while ($DataRows = mysqli_fetch_array($Execute)) {

                            $id = $DataRows['id'];
                            $DateTime = $DataRows['datetime'];
                            $categoryName = $DataRows['name'];
                            $creatorName = $DataRows['creatorname'];
                            $srNo++;
                    
                        ?>

                        <tr>
                            <td><?php echo $srNo; ?> </td>
                            <td><?php echo $DateTime; ?> </td>
                            <td><?php echo $categoryName; ?> </td>
                            <td><?php echo $creatorName; ?> </td>
                            <td><a href="DeleteCategory.php?id=<?php echo $id; ?>">
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