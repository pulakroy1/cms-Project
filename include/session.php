<?php
session_start();
function message(){
    if(isset($_SESSION['ErrorMessage'])){
        $output="<div class=\"alert alert-danger\">";
        $output.=htmlentities($_SESSION['ErrorMessage']);
        $output.="</div>";
        $_SESSION['ErrorMessage']=null;
        return $output;
    }
}


function successmessage(){
    if(isset($_SESSION['successmessage'])){
        $output="<div class=\"alert alert-success\">";
        $output.=htmlentities($_SESSION['successmessage']);
        $output.="</div>";
        $_SESSION['successmessage']=null;
        return $output;
    }
}

?>