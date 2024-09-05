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
        $DBE2=mysqli_query($conn,"SELECT * from `staff_card` WHERE `card_id`='$card_id'");
        if ($DBE2) {
          # code...
          $DBE_num2=mysqli_num_rows($DBE2);
          $dddd2=mysqli_fetch_assoc($DBE2);
          $res=$dddd2['office_number'];
          
          
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
          $erres = "Office number is required";
          $Tres=false;
        } else {
          $res = test_input($_POST["res"]);
          $Tres=true;
          
        }

       

         if ($Tres) {
          $todaysate=date("Y");
          $date=date_create($todaysate);
          $mindate=date_format($date,"Y");

          $today=date("Y-m-d"); 
                
           $sql="UPDATE `staff_card` SET `office_number`='$res' WHERE `card_id`='$card_id'";
              if(mysqli_query($conn,$sql))
                  {
                    
                      echo '<script type="text/javascript">alert("You Succesfully Updated A Staff Card"); window.location = "staff_card.php";</script>';
                      
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
        

        <div class="group-inputs">
          <label>Office Number (include Building)</label>
          <input type="text" class="form-control" placeholder="Enter Office Number (10-205)" name="res" value="<?php echo $res;?>">
          <span class="error"><?php echo $erres;?></span>
        </div>
        
      
      <div class="row">
        
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Update Staff Card</span></button>
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