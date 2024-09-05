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
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Student</a> </div>
  <h1>Student Card</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5></h5>
        </div>
        <?php
                // define variables and set to empty values
include '../phpqrcode/qrlib.php';
             
            //$sname=$ssurname=$sdob=$semail=$scellno=$sidno="";
              $img=$erimg=$bus=$erbus=$res=$erres="";
                
              $err=$ername=$ersurname=$erdob=$eremail=$ereidno=$ercellno=$erpwd=$ercpwd=$ercampus=$pwd=$cpwd=$hashp="";
              $Timg=$Tbus=$Tres=$Tname=$Tsurname=$Tdob=$Temail=$Tcellno=$Tidno=$Tpwd=$Tcpwd=false;
                
           
              if (isset($_POST['send'])) {
                 $name=$surname=$dob=$email=$cellno=$idno=$campus="";
              if ($_POST["bus"]=="") {
                $erbus = "Bus registration field is required";
                $Tbus=false;
              } else {
                $bus = test_input($_POST["bus"]);
                $Tbus=true;
              }

             
              if ($_POST["res"]=="") {
                $erres = "Residence registration field is required";
                $Tres=false;
              } else {
                $res = test_input($_POST["res"]);
                $Tres=true;
              }
               
              
              



                if (empty($_FILES['img']['name'])) {
                  $erimg = "Picture is required";
                  $Timg=false;
                } else {
                  $my_img=$_FILES['img']['name'];
                    if (move_uploaded_file($_FILES['img']['tmp_name'], '../files/' . $my_img)) {
                       $img = 'files/' . $my_img;
                       $Timg=true;
                    }else{
                      $erimg = "Failed to upload document";
                      $Timg=false;
                    }
                }

               
             
               if ($Timg&&$Tbus&&$Tres) {
                      $todaysate=date("Y");
                      $date=date_create($todaysate);
                      $mindate=date_format($date,"Y"); 

                      $sql2="SELECT * FROM `student_card` WHERE `student_id`='$id' AND `date`='$mindate'";
                      $res2=mysqli_query($conn,$sql2);
                      if($res2)
                        {
                          if (mysqli_num_rows($res2)>0) {
                            // code...
                            echo '<script type="text/javascript">alert("You already applied for student card this year."); window.location = "card.php";</script>';
                          }else{
                             $sql="INSERT INTO `student_card`(`student_id`, `photo`, `date`, `residence`, `bus`) VALUES ('$id','$img','$mindate','$res','$bus')";
                            if(mysqli_query($conn,$sql))
                                {
                                  $stud_card_no=mysqli_insert_id($conn);
                                  $path = '../qr_code/';
                                  $text = "http://demo.trevail.co.za/student/mycard.php?s=".$stud_card_no;
                        
                                  $ecc = 'L';
                                  $pixel_Size = 10;
                                  $frame_Size = 10;
                                  $file = $path.uniqid().".png";
                                  QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);
                                  //echo "<center><img src='".$file."'></center>"; 

                                  $item="UPDATE `student_card` SET `QR_code`='$file' WHERE `student_card_id`='$stud_card_no'";
                                  if (mysqli_query($conn,$item)) {
                                    // code...
                                  echo '<script type="text/javascript">alert("You Succesfully Applied For A Student Card"); window.location = "index.php";</script>';
                                }

                                    
                                    

                                    
                                }else{die("<h3>unsuccessful </h3>".mysqli_error($conn)); }
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
        <div class="widget-content nopadding">
          <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
          
            <div class="control-group">
              <label class="control-label">Picture:</label>
              <div class="controls">
                <input type="file" class="span11" value="<?php echo $img;?>" placeholder="Choose Picture" name="img" accept="image/*"/>
              <span class="error"><br><?php echo $erimg;?></span>
            </div>

            <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            
                            <select name="bus">
                             
                              <option value="">Do you have bus registration</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            
                            </select>
                            <br>
                             <span class="error"><?php echo $erbus;?></span>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            
                            <select name="res">
                             
                              <option value="">Do you have res registration</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                            
                            </select>
                            <br>
                             <span class="error"><?php echo $erres;?></span>
                        </div>
                    </div>
                </div>
            
            <div class="border-top">
                <div class="card-body">
                    <button type="Submit" class="btn btn-primary" name="send" style="width:100%;">Submit Student Card Application</button>
                    <hr>
                   <!--  <a onclick="delete_profile(<?php echo $id;?>)" class="btn btn-danger" style="width:96%;">Delete account</a> -->
                </div>
            </div>
          </form>
        </div>
      </div>

      
    </div>
</div>
    
    
  
</div></div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> &copy; 2022 </div>
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
