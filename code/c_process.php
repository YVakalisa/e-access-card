<?php 
include 'mail.php';
if (isset($_POST['submit'])) {
	// code...
$name=$_POST['name'];
$sname=$_POST['sname'];
$subject=$_POST['subject'];
$email=$_POST['email'];
$msg=$_POST['msg'];

$to=$email;
$from="eaccesscard@gmail.com";
//$subject="Student card";
$cmessage="Dear ".$name." ".$sname."<br><br>";
$cmessage.="your massege has been received, we will get back to you.<br><br>Kind Regard<br>e-access card System Team";
send_email($to,$from,$subject,$cmessage);

$to2=$email;
$from2="eaccesscard@gmail.com";

send_email($from2,$to2,$subject,$msg);

echo '<script type="text/javascript">alert("Massege sent"); window.location = "index.html";</script>';
}


if (isset($_POST['news'])) {
	// code...

$email=$_POST['email'];


$to=$email;
$from="eaccesscard@gmail.com";
$subject="Newsletter Subscribe";
$cmessage="Dear ".$name." ".$sname."<br><br>";
$cmessage.="Welcome to our news letter, stay tuned for updates.<br><br>Kind Regard<br>e-access card System Team";
send_email($to,$from,$subject,$cmessage);

echo '<script type="text/javascript">alert("Newsletter Subscribe, Completed"); window.location = "index.html";</script>';

}

 
?>