



<?php
include("session.php");
 include('sidenav.php');
if(isset($_GET['id']) && $_GET['id']!=""){

include("DBcon.php");
$notification_id=mysqli_real_escape_string($con,$_GET['id']);

$check_Query="SELECT * FROM notification_for  WHERE notification_id=$notification_id AND reciver_id=$login_session";
$check_query_result= mysqli_query($con,$check_Query) or die(mysqli_error($con));
if(mysqli_num_rows($check_query_result)>0){


$Query="SELECT * FROM notification  WHERE id=$notification_id";
$query_result= mysqli_query($con,$Query) or die(mysqli_error($con));
$query_result_row = mysqli_fetch_assoc($query_result);

  ?>


  <html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/res.css">
    <script src="jquery.js" ></script>
      <script src="jquery.min.js" ></script>
    <script src="css/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  </style>
  </head>








  <body>

  <div class="container">
    <h2>  </h2>

<h2> <?php echo $query_result_row['title'];  ?> </h2>
<p><?php echo nl2br($query_result_row['body']); ?></p>
</div>
</body>
<?php
}
}else{
echo"Invalid User ";
}









 ?>
 <script type="text/javascript">

 notify_seen();

   function notify_seen(){
 var notification_id=<?php echo $_GET['id']; ?>;
   $.ajax({
     url: "notify_seen.php",
     type:"POST",
     data:{notification_id:notification_id},
     success:function(data){

     }
   })

 }


 </script>
