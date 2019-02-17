<?php require_once("include/Db.php");?>
<?php require_once("include/session.php");?>

<?php
function Redirect_to($New_location){
    header("Location:".$New_location);
    exit;
}

function Login_Attempt($username,$password){

    global $connection;
    $Query="SELECT * FROM registration WHERE username='$username' AND password='$password' ";
    $Execute=mysqli_query($connection,$Query);

    if($admin=mysqli_fetch_assoc($Execute)){
        return $admin;
    }
    else{
        return null;
    }

}

function Login(){
    if(isset($_SESSION['User_Id'])){
        return true;
    }
}

function confirm_Login(){
    if(!Login()){
        $_SESSION['ErrorMessage']="Login Required";
        Redirect_to("Login.php");
    }
}

?>