<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>

<?php

    if(isset($_GET['id'])){
        
        $IdFormUrl = $_GET['id'];
        $connection;

        $Query = "UPDATE comments SET status='ON' WHERE id='$IdFormUrl' ";
        $Execute = mysqli_query($connection,$Query);

        if($Execute){
            $_SESSION['successmessage']="Comment Approve Successfully";
            Redirect_to("comments.php");
    
        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong";
        Redirect_to("comments.php");
        }

    }



?>
