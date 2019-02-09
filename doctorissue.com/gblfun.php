<?php
include("session.php");
include("DBcon.php");


function change_profile_picture($user_id,$file_extn,$temp_file){
    include("DBcon.php");
    $user_id=(int)$user_id;
    $file_name=substr(md5(time()),0,10);
    $file_path="uploads/images/prifilepicture/".$file_name.".".$file_extn;
    move_uploaded_file($temp_file,$file_path);

    $query="UPDATE users SET profile_picture='$file_path' WHERE accountno=$user_id";
    $execute=mysqli_query($con,$query);



}














function family_status($me,$member){
  include("DBcon.php");
  if ($member==$me) {
    return 0;
  }
  $member_check_query1="SELECT * FROM family_member WHERE ( sender='$me' AND reciver='$member') or ( sender='$member' AND reciver='$me') ";
  $member_check_result1=mysqli_query($con,$member_check_query1) or die(mysqli_error($con));
  if(mysqli_num_rows($member_check_result1)>0){
    $row = mysqli_fetch_array($member_check_result1,MYSQLI_ASSOC);
    if ($row['sender']==$me && $row['reciver']==$member && $row['status']==0) {
      return 2;
    }
    elseif ($row['sender']==$member && $row['reciver']==$me && $row['status']==0) {
      return 3;
    }
    elseif (($row['sender']==$member && $row['reciver']==$me && $row['status']==1) || ($row['sender']==$me && $row['reciver']==$member && $row['status']==1)) {
    return 1;
    }
    else {
      return 5;
    }

}
else {
  return 4;
}
}

function fetch_district(){
  include("DBcon.php");
    $option_string="";
  $query="SELECT * FROM district_code";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>=0){
          while($row = mysqli_fetch_assoc($result)) {
        $option_string.='<option value="'.$row['dis_id'].'">'.$row['dis_name'].'</option>';

      }
}
else {

        $option_string.='<option value=""> No Element to Show</option>';

  }

return $option_string;
}






function fetch_district_with_parameter($district_id){
  include("DBcon.php");
    $option_string="";
  $query="SELECT * FROM district_code";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>=0){
          while($row = mysqli_fetch_assoc($result)) {
            if($district_id==$row['dis_id']){
        $option_string.='<option value="'.$row['dis_id'].'"selected>'.$row['dis_name'].'</option>';
            }else{
        $option_string.='<option value="'.$row['dis_id'].'">'.$row['dis_name'].'</option>';
          }
      }
}
else {

        $option_string.='<option value=""> No Element to Show</option>';

  }

return $option_string;
}





function fetch_specialist_with_parameter($specialist_type_id){
  include("DBcon.php");
    $option_string="";
  $query="SELECT * FROM specialist_type where status=1";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>=0){
          while($row = mysqli_fetch_assoc($result)) {
            if($specialist_type_id==$row['s_id']){
        $option_string.='<option value="'.$row['s_id'].'"selected>'.$row['type_name'].'</option>';
            }else{
        $option_string.='<option value="'.$row['s_id'].'">'.$row['type_name'].'</option>';
          }
      }
}
else {

        $option_string.='<option value=""> No Element to Show</option>';

  }

return $option_string;
}









function return_specialist_type($specialist_type_id){
  include("DBcon.php");
    $option_string="";
  $query="SELECT * FROM specialist_type where status=1 AND s_id=$specialist_type_id";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)==1){
      $row = mysqli_fetch_assoc($result);
              return $row['type_name'];


      }

else {

        return "";

  }


}

















function is_applied_for_serial( $visiting_slot_id,$apointment_date,$patient_id){
  include("DBcon.php");
      $squery="SELECT *
      FROM serialno
      WHERE sid=$visiting_slot_id AND  	patientid=$patient_id AND DATE(sereal_date)='$apointment_date'  AND is_visited=0 ";

      $squery_result=mysqli_query($con,$squery) or die(mysqli_error($con));


      if(mysqli_num_rows($squery_result)){
        return 1;
      }
      else {
        return 0;
      }

}



function user_identity($user_account){
    include("DBcon.php");

  $query="SELECT role from users where accountno='$user_account'";
  $execute=mysqli_query($con,$query) or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($execute);
  if($row['role']=="basic"){
    return 0;
  }else {
    return 1;
  }

}









function account_visiblity($user_account){
    include("DBcon.php");

  $query="SELECT visibility from users where accountno='$user_account'";
  $execute=mysqli_query($con,$query) or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($execute);
  if($row['visibility']==1){
    return 1;
  }else {
    return 0;
  }

}










function sent_verificition_code($send_code_to){
include("DBcon.php");
include("session.php");
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
    $mail->IsSMTP(true); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = "ssl"; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'mail.doctorissue.com ';
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = '_mainaccount@doctorissue.com';
    $mail->Password = 'MinhazIt';
    $mail->SetFrom('info@doctorissue.com');
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
return  0;
}






function speciality_hospital($id ,$which_one ){

//1=hospital
//0=speciality
  include("DBcon.php");
   $output = '';
   if($which_one =="1")
   {
    $query = "SELECT *  FROM hospital_by_district WHERE hospital_id ='$id' AND status=1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
     $output =$row["hospital_name"];
     return $output;
   }

  else if($which_one =="0")
  {
   $query = "SELECT *  FROM specialist_type WHERE s_id='$id' AND status=1";
   $result = mysqli_query($con, $query);
   $row = mysqli_fetch_array($result);
    $output =$row["type_name"];
      return $output;
  }
  else {
        return $output;
  }
}





















?>
