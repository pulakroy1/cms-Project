<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>

<?php
if (isset($_POST['Submit'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    date_default_timezone_set("Asia/Dhaka");
$currentTime = time();
//$DateTime = strftime("%Y-%m-%d %H:%M:%S",$currentTime );
$DateTime =strftime("%B-%d-%Y %H:%M:%S");
 $DateTime;

    $PostId=$_GET['id'];

    if(empty($name) ||empty($email) ||empty($comment)){
        $_SESSION['ErrorMessage']="all field are required";
      
    } 

    elseif(strlen($comment)>300){
        $_SESSION['ErrorMessage']="Only 300 character are availabele for comment";
      
    }

    else{
        global $connection;
        $PostIDFormUrl=$_GET['id'];
        $Query = "INSERT INTO comments(datetime,name,email,comment,status,admin_panel_id)VALUES('$DateTime','$name','$email','$comment','OFF','$PostIDFormUrl')";
        $Execute = mysqli_query($connection,$Query);
        

        if($Execute){
            $_SESSION['successmessage']="Comment submitted successfully";
            Redirect_to("FullPost.php?id={$PostId}");

        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong!try again";
            Redirect_to("FullPost.php?id={$PostId}");
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
    <title>Full blog Post</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/publicstyle.css">
<style>
    .col-sm-3{
        background-color:green;
    }
    .fieldinfo{
        color: rgb(251,174,44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    }
    .commentBlock{
        background-color:#F6F7F9;
    }
    .comment-info{
        color:#365899;
        <font-family:sans-serif;
        font-size:1.1em;
        font-weight:bold;
        padding-top:10px;
    }
    .comment{
        font-weight:bold;
    }
</style>
        
</head>
<body>
    <!--<div style="height: 10px;background: #27aae1;"></div>-->
    <nav class="navbar navbar-dark navbar-expand-md ">
        <div class="container">
            <div class="navbar-header">
                <a href="#showcase" class="navbar-brand">Pulak Post</a>
            </div>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"          data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="index.html" class="nav-link">home</a></li>
                        <li class="nav-item"><a href="blog.php" class="nav-link">blog</a></li>
                        <li class="nav-item"><a href="about.html" class="nav-link">about us</a></li>
                        <li class="nav-item"><a href="#authors" class="nav-link">services</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">contact us</a></li>
                        <li class="nav-item"><a href="#services" class="nav-link">feature</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" action="blog.php">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="search" name="search">
                        </div>  
                        <button class="btn btn-default" name="searchButton">Go</button>
                    </form>
                </div>
        </div><!--ending container-->
    </nav><!--ending nav tag-->

    <div class="container">
        <div class="blog-header">
            <h1>The complete Responsive CMS Blog </h1>
            <p class="lead">The Complete blog using PHP by Pulak Roy</p>
            
        </div>
        <div class="row">
            <div class="col-sm-8">
            <?Php echo message();
                 echo successmessage();
            ?>
                <?php
                    global $connection;

                    if(isset($_GET['searchButton'])){

                        $search = $_GET['search'];

                        $viewquery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'OR category LIKE '%$search%'OR post LIKE '%$search%'";

                    }
                    else {

                    $PostIDFormUrl=$_GET['id'];

                    $viewquery="SELECT * FROM admin_panel
                     WHERE  id='$PostIDFormUrl'
                    ORDER BY datetime desc";    
                }
                    $Execute=mysqli_query($connection,$viewquery);

                    while($DataRows = mysqli_fetch_array($Execute)) {

                        $PostId = $DataRows['id'];
                        $DateTime = $DataRows['datetime'];
                        $Title = $DataRows['title'];
                        $Category = $DataRows['category'];
                        $Admin = $DataRows['author'];
                        $Image = $DataRows['image'];
                        $Post = $DataRows['post'];
                    
                
                ?>

                    <div class="blogpost img-thumbnail">
                        <img class=" img-thumbnail" src="upload/<?php echo $Image;?>" alt="not found img">
                        <div class="caption">
                            <h1 id="heading"><?php echo htmlentities($Title); ?> </h1>
                            <p class="description">Category:<?php echo htmlentities($Category);?> Publish On <?php echo htmlentities($DateTime ); ?></p>
                            <p class="post"><?php
                                echo $Post; ?>
                            </p>
                        </div>
                    </div>

                <?php  } ; ?><br>
                <span class="fieldinfo">Share Your Thought About This Post</span><br>
                <span class="fieldinfo">Comments</span>
                <?php 
                    $connection;

                    $postIdComment = $_GET['id'];
                    $commentQuery = "SELECT * FROM comments WHERE admin_panel_id='$postIdComment' AND status= 'ON' ";
                    $Execute = mysqli_query($connection,$commentQuery);

                    while($DataRows=mysqli_fetch_array($Execute)){
                        $DateTime = $DataRows['datetime'];
                        $Name = $DataRows['name'];
                        $Viewercomment = $DataRows['comment'];
                    
                
                
                ?>
                <div class="commentBlock">
                    <img class="pull-left" src= "images/Screenshot_2.jpg" width="85px"; height="50px;" >
                    <p class="comment-info"><?php echo $Name;?></p>
                    <p class="description"><?php echo $DateTime;?></p>
                    <p class="comment"><?php echo $Viewercomment;?></p>
                </div>
                <br> 
                        <hr>
                <?php }; ?>

                <div>
                    <form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="Name"><span class="fieldinfo">Name:</span></label>
                                <input class="form-control" type="text" name="name" id="Name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="Email"><span class="fieldinfo">Email:</span></label>
                                <input class="form-control" type="text" name="email" id="Email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="CommentArea"><span class="fieldinfo">Comment:</span></label>
                                <textarea class="form-control" name="comment" id="CommentArea" ></textarea>
                                <br>
                                <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
                            </div>
                        </fieldset>
                </form>
                </div>

            </div><!--ending col-sm-8-->
            <div class="col-sm-offset-1 col-sm-3">
            <h1>Test</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolorum libero quaerat eos facere molestiae earum exercitationem autem consectetur et assumenda, impedit illum hic, recusandae enim accusamus magni amet architecto!</p>
            </div>
        </div><!--ending row tag-->
    </div><!--ending container tag-->

    <div id="footer">
    <div class="fut">
        <p>Them By |Pulak Roy |&copy;2016-2020---All Right Reserved.</p>
        <a style="color:white; text-decoration:none;cursor:pointer; font-weight:bold" href="http://all credit goes to zagib akram"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo nihil, maxime eius <br> ad reprehenderit blanditiis.</p></a>
    </div>
</div><!--ending of id footer div-->

    
</body>
</html>