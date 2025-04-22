<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Sanitize user inputs
$name    = htmlspecialchars($_POST['name']);
$email   = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'imranasalis17@gmail.com';
    $mail->Password   = 'jqxlnnkxzkguxbap'; // Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($email, $name);
    $mail->addAddress('imranasalis17@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "
        <strong>From:</strong> $name<br>
        <strong>Email:</strong> $email<br>
        <strong>Message:</strong><br>" . nl2br($message);
    $mail->AltBody = "From: $name\nEmail: $email\nMessage:\n$message";

    $mail->send();
    echo 'Message sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
?>
