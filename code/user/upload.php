<?php
SESSION_START();
include '../connector.php';
// new filename
$filename = 'pic_'.date('YmdHis') . '.jpeg';
$current_pic=$_SESSION['p_pic'];
$url = '';

if( move_uploaded_file($_FILES['webcam']['tmp_name'],'../upload/'.$filename) ){
     $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
       $_SESSION["photo"]='upload/'.$filename;  
    
	
}

// Return image url
echo $url;
?>