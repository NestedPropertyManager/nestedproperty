<?php
//four steps into closing a session i.e logging out
//1. find the cookie
session_start();
//2.unset all the session variables
$_SESSION=array();
//3.destroy the session cookie
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-4500,'/');
    //4.destroy the session
    session_destroy();
    header("location:login.php?logout=1");
    exit;
   // print("you are now logged out");
}//end if statement
?>