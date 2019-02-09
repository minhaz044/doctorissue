<?php
include("DBcon.php");
include("session.php");
if($login_role=="basic"){
if(isset($_POST['apply']) && $_POST["token"]==$_SESSION["token"]){
  // username and password sent from form
  $bmdc = mysqli_real_escape_string($con,$_POST['bmdc']);
  $mypassword = mysqli_real_escape_string($con,$_POST['pwd']);



  if(empty($_FILES['profile_picture']['name'])===true || empty($bmdc) || empty($mypassword)){
    echo "$bmdc";
    echo "$mypassword";
    echo"Field Must Not Be Empty";
  }else{
    $allowed=array('jpg', 'jpeg', 'gif', 'png');
    $file_name=$_FILES['profile_picture']['name'];
    $file_extn=explode('.',$file_name);
    $file_extn=end($file_extn);
    $file_extn=strtolower($file_extn);
    $file_temp=$_FILES['profile_picture']['tmp_name'];
    $file_size = $_FILES['profile_picture']['size'];
    $new_size = $file_size/1024;
    if(in_array($file_extn,$allowed)){
      if($new_size <2500){

                      if ( $mypassword==$login_password) {
                        $user_id=(int)$login_session;
                        $file_name=substr(md5(time()),0,10);
                        $file_path="uploads/images/prifilepicture/".$file_name.".".$file_extn;
                        $up=move_uploaded_file($file_temp,$file_path);
      
                        $query1=" INSERT INTO temp_doctors_basic_info(user_id,govt_doc_id,seen,rejected,accepted,status,picture ) VALUES('$user_id',$bmdc,0,0,0,1,'$file_path')";
                        $execute1=mysqli_query($con,$query1) or die(mysqli_error($con));
echo "Request Submited";
                              if($execute1){
                                ?><script type="text/javascript">
                                  alert("Your Request has been Submited.\n We will Verify Your account With in 24 Hour\n Thank You.");window.location.href='homepage.php';
                                </script><?php

                              }else{
                                echo "Something Wrong ,We are Working On it";
                              }

                      }else{
                            echo"Wrong Password\n Try with Valid Password";
                      }

      }else{
            echo"Upload a File with in 2MB ";
      }

    }else{
      echo"Incorrect File Type.Allowed ";
      echo implode(',',$allowed);
    }

  }

  $_SESSION["token"] = rand(10000,99999);
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">


  <div class="row">
    <form style="padding-top: 50px;" class="form-horizontal" method="POST"enctype="multipart/form-data"action="">

      <div class="form-group">
        <label class="control-label col-sm-2" for="BM&DC">Your BM&DC id:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bmdc" placeholder="Enter your BM&DC id" name="bmdc" required>
        </div>
      </div>

      <div  class="form-group">
        <label class="control-label col-sm-2" for="email">Profile Picture(A valid Picture of yours):</label>
        <div class="col-sm-10">
          <input type="file" class="file" id="profile_picture"  name="profile_picture" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
        </div>
      </div>
      <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
       echo  $_SESSION["token"] ;?>">
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" name="apply" id="apply" value="Apply"class="btn btn-default btn-success">Apply</button>
        </div>
      </div>
    </form>
    <div class="alert alert-danger">
    <strong>Notice!</strong> Do not Provide Any Fake Information And Make Sure Your Profile is Completed.
  </div>
  </div>

</div>

</body>
</html>
<?php
}

else {
  ?>

<script type="text/javascript">
  alert("Your Are Already A Doctor.\n Thank You.");window.location.href='homepage.php';
</script>

  <?php
}
?>
