<?php session_start();
      include 'connector.php';?>
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
      <div style="margin:auto;width: 50%;">
      <img src="tut.png" style="width:100%;"> 
      </div>
      <h2 class="card-heading px-3">Sign Up</h2>
      <h5 class="card-subheading px-3 pb-3">It's quick and easy.</h5>
      <?php
      /*session_start();
      include 'connector.php';*/
      //include 'api_connecter.php';
          // define variables and set to empty values

//echo $_SESSION['photo'];
      $ini=$erini=$surname=$ersurname=$email=$eremail=$campus=$ercampus=$user_type=$eruser_type=$staff_no=$erstaff_no=$stud_no=$erstud_no=$pwd=$erpwd=$cpwd=$ercpwd=$hashp=$ermy_photo=$my_photo=$cell_no=$ercell_no="";
        $Tini=$Tsurname=$Temail=$Tcampus=$Tuser_type=$Tstaff_no=$Tstud_no=$Tpwd=$Tcpwd=$Tmy_photo=$Tcell_no=false;
        
     
        if (isset($_POST['register'])) {
            
            
       /*if (empty($_POST["photo"])) {
          $_SESSION['photo']="";
        } else {
          $_SESSION['photo']=$_POST["photo"];
        }*/
           
        if (empty($_POST["ini"])) {
          $erini = "Inititials are required";
          $Tini=false;
        } else {
          $ini = test_input($_POST["ini"]);
          $Tini=true;
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z]*$/",$ini)) {
            $erini = "Inititials allow only letters";
            $Tini=false; 
          }else{
              if(strlen($ini)>3){
                  $ername = "Inititials are long";
                  $Tname=false;

              }
          }
        }

         if (empty($_POST["surname"])) {
          $ersurname = "Surname is required";
          $Tsurname=false;
        } else {
          $surname = test_input($_POST["surname"]);
          $Tsurname=true;
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
            $ersurname = "Surname allows only letters and white space.";
            $Tsurname=false; 
          }else{
              if(strlen($surname)<2){
                  $ersurname = "Surname is short";
                  $Tsurname=false;

              }
          }
        }

         if (empty($_POST["user_type"])) {
          $eruser_type = "User type is required";
          $Tuser_type=false;
        } else {
          $user_type = test_input($_POST["user_type"]);
          $Tuser_type=true;
         
          switch ($user_type) {
            case 'Student':
              if (empty($_POST["stud_no"])) {
                  echo '<script type="text/javascript">alert("Student number is required");</script>';
                  $eruser_type= "Student number is required";
                  $Tuser_type=false;
                } else {
                  $stud_no = test_input($_POST["stud_no"]);
                  $Tuser_type=true;
                  
                   $studentArr=['219586930','218735550','219518048','219042558','219518246','219586940','211588999','209579214','221896471','219355962','217654440','219077336','219518045','219586933'];
                  if (in_array($stud_no, $studentArr))
                      {
                      //echo "Match found";
                      }
                    else
                      {
                          echo '<script type="text/javascript">alert("This student number is not registered with TUT");</script>';
                       $eruser_type ="This student number is not registered with TUT";
                              $Tuser_type=false;
                      }
                  
                    /*  $query="SELECT * FROM tut_database WHERE individual_no='$stud_no' and user='Student'";
                      $result=mysqli_query($conn2,$query);
                       if(!$result){

                        echo("db access failed ".mysqli_error($conn2));
                      }else{

                        //get the number of rows of the executed query
                        $rows=mysqli_num_rows($result);         
                        if($rows==0){
                              $erstud_no ="This student number is not registered with TUT";
                              $Tstud_no=false;
                          }

                      }*/
                      //check if registered on this system
                      $query2="SELECT * FROM student WHERE student_number='$stud_no'";
                      $result2=mysqli_query($conn,$query2);
                       if(!$result2){

                        echo("db access failed ".mysqli_error($conn));
                      }else{

                        //get the number of rows of the executed query
                        $rows2=mysqli_num_rows($result2);         
                        if($rows2>0){
                            //echo '<script type="text/javascript">alert("This student number is already registered on this system");</script>';
                              $eruser_type ="This student number is already registered on this system";
                              $Tuser_type=false;
                          }

                      }
                                        
                
                 }

              break;

            case 'Staff':
            // code...
            if (empty($_POST["staff_no"])) {
                echo '<script type="text/javascript">alert("Staff number is required");</script>';
                  $eruser_type= "Staff number is required";
                  $Tuser_type =false;
                } else {
                  $staff_no = test_input($_POST["staff_no"]);
                  $Tuser_type =true;
                  $staffArr=['216332','223451','229472','226319','219324','236163','279865','214756','215879','212765','219566','219285','219022'];
                  if (in_array($staff_no, $staffArr))
                      {
                      //echo "Match found";
                      }
                    else
                      {
                          echo '<script type="text/javascript">alert("This staff number is not registered with TUT");</script>';
                      $eruser_type ="This staff number is not registered with TUT";
                              $Tuser_type=false;
                      }
                  
                      /*$query="SELECT * FROM tut_database WHERE individual_no='$staff_no' and user='Staff'";
                      $result=mysqli_query($conn2,$query);
                       if(!$result){

                        echo("db access failed ".mysqli_error($conn2));
                      }else{

                        //get the number of rows of the executed query
                        $rows=mysqli_num_rows($result);         
                        if($rows==0){
                              
                          }

                      }
*/
                      //check staff if already regisred
                      $query="SELECT * FROM staff WHERE staff_number='$staff_no'";
                      $result=mysqli_query($conn,$query);
                       if(!$result){

                        echo("db access failed ".mysqli_error());
                      }else{

                        //get the number of rows of the executed query
                        $rows=mysqli_num_rows($result);         
                        if($rows>0){
                            echo '<script type="text/javascript">alert("This staff number is already registered on this system");</script>';
                              $eruser_type ="This staff number is already registered on this system";
                              $Tuser_type=false;
                          }

                      }
                                        
                
                 }
            break;
            
            case 'Admin':
            // code...
            if (empty($_POST["cell_no"])) {
                echo '<script type="text/javascript">alert("Phone number is required");</script>';
                  $eruser_type = "Phone number is required";
                  $Tuser_type=false;
                } else {
                  $cell_no = test_input($_POST["cell_no"],$conn);
                  $Tuser_type=true;
                  // check if name only contains letters and whitespace
                  if (!preg_match("/^[0-9]*$/",$cell_no)) {
                      echo '<script type="text/javascript">alert("Only digits allowed for Phone number");</script>';
                    $eruser_type = "Only numbers allowed"; 
                    
                    $Tuser_type=false;
                  }else{
                      if(strlen($cell_no)!=10){
                          echo '<script type="text/javascript">alert("Phone number must be 10 digits");</script>';
                          $eruser_type = "Phone number must be 10 digits";
                          
                          $Tuser_type=false;

                      }

                      }
                  }
            break;
            
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
              $query="SELECT * FROM user WHERE email='$email'";
              $result=mysqli_query($conn,$query);
               if(!$result){

                die("db access failed ".mysqli_error($conn));
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
                  $erpwd = "Password must have at least 8 digits";
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

        if (isset($_SESSION['photo'])) {
             // code...
            //echo "Photo uploaded, no biggie";
            $my_photo=$_SESSION['photo'];
            $Tmy_photo=true;
           }else{
            $ermy_photo="Photo not uploaded";
            $Tmy_photo=false;
           }



         if ($Tini&&$Tsurname&&$Temail&&$Tcampus&&$Tuser_type&&$Tpwd&&$Tcpwd&&$hashp&&$Tmy_photo) {
            $today=date("Y-m-d"); 
            $sql="INSERT INTO `user`(`initials`, `lastname`, `email`, `campus`, `photo`, `password`, `user_type`,`date_created`) VALUES ('$ini','$surname','$email','$campus','$my_photo','$hashp','$user_type','$today')";
            if(mysqli_query($conn,$sql))
                {

                  $get_user_id=mysqli_insert_id($conn);
                  unset($_SESSION['photo']);
                  include 'mail.php';
                  $to=$email;
                  $from="eaccesscard@gmail.com";
                  $subject="Welcome to our system";
                  $cmessage="Dear ".$ini." ".$surname."<br><br>";
                  $cmessage.="You have succefully registered on the e-access card System as a(n) ".$user_type.".<br> You cant now login.  <a href='http://demo.trevail.co.za/'>Click to log in</a> <br><br>Kind Regard<br>e-access card System Team";
                  send_email($to,$from,$subject,$cmessage);
                  if ($user_type=='Student') {
                    // code...
                     $sql="INSERT INTO `student`(`student_number`, `user_id`) VALUES ('$stud_no','$get_user_id')";
                    if (mysqli_query($conn,$sql)) {
                      // code...
                      //$_SESSION['photo']="";

                      echo '<script type="text/javascript">alert("You Succesfully Registered Please Login Your Account"); window.location = "login.php";</script>';
                    }
                  }elseif ($user_type=='Staff') {
                    // code...
                    //$_SESSION['photo']="";
                     $sql="INSERT INTO `staff`(`staff_number`, `user_id`) VALUES ('$staff_no','$get_user_id')";
                    if (mysqli_query($conn,$sql)) {
                      // code...

                      echo '<script type="text/javascript">alert("You Succesfully Registered Please Login Your Account"); window.location = "login.php";</script>';
                    }
                  }else{
                    $sql="INSERT INTO `admin`(`user_id`,`phone_number`) VALUES ('$get_user_id','$cell_no')";
                    if (mysqli_query($conn,$sql)) {
                      // code...
                      //$_SESSION['photo']="";

                      echo '<script type="text/javascript">alert("You Succesfully Registered Please Login Your Account"); window.location = "login.php";</script>';
                    }
                    
                  }
                    

                    
                }else{ echo("<h3>unsuccessfully not registered </h3>".mysqli_error($conn)); }
                          
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
        <div class="group-inputs">
          <label>Initials</label>
          <input type="text" class="form-control" placeholder="Enter Initials"  maxlength="3" name="ini" value="<?php echo $ini;?>">
          <span class="error"><?php echo $erini;?></span>
        </div>
        <div class="group-inputs">
          <label>Surname</label>
          <input type="text" class="form-control" placeholder="Enter Surname"  name="surname" value="<?php echo $surname;?>">
          <span class="error"><?php echo $ersurname;?></span>
        </div>
        <div class="group-inputs">
          <label>Email</label>
          <input type="text" class="form-control" placeholder="Email Addresss" name="email" value="<?php echo $email;?>">
          <span class="error"><?php echo $eremail;?></span>
        </div>
        <div class="form-group">
          <label>Campus</label>
          <select name="campus" class="form-control">
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
            <span class="error"><?php echo $ercampus;?></span>
        </div>
        <div class="form-group" style="padding: 5px;">
          <label>Register As:</label>
          <p ><input type="radio"  value="Student" name="user_type" onclick="user(this);"  <?php if($user_type=='Student')echo 'checked';?>>Student
          <input type="radio"  value="Staff" name="user_type" onclick="user(this);"  <?php if($user_type=='Staff')echo 'checked';?>>Staff
          <input type="radio"  value="Admin" name="user_type" onclick="user(this);"  <?php if($user_type=='Admin')echo 'checked';?>>Admin</p>
          
          <span class="error"><?php echo $eruser_type;?></span>
        </div>
        <script>
          //user('Student');
          function user(type) {
            // body...
            if (type.value==="Student") {
              document.getElementById("stud_no").style.display="block";
              document.getElementById("sta_no").style.display="none";
              document.getElementById("cell_no").style.display="none";
            }else if (type.value==="Staff") {
              document.getElementById("stud_no").style.display="none";
              document.getElementById("sta_no").style.display="block";
              document.getElementById("cell_no").style.display="none";
            }else if (type.value==="Admin") {
              document.getElementById("cell_no").style.display="block";
              document.getElementById("stud_no").style.display="none";
              document.getElementById("sta_no").style.display="none";
            }else{
              document.getElementById("stud_no").style.display="none";
              document.getElementById("sta_no").style.display="none";
              document.getElementById("cell_no").style.display="none";
            }
          }
        </script>
        <div class="group-inputs" id="sta_no" style="display: none;">
          <label>Staff Number</label>
          <input type="text" class="form-control" placeholder="Enter Staff Number" name="staff_no" value="<?php echo $staff_no;?>" maxlength="6">
         <!-- <span class="error"><?php echo $erstaff_no;?></span>-->
        </div>
        <div class="group-inputs" id="stud_no" style="display: none;">
          <label>Student Number</label>
          <input type="text" class="form-control" placeholder="Enter Student Number" name="stud_no" value="<?php echo $stud_no;?>" maxlength="9">
          <!--<span class="error"><?php echo $erstud_no;?></span>-->
        </div>
        <div class="group-inputs" id="cell_no" style="display: none;">
          <label>Phone Number</label>
          <input type="text" class="form-control" placeholder="Enter Phone Number" name="cell_no" value="<?php echo $cell_no;?>" maxlength="10">
          <!--<span class="error"><?php echo $ercell_no;?></span>-->
        </div>

        <div class="form-group mb-4" style="margin: auto;">
          <label>Profile Picture</label>
         
        <style>
          #video{
              width: 320px;
              height: 240px;
              border: 1px solid black;
          }
        </style>

        <!-- -->
          <div style="margin: auto;">
             <style>
          #my_camera{
              width: 320px;
              height: 240px;
              border: 1px solid black;
          }
        </style>

        <!-- -->
          <div style="margin: auto;">
          <div id="container">
            <canvas class="center-block" id="canvasOutput" style="width: 320px;height: 240px;margin: auto;display:none;"></canvas>
          </div>
          <div class="text-center" hidden>
            <p hidden>
            
              <input type="radio" id="face" name="😑" value="face" checked hidden>
              
              <input type="radio" id="eye" name="👁️" value="eye" hidden>
            
            
            </p>
          </div>
          <!-- <div id="my_camera" style="margin: auto;"></div> -->
          <input type=button value="Start Camera" onClick="configure()" style="width:49%;">
          <input type=button value="Take Snapshot" onClick="take_snapshot()" style="width:49%;">
          

          <div class="invisible" hidden>
            <video id="video" class="hidden" style="width: 320px;height: 240px;margin: auto;" >Your browser does not support the video tag.</video>
          </div>
          
          <span class="error"><?php echo $ermy_photo;?></span>
            <div id="results"  style="margin: auto;">
               <?php 
              if (isset($_SESSION['photo'])&&$_SESSION['photo']!="") {
                // code...
                echo '<img src='.$_SESSION['photo'].' id=old_img style="width: 100%;">';
              }
            ?>
            <input name='photo' id='myphoto' hidden>
            </div>
           
           <input type=button value="Save Snapshot" onClick="saveSnap()" id="save" style="width:100%;display: block;">
          </div>
          
        </div>

      <div class="step-forms">
        <div class="form-group mb-4">
        <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
          <span class="error"><?php echo $erpwd;?></span>
        </div>
        <div class="form-group mb-4">
        <label>Confirm Password</label>
          <input type="password" class="form-control" placeholder="Re-type Password" name="cpwd">
          <span class="error"><?php echo $ercpwd;?></span>
        </div>
      </div>
      
      <div class="row">
        
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Sign Up</span></button>
        </div>
        
        <div class="col-md-6">
          <a href="login.php" class="btn btn-outline-primary" style="width:100%;"><span>Sign In here</span></a>
        </div>
      </div>

      <div class="row rfour">
        <div class="col-md-12 ml-3">
          <a href="index.html" class="btn btn-success mt-3" style="width:90%;"><span>Back to home Page</span></a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

  <script type="text/javascript" src="webcamjs/webcam.min.js"></script>

  <!-- Code to handle taking the snapshot and displaying it locally -->
  <script language="JavaScript">
    
    // Configure a few settings and attach camera
  function configure(){
      Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
      });
      document.getElementById('canvasOutput').style.display='block';
      Webcam.attach( '#video' );

      
    }
    // A button for taking snaps
    

    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    function take_snapshot() {
      // play sound effect
      shutter.play();

      // take snapshot and get image data
      Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('results').innerHTML = 
          '<img id="imageprev" src="'+data_uri+'" style="width: 100%;"/>';

          document.getElementById('canvasOutput').style.display='none';
          document.getElementById("save").style.display="block";
          
      } );

      Webcam.reset();
    }


    function saveSnap(){
      // Get base64 value from <img id='imageprev'> source
      var base64image =  document.getElementById("imageprev").src;

       Webcam.upload( base64image, 'upload.php', function(code, text) {
         //console.log('Save successfully');
         document.getElementById('myphoto').value=text;
         console.log(text);
            });

    }
  </script>
 <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>

 <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.5/dat.gui.min.js"></script>
