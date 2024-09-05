<?php include "header.php";

     $erini=$ersurname=$eremail=$ercampus=$eruser_type=$erstud_no=$ermy_photo=$erstaff_no="";
        $Tini=$Tsurname=$Temail=$Tcampus=$Tuser_type=$Tstaff_no=$Tstud_no=$Tpwd=$Tcpwd=$Tmy_photo=false;
        $other_user_id=$_GET['u'];
        $sql2="SELECT * FROM user WHERE user_id='$other_user_id'";
        $query=mysqli_query($conn,$sql2);
        if ($query) {
          // code...
           $rowsn=mysqli_num_rows($query);
           if ($rowsn>0) {
             // code...
            $other_user=mysqli_fetch_assoc($query);
            $ini=$other_user['initials'];
            $surname=$other_user['lastname'];
            $email=$other_user['email'];
            $campus=$other_user['campus'];
            $user_type=$other_user['user_type'];
            $my_photo=$other_user['photo'];

            if ($user_type=="Student") {
              // code...
              $sql23="SELECT * FROM student WHERE user_id='$other_user_id'";
              $query3=mysqli_query($conn,$sql23);
              if ($query3) {
                // code...
                $stud=mysqli_fetch_assoc($query3);
                $stud_no=$stud['student_number'];
              }
              
            }else{
              $sql23="SELECT * FROM staff WHERE user_id='$other_user_id'";
              $query3=mysqli_query($conn,$sql23);
              if ($query3) {
                // code...
                $staff=mysqli_fetch_assoc($query3);
                $staff_no=$staff['staff_number'];
              }

            }
            
           }
        }
        


     
        if (isset($_POST['register'])) {
           $ini=$surname=$email=$campus=$user_type=$stud_no=$staff_no="";
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
                  $eruser_type= "Student number is required";
                  $Tuser_type=false;
                } else {
                  $stud_no = test_input($_POST["stud_no"]);
                  $Tuser_type=true;
                  
                      $studentArr=['218735550','219518048','219586940','219285167','211588999','209579214','221896471','123456789','219355962','217654440','219077336','219518045','219586933'];
                  if (in_array($stud_no, $studentArr))
                      {
                      //echo "Match found";
                      }
                    else
                      {
                          echo '<script type="text/javascript">alert("This student number is not registered with TUT");</script>';
                       $erstud_no ="This student number is not registered with TUT";
                              $Tstud_no=false;
                      }
                      //check if registered on this system
                      $query2="SELECT * FROM student WHERE student_number='$stud_no' and user_id<>'$other_user_id'";
                      $result2=mysqli_query($conn,$query2);
                       if(!$result2){

                        echo("db access failed ".mysqli_error($conn));
                      }else{

                        //get the number of rows of the executed query
                        $rows2=mysqli_num_rows($result2);         
                        if($rows2>0){
                              $eruser_type ="This student number is already registered on this system";
                              $Tuser_type=false;
                          }

                      }
                                        
                
                 }

              break;

            case 'Staff':
            // code...
            if (empty($_POST["staff_no"])) {
                  $eruser_type= "Student number is required";
                  $Tuser_type=false;
                } else {
                  $staff_no = test_input($_POST["staff_no"]);
                  $Tuser_type=true;
                  
                       $staffArr=['216332','223451','229472','226319','219324','236163','215126'];
                  if (in_array($staff_no, $staffArr))
                      {
                      //echo "Match found";
                      }
                    else
                      {
                          echo '<script type="text/javascript">alert("This staff number is not registered with TUT");</script>';
                      $erstaff_no ="This staff number is not registered with TUT";
                              $Tstaff_no=false;
                      }

                      //check staff if already regisred
                      $query="SELECT * FROM staff WHERE staff_number='$staff_no' and user_id<>'$other_user_id'";
                      $result=mysqli_query($conn,$query);
                       if(!$result){

                        echo("db access failed ".mysqli_error());
                      }else{

                        //get the number of rows of the executed query
                        $rows=mysqli_num_rows($result);         
                        if($rows>0){
                              $eruser_type ="This staff number is already registered on this system";
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
              $query="SELECT * FROM user WHERE email='$email' AND user_id<>'$other_user_id'";
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
          
      
       

         if ($Tini&&$Tsurname&&$Temail&&$Tcampus&&$Tuser_type) {
                
            $sql="UPDATE `user` SET `initials`='$ini', `lastname`='$surname', `email`='$email', `campus`='$campus' WHERE `user_id`='$other_user_id'";
            if(mysqli_query($conn,$sql))
                {

                  if ($user_type=='Student') {
                    // code...
                     $sql22="UPDATE `student` SET `student_number`='$stud_no' WHERE `user_id`='$other_user_id'";
                    if (mysqli_query($conn,$sql22)) {
                      // code...
                      
                      echo '<script type="text/javascript">alert("Student Profile Updated Succesfully"); window.location = "user_view.php";</script>';

                    }else{echo '<script type="text/javascript">alert("error! '.mysqli_error($conn).'");</script>';}
                  }elseif ($user_type=='Staff') {
                    // code...
                    //$_SESSION['photo']="";
                    $sql22="UPDATE `staff` SET `staff_number`='$staff_no' WHERE `user_id`='$other_user_id'";
                    if (mysqli_query($conn,$sql22)) {
                      // code...
                      
                      echo '<script type="text/javascript">alert("Staff Profile Updated Succesfully"); window.location = "user_view.php";</script>';

                    }else{echo '<script type="text/javascript">alert("error! '.mysqli_error($conn).'");</script>';}
                  }

                   
                }else{
                 echo("<h3>unsuccessfully not registered </h3>".mysqli_error($conn));}
                          
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
						<h4 class="page-title"><?php echo $user_type;?> Profile</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Edit <?php echo $user_type;?> Profile</div>
								</div>
								<div class="card-body">
									<div class="row">
                    <div class="col-md-6 col-lg-6">
                      <label>Picture</label>
                      <br>
                      <img src="../../<?php echo $my_photo;?>">
                    </div>
										<div class="col-md-6 col-lg-6">
											
	<form action="" method="post">
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
        
        <?php if ($user_type=="Student") {
          // code...
          ?>
          <div class="group-inputs" id="stud_no" style="">
          <label>Student Number</label>
          <input type="text" class="form-control" placeholder="Enter Student Number" name="stud_no" value="<?php echo $stud_no;?>" maxlength="9">
          <span class="error"><?php echo $eruser_type;?></span>
        </div> 
          <?php
        }else{

          ?>
        <div class="group-inputs" id="stud_no">
          <label>Staff Number</label>
          <input type="text" class="form-control" placeholder="Enter Staff Number" name="staff_no" value="<?php echo $staff_no;?>" maxlength="9">
          <span class="error"><?php echo $eruser_type;?></span>
        </div> 
          <?php

        }?>
        

        <input type="hidden" name="user_type" value="<?php echo $user_type;?>">
      
      <div class="row">
        
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Update Profile</span></button>
        </div>
        
        <div class="col-md-6">
          <a href="index.php" class="btn btn-success" style="width:100%;"><span>Back to Dashboard Page</span></a>
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