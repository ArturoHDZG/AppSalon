<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
  public $email;
  public $name;
  public $token;

  public function __construct($email, $name, $token)
  {
    $this->email = $email;
    $this->name = $name;
    $this->token = $token;
  }

  // Send verification token to registered email
  public function sendEmail()
  {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'a99199ddfd601d';
    $mail->Password = 'adbf99ec0cfd15';

    $mail->setFrom('cuentas@appsalon.com');
    $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
    $mail->Subject = 'Activate Your Account';
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    // Body HTML Message
    $content = "<html>";
    $content .= "<p><strong>Hola " . $this->name . "</strong></p>";
    $content .= "<p>Confirm your email address by clicking the following link</p>";
    $content .= "<p>to activate your Account:</p>";
    $content .= "<p>Follow next link:
     <a href='http://localhost:3000/validate?token=" . $this->token . "'>Confirm Account</a></p>";
     $content .= "<p>If you did not request registration for this account, please ignore this message.</p>";

    $mail->Body = $content;
    $mail->send();
  }
}
