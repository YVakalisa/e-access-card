<?php include "header.php";

     $erini=$ersurname=$eremail=$ercampus=$eruser_type=$erstud_no=$ermy_photo=$pwd=$erpwd=$cpwd=$ercpwd=$hashp="";
        $Tini=$Tsurname=$Temail=$Tcampus=$Tuser_type=$Tstaff_no=$Tstud_no=$Tpwd=$Tcpwd=$Tmy_photo=false;
        
     
        if (isset($_POST['register'])) {
          
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
                    
            $sql="UPDATE `user` SET `password`='$hashp' WHERE `user_id`='$id'";
            if(mysqli_query($conn,$sql))
                {
                echo '<script type="text/javascript">alert("Password Updated Succesfully"); window.location = "index.php";</script>';
                     
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
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Password</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Edit Password</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">
											
              	<form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                      
                      <div class="col-md-6">
                       <div class="form-group mb-4">
                      <label>New Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="pwd">
                        <span class="error"><?php echo $erpwd;?></span>
                      </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group mb-4">
                      <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Re-type Password" name="cpwd">
                        <span class="error"><?php echo $ercpwd;?></span>
                      </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Update Passward</span></button>
                      </div>
                      
                      <div class="col-md-6">
                        <a href="index.php" class="btn btn-success" style="width:90%;"><span>Back to Dashboard</span></a>
                      </div>
                    </div>

                    
                    </form>
	</div>
	
	
								</div>
							
							</div>
						</div>
					</div>
				</div>
			</div>




<?php include "footer.php";?>