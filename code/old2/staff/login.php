<?php
session_start();
include '../connector.php';

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Staff Portal</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
 <style type="text/css">
 .error {color: #FF0000;}
 </style>
    </head>
    <body style="background-color: black;">
        <div id="loginbox"> 
        <?php
                                // define variables and set to empty values

                             
            $emailErr = $err = $erpwd ="";
              $email = $pwd ="";
              $Temail = $Tpwd =false;
                
            if (isset($_POST['send'])) {

              
              //email
              if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                $Temail=false;
              } else {
                $email = test_input($_POST["email"]);
                $Temail=true;
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format";
                  $Temail=false; 
                }else{
                    $query="SELECT * FROM staff WHERE staff_email='$email'";
                    $result=mysqli_query($conn,$query);
                     if(!$result){

                      die("db access failed ".mysqli_error());
                    }
                      //get the number of rows of the executed query  
                    $rows=mysqli_num_rows($result);
                                
              if($rows==0){
                        $emailErr ="User not registered on our system";
                        $Temail=false;
                    }
                }
              }
               

               
               //2nd password 
             if (empty($_POST["pwd"])) {
                $erpwd = "Password is required";
                $Tpwd=false;
              } else {

                   $pwd = test_input($_POST["pwd"]);
                   $Tpwd=true;
                   
                }
                 if ($Tpwd && $Temail) {
                     
                   
                    $query="SELECT * FROM staff WHERE staff_email='$email'";
                    $result=mysqli_query($conn,$query);

                    if(!$result)
                    {
                      $err="unable to connect to database";
                       mysqli_error($conn);
                    }else{
                        $rows=mysqli_num_rows($result);
                        if($rows<1)
                        {
                            $err="username or password doesnt exsist";
                    
                        }else{
                                

                                while ($rows=mysqli_fetch_assoc($result)) 
                                    {
                                        $cpwd=$rows['password'];
                                        
                                        //!password_verify('$passwd',$cpwd) !hash_equals('$passwd',$cpwd)
                        

                                        if (!password_verify($pwd,$cpwd)) {
                                            $err="incorect password ";
                                        }else{
                                            //session_start();
                                            $_SESSION['email']=$rows['staff_email'];
                                            $_SESSION['id']=$rows['staff_id'];
                                            $_SESSION['name']=$rows['staff_name'];
                                            $_SESSION['surname']=$rows['staff_surname'];
                                            $_SESSION['student_no']=$rows['staff_number'];
                                            $_SESSION['campus']=$rows['campus'];
                                            echo '<script> window.location = "index.php";</script>';
                                          }
          
                                            
                                            
                                            
                                                            
                                        }


                                
                                    }

                            }
                        }
                      
                    }

            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
           
            ?>           
            <form id="loginform" class="form-vertical" action="" method="post">
				 <div class="control-group normal_text"> <h3><img src="img/logo-icon.png" alt="Logo" />Staff Login</h3></div>
                 
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                            <input type="email" placeholder="Email" name="email" value="<?php echo $email;?>" />
                            <br>
                            <span class="error"><?php echo $emailErr;?></span>
                        </div>
                    </div>
                </div>

                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" placeholder="Password" name="pwd" value="<?php echo $pwd;?>" />
                            <br>
                            <span class="error"><?php echo $erpwd;?></span>
                        </div>
                    </div>
                </div>
                <span class="error"><?php echo $err;?></span>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Forgot password?</a></span>
                    <span class="pull-right"><button type="submit" class="btn btn-success" name="send">Login</button></span>
                    <a href="register.php" style="color: white;">Don't have account? register here.</a>
                </div>
                <a href="../index.html" style="color: lime;">Return home</a>
            </form>

<?php
 $name=$surname=$dob=$email=$cellno=$idno=$pwd=$cpwd=$hashp="";

                         
                              $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd="";
                              $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=false;
                                

                    if (isset($_POST["recover"])) {
    

                                if (empty($_POST["email"])) {
                                
                                echo '<script type="text/javascript">alert("Email is required"); window.location = "login.php";</script>';
                                $Temail=false;
                              } else {
                                $email = test_input($_POST["email"]);
                                $Temail=true;
                                // check if e-mail address is well-formed
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                  
                                  echo '<script type="text/javascript">alert("Invalid email format"); window.location = "login.php";</script>';
                                  $Temail=false; 
                                }else{
                                    $query="SELECT * FROM staff WHERE staff_email='$email'";
                                    $result=mysqli_query($conn,$query);
                                     if(!$result){

                                      die("db access failed ".mysqli_error());
                                    }
                                      //get the number of rows of the executed query  
                                    $rows=mysqli_num_rows($result);
                                                
                              if($rows<=0){
                                        
                                        echo '<script type="text/javascript">alert("email not registered"); window.location = "login.php";</script>';
                                        $Temail=false;
                                    }
                                }
                              
                               }
                               

                                
                                //1st password
                              if (empty($_POST["pwd"])) {
                                
                                echo '<script type="text/javascript">alert("Password is required"); window.location = "login.php";</script>';
                                $Tpwd=false;
                              } else {
                                $pwd = test_input($_POST["pwd"]);
                                $Tpwd=true;

                                    if(strlen($pwd)<8){
                                        $erpwd = "password must have at least 8 digits";
                                        echo '<script type="text/javascript">alert("Password confirm is required"); window.location = "login.php";</script>';
                                        $Tpwd=false;
                                        
                                    }
                                }
                                
                              
                                
                               //2nd password 
                             if (empty($_POST["cpwd"])) {
                               
                                echo '<script type="text/javascript">alert("Password confirm is required"); window.location = "login.php";</script>';
                                $Tcpwd=false;
                              } else {
                                    $cpwd = test_input($_POST["cpwd"]);
                                    $hashp=password_hash($pwd,PASSWORD_DEFAULT);
                                    $Tcpwd=true;

                                    if ($pwd!=$cpwd){
                                            $ercpwd = "";
                                            echo '<script type="text/javascript">alert("Password do match"); window.location = "login.php";</script>';
                                            $Tcpwd=false;
                                    }
                                    
                              }
                               if ($Temail&&$Tpwd&&$Tcpwd&&$hashp) {
                                          
                                                    //echo $staffno." ".;
                                                  $sql="Update staff set password='$hashp' where staff_email='$email'";
                                                  if(mysqli_query($conn,$sql))
                                                      {
                                                          echo '<script type="text/javascript">alert("You Succesfully Reseted the password"); window.location = "login.php";</script>';
                                                          

                                                          
                                                      }else{die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                                                    
                                      }else{
                                        echo "somthing its wrong";
                                      }
                            }
                            
                          


                            ?>

            <form id="recoverform" action="#" class="form-vertical" method="post">
				<p class="normal_text">Enter your e-mail address below</p>
				
                   

                   <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span>
                            <input type="email" placeholder="Email"  name="email" value="<?php echo $email;?>" required/>
                            <br>
                             <span class="error"><?php echo $eremail;?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" placeholder="Password" name="pwd" value="<?php echo $pwd;?>"  required/>
                            <br>
                            <span class="error"><?php echo $erpwd;?></span>
                        </div>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" placeholder="Confirm Password" name="cpwd" value="<?php echo $cpwd;?>"  required/>
                            <br>
                            <span class="error"><?php echo $ercpwd;?></span>
                        </div>
                    </div>
                </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right">
                        <button type="submit" name="recover" class="btn btn-info"/>Change Password</button>
                        
                     
                </div>

                <a href="../index.html" style="color: lime;">Return home</a>
            </form>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    </body>

</html>
