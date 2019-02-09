<?php

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
    $mail->Subject = "Test";
    $mail->Body = "hello";
    $mail->AddAddress("minhazuddin044@gmail.com");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }



?>
