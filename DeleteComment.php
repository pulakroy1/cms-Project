<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>

<?php

    if(isset($_GET['id'])){
        
        $IdFormUrl = $_GET['id'];
        $connection;

        $Query = "DELETE FROM comments WHERE id='$IdFormUrl' ";
        $Execute = mysqli_query($connection,$Query);

        if($Execute){
            $_SESSION['successmessage']="Comment Deleted Successfully";
            Redirect_to("comments.php");
    
        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong";
        Redirect_to("comments.php");
        }

    }



?>
