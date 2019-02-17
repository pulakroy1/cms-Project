<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>
<?php confirm_Login(); ?>
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
                            <input type="text" class="form-control" placeholder="search"name="search">
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
                <br> 
                <ul id="side_menue"  class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>
                    <li class="nav-item"><a class="nav-link" href="AddNewPost.php"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>
                    <li class="nav-item active"><a class="nav-link" href="Comments.php"><span class="fa fa-cloud"></span>&nbsp; Comments</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
                </ul>
            </div><!--ending of col-2-->
            <div class="col-sm-10"><!--main area-->
                <div>
                    <?Php echo message();
                          echo successmessage();
                    ?>
                </div>
                
                <h1>Un-Approve Comments</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No:</th>
                            <th>Name:</th>
                            <th>Date:</th>
                            <th>Comment:</th>
                            <th>Approve:</th>
                            <th>Delete Comment:</th>
                            <th>Details:</th>
                        </tr>
                        <?php 
                            global $connection;
                            $query="SELECT * FROM comments WHERE status='OFF' ORDER by datetime desc";
                            $execute = mysqli_query($connection,$query);

                                $srNo=0;
                            while($DataRows=mysqli_fetch_array($execute)){
                                $commentId=$DataRows['id'];
                                $dateTime=$DataRows['datetime'];
                                $PersonName=$DataRows['name'];
                                $PersonComment=$DataRows['comment'];
                                $commentedPostId=$DataRows['admin_panel_id'];
                                $srNo++;

                                

                                if(strlen($PersonName)>6){$PersonName=substr($PersonName,0,6) .'..';}
                        
                        ?>
                        <tr>
                            <td><?php echo $srNo; ?></td>
                            <td><?php echo $PersonName; ?></td>
                            <td><?php echo $dateTime; ?></td>
                            <td><?php echo $PersonComment; ?></td>
                            <td><a href="ApproveComment.php?id=<?php echo $commentId;?>"><span class="btn btn-success">Approve</span></a></td>
                            <td><a href="DeleteComment.php?id=<?php echo $commentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                            <td><a href="FullPost.php?id=<?php echo $commentedPostId; ?>" target="_blank">
                            <span class="btn btn-primary">Live Priview</span></a></td>
                        </tr>
                        <?php }; ?>
                    </table>
                </div>
                <!--2 nd time h1-->
                <h1>Approve Comments</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No:</th>
                            <th>Name:</th>
                            <th>Date:</th>
                            <th>Comment:</th>
                            <th>Approved by</th>
                            <th>Revert Approve:</th>
                            <th>Delete Comment:</th>
                            <th>Details:</th>
                        </tr>
                        <?php 
                            global $connection;
                            $admin="Pulak Roy";
                            $query="SELECT * FROM comments WHERE status='ON' ORDER by datetime desc";
                            $execute = mysqli_query($connection,$query);

                                $srNo=0;
                            while($DataRows=mysqli_fetch_array($execute)){
                                $commentId=$DataRows['id'];
                                $dateTime=$DataRows['datetime'];
                                $PersonName=$DataRows['name'];
                                $PersonComment=$DataRows['comment'];
                                $commentedPostId=$DataRows['admin_panel_id'];
                                $srNo++;
                

                                if(strlen($PersonName)>6){$PersonName=substr($PersonName,0,6) .'..';}
                                
                    

                            
                        
                        
                        ?>
                        <tr>
                            <td><?php echo $srNo; ?></td>
                            <td><?php echo $PersonName; ?></td>
                            <td><?php echo $dateTime; ?></td>
                            <td><?php echo $PersonComment; ?></td>
                            <td><?php echo $admin;?></td>
                            <td><a href="DisApproveComment.php?id=<?php echo $commentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
                            <td><a href="#"><span class="btn btn-danger">Delete</span></a></td>
                            <td><a href="FullPost.php?id=<?php echo $commentedPostId; ?>" target="_blank">
                            <span class="btn btn-primary">Live Priview</span></a></td>
                        </tr>
                        <?php }; ?>
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