<script>
  var Module = {
    wasmBinaryFile: 'https://huningxin.github.io/opencv.js/build/wasm/opencv_js.wasm',
    preRun: [function() {
      Module.FS_createPreloadedFile('/', 'haarcascade_eye.xml', 'https://raw.githubusercontent.com/opencv/opencv/master/data/haarcascades/haarcascade_eye.xml', true, false);
      Module.FS_createPreloadedFile('/', 'haarcascade_frontalface_default.xml', 'https://raw.githubusercontent.com/opencv/opencv/master/data/haarcascades/haarcascade_frontalface_default.xml', true, false);
      Module.FS_createPreloadedFile('/', 'haarcascade_profileface.xml', 'https://raw.githubusercontent.com/opencv/opencv/master/data/haarcascades/haarcascade_profileface.xml', true, false);
    }],
    _main: function() {
      opencvIsReady();
    }
  };
</script>

<script async src="https://huningxin.github.io/opencv.js/build/wasm/opencv.js"></script>

  <script>
    let videoWidth, videoHeight;
// whether streaming video from the camera.
let streaming = false;

let video = document.getElementById("video");
let canvasOutput = document.getElementById("canvasOutput");
let canvasOutputCtx = canvasOutput.getContext("2d");
let stream = null;

let detectFace = document.getElementById("face");
let detectEye = document.getElementById("eye");

