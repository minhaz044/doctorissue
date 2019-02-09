<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>DoctorIssue</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="css/style.css">
  <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 200px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e;
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }  <link rel="stylesheet" href="css/style.css
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    }
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
    .jumbotron {

        padding: 160px 25px;

    }
  }



  .logo-content {
      display: inline-block;
      position: relative;
      font-size: 50px;
      color: black;
  }

  .overlay {
      width: 50%;
      position: absolute;
      color: red;
      overflow: hidden;
  }

  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top ">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">D<span style="margin-left: -8.5px;">OctorIssue</span> </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a onclick="nav_toggle()" href="#about">Features</a></li><!----
        <li><a onclick="nav_toggle()" href="#about">ABOUT</a></li>
        <li><a onclick="nav_toggle()" href="#services">SERVICES</a></li>
        <li><a onclick="nav_toggle()"href="#portfolio">PORTFOLIO</a></li>
        <li><a onclick="nav_toggle()" href="#pricing">PRICING</a></li>---->
        <li><a onclick="nav_toggle()"href="#contact">Contact</a></li>
        <span id="main-nav" class="nav navbar-nav navbar-right">
          <li ><a onclick="nav_toggle()"style="font-size:13px;  "class="cd-signin" href="#Sign_in">Sign in</a></li>
          <li ><a onclick="nav_toggle()"style="font-size:13px;  " class="cd-signup" href="#Sign_up">Sign up</a></li>
        </span>

      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Doctor Issue<small style="color:black;" > <font size="5">&#946;eta</font></small></h1>
  <p>Your Digital Health Assistant</p>
      <!--<form>
    <div class="input-group">
  <input type="email" class="form-control" size="50" placeholder="Email Address" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Subscribe</button>
      </div>
    </div>
  </form>--->
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2> App Features</h2><br>
    </div>
    <div class="row slideanim">
      <div class="col-sm-6 ">
        <div class="panel panel-default ">
          <div class="panel-heading">
            <h3 class="text-center">General User</h3>
          </div>
          <div style="color:black;" class="panel-body">
            <p><strong>1. </strong> সরাসরি ডাক্তারের সিরিয়াল দেয়া, কোন প্রকার ফোন দেয়ার দরকার নেই।</p>
            <p><strong>2. </strong>  "Family Member"  এই feature মাধ্যমে আপনি আপনার পরিবারের সদস্যর সাথে add থাকতে পারবেন এবং একজন অন্য জনের জন্য সিরিয়াল দিতে পারবেন।</p>
            <p><strong>3. </strong> অনলাইনে সরাসরি নিজের সিরিয়াল এবং আপনার উপরে কারা আছেন এবং এদের মধ্যে কার কার ডাক্তার দেখানো শেষ তা দেখতে পাবেন, যার ফলে আপনাকে ২-৩ ঘন্টা আগে এসে বসে থাকতে হবেনা।</p>
            <p><strong>4. </strong> -যেহেতু অনলাইনে সিরিয়াস,তাই৷ সিরিয়াস   Break করে কাউকে আগে  দেখার বা সিরিয়াল মাঝে  add হওয়ার সুযোগ নেই।</p>
            <p><strong>5. </strong> অনলাইনে  Prescription নেওয়ার সুযোগ,যা আপনি জীবনের যেকোন সময় যেকোন স্থানে  PDF হিসেবে  Download এবং   প্রিন্ট করতে পারবেন।</p>
            <p><strong>6. </strong> এক একাউন্টে আপনার সারা জীবনের সকল  Prescription এবং,  Report  জমা থাকবে,যা আপনি ডাক্তারকে খুব দোখাতে পারবেন,এবং আপনার  Medical History জানা থাকলে ডাক্তারের জন্য সমস্যা চিহ্নিত করাও সঠিক ঔষদ প্রধান করা সম্ভব হবে।</p>
            <p><strong>7. </strong> Prescription কম্পিউটার তৈরি হওয়ায় , ডাক্তারদের হাতের লেখা বুঝতে সমস্যা নেই।</p>
            <p><strong>8. </strong> টেষ্ট  report সমূহ আপনি সহযেই বসায় বসে পেয়ে যেতে পারবেন,এর জন্য  Medical   Test করানোর পর আপনাকে  Report জন্য লম্বা লাইন দিতে হবেনা।

            <p><strong></strong></p>
          </div>
          <div class="panel-footer">
          </div>
        </div>
      </div>
      <div class="col-sm-6 ">
        <div class="panel panel-default ">
          <div class="panel-heading">
            <h3 class="text-center">Doctor</h3>
          </div>
          <div style="color:black;"class="panel-body">
              
              
              
