<?php
include("DBcon.php");


if(isset($_POST['apply'])){
  // username and password sent from form

  $myid = mysqli_real_escape_string($con,$_POST['signup_email']);
  $mypassword = mysqli_real_escape_string($con,$_POST['txtNewPassword']);
  $querytest=" SELECT  * FROM users WHERE id='$myid'";
  $executetest=mysqli_query($con,$querytest) or die(mysqli_error($con));
 $count = mysqli_num_rows($executetest);
 echo $count;
 if(mysqli_num_rows($executetest)==0){




   $query1=" INSERT INTO users(id,password,role) VALUES('$myid','$mypassword','basic')";
   $execute1=mysqli_query($con,$query1) or die(mysqli_error($con));

         if($execute1){
           $user_id=mysqli_insert_id($con);
           $insert_query2="INSERT INTO notification_for (reciver_id,notification_id,status) VALUES('$user_id',12,1)";
       		  $insert_query_result2=mysqli_query($con,$insert_query2) or die(mysqli_error($con));




           session_start();

        	 // $myrole = mysqli_real_escape_string($con,$_POST['role']);
              $query = "SELECT * FROM users WHERE id = '$myid' and password = '$mypassword'";
              $execute = mysqli_query($con,$query);
              $row = mysqli_fetch_array($execute,MYSQLI_ASSOC);
              $count = mysqli_num_rows($execute);
              $active=0;
              // If result matched $myusername and $mypassword, table row must be 1 row
              if($count == 1 && $active==1) {
                 $_SESSION['login_user_accountno'] = $row['accountno'];
                 $_SESSION['login_user'] = $myid;
        		     $_SESSION['login_role'] = $row['role'];
        		     $_SESSION['login_password'] = $mypassword;
               $_SESSION['active_status'] =$row['verification_status'];
        		    header("location: homepage.php");
              }elseif ($count == 1 && $active==0) {
               $_SESSION['login_user_accountno'] = $row['accountno'];
               $_SESSION['login_user'] = $myid;
              $_SESSION['login_role'] = $row['role'];
              $_SESSION['login_password'] = $mypassword;
             include("gblfun.php");
             sent_verificition_code($row['accountno']);
             echo "<script type='text/javascript'> document.location = 'verify_account.php'; </script>";
             header("location:verify_account.php");
             }else {
        ?>
        			<script type="text/javascript">
        				alert("Your Id or Password in incorrect.\n Plz try again with valid information");window.location.href='index.php';
        			</script>
        <?php
              }
           }

 }else{

   ?>
   <script type="text/javascript">
     alert("This E-mail/Phone Number is already used .\n Plz try again with other E-mail/Phone Numer");window.location.href='index.php';
   </script>


   <?php


}
}

 ?>