function startCamera() {
  if (streaming) return;
  navigator.mediaDevices
    .getUserMedia({ video: true, audio: false })
    .then(function (s) {
      stream = s;
      video.srcObject = s;
      video.play();
    })
    .catch(function (err) {
      console.log("An error occured! " + err);
    });

  video.addEventListener(
    "canplay",
    function (ev) {
      if (!streaming) {
        videoWidth = video.videoWidth;
        videoHeight = video.videoHeight;
        video.setAttribute("width", videoWidth);
        video.setAttribute("height", videoHeight);
        canvasOutput.width = videoWidth;
        canvasOutput.height = videoHeight;
        streaming = true;
      }
      startVideoProcessing();
    },
    false
  );
}

let faceClassifier = null;
let eyeClassifier = null;

let src = null;
let dstC1 = null;
let dstC3 = null;
let dstC4 = null;

let canvasInput = null;
let canvasInputCtx = null;

let canvasBuffer = null;
let canvasBufferCtx = null;

function startVideoProcessing() {
  if (!streaming) {
    console.warn("Please startup your webcam");
    return;
  }
  stopVideoProcessing();
  canvasInput = document.createElement("canvas");
  canvasInput.width = videoWidth;
  canvasInput.height = videoHeight;
  canvasInputCtx = canvasInput.getContext("2d");

  canvasBuffer = document.createElement("canvas");
  canvasBuffer.width = videoWidth;
  canvasBuffer.height = videoHeight;
  canvasBufferCtx = canvasBuffer.getContext("2d");

  srcMat = new cv.Mat(videoHeight, videoWidth, cv.CV_8UC4);
  grayMat = new cv.Mat(videoHeight, videoWidth, cv.CV_8UC1);

  faceClassifier = new cv.CascadeClassifier();
  faceClassifier.load("haarcascade_frontalface_default.xml");

  eyeClassifier = new cv.CascadeClassifier();
  eyeClassifier.load("haarcascade_eye.xml");

  requestAnimationFrame(processVideo);
}

