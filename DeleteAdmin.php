<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>
<?php require_once("include/function.php");?>

<?php

    if(isset($_GET['id'])){
        
        $IdFormUrl = $_GET['id'];
        $connection;

        $Query = "DELETE FROM registration WHERE id='$IdFormUrl' ";
        $Execute = mysqli_query($connection,$Query);

        if($Execute){
            $_SESSION['successmessage']="Admin Deleted Successfully";
            Redirect_to("Admins.php");
    
        }
        else{
            $_SESSION['ErrorMessage']="Something went wrong";
        Redirect_to("Admins.php");
        }

    }



?>
