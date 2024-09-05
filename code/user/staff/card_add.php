<?php include "header.php";
ini_set('display_errors','On');
error_reporting(E_ALL);
include '../phpqrcode/qrlib.php';
     $res=$erres=$bus=$erbus=$ernew_pic=$new_pic="";
        $Tbus=$Tres=$Tnew_pic=false;
     $Ores=$Obus=0;
     
        if (isset($_POST['register'])) {
        
         if (empty($_POST["res"])) {
          $erres = "Office number is required";
          $Tres=false;
        } else {
          $res = test_input($_POST["res"]);
          $Tres=true;
          
        }
          
        if (!isset($_SESSION['new_pic'])) {
          $ernew_pic = "Picture is required";
          $Tnew_pic=false;
        } else {
          $new_pic = test_input($_SESSION['new_pic']);
          $Tnew_pic=true;

          
          require('../vendor/cloudmersive/cloudmersive_imagerecognition_api_client/vendor/autoload.php');
          // Configure API key authorization: Apikey
          $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', '688370a7-d795-4c24-9921-9a14fbbcf03f');
          // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
          // $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Apikey', 'Bearer');

          $apiInstance = new Swagger\Client\Api\FaceApi(
              // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
              // This is optional, `GuzzleHttp\Client` will be used as default.
              new GuzzleHttp\Client(),
              $config
          );
          $input_image = '../../'.$new_pic; // \SplFileObject | Image file to perform the operation on; this image can contain one or more faces which will be matched against face provided in the second image.  Common file formats such as PNG, JPEG are supported.
          $match_face = '../../'.$_SESSION['p_pic']; // \SplFileObject | Image of a single face to compare and match against.

          try {
               $result = $apiInstance->faceCompare($input_image, $match_face);
              //print_r($result);
              $re = print_r($result, true);
              //echo($re);
              if (getmatch_score($re)<86) {
                // code...
                $ernew_pic = "face does not match, try new angel/ area with sufficient lighting";
                $Tnew_pic=false;
              }else{
                $ernew_pic = "Face match ";
              }
              if(getface_count($re)==0){
                $ernew_pic = "No faces detected on the picture";
                $Tnew_pic=false;
              }elseif (getface_count($re)>1) {
                // code...
                $ernew_pic = "Many faces detected on the picture";
                $Tnew_pic=false;
              }

          } catch (Exception $e) {
              echo 'Exception when calling FaceApi->faceCompare: ', $e->getMessage(), PHP_EOL;
          }
          $apiInstance = new Swagger\Client\Api\FaceApi(
              // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
              // This is optional, `GuzzleHttp\Client` will be used as default.
              new GuzzleHttp\Client(),
              $config
          );

        } 

         if ($Tres&&$Tnew_pic) {
          $todaysate=date("Y");
          $date=date_create($todaysate);
          $mindate=date_format($date,"Y");

          $today=date("Y-m-d"); 
                
           $sql2="SELECT `card_id`,`user_id`, DATE_FORMAT(`issue_date`, '%Y') as date FROM `card` WHERE DATE_FORMAT(`issue_date`, '%Y')='$mindate' AND `user_id`='$id'";
            $res2=mysqli_query($conn,$sql2);
            if($res2)
              {
                if (mysqli_num_rows($res2)>0) {
                  // code...
                  echo '<script type="text/javascript">alert("You already applied for student card this year."); window.location = "card_view.php";</script>';
                }else{
                   $sql="INSERT INTO `card`(`user_id`, `issue_date`) VALUES ('$id','$today')";
                  if(mysqli_query($conn,$sql))
                      {
                        $card_id=mysqli_insert_id($conn);
                        $path = 'qr_code/';
                        $text = "http://demo.trevail.co.za/user/mycard.php?s=".$card_id;
              
                        $ecc = 'L';
                        $pixel_Size = 10;
                        $frame_Size = 10;
                        $file = $path.uniqid().".png";
                        QRcode::png($text, '../../'.$file, $ecc, $pixel_Size, $frame_Size);
                        //echo "<center><img src='".$file."'></center>"; 

                        $item="UPDATE `card` SET `QR_code`='$file' WHERE `card_id`='$card_id'";
                        if (mysqli_query($conn,$item)) {
                          // code...

                          $item2="INSERT INTO `staff_card`(`card_id`, `office_number`) VALUES ('$card_id','$res')";
                          if (mysqli_query($conn,$item2)) {
                            // code...
                            $_SESSION['p_pic']=$new_pic;
                          include '../../mail.php';
                          $to=$email;
                          $from="eaccesscard@gmail.com";
                          $subject="Staff card";
                          $cmessage="Dear ".$ini." ".$surname."<br><br>";
                          $cmessage.="You have succefully created your staff card on the e-access card System .<br> You cant now login.  <a href='".$text."'>Click to view your student card</a> <br><br>Kind Regard<br>e-access card System Team";
                          send_email($to,$from,$subject,$cmessage);
                          echo '<script type="text/javascript">alert("You Succesfully Applied For A Staff Card"); window.location = "index.php";</script>';
                          }
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
						<h4 class="page-title">Staff Card</h4>
						
					</div>
					<div class="row">
						<div class="col-md-6" style="margin:auto;">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Add Staff Card</div>
								</div>
								<div class="card-body" style="margin:auto;">
									<div class="row" style="margin:auto;">
<form action="" method="post" enctype="multipart/form-data">
						<div class="col-md-12 col-lg-12" style="margin:auto;">
											
	
        <div class="group-inputs">
        
        <div class="group-inputs">
          <label>Office Number (include Building)</label>
          <input type="text" class="form-control" placeholder="Enter Office Number (10-205)" name="res" value="<?php echo $res;?>">
          <span class="error"><?php echo $erres;?></span>
        </div>

        <div class="form-group mb-4" style="margin: auto;">
          <label>Take Picture</label>
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
          <span class="error"><?php echo $ernew_pic;?></span>
            
      <div class="row">
        
        <div class="col-md-6">
           <label>Current Picture</label>
          <img src="../../<?php echo $_SESSION['p_pic'];?>"  style="width: 100%;">
        </div>
        
        <div class="col-md-6">
           <label>New Picture</label>
          <div id="results"  style="margin: auto;">
              <?php if(isset($_SESSION['new_pic'])){
              echo "<img src='../../".$_SESSION['new_pic']."' id=old_img style='width: 100%;'>";
            }else{
              echo "<img src='../ZZ5H.gif' id=old_img style='width: 70%;'>";
            }?>
             
             
            </div>
        </div>
      </div>
            <br>
            <input type=button value="Save Snapshot" onClick="saveSnap()" id="save" style="width:100%;display: block;">
          </div>
          
        </div>
                    
                    </div>
      
      <div class="row">
        
        <div class="col-md-6">
          <button type="submit" class="btn btn-primary" name="register" style="width:100%;"><span>Creat New Card</span></button>
        </div>
        
        <div class="col-md-6">
          <a href="index.php" class="btn btn-success" style="width:100%;"><span>Back to Dashboard </span></a>
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

       Webcam.upload( base64image, '../upload2.php', function(code, text) {
         //alert('Save successfully');
         //window.location="index.php";
         console.log(text);
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