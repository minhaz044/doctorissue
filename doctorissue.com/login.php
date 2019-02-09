<?php
   include("DBcon.php");
      include("gblfun.php");


              session_destroy();

  
         session_start();


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myid = mysqli_real_escape_string($con,$_POST['in-email']);
      $mypassword = mysqli_real_escape_string($con,$_POST['in-password']);
	 // $myrole = mysqli_real_escape_string($con,$_POST['role']);

      $query = "SELECT * FROM users WHERE id = '$myid' and password = '$mypassword' ORDER BY accountno DESC";
      $execute = mysqli_query($con,$query);
      $row = mysqli_fetch_array($execute,MYSQLI_ASSOC);
      $active = $row['verification_status'];

      $count = mysqli_num_rows($execute);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count >=1 ) {

         $_SESSION['login_user_accountno'] = $row['accountno'];
         $_SESSION['login_user'] = $myid;
		     $_SESSION['login_role'] = $row['role'];
		     $_SESSION['login_password'] = $mypassword;
         if($active ==0){
           sent_verificition_code($row['accountno']);
           
           header("location: verify_account.php");
            echo "<script type='text/javascript'> document.location = 'verify_account.php'; </script>";
           echo"string";
         }elseif($active==1 && ($row['role']=='adminsx' || $row['role']=='admin')){
           		 header("location:admin/adminhomepage.php");
         }
         elseif($active==1){
           		 header("location: homepage.php");
         }else{
            header("location: index.php");
         }



      }else {
?>              session_destroy();
			<script type="text/javascript">
				alert("Your Id or Password in incorrect.\n Plz try again");window.location.href='index.php';
			</script>
<?php
      }
   }
?>
