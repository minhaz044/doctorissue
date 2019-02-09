<?php

include("DBcon.php");
include("session.php");

if(isset($_POST['string_'])){
  $verification_code=mt_rand(1000,9999);
  $message=$verification_code." "."is your Verification Code. \n Thank You";
  $temp_query="SELECT * FROM users WHERE accountno='$send_code_to'";
  $temp_result=mysqli_query($con,$temp_query) or die(mysqli_error($con));
  $temp_row = mysqli_fetch_assoc($temp_result);
  $phone_number="";
  $email="";

  $inserted_text="";



  /**************If this An e-mail of a Phone Number**********************/


  $is_mail=0;
  $is_phone_number=0;
  //Email Validation
    if (empty($temp_row['id'])) {
      $emailErr = "Email is required";
          $is_mail=0;

    }
    else {

      if (filter_var($temp_row['id'], FILTER_VALIDATE_EMAIL)) {
            $email = $temp_row['id'];
            $is_mail=1;

      }else{
            $email = "";
            $is_mail=0;
                    $inserted_text.="IS Empty inv phn";
      }
    }





    //phone number validation
    if (empty($temp_row['id'])) {
      $emailErr = "Phone Number is required";
        $is_phone_number=0;

    }
  else{
          if(preg_match("/^[0]{1}[1]{1}[0-9]{9}$/", $temp_row['id']) && strlen($temp_row['id'])==11) {
                  $phone_number=$temp_row['id'];
                  $is_phone_number=1;
          }
          else{
                    $phone_number="";
                    $is_phone_number=0;
                    echo "Invalid Phone Number format";
                            $inserted_text.="IS Empty inv";
          }
  }


  /*****************************End***************************/














  if($is_phone_number){
    $inserted_text=$phone_number;
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
  }}
  else if($is_mail){
      $inserted_text=$email;
    $msg = wordwrap($message,70);









    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->IsSMTP(); // enable SMTP

      $mail->SMTPDebug = 3; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'tsl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587; // or 587
      $mail->IsHTML(true);
      $mail->Username = 'minhazuddin3044@gmail.com';
      $mail->Password = 'minhaz044';
      $mail->SetFrom('minhazuddin3044@gmail.com');
      $mail->Subject = "Verification Key";
      $mail->Body = "$msg";
      $mail->AddAddress("$email");

       if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
       } else {
          echo "Message has been sent";
       }













  }

  else{
            $inserted_text.="";
  }

  $query="INSERT INTO verification_code VALUES ('$login_session','$inserted_text','$verification_code',1) ON DUPLICATE KEY UPDATE phone_number='$phone_number' ,code='$verification_code',status=1";

  $result=mysqli_query($con,$query) or die(mysqli_error($con));

$output="3";

echo $output;

}
?>
