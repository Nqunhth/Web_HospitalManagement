<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../lib/PHPMailer/src/Exception.php';
// require '../lib/PHPMailer/src/PHPMailer.php';
// require '../lib/PHPMailer/src/SMTP.php';

class ComfirmationMailing
{
    private $mail;

    function SetServer()
    {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->SMTPDebug = 0;                      //Enable verbose debug output
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'hhmsystemda1@gmail.com';                     //SMTP username
        $this->mail->Password   = 'ktbatasjpjwyqiht';                               //SMTP password
        $this->mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->isSMTP();                                            //Send using SMTP

        $this->mail->setFrom('hhmsystemda1@gmail.com', 'Email Confirmation');
    }

    function SendTo($address, $name, $password ,$token)
    {
        try {

            $this->SetServer();
            //Recipients
            $this->mail->addAddress($address, $name);     //Add a recipient
            //Optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com'); //backup sender email
            // $mail->addBCC('bcc@example.com');

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'Email Confirmation for HHMSystem (test)';
            $this->verifyGeneration($name, $password ,$token);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        };
    }

    function verifyGeneration($name, $password, $token)
    {
        $message = '<html><head>
           <title>Email Verification</title>
           </head>
           <body>';
        $message .= '<h1>Hi ' . $name . '!</h1>';
        $message .= '<p>The password for your account is : </p>';
        $message .= '<h2>Hi ' . $password . '!</h2>';
        $message .= '<p><a href="http://localhost/Web_HospitalManagement/Controllers/Mail/Activation.php?token=' . $token . '">CLICK TO ACTIVATE YOUR ACCOUNT</a></p>';
        $message .= "</body></html>";
        $this->mail->MsgHTML($message);
    }

    function sendPasswordRecovery($address, $token)
    {
        try {

            $this->SetServer();
            $this->mail->setFrom('hhmsystemda1@gmail.com', 'Password Recovery');

            $this->mail->addAddress($address);

            $this->mail->isHTML(true);
            $this->mail->Subject = 'HHM System Password Recovery';

            $message = '';
            $message .= '<h1>Your request for password recovery has been approved!</h1>';
            // $message .= '<p><a href="' . SITE_URL . 'activate.php?id=' . base64_encode($lastID) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
            $message .= '<p><a href="http://localhost/Web_HospitalManagement/Controllers/Mail/Recovery.php?token=' . $token .'">CLICK TO CHANGE YOUR PASSWORD</a>';
            $message .= "</body></html>";
            $this->mail->MsgHTML($message);


            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        };
    }
}