function processVideo() {
  stats.begin();
  canvasInputCtx.drawImage(video, 0, 0, videoWidth, videoHeight);
  let imageData = canvasInputCtx.getImageData(0, 0, videoWidth, videoHeight);
  srcMat.data.set(imageData.data);
  cv.cvtColor(srcMat, grayMat, cv.COLOR_RGBA2GRAY);
  let faces = [];
  let eyes = [];
  let size;
  if (detectFace.checked) {
    let faceVect = new cv.RectVector();
    let faceMat = new cv.Mat();
    if (detectEye.checked) {
      cv.pyrDown(grayMat, faceMat);
      size = faceMat.size();
    } else {
      cv.pyrDown(grayMat, faceMat);
      cv.pyrDown(faceMat, faceMat);
      size = faceMat.size();
    }
    faceClassifier.detectMultiScale(faceMat, faceVect);
    for (let i = 0; i < faceVect.size(); i++) {
      let face = faceVect.get(i);
      faces.push(new cv.Rect(face.x, face.y, face.width, face.height));
      if (detectEye.checked) {
        let eyeVect = new cv.RectVector();
        let eyeMat = faceMat.getRoiRect(face);
        eyeClassifier.detectMultiScale(eyeMat, eyeVect);
        for (let i = 0; i < eyeVect.size(); i++) {
          let eye = eyeVect.get(i);
          eyes.push(
            new cv.Rect(face.x + eye.x, face.y + eye.y, eye.width, eye.height)
          );
        }
        eyeMat.delete();
        eyeVect.delete();
      }
    }
    faceMat.delete();
    faceVect.delete();
  } else {
    if (detectEye.checked) {
      let eyeVect = new cv.RectVector();
      let eyeMat = new cv.Mat();
      cv.pyrDown(grayMat, eyeMat);
      size = eyeMat.size();
      eyeClassifier.detectMultiScale(eyeMat, eyeVect);
      for (let i = 0; i < eyeVect.size(); i++) {
        let eye = eyeVect.get(i);
        eyes.push(new cv.Rect(eye.x, eye.y, eye.width, eye.height));
      }
      eyeMat.delete();
      eyeVect.delete();
    }
  }
  canvasOutputCtx.drawImage(canvasInput, 0, 0, videoWidth, videoHeight);
  drawResults(canvasOutputCtx, faces, "red", size);
  drawResults(canvasOutputCtx, eyes, "yellow", size);
  stats.end();
  requestAnimationFrame(processVideo);
}

