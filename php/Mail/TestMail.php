<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);
$address = "kurocrea@gmail.com";
$name = "Anh";
//Server settings
$mail->SMTPDebug = 0;                      //Enable verbose debug output
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'hhmsystemda1@gmail.com';                     //SMTP username
$mail->Password   = 'ktbatasjpjwyqiht';                               //SMTP password
$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->isSMTP();                                            //Send using SMTP

$mail->setFrom('hhmsystemda1@gmail.com', 'Email Confirmation');


try {
    //Recipients
    $mail->addAddress($address, $name);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    //Optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com'); //backup sender email
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $message = '<html><head>
            <title>Email Verification</title>
            </head>
            <body>';
    $message .= '<h1>Hi ' . $name . '!</h1>';
    // $message .= '<p><a href="http://localhost/da1_courseadviser/Mail/Activation.php?id=' . base64_encode($lastID) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
    $message .= '<p><a href="http://localhost/da1_courseadviser/Mail/Activation.php?id=' . $name . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
    $message .= "</body></html>";


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Confirmation for HHMSystem (test)';
    // $mail->Body    = 'Comfirmation Contents is empty for now <b>in bold!</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->MsgHTML($message);
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
};