<p><strong>1. </strong> সরাসরি সিরিয়াল নেয়ার সুযোগ।ফোনে সিরিয়াল নেয়ার বিরক্তি নেই। Assistant সিরিয়াল নেয়ার কাজটা আমাদের  Software- ই করে দিবে।</p>
<p><strong>1. </strong> কোন নিদিষ্ট দিন বা সাপ্তাহিক  visiting Slot করতে পারবেন,সপ্তাহিক  Visiting Slot গুলো পরের সপ্তাহে আবার একই দিনে Active হবে।বারবার  Visiting Slot Create করার ঝামেলা নেই।</p>
 <p><strong>2. </strong> সিরিয়াল নেয়ার  ক্ষেত্রে,  Software    Automatic সিরিয়াল করে নিবে, ঐ সিরিয়াল অনুসারে  Patient's দেখা।</p>
 <p><strong>3. </strong> Visiting Slot গুলো আপনার ইচ্ছা অনুযায়ী আপনি করতে পারবেন,তবে আমরা ৩টা  Slot Recommend করি। সকাল(৯.৩০-১২.৩০),বিকাল(২.৩০-মাগরীব নামাজের আগ পর্যন্ত), সন্ধ্যা (মাগরীব নামাজ পর থেকে -৯/১০ )।</p>
 <p><strong>4. </strong> কোন কারনে আপনি যদি কোন  Visiting Slot বাহিল করেন,তাহলে ঐ  Slot যারা যারা  সিরিয়াল দিয়েছিলো সবার কাছে একটা করে   SMS/Notification  চলে যাবে।</p>
 <p><strong>5. </strong> আপনি চাইলে  Prescription  অনলাইলে  patient একাউন্টে দিতে পারবেন,যা  Patient পরবর্তীতে  PDF আকারে  Download এবং  প্রিন্ট করতে পারবে</p>
 <p><strong>6. </strong>  Prescription, Software Auto Generate  করবে,আপনাকে  শুধুমাত্র   Problems,RX,Premary test,Investigation test,Suggestion   এই  গুলো লিখতে হবে,আপনি চাইলে এদের যেকোন অংশ ফাকাও রাখতে পারবেন।</p>
 <p><strong>7. </strong>  prescription এ আপনার নাম, পদবী, কর্মস্থল এবং   আপনার     Account ID,   Software Automatic Add করবে এবং এবং একটা  সুন্দর  Prescription Generate  করবে।</p>
 <p><strong>8. </strong> আপনি খুব সহযে  Patient এর অতীত  prescription এবং  Medical Report গুলো দেখতে পারবেন, যা রোগ সনাক্তকরণ এবং ঔষধ নির্নয়ে আপনাকে সহায়তা করবে।</p>
 <p><strong>9. </strong> ডাক্তার খোজার জন্য,   Search By Destrict, or Specialist,or  Name of Hospital,or  Doctors Name, or Doctors Account Id  এই আপশন গুলো রয়েছে, যার জন্য ডাক্তার খোজাটা হবে খুবই সহয এবং সুনির্দিষ্ট ।</p>
 <p><strong>10. </strong> আপনি  General Patient এবং  Doctor  দুটো সুবিধাই এক একাউন্টে পাবেন।</p>
 <p><strong>11. </strong> আপনার একটা  Profile  Page  থাকবে, যেখানে আপনি আপনার নাম,পদবি,কর্মস্থল, শিক্ষাগত যোগ্যতা,  এবং সকল  Visiting Slot গুলো সুন্দর করে সাজাতে পারবেন।</p>
 <p><strong>12. </strong> আপনার  Submit করা  Prescription History দেখতে পারবেন।</p>
              

          </div>
          <div class="panel-footer">
          </div>
        </div>
      </div>
  </div>
</div>
</div>





<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
        
      <span class="fa fa-android logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Android Version Will Be Available Soon.</h2><br>
      <h4>Coming Soon.......</h4>
      
    </div>
  </div>
</div>








<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Tongi College Gate, Tongi, Gazipur, Bangladesh.</p>
      <p><span class="glyphicon glyphicon-phone"></span> 01852153044</p>
      <p><span class="glyphicon glyphicon-envelope"></span>minhazuddin044@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>



