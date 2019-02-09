<?php

   include('DBcon.php');
     if(!isset($_SESSION))
    {
        session_start();
    }


   //$login_session = $_SESSION['login_user'];
   $role_check = $_SESSION['login_role'];
   $login_session =$_SESSION['login_user_accountno'] ;

      date_default_timezone_set('Asia/Dhaka');


   //$login_session = $user_accountno
   $login_role=$role_check;
    $login_password=$_SESSION['login_password'];
   if(!isset($_SESSION['login_user_accountno'])){
      header("location:index.php");
   }



?>
