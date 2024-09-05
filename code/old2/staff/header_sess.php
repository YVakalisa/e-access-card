<?php
session_start();
include '../connector.php';

$id=$name=$surname=$email=$student_no=$idno=$campus="";

if (isset($_SESSION['id'])) {
	# code...
$email=$_SESSION['email'];
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$surname=$_SESSION['surname'];
$student_no=$_SESSION['student_no'];
$campus=$_SESSION['campus'];

}else{
	 echo '<script> window.location = "login.php";</script>';
}
?>