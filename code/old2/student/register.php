<?php

include '../connector.php';

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Student Portal</title><meta charset="UTF-8" />
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
    <body>
        <div id="loginbox"> 
        <?php
                                // define variables and set to empty values

                             
                            $name=$surname=$dob=$email=$cellno=$idno=$pwd=$cpwd=$hashp=$ercampus=$campus="";

                         

                              $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd="";
                              $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=$Tcampus=false;
                                
                           
                              if (isset($_POST['send'])) {
                                 
                              if (empty($_POST["name"])) {
                                $ername = "First Name is required";
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
                                        $ername = "fisrtname is short";
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
                              
                              

                                   //cellno
                              if (empty($_POST["cellno"])) {
                                $ercellno = "Student number is required";
                                $Tcellno=false;
                              } else {
                                $cellno = test_input($_POST["cellno"]);
                                $Tcellno=true;
                                // check if name only contains letters and whitespace
                                if (!preg_match("/^[0-9]*$/",$cellno)) {
                                  $ercellno = "Only numbers allowed"; 
                                  $Tcellno=false;
                                }else{
                                    if(strlen($cellno)!=9){
                                        $ercellno = "Student number must be 9 digits";
                                        $Tcellno=false;

                                    }else{
                                      $firtn=substr($cellno, 0,1);
                                      $lasttwo=substr($cellno, 1,2);

                                      $studentNoYear=$firtn."0".$lasttwo;

                                      $currentYear=date("Y");

                                      $difference=$currentYear-$studentNoYear;

                                      if ($difference<0) {
                                        # code...
                                        //$ercellno = $currentYear." - ".$firtn."0".$lasttwo." = ".$difference;
                                        $ercellno = "Student number is not recognised";
                                        $Tcellno=false;
                                      }else{
                                        //$ercellno = $currentYear." - ".$firtn."0".$lasttwo." = ".$difference;
                                        
                                    $query="SELECT * FROM student WHERE student_no='$cellno'";
                                    $result=mysqli_query($conn,$query);
                                     if(!$result){

                                      die("db access failed ".mysqli_error($conn));
                                    }
                                      //get the number of rows of the executed query  
                                    $rows=mysqli_num_rows($result);
                                                
                                  if($rows>0){
                                        $ercellno ="Student number already registered";
                                        $Tcellno=false;
                                    }

                                      }


                                      
                                    }
                                }
                              }

                              if (empty($_POST["idno"])) {
                                $ereidno = "ID number is required";
                                $Tidno=false;
                              } else {
                                $idno = test_input($_POST["idno"]);
                                $Tidno=true;
                                // check if name only contains letters and whitespace
                                if (!preg_match("/^[0-9]*$/",$idno)) {
                                  $ereidno = "Only digits allowed"; 
                                  $Tidno=false;
                                }else{
                                    if(strlen($idno)!=13){
                                        $ereidno = "ID number must be 13 digits";
                                        $Tidno=false;
                                      }else{


                                    $query="SELECT * FROM student WHERE id_no='$idno'";
                                    $result=mysqli_query($conn,$query);
                                     if(!$result){

                                      die("db access failed ".mysqli_error($conn));
                                    }
                                      //get the number of rows of the executed query  
                                    $rows=mysqli_num_rows($result);
                                                
                                  if($rows>0){
                                        $ereidno ="ID number already registered";
                                        $Tidno=false;
                                    }else{

                                      if ($idno=="0000000000000") {
                          # code...
                          $ereidno = "Invalid ID Number";
                          $Tidno=false;
                        }else{
                          if (substr($idno, 6,1)>=5) {
                            # code...
                            //$error_idno = "gender= Male";
                          }else{
                           //$error_idno = "gender= Female";
                          }

                          if (substr($idno, 10,1)==0) {
                            # code...
                            //$error_idno .= "<br>Natioanality: SA Citizen";
                          }elseif (substr($idno, 10,1)==1) {
                            # code...
                            
                          }else{
                            $ereidno = "The 11th digit must either be 0 or 1";
                            $Tidno=false;
                          }

                          if (substr($idno, 0,2)>20) {
                            # code...
                            $date= date("Y");
                            $dob="19".substr($idno, 0,2);
                            if ($date-$dob>17) {
                              
                            }else{
                            $ereidno = "Household owner has to be 18 years old or older";
                            $Tidno=false;
                            }

                          }else{
                             $date= date("Y");
                              $dob="20".substr($idno, 0,2);
                           //$error_idno = $date." - 20".substr($idno, 0,2);
                           if ($date-$dob>17) {
                              
                            }else{
                            $ereidno = "Sorry user has to be 18 years old or older";
                            $Tidno=false;
                            }
                          }

                          if (substr($idno, 2,2)>12) {
                            # code...
                            $ereidno = "Sorry there are 12 months in a year";
                            $Tidno=false;
                          }else{
                            //echo substr($idno, 0,2)." ".substr($idno, 2,2)." ".substr($idno, 4,2);
                            if (substr($idno, 4,2)>31) {
                              # code...
                              $ereidno = "Sorry a month may consist of 29 to 31 days";
                              $Tidno=false;
                            }
                           
                          }
                          if (substr($idno, 2,2)==2||substr($idno, 2,2)==02||substr($idno, 2,2)=="02") {
                            # code...
                            if (substr($idno, 4,2)>29) {
                              # code...
                              $ereidno = "Sorry February may consist of 29 days max";
                              $Tidno=false;
                            }
                            
                          }else{
                            //echo substr($idno, 0,2)." ".substr($idno, 2,2)." ".substr($idno, 4,2);
                            if (substr($idno, 4,2)>31) {
                              # code...
                              $ereidno = "Sorry a months may consist of 29 to 31 days";
                              $Tidno=false;
                            }
                           
                          }
                        }
                                    }
                              

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
                                    $query="SELECT * FROM student WHERE email='$email'";
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
                               

                               if (empty($_POST["campus"])) {
                                $ercampus = "Campus is required";
                                $Tcampus=false;
                              } else {
                                $campus = test_input($_POST["campus"]);
                                $Tcampus=true;

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
                                    $hashp=password_hash($pwd,PASSWORD_DEFAULT);
                                    $Tcpwd=true;

                                    if ($pwd!=$cpwd){
                                            $ercpwd = "Password do match";
                                            $Tcpwd=false;
                                    }
                                    
                              }
                               if ($Tname&&$Tsurname&&$Temail&&$Tcellno&&$Tpwd&&$Tcpwd&&$hashp&&$Tidno&&$Tcampus) {
                                          
                                                    //echo $staffno." ".;
                                                  $sql="insert into student (student_no,name,surname,id_no,email,campus,password)
                                                   values ('$cellno','$name','$surname','$idno','$email','$campus','$hashp')";
                                                  if(mysqli_query($conn,$sql))
                                                      {
                                                          echo '<script type="text/javascript">alert("You Succesfully Registered Please Login Your Account"); window.location = "login.php";</script>';
                                                          

                                                          
                                                      }else{die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                                                    
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
         <div class="control-group normal_text"> <h3><img src="img/logo-icon.png" alt="Logo" />Student Register</h3></div>
         
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                            <input type="text" placeholder="Name" name="name" value="<?php echo $name;?>" />
                            <br>
                            <span class="error"><?php echo $ername;?></span>
                        </div>

                    </div>
                </div>

        
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                            <input type="text" placeholder="Surname" name="surname" value="<?php echo $surname;?>" />
                            <br>
                             <span class="error"><?php echo $ersurname;?></span>
                        </div>
                    </div>
                </div>

                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-sign-blank"> </i></span>
                            <input type="text" placeholder="Student Number" name="cellno" value="<?php echo $cellno;?>" />
                            <br>
                             <span class="error"><?php echo $ercellno;?></span>
                        </div>
                    </div>
                </div>

                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-sign-blank"> </i></span>
                            <input type="text" placeholder="Id Number" name="idno" value="<?php echo $idno;?>" />
                            <br>
                             <span class="error"><?php echo $ereidno;?></span>
                        </div>
                    </div>
                </div>

                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span>
                            <input type="text" placeholder="Email"  name="email" value="<?php echo $email;?>" />
                            <br>
                             <span class="error"><?php echo $eremail;?></span>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            
                            <select name="campus">
                              <?php 
                                if (empty($campus)) {
                                  // code...
                                  echo "<option value=''>Choose Campus</option>";
                                }else{
                                  echo "<option value='".$campus."'>".$campus."</option>";
                                }
                              ?>
                              <option value="Arcadia Campus">Arcadia Campus</option>
                              <option value="Art Campus">Art Campus</option>
                              <option value="eMalahleni Campus">eMalahleni Campus</option>
                              <option value="Ga-rankuwa Campus">Ga-rankuwa Campus</option>
                              <option value="Mbombela Campus">Mbombela Campus</option>
                              <option value="Sosh-South Campus">Sosh-South Campus</option>
                              <option value="Sosh-North Campus">Sosh-North Campus</option>
                              <option value="Polokwane Campus">Polokwane Campus</option>
                              <option value="Pretoria-Main Campus">Pretoria-Main Campus</option>
                            </select>
                            <br>
                             <span class="error"><?php echo $ercampus;?></span>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" placeholder="Password" name="pwd" value="<?php echo $pwd;?>"  />
                            <br>
                            <span class="error"><?php echo $erpwd;?></span>
                        </div>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" placeholder="Confirm Password" name="cpwd" value="<?php echo $cpwd;?>"  />
                            <br>
                            <span class="error"><?php echo $ercpwd;?></span>
                        </div>
                    </div>
                </div>
                <span class="error"><?php echo $err;?></span>
                <div class="form-actions">
                    
                    <span class="pull-right"><button type="submit" class="btn btn-success" name="send">Register</button></span>
                    <a href="register.php" style="color: white;">Don't have account? register here.</a>
                </div>
                <a href="../index.html" style="color: lime;">Return home</a>
            </form>



            
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    </body>

</html>
