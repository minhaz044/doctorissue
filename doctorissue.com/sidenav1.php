<!DOCTYPE html>
<html>






<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}


.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: ;
  color: black;
}

.topnav a.active {
  background-color: #000000;
  color: white;
}
.res_screen{
	display: none;
}

.log-out-full{
  float: right;
  padding-right: 50px;
}
.full_screen{
display: block;
  float: right;

}
@media screen and (max-width: 600px) {
  .full_screen{
 	display: none;
    float: right;

  }
  .res_screen{
	display: block;
}
.log-out-full{
  float: left;
  padding-right: 0px;
}
.topnav a {

  color: #f2f2f2;
  text-align: center;
  padding: 15px 20px;
  text-decoration: none;
  font-size: 20px;
}
}



</style>
</head>















<body>

<?php
include("session.php");
include("gblfun.php");
/*********************************The Error Box*///////////////////////////



date_default_timezone_set('Asia/Dhaka');
$ses_query="SELECT  verification_status from users where accountno = '$login_session' ";
$ses_sql = mysqli_query($con,$ses_query);
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$count = mysqli_num_rows($ses_sql);
if($count == 1) {
  $active=$row['verification_status'];
}
else {
$active=0;
}
if($active==0){
header("location:verify_account.php");
}


/*****************************************End of Thje bocx of error********************************/




if(user_identity($login_session)){
?>





<div class="topnav">
  <a class="active" href="homepage.php"><span class="glyphicon glyphicon-home w3-xlarge res_screen"  > </span><span class="full_screen">Home</span></a>
  <a href="doctorsprofile.php?d_id=<?php echo $login_session?>&id=<?php echo $login_session?>"><span class="glyphicon glyphicon-user w3-xlarge res_screen"  > </span><span class="full_screen">Minhaz</span></a>
    <a href="updatepersonalinfo.php"><span class="glyphicon glyphicon-cog w3-xlarge res_screen"  > </span><span class="full_screen">Settings</span></a>
  <a href="#Notefication"><span class="glyphicon glyphicon-bell w3-xlarge res_screen"  > </span><span class="full_screen">Notefication</span></a>


  <a  href="logout.php"><span class="glyphicon glyphicon-log-out w3-xlarge "  ></span><span class="full_screen">Logout</span></a>
  <!-------
  <a href="#about"><span class="fa fa-comments-o w3-xlarge res_screen"  ></span><span class="full_screen">Message</span></a>-->

</div>









<!-------------------
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="homepage.php"><span>Home</span></a>
  <a href="doctorsrole.php"><span>As Doctor </span></a>
  <a href="finddoctor.php"><span>Find A Doctort</span></a>
  <a href="serial.php"><span>My Sereal</span></a>
  <a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical Histry</span></a>
  <a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a>
  <a href="family_member.php"><span>Family Member </span></a>
  <a href="#"><span><s>Need Blood </s></span></a>
  <a href = "logout.php">Sign Out</a>
</div>
------------>

<?php
}else {
?>











<div class="topnav">
  <a class="active" href="homepage.php"><span class="glyphicon glyphicon-home w3-xlarge res_screen"  > </span><span class="full_screen">Home</span></a>
    <a href="updatepersonalinfo.php"><span class="glyphicon glyphicon-cog w3-xlarge res_screen"  > </span><span class="full_screen">Settings</span></a>
  <a href="#Notefication"><span class="glyphicon glyphicon-bell w3-xlarge res_screen"  > </span><span class="full_screen">Notefication</span></a>
  <a  href="logout.php"><span class="glyphicon glyphicon-log-out w3-xlarge "  ></span><span class="full_screen">Logout</span></a>
  <!-------
  <a href="#about"><span class="fa fa-comments-o w3-xlarge res_screen"  ></span><span class="full_screen">Message</span></a>-->

</div>








<!------------
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="homepage.php"><span>Home</span></a>
  <a href="finddoctor.php"><span>Find A Doctort</span></a>
  <a href="serial.php"><span>My Sereal</span></a>
  <a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical Histry</span></a>
  <a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a>
  <a href="family_member.php"><span>Family Member </span></a>
  <a href="#"><span><s>Need Blood </s></span></a>
  <a href = "logout.php">Sign Out</a>
</div>

----------------->


<?php
}



?>






</body>
</html>
