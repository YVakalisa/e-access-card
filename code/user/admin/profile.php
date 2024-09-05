<?php include "header.php";

     $erini=$ersurname=$eremail=$ercampus=$eruser_type=$erstud_no=$ermy_photo="";
        $Tini=$Tsurname=$Temail=$Tcampus=$Tuser_type=$Tstaff_no=$Tstud_no=$Tpwd=$Tcpwd=$Tmy_photo=false;
        
     
        if (isset($_POST['register'])) {
           $ini=$surname=$email=$campus=$user_type=$stud_no=$my_photo=$cell_no=$ercell_no="";
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
        
        if (empty($_POST["cell_no"])) {
            //echo '<script type="text/javascript">alert("Phone number is required");</script>';
              $ercell_no = "Phone number is required";
              $Tcell_no=false;
            } else {
              $cell_no = test_input($_POST["cell_no"],$conn);
              $Tcell_no=true;
              // check if name only contains letters and whitespace
              if (!preg_match("/^[0-9]*$/",$cell_no)) {
                  //echo '<script type="text/javascript">alert("Only digits allowed for Phone number");</script>';
                $ercell_no = "Only numbers allowed"; 
                
                $Tcell_no=false;
              }else{
                  if(strlen($cell_no)!=10){
                      //echo '<script type="text/javascript">alert("Phone number must be 10 digits");</script>';
                      $ercell_no = "Phone number must be 10 digits";
                      
                      $Tcell_no=false;

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
              $query="SELECT * FROM user WHERE email='$email' AND user_id<>'$id'";
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
          
      
       

         if ($Tini&&$Tsurname&&$Temail&&$Tcampus&&$Tcell_no) {
                
            $sql="UPDATE `user` SET `initials`='$ini', `lastname`='$surname', `email`='$email', `campus`='$campus' WHERE `user_id`='$id'";
            if(mysqli_query($conn,$sql))
                {
                     $sql22="UPDATE `admin` SET `phone_number`='$cell_no' WHERE `user_id`='$id'";
                    if (mysqli_query($conn,$sql22)) {
                      // code...
                        
            		$_SESSION['email']=$email;
                  $_SESSION['ini']=$ini;
                  $_SESSION['surname']=$surname;
                  $_SESSION['campus']=$campus;
                  $_SESSION['cell_no']=$cell_no;

                echo '<script type="text/javascript">alert("Profile Updated Succesfully"); window.location = "index.php";</script>';

                    }else{echo '<script type="text/javascript">alert("Missing '.mysqli_error($conn).'");</script>';}

                  
                  
                     
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
						<h4 class="page-title">Profile</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Edit Profile</div>
								</div>
								<div class="card-body">
									<div class="row">
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
        <div class="group-inputs" id="cell_no">
          <label>Phone Number</label>
          <input type="text" class="form-control" placeholder="Enter Phone Number" name="cell_no" value="<?php echo $cell_no;?>" maxlength="10">
          <span class="error"><?php echo $ercell_no;?></span>
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
        
        <!-- <div class="group-inputs" id="stud_no">
          <label>Staff Number</label>
          <input type="text" class="form-control" placeholder="Enter Student Number" name="stud_no" value="<?php echo $stud_no;?>" maxlength="9">
          <span class="error"><?php echo $erstud_no;?></span>
        </div> -->
      
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
	
	<div class="col-md-6 col-lg-6">
		<div class="form-group mb-4" style="margin: auto;">
          <label>Update Picture</label>
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
          <!-- <input type=button value="Save Snapshot" onClick="saveSnap()" id="save" style="width:100%;display: block;"> -->

          <div class="invisible" hidden>
            <video id="video" class="hidden" style="width: 320px;height: 240px;margin: auto;" >Your browser does not support the video tag.</video>
          </div>
          <span class="error"><?php echo $ermy_photo;?></span>
            <div id="results"  style="margin: auto;">
              <?php 
              if (isset($_SESSION['p_pic'])&&$_SESSION['p_pic']!="") {
                // code...
                echo '<img src=../../'.$_SESSION['p_pic'].' id=old_img style="width: 100%;">';
              }
            ?>
            </div>
            
            <input type=button value="Save Snapshot" onClick="saveSnap()" id="save" style="width:100%;display: block;">
          </div>
          
        </div>
										
										</div>
									</div>
								</div>
							
							</div>
						</div>
					</div>
				</div>
			</div>
<script type="text/javascript" src="../../webcamjs/webcam.min.js"></script>

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

       Webcam.upload( base64image, '../upload.php', function(code, text) {
         alert('Save successfully');
         window.location="index.php";
         //console.log(text);
            });

    }
  </script>

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
<?php include "footer.php";?>