function drawResults(ctx, results, color, size) {
  for (let i = 0; i < results.length; ++i) {
    let rect = results[i];
    let xRatio = videoWidth / size.width;
    let yRatio = videoHeight / size.height;
    ctx.lineWidth = 3;
    ctx.strokeStyle = color;
    ctx.strokeRect(
      rect.x * xRatio,
      rect.y * yRatio,
      rect.width * xRatio,
      rect.height * yRatio
    );
  }
}

function stopVideoProcessing() {
  if (src != null && !src.isDeleted()) src.delete();
  if (dstC1 != null && !dstC1.isDeleted()) dstC1.delete();
  if (dstC3 != null && !dstC3.isDeleted()) dstC3.delete();
  if (dstC4 != null && !dstC4.isDeleted()) dstC4.delete();
}

function stopCamera() {
  if (!streaming) return;
  stopVideoProcessing();
  document
    .getElementById("canvasOutput")
    .getContext("2d")
    .clearRect(0, 0, width, height);
  video.pause();
  video.srcObject = null;
  stream.getVideoTracks()[0].stop();
  streaming = false;
}

function initUI() {
  stats = new Stats();
  stats.showPanel(0);
  document.getElementById("container").appendChild(stats.dom);
}

function opencvIsReady() {
  console.log("OpenCV.js is ready");
  initUI();
  startCamera();
}

  </script>

  </body>
</html>

