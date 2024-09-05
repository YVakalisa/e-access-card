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
  <div class="card mx-5 my-5" style="margin: auto;">
    <div class="card-body px-2">
    	<div style="margin:auto;width: 50%;">
    	<img src="tut.png" style="width:100%;">	
    	</div>
    	
      <h2 class="card-heading px-3">Sign In</h2>
      <h5 class="card-subheading px-3 pb-3">Enter email and password to sign in.</h5>
      <?php
      
          // define variables and set to empty values


      $email=$eremail=$eruser_type=$pwd=$erpwd=$hashp="";
       $Tini=$Tsurname=$Temail=$Tcampus=$Tuser_type=$Tpwd=false;
        
     
        if (isset($_POST['login'])) {
           

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
                          
        if($rows==0){
                  $eremail ="User not registered on this system.";
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
          
        
         if ($Tpwd && $Temail) {
                     
                   
        $query="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($conn,$query);

        if(!$result)
        {
          $err="unable to connect to database";
           mysqli_error($conn);
        }else{
            $rows=mysqli_num_rows($result);
            if($rows<1)
            {
                $erpwd="username or password doesnt exsist";
        
            }else{
                    

                    while ($rows=mysqli_fetch_assoc($result)) 
                        {
                            $cpwd=$rows['password'];
                            
                            //!password_verify('$passwd',$cpwd) !hash_equals('$passwd',$cpwd)
            

                            if (!password_verify($pwd,$cpwd)) {
                                $erpwd="incorect password ";
                            }else{
                                session_start();
                                //,``, ``, ``, ``, ``, ``, ``
                                $_SESSION["email"]=$rows['email'];
                                $_SESSION["id"]=$rows['user_id'];
                                $_SESSION["ini"]=$rows['initials'];
                                $_SESSION["surname"]=$rows['lastname'];
                                //$_SESSION['student_no']=$rows['student_no'];
                                $_SESSION["p_pic"]=$rows['photo'];
                                $_SESSION["campus"]=$rows['campus'];
                                $_SESSION["user_type"]=$rows['user_type'];

                          if ($_SESSION["user_type"]=='Student') {
			                      echo '<script> window.location = "user/student/index.php";</script>';
				                  }elseif ($_SESSION["user_type"]=='Staff') {
				                    echo '<script> window.location = "user/staff/index.php";</script>';
				                  }else{
				                    echo '<script> window.location = "user/admin/index.php";</script>';
				                  }

                                
                                
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
      <form action="" method="post" enctype="multipart/form-data">
        
        <div class="group-inputs">
          <label>Email</label>
          <input type="text" class="form-control" placeholder="Email Addresss" name="email" value="<?php echo $email;?>">
          <span class="error"><?php echo $eremail;?></span>
        </div>
        

       <div class="step-forms">
        <div class="form-group mb-4">
        <label>Password</label>
          <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
          <span class="error"><?php echo $erpwd;?></span>
        </div>
      </div>
      <div class="step-forms">
        <div class="form-group mb-4">
        <a href="reset.php" ><span>Forgot your password?</span></a>
        </div>
      </div>
      <div class="row">
      	
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" name="login" style="width:100%;"><span>Sign In</span></button>
        </div>
        
        <div class="col-md-6">
          <a href="register.php" class="btn btn-outline-primary" style="width:100%;"><span>Sign up here</span></a>
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

 <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>

  </body>
</html>

