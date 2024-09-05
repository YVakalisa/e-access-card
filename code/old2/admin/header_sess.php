<?php
session_start();
include '../connector.php';

$id=$name=$surname=$email="";

if (isset($_SESSION['id'])) {
	# code...
$email=$_SESSION['email'];
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$surname=$_SESSION['surname'];

}else{
	 echo '<script> window.location = "login.php";</script>';
}
?>