<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Founder And Developed By :<a href="https://www.facebook.com/minhaz.uddin.1401933" title="">Minhaz Uddin</a></p>
</footer>






















<!-----------------Temporary section-------------------------->
	<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a class="not_hide_modal"href="#0">Sign in</a></li>
				<li><a class="not_hide_modal"href="#0">New account</a></li>
			</ul>
			<div id="cd-login"> <!-- log in form -->
				<form class="cd-form" method="post" action="login.php">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signin-email" name="in-email" type="text" placeholder="E-mail/Phone Number "required>
						<span class="cd-error-message">Error message here!</span>
					</p>
					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" name="in-password"type="password"  placeholder="Password"required>
					<!--	<a class="not_hide_modal" href="#0" class="hide-password">Hide</a> -->
						<span class="cd-error-message">Error message here!</span>
					</p>
					<p class="fieldset">
						<input type="checkbox" id="remember-me"  checked >
						<label for="remember-me">Remember me</label>
					</p>
					<p class="fieldset">
						<input class="full-width" type="submit" value="Login">
					</p>
				</form>
				<p class="cd-form-bottom-message"><a class="not_hide_modal" href="#0">Forgot your password?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->
			<div id="cd-signup"> <!-- sign up form -->
				<form class="cd-form" method="post" action="signup.php" onsubmit="return validateForm()">
					<p class="fieldset">
						<label class="image-replace cd-email" for="signup-email">E-Mail/Phone Number</label>
						<input class="full-width has-padding has-border" id="signup_email" name="signup_email" type="text" placeholder="E-mail/Phone Number " required>
						<span class="cd-error-message">Error message here!</span>
					</p>
					<p class="fieldset">
						<label class="image-replace cd-password" for="signup-password">Password</label>
						<input class="full-width has-padding has-border" id="txtNewPassword" name="txtNewPassword" type="password"  placeholder="Password" required>
						<!--------<a class="not_hide_modal"href="#0" class="hide-password">Hide</a> ------>
						<span class="cd-error-message">Re Enter The password</span>
					</p>
          <p class="fieldset">
						<label class="image-replace cd-password" for="confarm-password">Confarm Password</label>
						<input class="full-width has-padding has-border" id="txtConfirmPassword" name="txtConfirmPassword" type="password"  placeholder="Re Enter Password" onChange="checkPasswordMatch();" required>
						<!------------<a class="not_hide_modal" href="#0" class="hide-password">Hide</a>----------->
						<span class="" id="divCheckPasswordMatch" style="color:red;"></span>
					</p>
					<p class="fieldset">
						<input type="checkbox" id="accept-terms" name="accept-terms" required>
						<label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
					</p>
          <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
           echo  $_SESSION["token"] ;?>">
					<p class="fieldset">
						<input class="full-width has-padding" type="submit" name="apply"value="Create account">
					</p>
				</form>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->
			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your E-mail/Phone Number . You will receive a SMS With Your password.</p>
				<form class="cd-form" type="POST"method="POST" action="forgotpassword.php">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" name="reset_email" id="reset_email" type="text" placeholder="E-mail/Phone Number " required>
					<span class="cd-error-message" id="">Error message here!</span>
					</p>
					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>
				<p class="cd-form-bottom-message"><a class="not_hide_modal" href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->
</body>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>

<!-----------------Temporary section-------------------------->




<script type="text/javascript">
function nav_toggle(){
  if($(window).width()  <=800){

    $('.navbar-toggle').click();

  }
}


</script>






















<script type="text/javascript">


function checkPasswordMatch() {
 var password = $("#txtNewPassword").val();
   var confirmPassword = $("#txtConfirmPassword").val();
   if(password.length >=5){
     if (password != confirmPassword){
         $("#divCheckPasswordMatch").text("Password Do Not Match");
     }else{
     $("#divCheckPasswordMatch").text("");
     }
   }else {
     $("#divCheckPasswordMatch").text("Password Must Be 6 character Long");
   }


}


   function validateForm() {
     var password = $("#txtNewPassword").val();
     var confirmPassword = $("#txtConfirmPassword").val();


    if(password.length >=5){
       if(password==confirmPassword){
        return true;
       }
       else{
         alert("Password Do Not Match");
          return false;
       }
     }else{
       alert("Password Must Be 5 character length");
        return false;

     }
   }

$(document).ready(function () {
 $("#txtConfirmPassword").keyup(checkPasswordMatch);
});


</script>

















<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
