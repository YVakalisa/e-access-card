<?php

function send_email($to,$from,$subject,$cmessage){
  $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $from . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

   /* $message ='<table style="width:100%">
        <tr>
            <td>'.$name.'  '.$subject.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>phone: '.$phone.'</td></tr>
        <tr><td>Text: '.$text.'</td></tr>
        
    </table>';*/

    if (@mail($to, $from, $cmessage, $headers))
    {
        //echo '<script type="text/javascript">alert("Massege sent"); window.location = "index.html";</script>';
        //Redirect_to("thankyoumessage.html");
    }else{
        //Redirect_to("failuremessage.html");
    }
}
?>