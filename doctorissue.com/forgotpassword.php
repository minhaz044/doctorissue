<?php
   include("DBcon.php");


   if(isset($_POST['reset_email']) && $_POST['reset_email']!="") {
      // username and password sent from form

      $myid = mysqli_real_escape_string($con,$_POST['reset_email']);

      $query = "SELECT * FROM users WHERE id = '$myid'";
      $execute = mysqli_query($con,$query);
      $row = mysqli_fetch_array($execute,MYSQLI_ASSOC);
      $count = mysqli_num_rows($execute);

      if($count == 1) {


        $password=$row['password'];
        $company_name="";
        $message="Your ".$company_name."Password is ".$password." \n Thank You.";
/**************If this An e-mail of a Phone Number**********************/


$is_mail=0;
$is_phone_number=0;
//Email Validation
  if (empty($row['id'])) {
    $emailErr = "Email is required";
        $is_mail=0;
  }
  else {

    if (filter_var($row['id'], FILTER_VALIDATE_EMAIL)) {
          $email = $row['id'];
          $is_mail=1;

    }else{
          $email = "";
          $is_mail=0;
    }
  }





  //phone number validation
  if (empty($row['id'])) {
    $emailErr = "Phone Number is required";
      $is_phone_number=0;
  }
else{
        if(preg_match("/^[0]{1}[1]{1}{2}[0-9]{9}$/", $row['id']) && strlen($row['id'])==11) {
                $phone_number=$row['id'];
                $is_phone_number=1;
        }
        else{
                  $phone_number="";
                  $is_phone_number=0;
                  //echo "Invalid Phone Number format. (+880) not required";
        }
}


/*****************************End***************************/
/**********Sent SMS if Phone Number*******************/
//echo $is_phone_number."\n";
//echo $is_mail;
if($is_phone_number){

        try{
                $soapClient = new SoapClient("http://api.onnorokomsms.com/sendsms.asmx?wsdl");
                $paramArray = array(
                'userName'=>"01852153044",
                'userPassword'=>"120080",
                'mobileNumber'=> "$phone_number",
                'smsText'=>"$message",
                'type'=>"1",
                'maskName'=> "",
                'campaignName'=>'',
                );
                $value = $soapClient->__call("OneToOne", array($paramArray));
                } catch (dmException $e) {
                echo $e;
        }



        ?>
        <script type="text/javascript">
          alert("Your Password is send to your Phone Number  .\nThank you ");window.location.href='index.php';
        </script>


        <?php

}
/**************************Sent Email If it is a email*************/

else if($is_mail){
echo"Mail Function";

  $inserted_text=$email;
$message = wordwrap($message,70);

require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = "ssl"; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'mail.doctorissue.com ';
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = '_mainaccount@doctorissue.com';
    $mail->Password = 'MinhazIt';
    $mail->SetFrom('info@doctorissue.com');
    $mail->Subject = "Password ";
  $mail->Body = "$message";
  $mail->AddAddress("$email");

   if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   } else {
      echo "Message has been sent";


      ?>
      <script type="text/javascript">
        alert("Your Password is send to your E-mail  .\nThank you ");window.location.href='index.php';
      </script>
      <?php
   
}
}
else{
//echo "Invalid user";
      ?>
      <script type="text/javascript">
        alert("Invalid Information.\n Try with Valid Information  .\nThank you ");window.location.href='index.php';
      </script>
      <?php
}

}


else{

  ?>
  <script type="text/javascript">
    alert("No Data Found.\nThank you ");window.location.href='index.php';
  </script>
  <?php

}

}
else {
  echo "Empty Mail/number field";
    ?>
  <script type="text/javascript">
    alert("Email/Phone Number field Is Empty.\nThank you ");window.location.href='index.php';
  </script>
  <?php
}


?>
