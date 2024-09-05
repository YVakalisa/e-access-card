<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>e&mdash;access Card</title>
<link href='#' rel='stylesheet'>
<link href='#' rel='stylesheet'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<style>::-webkit-scrollbar {
  width: 8px;
}
/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
} body{
  background: #2962FF;
  font-family: Arial, Helvetica, sans-serif;
}



.card-heading, .card-subheading{
  font-weight: bold;
}
.card{
  width: 450px;

  border: none;
  border-radius: 10px;  
}
.form-control{
  border: none;
  border-radius: 10px;
  
}
.fone{
  padding-left: 30px;

}

.form-control{
    background-color:#eee !important;
}

.form-control:focus {
    color: #495057;
   
    border-color: #fff !important;
    outline: 0;
    box-shadow: 0 0 0 0 rgba(0,123,255,.25) !important;
}

.fone input{
      width: 120%;
     background: rgba(165, 147, 69, 0.075);
     
}
.ftwo input{
      width: 120%;
      background: rgba(165, 147, 69, 0.075);
}

.fthree{
  padding-left: 30px;
  padding-right: 45px;
}
.fthree input{
  background-color: rgba(165, 147, 69, 0.075);
}
.ffour{
  padding-left: 30px;
}

.ffour input{
      width: 120%;
      background-color: rgba(165, 147, 69, 0.075);
}
.ffive input{
      width: 120%;
      background-color: rgba(165, 147, 69, 0.075);
  }
.rthree{
  padding-top: 1px;
}
.para1{
  height: 10px;
  font-size: 12px;
}
.para2{
  font-size: 12px;
}
.btn-primary{
  border-radius: 8px;
  background: #2979FF;
  width: 120px;
}
.btn-primary span{
  font-size: 15px;
}

@media screen and (max-width: 768px){
.fone input{
      width: 90%;
}
.ftwo input{
      width: 86%;
}
.fthree{
  width: 110%;
}
.ffour input{
      width: 90%;
}
.ffive input{
      width: 86%;
}
}

.error{
  color: red;
  text-align: center;
  align-content: center;
  justify-content: center;
  align-self: center;
}
</style>
</head>
  <body className='snippet-body'>
    <div class="container d-flex justify-content-center">
  <div class="card mx-5 my-5">
    <div class="card-body px-2">
      <h2 class="card-heading px-3">Password Reset</h2>
      <h5 class="card-subheading px-3 pb-3">It's quick and easy.</h5>
      <?php
      //session_start();
      include 'connector.php';
          // define variables and set to empty values
   $name=$surname=$dob=$email=$cellno=$idno=$pwd=$cpwd=$hashp=$address=$city=$pcode="";
                $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd=$eraddress=$ercity=$erpcode="";
                  $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=$Taddress=$Tcity=$Tpcode=false;
                    
                  $email=$_GET['e'];
                  if (isset($_POST['register'])) {
                     
                 
                 
                 if (empty($_POST["email"])) {
                    $eremail= "Email is required";
                    $Temail=false;
                  } else {
                    $email = test_input($_POST["email"],$conn);
                    $Temail=true;
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $eremail= "Invalid email format";
                      $Temail=false; 
                    }else{

                        $query="SELECT * FROM user WHERE email='$email'";
                        $result=mysqli_query($conn,$query);
                         if(!$result){

                          die("db access failed ".mysqli_error());
                        }
                          //get the number of rows of the executed query  
                        $rows=mysqli_num_rows($result);
                                    
                  if($rows==0){
                            $eremail ="Email not registered in our system";
                            $Temail=false;
                        }
                    }
                  
                   }

                
                    //1st password
                  if (empty($_POST["pwd"])) {
                    $erpwd = "Password is required";
                    $Tpwd=false;
                  } else {
                    $pwd = test_input($_POST["pwd"],$conn);
                    $Tpwd=true;

                        if(strlen($pwd)<8){
                            $erpwd = "password must have at least 8 characters or digits";
                            $Tpwd=false;
                            
                        }
                    }
                    
                  
                    
                   //2nd password 
                 if (empty($_POST["cpwd"])) {
                    $ercpwd = "Password confirm is required";
                    $Tcpwd=false;
                  } else {
                        $cpwd = test_input($_POST["cpwd"],$conn);
                        $hashp=password_hash($pwd,PASSWORD_DEFAULT);
                        $Tcpwd=true;

                        if ($pwd!=$cpwd){
                                $ercpwd = "Password do match";
                                $Tcpwd=false;
                        }
                        
                  }
                 
                   if ($Temail&&$Tpwd&&$Tcpwd&&$hashp) {
                              
                        //echo $staffno." ".;

                      $sql="UPDATE `user` SET `Password`= '$hashp' WHERE email='$email'";
                      if(mysqli_query($conn,$sql))
                          {
                                include 'mail.php';
                              $to=$email;
                              $from="eaccesscard@gmail.com";
                              $subject="Password Changed";
                              $cmessage="Hi there, <br><br>";
                              $cmessage.="You have succefully changed your password on the e-access card System,<br> You can now login with your new password.  <a href='http://demo.trevail.co.za/'>Click to log in</a> <br><br>Kind Regard<br>e-access card System Team";
                  send_email($to,$from,$subject,$cmessage);
                              echo '<script type="text/javascript">alert("Password Updated Succesfully."); window.location = "login.php";</script>';
                              
                          }else{echo("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                                        
                          }
                }

            

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
     
      ?> 
      <form action="" method="post" enctype="multipart/form-data">
        <div style="margin:auto;width: 50%;">
    	<img src="tut.png" style="width:100%;">	
    	</div>
        <div class="group-inputs">
          <label>Email</label>
          <input type="text" class="form-control" placeholder="Email Addresss" name="email" value="<?php echo $email;?>">
          <span class="error"><?php echo $eremail;?></span>
        </div>
        

       <div class="step-forms">
        <div class="form-group">
        <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
          <span class="error"><?php echo $erpwd;?></span>
        </div>
      </div>
      <div class="step-forms">
        <div class="form-group mb-4">
        <label>Confirm Password</label>
          <input type="password" class="form-control" placeholder="Confirm Password" name="cpwd">
          <span class="error"><?php echo $ercpwd;?></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 ml-3">
          <button type="submit" class="btn btn-primary mt-3" name="register"><span>Update</span></button>
        </div>
        <div class="col-md-6">
          <a href="login.php" class="btn btn-outline-primary mt-3" style="width:100%;"><span>Sign in here</span></a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

 <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>

  </body>
</html>

