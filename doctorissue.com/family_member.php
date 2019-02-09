      <?php  include("sidenav.php"); ?>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
button {
    background-color: #4CbF50;
    color: white;
    padding: 12px 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: center;
}
ul {
  list-style-type: none;

}
li a {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 25px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.3s;
  cursor: pointer;
  height:18px;
  width:220px;
  background-color: white;
  color: black;
  border: 2px solid #4CAF50;


}


li a:hover {
     background-color: #4CAF50;
    color: white;
}

</style>
</head>
<body>

  <div class="container-p">

    <h2>Family Member</h2>
      <form action="" method="POST">
      <div class="row">
        <div class="col-75">
           <input type="text" name="search_tag"  placeholder="Search With Your Family Members ID" required></br>
        </div>
        <div class="col-25">
          <input type="submit" value="Submit" class="btn btn-success" name="search_button">
        </div>
        </div>
  </form >
</div>
<div class="col-75" >
<?php
include('session.php');
include('DBcon.php');


if(isset($_POST['search_button']))
{

  $temp=mysqli_real_escape_string($con,$_POST['search_tag']);
$query1="SELECT * FROM users WHERE accountno='$temp'";


$result1=mysqli_query($con,$query1) or die(mysqli_error($con));

      if(mysqli_num_rows($result1)>0){

?>
            <table class="table table-Responsive table-hover table-condensed">
<?php
      			while($row1 = mysqli_fetch_assoc($result1)) {


              ?>
              <tr>
                <td width="50%"align="center"><?php echo $row1['fname']." ".$row1['lname']?></td>
<?php
//Cheking the function


$is_family=family_status($login_session,$row1['accountno']);
if ($is_family==0) {7
  ?>
  <td></td>
  <?php
}
elseif ($is_family==1) {
?>
<td ><button  class="family_handaler btn btn-success "  type="button" name="add_to_family" id="<?php echo $row1['accountno']?>"> Family</button></td>
<?php
}
elseif ($is_family==2) {
?>
<td ><button  class="family_handaler btn btn-success "  type="button" name="add_to_family" id="<?php echo $row1['accountno']?>"> Cancel</button></td>
<?php
}
elseif ($is_family==3) {
  ?>
<td ><button  class="family_handaler btn btn-success "  type="button" name="add_to_family" id="<?php echo $row1['accountno']?>"> Accept</button></td>
<?php
}
else {
  ?>
  <td ><button  class="family_handaler btn btn-success "   type="button" name="add_to_family" id="<?php echo $row1['accountno']?>">  Add Family</button></td>
<?php
}

?>

      </tr>

<?php

            }
?>



<?php
    }
        else {
          echo "NO Data Found";
        }



?>
</table>

</div>

<?php
}
else {
//show Family Member


//check family then show member
$member_check_query1="SELECT * FROM family_member WHERE ( sender='$login_session' or reciver='$login_session') AND status=1";
$member_check_result1=mysqli_query($con,$member_check_query1) or die(mysqli_error($con));
    if(mysqli_num_rows($member_check_result1)>0){




?>
      <div align="center">
      <ul >
<?php
      			while($member_check_row1 = mysqli_fetch_assoc($member_check_result1)) {
              if($login_session==$member_check_row1['reciver']){
                $family_member=$member_check_row1['sender'];
              }else {
                $family_member=$member_check_row1['reciver'];
              }

      $member_check_query2="SELECT * FROM users WHERE accountno='$family_member'";
      $member_check_result2=mysqli_query($con,$member_check_query2) or die(mysqli_error($con));
      $member_check_row2 = mysqli_fetch_assoc($member_check_result2);
?>
    <li><a href="family_member_profile.php?f_m_id=<?php echo $member_check_row2['accountno'];?>"><span><?php echo $member_check_row2['fname']." ". $member_check_row2['lname'];?></span></a></li>
<?php
    }
?>
</ul>
</div>
<?php
}
}
?>

</body>
</html>
<script >

  $(document).ready(function(){


    $(document).on("click",".family_handaler",function(){

            var select_btn_val =$(this).attr("id");
            $.ajax({
              url: "family_handaler.php",
              type:"POST",
              data:{"select_btn_val":select_btn_val},
              success:function(data){
                $(".family_handaler").html(data);
              }
            })

            });





  });



</script>
