<?php
include 'top_nav.php';

?>

<!--close-top-Header-menu-->
<!--start-top-serch-->
<style type="text/css">
 .error {color: #FF0000;}
 </style>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar">
  <?php
include 'side_nav.php';

?>

</div>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Profile</a> </div>
  <h1>Profile</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Personal-info</h5>
        </div>
        <?php
                // define variables and set to empty values

             
            //$sname=$ssurname=$sdob=$semail=$scellno=$sidno="";

         
              $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd=$ercampus=$pwd=$cpwd=$hashp="";
              $Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=false;
                
           
              if (isset($_POST['send'])) {
                 $name=$surname=$dob=$email=$cellno=$idno=$campus="";
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

              if (empty($_POST["campus"])) {
                  $ercampus = "Campus is required";
                  $Tcampus=false;
                } else {
                  $campus = test_input($_POST["campus"]);
                  $Tcampus=true;

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
                }
              
               }
               

                
              
             
               if ($Tname&&$Tsurname&&$Temail&&$Tcellno&&$Tidno) {
                          
                     $sql="UPDATE student SET student_no='$cellno',name='$name',surname='$surname',id_no='$idno',email='$email',campus='$campus' where student_id='$id'";
                    if(mysqli_query($conn,$sql))
                        {
                          $_SESSION['email']=$email;
                          $_SESSION['name']=$name;
                          $_SESSION['surname']=$surname;
                          $_SESSION['student_no']=$student_no;
                          $_SESSION['idno']=$idno;
                          $_SESSION['campus']=$campus;

                            echo '<script type="text/javascript">alert("You Succesfully Updated your information"); window.location = "index.php";</script>';
                            

                            
                        }else{die("<h3>unsuccessful </h3>".mysqli_error($conn)); }
                                    
                      }
            }
            
          



            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
           
            ?>  
        <div class="widget-content nopadding">
          <form action="#" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">First Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Enter First name" name="name" value="<?php echo $name;?>" />
                <span class="error"><br><?php echo $ername;?></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Last Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Enter Last name" name="surname" value="<?php echo $surname;?>" />
                <span class="error"><br><?php echo $ersurname;?></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email</label>
              <div class="controls">
                <input type="email"  class="span11" placeholder="Enter Email" name="email" value="<?php echo $email;?>"  />
                <span class="error"><br><?php echo $eremail;?></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">ID number :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Enter ID number" name="idno" value="<?php echo $idno;?>" />
                <span class="error"><br><?php echo $ereidno;?></span>
              </div>
            </div>





            <div class="control-group">
              <label class="control-label">Student number:</label>
              <div class="controls">
                <input type="text" class="span11" value="<?php echo $student_no;?>" placeholder="Enter Student number" name="cellno" />
              <span class="error"><br><?php echo $ercellno;?></span>
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
            
            <div class="border-top">
                <div class="card-body">
                    <button type="Submit" class="btn btn-primary" name="send" style="width:100%;">Update</button>
                    <hr>
                    <a onclick="delete_profile(<?php echo $id;?>)" class="btn btn-danger" style="width:96%;">Delete account</a>
                </div>
            </div>
          </form>
        </div>
      </div>

      
    </div>
</div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Change Password</h5>
        </div>
        <?php
              
           
              if (isset($_POST['pass'])) {
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
             
               if ($Tpwd&&$Tcpwd&&$hashp) {
                          
                       $sql="UPDATE student_info SET password='$hashp' where student_id='$id'";
                      if(mysqli_query($conn,$sql))
                          {
                           
                              echo '<script type="text/javascript">alert("Password Updated Succesfully."); window.location = "index.php";</script>';
                              

                              
                          }else{die("<h3>unsuccessful </h3>".mysqli_error($conn)); }
                                    
                      }
            }
            
          
            ?>  
        <div class="widget-content nopadding">
          <form action="#" method="post" class="form-horizontal">
          
            <div class="control-group">
              <label class="control-label">New Password:</label>
              <div class="controls">
               
              <input type="password" class="span11" placeholder="Password" name="pwd"  />
                <br>
                <span class="error"><?php echo $erpwd;?></span>
            </div>
          </div>

          <div class="control-group">
              <label class="control-label">Confirm Password:</label>
              <div class="controls">
               
              <input type="password" class="span11" placeholder="Password" name="cpwd" />
                <br>
                <span class="error"><?php echo $ercpwd;?></span>
            </div>
          </div>
            
            <div class="border-top">
                <div class="card-body">
                    <button type="Submit" class="btn btn-warning" name="pass" style="width:100%;">Update Password</button>
                    <hr>
                    <a onclick="delete_profile(<?php echo $id;?>)" class="btn btn-danger" style="width:96%;">Delete account</a>
                </div>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
   <script>
       function delete_profile(id) {
          // body...
          if (confirm("Are you sure you want to delete your profile?!") == true) {
              text = "You pressed OK!";
              window.location="profile_delete.php?myid="+id;
            }
       }
    </script>
</div></div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> &copy; 2012 </div>
</div>
<!--end-Footer-part--> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/jquery.toggle.buttons.js"></script> 
<script src="js/masked.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.form_common.js"></script> 
<script src="js/wysihtml5-0.3.0.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/bootstrap-wysihtml5.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>
</body>
</html>
