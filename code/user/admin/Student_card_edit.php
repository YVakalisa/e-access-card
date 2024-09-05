<?php include "header.php";
include '../phpqrcode/qrlib.php';

     $erres=$erbus=$ernew_pic="";
        $Tbus=$Tres=$Tnew_pic=false;
     $Ores=$Obus=0;
     $card_id=$_GET['s'];
     $DBE=mysqli_query($conn,"SELECT * FROM `card` WHERE `card_id`='$card_id'");
      if ($DBE){
        $DBE_num=mysqli_num_rows($DBE);
        $dddd=mysqli_fetch_assoc($DBE);
        $user_id=$dddd['user_id'];
        $DBE2=mysqli_query($conn,"SELECT * from `student_card` WHERE `card_id`='$card_id'");
        if ($DBE2) {
          # code...
          $DBE_num2=mysqli_num_rows($DBE2);
          $dddd2=mysqli_fetch_assoc($DBE2);
          $bus=$res="No";
          if ($dddd2['residence']==1) {
            // code...
            $res="Yes";
          }

          if ($dddd2['bus']==1) {
            // code...
           $bus="Yes";
          }
          
          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
        }else{
          echo "Error! ".mysqli_error($conn);
        }

        //get user

        $DBE3=mysqli_query($conn,"SELECT * from `user` WHERE `user_id`='$user_id'");
        if ($DBE3) {
          # code...
          $DBE_num3=mysqli_num_rows($DBE3);
          $user_res=mysqli_fetch_assoc($DBE3);
          $new_pic=$user_res['photo'];
          $Student=$user_res['initials'].' '.$user_res['lastname'];

          //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
        }else{
          echo "Error! ".mysqli_error($conn);
        }
      }

        if (isset($_POST['register'])) {
        $bus=$res="";
         if (empty($_POST["res"])) {
          $erres = "Residence field is required";
          $Tres=false;
        } else {
          $res = test_input($_POST["res"]);
          $Tres=true;
          if ($res=="Yes") {
            // code...
            $Ores=1;
          }
          }
          
      if (empty($_POST["bus"])) {
          $erbus = "Bus field is required";
          $Tbus=false;
        } else {
          $bus = test_input($_POST["bus"]);
          $Tbus=true;
          if ($bus=="Yes") {
            // code...
            $Obus=1;
          }

        }

       

         if ($Tbus&&$Tres) {
          $todaysate=date("Y");
          $date=date_create($todaysate);
          $mindate=date_format($date,"Y");

          $today=date("Y-m-d"); 
                
           $sql="UPDATE `student_card` SET `residence`='$Ores', `bus` ='$Obus' WHERE `card_id`='$card_id'";
              if(mysqli_query($conn,$sql))
                  {
                    

                    
                      echo '<script type="text/javascript">alert("You Succesfully Updated A Student Card"); window.location = "student_card.php";</script>';
                      
                 
                      
                  }else{die("<h3>unsuccessful </h3>".mysqli_error($conn)); }

                    
                          
            }
      }
      
    



      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      function getmatch_score($str2)
      {
          $str_start2 = strpos($str2, "match_score");
          $temp_str2=substr($str2, $str_start2);
          $str_end2=strpos($temp_str2, ")");
          $match_score=floatval(substr($temp_str2,16,$str_end2-17))*100;
          return $match_score;
      }

      function getface_count($str2)
      {
          $str_start2 = strpos($str2, "face_count");
          $temp_str2=substr($str2, $str_start2);
          $str_end2=strpos($temp_str2, "[");
          $face_count=number_format(intval(substr($temp_str2,14,$str_end2-15)));
          return $face_count;
      }

     
?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Student Card</h4>
						
					</div>
					<div class="row">
						<div class="col-md-6" style="margin:auto;">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Edit Student Card</div>
								</div>
								<div class="card-body" style="margin:auto;">
									<div class="row" style="margin:auto;">
                    
                    
<form action="" method="post" enctype="multipart/form-data">
		<div class="col-md-12 col-lg-12" style="margin:auto;width: 100%;">
			<div class="group-inputs">
        <div class="form-group">
          <h3 class="fw-bold mb-1">Student: <?php echo $Student;?></h3>
          <img src="<?php echo "../../".$new_pic;?>" alt="..." class="avatar-img square" height="100.5">
        </div>
      </div>						
	
        <div class="group-inputs">
        <div class="form-group">
          <label>Do you have school residence access?</label>
          <select name="res" class="form-control">
              <?php 
                if (empty($res)) {
                  // code...
                  //echo "<option value=''>Choose Campus</option>";
                }else{
                  echo "<option value='".$res."'>".$res."</option>";
                }
              ?>
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
            <span class="error"><?php echo $erres;?></span>
        </div>
        
        <div class="form-group" style="padding: 5px;">
          <label>Do you have school bus access?</label>
          <p ><input type="radio"  value="Yes" name="bus" <?php if($bus=='Yes')echo 'checked';?>>Yes
          <input type="radio"  value="No" name="bus" <?php if($bus=='No')echo 'checked';?>>No
       
          
          <span class="error"><?php echo $erbus;?></span>
        </div>
      
      <div class="row">
        
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Update Student Card</span></button>
        </div>
        <hr>
        <div class="col-md-12">
          <a onclick="history.back();" class="btn btn-success" style="width:100%;"><span><< Back</span></a>
        </div>
      </div>

      
      
	</div>
	

    </form>
								</div>
							
							</div>
						</div>
					</div>
				</div>
			</div>

<?php include "footer.php";?>