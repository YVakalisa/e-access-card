<?php

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
    <title>Admin Portal</title>
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

<body>
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
                <div>
                    <div class="text-center p-t-20 p-b-20">
                         <span class="db" style="color: white;"><img src="assets/images/favicon.png" width="30" height="30" alt="logo" /> Admin Reguster</span>
                    </div>
                    <!-- Form -->
                    <?php
                              $name=$surname=$dob=$email=$cellno=$pwd=$cpwd=$hashp="";
                         
                              $ername=$ersurname=$erdob=$eremail=$ercellno=$erpwd=$ercpwd2=$ercpwd="";
                              $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tpwd=$Tcpwd=false;


                              if (isset($_POST['signup'])) {
                                 
                              if (empty($_POST["name"])) {
                                $ername = "Name is required";
                                $Tname=false;
                              } else {
                                $name = test_input($_POST["name"]);
                                $Tname=true;
                                // check if name only contains letters and whitespace
                                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                                  $ername = "Only letters and white space allowed";
                                  $Tname=false; 
                                }else{
                                    if(strlen($name)<2){
                                        $ername = "Name is short";
                                        $Tname=false;

                                    }
                                }
                              }

                               if (empty($_POST["surname"])) {
                                $ersurname = "surname is required";
                                $Tsurname=false;
                              } else {
                                $surname = test_input($_POST["surname"]);
                                $Tsurname=true;
                                // check if name only contains letters and whitespace
                                if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
                                  $ersurname = "Only letters and white space allowed";
                                  $Tsurname=false; 
                                }else{
                                    if(strlen($surname)<2){
                                        $ersurname = "surname is short";
                                        $Tsurname=false;

                                    }
                                }
                              }
                              
                              

                             if (empty($_POST["email"])) {
                                $eremail= "Email is required";
                                $Temail=false;
                              } else {
                                $email = test_input($_POST["email"]);
                                $Temail=true;
                                // check if e-mail address is well-formed
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                  $eremail= "Invalid email format";
                                  $Temail=false; 
                                }else{
                                    $query="SELECT * FROM admin WHERE admin_email='$email'";
                                    $result=mysqli_query($conn,$query);
                                     if(!$result){

                                      die("db access failed ".mysqli_error());
                                    }
                                      //get the number of rows of the executed query  
                                    $rows=mysqli_num_rows($result);
                                                
                              if($rows>0){
                                        $eremail ="email already registered";
                                        $Temail=false;
                                    }
                                }
                              
                               }
                               

                                
                                //1st password
                              if (empty($_POST["pwd"])) {
                                $erpwd = "Password is required";
                                $Tpwd=false;
                              } else {
                                $pwd = test_input($_POST["pwd"]);
                                $Tpwd=true;

                                    if(strlen($pwd)<8){
                                        $erpwd = "password must have at least 8 digits";
                                        $Tpwd=false;
                                        
                                    }
                                }
                                
                              
                                
                               //2nd password 
                             if (empty($_POST["cpwd"])) {
                                $ercpwd = "Password confirm is required";
                                $Tcpwd=false;
                              } else {
                                $cpwd = test_input($_POST["cpwd"]);
                                if ($pwd==$cpwd) {
                                  # code...

                                    $hashp=password_hash($pwd,PASSWORD_DEFAULT);
                                    $Tcpwd=true;
                                }else{
                                    $ercpwd2 = "Password do match";
                                    $Tcpwd=false;

                                }
                                    
                                 
                              }

                               if ($Tname&&$Tsurname&&$Temail&&$Tpwd&&$Tcpwd&&$hashp) {
                                          
                                                    //echo $staffno." ".;
                                                  $sql="insert into admin (admin_name,admin_surname,admin_email,password)values ('$name','$surname','$email','$hashp')";
                                                  if(mysqli_query($conn,$sql))
                                                      {
                                                          echo '<script type="text/javascript">alert("You Succesfully Registered Please Login Your Account"); window.location = "login.php";</script>';
                                                          

                                                          
                                                      }else{
                                                        echo("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                                                    
                                      }
                            }
                            
                          



                            function test_input($data) {
                              $data = trim($data);
                              $data = stripslashes($data);
                              $data = htmlspecialchars($data);
                              return $data;
                            }
                           


        ?>
                    <form class="form-horizontal m-t-20" action="" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">

                              <!-- name -->
                                <div class="error"><?php echo $ername;?></div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg"  name="name" placeholder="Name" aria-label="name" aria-describedby="basic-addon1" value="<?php echo $name;?>">
                                    
                                    

                                </div>
                                
                                <!-- surname -->
                                <span class="error"><?php echo $ersurname;?></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="surname" placeholder="surname" aria-label="surname" aria-describedby="basic-addon1" value="<?php echo $surname;?>">
                                    

                                </div>
                                <!-- email -->
                                <span class="error"><?php echo $eremail;?></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $email?>">
                                    

                                </div>
                                <!-- password -->
                                <span class="error"><?php echo $erpwd;?></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="pwd" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" value="<?php echo $pwd;?>">
                                    

                                </div>

                                <!-- c password -->

                                <span class="error"><?php echo $ercpwd;?></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="cpwd" placeholder=" Confirm Password" aria-label="Password" aria-describedby="basic-addon1" value="<?php echo $cpwd;?>">
                                    
                                </div>
                                <span class="error"><?php echo $ercpwd2;?></span>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit" name="signup">Sign Up</button>
                                         <a href="login.php" style="color: white;">Already have account? login here.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="../index.html" style="color: lime;">Return home</a>
                    </form>
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
    </script>
</body>

</html>