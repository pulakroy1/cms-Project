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
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/adminstyle.css">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <h2>Pulak</h2>
                <ul id="side_menue" class="nav">
                    <li class="active"><a href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
                    <li><a href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
                    <li><a href="#"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
                    <li><a href="#"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
                    <li><a href="#"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
                    <li><a href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
                    <li><a href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
                </ul>
            </div><!--ending of col-2-->
            <div class="col-sm-10">
                
                <h1>Admin Dashboard</h1>
                <div><?Php echo message();
                    echo successmessage();
                 ?></div>
                <h4>About</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
                <h4>About</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
                <h4>About</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
                <h4>About</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
                <h4>About</h4>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda odit numquam officia earum nisi perspiciatis iste consequuntur modi maxime aut?</p>
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