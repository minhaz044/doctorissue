<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="jquery.js" ></script>
  <script src="jquery.min.js" ></script>


<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.dot {
    height: 25px;
    width: 25px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}
.navbar {
    overflow: ;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: ;
}

.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #333;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 99;
}

.dropdown-content a {
    float: none;
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.dropdown-content-click{
      display: block;
}
.dropdown-content a:hover {
    background-color: red;
}


.res_screen{
	display: none;
}

.res_nav a {
    font-size: 15px;
    background-color: white;
        color: black;
        min-width: 300px;

}
.res_nav a:hover {
    background-color:  #DCDCDC;
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
  .dot {
      height: 18px;
      width: 18px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
  }

  .res_screen{
	display: block;
}
.log-out-full{
  float: left;
  padding-right: 0px;
}
.navbar a {

  color: #f2f2f2;
  text-align: center;
  padding: 15px 18px;
  text-decoration: none;
  font-size: 20px;
}
.dropdown-content a {
    font-size: 15px;
}
.number_of_new_noti{

}
.res_nav a {
    font-size: 10px;
    background-color: white;
    color: black;

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



  if(user_identity($login_session)){
  ?>


  <div class="navbar">
    <a class="active" href="homepage.php"><span class="fa fa-home w3-xlarge res_screen"  > </span><span class="full_screen">Home</span></a>
    <a href="doctorsprofile.php?d_id=<?php echo $login_session?>&id=<?php echo $login_session?>"><span class="fa fa-user-o w3-xlarge res_screen"  > </span><span class="full_screen">Profile</span></a>
      <div class="dropdown">
      <button  class="dropdownmenu dropbtn" onclick=dropdownmenuFunction()><span class="fa fa-th w3-xlarge res_screen"  > </span><span  class="full_screen" >Menu</span>
        <i class="fa fa-caret-down"></i>
      </button>
      <div id="dropdownmenu"class="dropdown-content menu-drp ">
        <a href="doctorsrole.php"><span>As Doctor </span></a>
        <a href="finddoctor.php"><span>Find A Doctor</span></a>
        <a href="serial.php"><span>My Sereal</span></a>
        <a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical History</span></a>
        <a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a>
        <a href="family_member.php"><span>Family Member </span></a>
        <a href="blooddonation.php"><span>Blood Bank</span></a>
      </div>
    </div>
    <a href="updatepersonalinfo.php"><span class="fa fa-gear w3-xlarge res_screen"  > </span><span class="full_screen">Settings</span></a>
    <div class="dropdown">
    <button class="dropbtn navdropbtn" onclick="dropdownnotiFunction()"><span class="fa fa-bell w3-xlarge res_screen res_nav"  > </span><span  class="number_of_new_noti " style="  color: red; " ></span><span  class="full_screen" >Notification</span>
    </button>
    <div class="dropdown-content res_nav  " style="right: 0; left: auto;" id="new_notification_list">
    </div>
  </div>
  <a  href="logout.php"><span class="fa fa-sign-out w3-xlarge "  ></span><span class="full_screen">Logout</span></a>
  </div>




  <?php
  }else {
  ?>

  <div class="navbar">
    <a class="active" href="homepage.php"><span class="fa fa-home w3-xlarge res_screen"  > </span><span class="full_screen">Home</span></a>
      <div class="dropdown">
      <button  class="dropdownmenu dropbtn" onclick=dropdownmenuFunction()><span class="fa fa-th w3-xlarge res_screen"  > </span><span  class="full_screen" >Menu</span>
        <i class="fa fa-caret-down"></i>
      </button>
      <div id="dropdownmenu"class="dropdown-content menu-drp ">
        <a href="finddoctor.php"><span>Find A Doctor</span></a>
        <a href="serial.php"><span>My Sereal</span></a>
        <a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical History</span></a>
        <a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a>
        <a href="family_member.php"><span>Family Member </span></a>
        <a href="blooddonation.php"><span>Blood Bank</span></a>
      </div>
    </div>
    <a href="updatepersonalinfo.php"><span class="fa fa-gear w3-xlarge res_screen"  > </span><span class="full_screen">Settings</span></a>
    <div class="dropdown">
    <button class="dropbtn navdropbtn" onclick="dropdownnotiFunction()"><span class="fa fa-bell w3-xlarge res_screen res_nav"  > </span><span  class="number_of_new_noti " style="  color: red; " ></span><span  class="full_screen" >Notification</span>
    </button>
    <div class="dropdown-content res_nav  " style="right: 0; left: auto;" id="new_notification_list">
    </div>
  </div>
  <a  href="logout.php"><span class="fa fa-sign-out w3-xlarge "  ></span><span class="full_screen">Logout</span></a>
  </div>


<?php } ?>
<script type="text/javascript">



     notify_me();

     $(document).ready(function(){
    $(document).on("click",".navdropbtn",function(){

        $.ajax({
          url: "notification_old.php",
          type:"POST",
          data:{},
          success:function(data){
              $(".number_of_new_noti").text("");
              $(".number_of_new_noti").removeClass("dot");
          }
        })
             }, function(){
         });
     });


setInterval(function(){

  notify_me();

}, 1000*30);

  function notify_me(){

  $.ajax({
    dataType: "json",
    url: "notifier.php",
    type:"POST",
    data:{},
    success:function(data){

      $('#new_notification_list').html(data.notification);
      if(data.count>0){

              $(".number_of_new_noti").text(data.count);
              $(".number_of_new_noti").addClass("dot");

      }else{
          $(".number_of_new_noti").text("");
      }

    }
  })

  }




</script>


<script type="text/javascript">
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function dropdownmenuFunction() {
    document.getElementById("dropdownmenu").classList.toggle("dropdown-content-click");
}

function dropdownnotiFunction() {
    document.getElementById("new_notification_list").classList.toggle("dropdown-content-click");


}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.navdropbtn')) {

    var dropdowns = document.getElementsByClassName("res_nav");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('dropdown-content-click')) {
        openDropdown.classList.remove('dropdown-content-click');
      }
    }
  }

  if (!event.target.matches('.dropdownmenu')) {

    var dropdowns =document.getElementsByClassName("menu-drp");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('dropdown-content-click')) {
        openDropdown.classList.remove('dropdown-content-click');
      }
    }
  }




}

</script>
