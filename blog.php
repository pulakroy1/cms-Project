<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/publicstyle.css">
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
                        <li class="nav-item active"><a href="blog.php" class="nav-link">blog</a></li>
                        <li class="nav-item"><a href="about.html" class="nav-link">about us</a></li>
                        <li class="nav-item"><a href="#authors" class="nav-link">services</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">contact us</a></li>
                        <li class="nav-item"><a href="#services" class="nav-link">feature</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" action="FullPost.php">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="search"name="search">
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
                <?php
                    global $connection;

                    if(isset($_GET['searchButton'])){

                        $search = $_GET['search'];

                        $viewquery = "SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%'OR category LIKE '%$search%'OR post LIKE '%$search%'";

                    }else {

                    $viewquery="SELECT * FROM admin_panel ORDER BY datetime desc";    
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
                                if(strlen($Post)>150){$Post=substr($Post,0,150).'...';}
                                echo $Post; ?>
                            </p>
                        </div>
                        <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
                    </div>

                <?php  } ; ?>

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