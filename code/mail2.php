<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$to='masetlans@gmail.com';
$from="noreply@ai-detective.xyz";
$subject="The newsletter";
$cmessage="Dear user<br><br>";
$cmessage.="You have succefully registered on the Q-marshal System as a Q-marshal.<br>Please note that before you can access the system, our admin should approve you first.<br> Apon approval, you will recieve a notification.<br><br>Kind Regard<br>Q-marshal System Team";
send_email($to,$from,$subject,$cmessage);

function send_email($to,$from,$subject,$cmessage){
  
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);
//
//
try {
 //Server settings
 $mail->SMTPDebug = 2; // Enable verbose debug output
 $mail->isSMTP(); // Set mailer to use SMTP
 $mail->Host = 'ai-detective.xyz'; // Specify main and backup SMTP servers
 $mail->SMTPAuth = true; // Enable SMTP authentication
 $mail->Username = 'noreply@ai-detective.xyz'; // SMTP username
 $mail->Password = 'r-})M?lJK6pO'; // SMTP password
 $mail->SMTPSecure = 'tls'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
 $mail->Port = 587; // TCP port to connect to

//Recipients
 $mail->setFrom($from, 'Q-marshal System');
 $mail->addAddress($to); // Add a recipient
 //$mail->addAddress('recipient2@example.com'); // Name is optional
 $mail->addReplyTo('info@oq-marshal.xyz', 'Information');
 $mail->addCC('info@oq-marshal.xyz');
 $mail->addBCC('info@oq-marshal.xyz');

// Attachments
 //$mail->addAttachment('/home/cpanelusername/attachment.txt'); // Add attachments
 //$mail->addAttachment('/home/cpanelusername/image.jpg', 'new.jpg'); // Optional name

// Content
 $mail->isHTML(true); // Set email format to HTML
/* $mail->Subject = 'Here is the subject';
 $mail->Body = 'This is the HTML message body <b>in bold!</b>';
 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/
 
 $mail->Subject = $subject;
 $mail->Body = $cmessage;
 $mail->AltBody = $cmessage;

$mail->send();
 echo 'Message has been sent';

} catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
?>