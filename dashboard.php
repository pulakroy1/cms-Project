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
                <br> 
                <ul id="side_menue"  class="nav nav-pills">
                    <li class="active nav-item"><a class="nav-link" href="Dashboard.php"><span class="fa fa-home"></span> &nbsp; Dashboard</a></li>

                    <li class="nav-item"><a class="nav-link" href="Categories.php"><span class="fa fa-twitter"></span>&nbsp; Catagories</a></li>

                    <li class="nav-item"><a class="nav-link" href="AddNewPost.php"><span class="fa fa-envelope-open"></span>&nbsp; Add New Post</a></li>

                    <li class="nav-item"><a class="nav-link" href="Admins.php"><span class="fa fa-gears"></span>&nbsp; Manage Admins</a></li>

                    <li class="nav-item"><a class="nav-link" href="comments.php"><span class="fa fa-cloud"></span>&nbsp; Comments
                    <?php
                        
                        $connection;
                        $QueryTotal = "SELECT COUNT(*) FROM comments WHERE status='OFF' ";
                        $executeTotal = mysqli_query($connection,$QueryTotal);
                        $RowsTotal = mysqli_fetch_array($executeTotal);
                        $TotalTotal = array_shift($RowsTotal);
                        if ($TotalTotal >0){
                        
                        ?>
                        <span class="prm pull-right btn-warning">
                            <?php echo $TotalTotal; ?>
                        </span>
                        <?php } ?>

                    <li class="nav-item"><a class="nav-link" href="blog.php"><span class="fa fa-cart-plus"></span>&nbsp; Live Blog</a></li>

                    <li class="nav-item"><a class="nav-link" href="Logout.php"><span class="fa fa-list"></span>&nbsp; Logout</a></li>
                </ul>
            </div><!--ending of col-2-->
            <div class="col-sm-10"><!--main area-->
                <div>
                    <?Php echo message();
                          echo successmessage();
                    ?>
                </div>
                
                <h1>Admin Dashboard</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                        <?php
                            $connection;

                            $viewquery = "SELECT * FROM admin_panel ORDER BY datetime desc;";

                            $execute = mysqli_query($connection,$viewquery);
                            $srNo=0;
                            while($datarows = mysqli_fetch_array($execute)){
                                $id = $datarows['id'];
                                $datetime = $datarows['datetime'];
                                $title = $datarows['title'];
                                $category = $datarows['category'];
                                $admin = $datarows['author'];
                                $image = $datarows['image'];
                                $post = $datarows['post'];
                                
                                $srNo++;
                            
                        ?>
                            <tr>
                                <td><?php echo $srNo; ?></td>
                                <td style="color:#5e5eff;">
                                    <?php
                                        if(strlen($title)>6){$title=substr($title,0,6) .'..';}
                                        echo $title; 
                                    ?>
                                 </td>
                                <td><?php
                                if(strlen($datetime)>15){$datetime=substr($datetime,0,15) .'..';}
                                 echo $datetime; ?></td>
                                <td><?php
                                
                                if(strlen($admin)>5){$admin=substr($admin,0,5) .'..';}
                                 echo $admin; ?></td>
                                <td><?php
                                 echo $category; ?></td>

                                <td><img src="upload/<?php echo $image; ?>" width="130px" height="100px" alt="img not found"></td>
                                <td>

                                    <?php
                                    
                                    $connection;
                                    $QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='ON' ";
                                    $executeApproved = mysqli_query($connection,$QueryApproved);
                                    $RowsApproved = mysqli_fetch_array($executeApproved);
                                    $TotalApproved = array_shift($RowsApproved);
                                    if ($TotalApproved >0){
                                        
                                    
                                    ?>
                                    <span class="pkrp label pull-right">
                                     <?php echo $TotalApproved; ?>
                                    </span>
                                    <?php } ?>

                                    <!--2nd time-->
                                     <?php
                                    
                                    $connection;
                                    $QueryUnApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='OFF' ";
                                    $executeUnApproved = mysqli_query($connection,$QueryUnApproved);
                                    $RowsUnApproved = mysqli_fetch_array($executeUnApproved);
                                    $TotalUnApproved = array_shift($RowsUnApproved);
                                    if ($TotalUnApproved >0){
                                    
                                    ?>
                                    <span class="prm">
                                     <?php echo $TotalUnApproved; ?>
                                    </span>
                                    <?php } ?>
                               
                                </td>

                                <td>
                                    <a href="EditPost.php?Edit=<?php echo $id; ?>"><span class="btn btn-warning">Edit </span></a>

                                    <a href="DeletePost.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
                                    
                                <td>
                                <a href="FullPost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span>
                                    </a>
                                </td>
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