<!DOCTYPE html>
<?php
include("session.php");
if(isset($_POST['btn-upload']))
{
  include("DBcon.php");
  $user_id=mysqli_real_escape_string($con,$_GET["id"]);
  $slot_id=mysqli_real_escape_string($con,$_GET["sid"]);
  date_default_timezone_set('Asia/Dhaka');
  $date=date('y-m-d');
  $did=$login_session;
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
  $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="uploads/";

	// new file size in KB
	$new_size = $file_size/1024;
	// new file size in KB

	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case

	$final_file=str_replace(' ','-',$new_file_name);

	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
    $query="INSERT INTO report(user_id,doctors_id,submisson_date,file)
    values ('$user_id','$did','$date','$final_file')";
    $execute=mysqli_query($con,$query);
    if($execute){
      ?>
      <script type="text/javascript">
          alert("Medical Report Uploaded Sucessfuly.\nThank you ");window.location.href='viewpatientprofile.php?id=<?php echo"$user_id";?>&sid=<?php echo"$slot_id";?>';
        </script>
  <?php
    }
    else {
      echo " Data insertion failed! </br> Try Again!";
    }
    }
    else {
      echo " Data insertion failed! </br> Try Again!";
    }
}
?>
























































<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="jquery.js" ></script>
      <script src="jquery.min.js" ></script>
    <script src="css/js/bootstrap.min.js" ></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Upload Report </title>
  </head>
  <body>
    <div class="Responsive" align="center">
    <form class="form-control" enctype="multipart/form-data" action="" method="post"></br></br>

      <p>Browse report To upload</p>

      <input type="file" name="file" value="" ></br>
      <input type="submit" class="btn btn-warning" name="btn-upload" value="Upload">
    </form><div>
  </body>
</html>
