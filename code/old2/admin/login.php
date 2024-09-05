<?php
session_start();
include '../connector.php';

?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Admin portal</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 <style type="text/css">
 .error {color: #FF0000;}
 </style>
</head>

<body style="background-color:black;">
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-success">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db" style="color: white;"><img src="assets/images/favicon.png" width="30" height="30" alt="logo" /> Admin Login</span>
                    </div>
                    <!-- Form -->
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
                    $query="SELECT * FROM admin WHERE admin_email='$email'";
                    $result=mysqli_query($conn,$query);
                     if(!$result){

                      die("db access failed ".mysqli_error());
                    }
                      //get the number of rows of the executed query  
                    $rows=mysqli_num_rows($result);
                                
              if($rows==0){
                        $emailErr ="email not registered";
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
                     
                   
                    $query="SELECT * FROM admin WHERE admin_email='$email'";
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
                                            
                                            $_SESSION['email']=$rows['admin_email'];
                                            $_SESSION['id']=$rows['admin_id'];
                                            $_SESSION['name']=$rows['admin_name'];
                                            $_SESSION['surname']=$rows['admin_surname'];
                                            //$_SESSION['email']=$rows['admin_email'];
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
                    <form class="form-horizontal m-t-20" id="loginform" action="" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <span class="error"><?php echo $emailErr;?></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo $email?>">
                                </div>




                                <span class="error"><?php echo $erpwd;?></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="pwd" value="<?php echo $pwd;?>">
                                </div>

                                <span class="error"><?php echo $err;?></span>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Forgot password?</button>

                                        <button class="btn btn-success float-right" type="submit" name="send">Login</button>
                                        <br>
                                        <a href="register.php" style="color: white;">Don't have account? register here.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="../index.html" style="color: lime;">Return home</a>
                    </form>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below </span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->

<?php
 $name=$surname=$dob=$email=$cellno=$idno=$pwd=$cpwd=$hashp="";

                         
                              $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd="";
                              $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=false;
                                

                    if (isset($_POST["action"])) {
    

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
                                    $query="SELECT * FROM admin WHERE admin_email='$email'";
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
                                                  $sql="Update admin set password='$hashp' where admin_email='$email'";
                                                  if(mysqli_query($conn,$sql))
                                                      {
                                                          echo '<script type="text/javascript">alert("You Succesfully Reseted the password"); window.location = "login.php";</script>';
                                                          

                                                          
                                                      }else{die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                                                    
                                      }else{
                                        echo "somthing its wrong";
                                      }
                            }
                            
                          


                            ?>

                        <form class="col-12" action="" method="post">
                            <!-- email -->
                            

                 
                
                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Confirm Password" aria-describedby="basic-addon1" name="email" value="<?php echo $email;?>">
                                </div>
                
                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Confirm Password" aria-describedby="basic-addon1" name="pwd" value="<?php echo $pwd;?>">
                                </div>
                
                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Confirm Password" aria-describedby="basic-addon1" name="cpwd" value="<?php echo $cpwd;?>">
                                </div>
               
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="submit" name="action">Recover</button>
                                    <br>
                                    <a href="register.php" style="color: white;">Don't have account? register here.</a>
                                </div>
                            </div>
                            <a href="../index.html" style="color: lime;">Return home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>