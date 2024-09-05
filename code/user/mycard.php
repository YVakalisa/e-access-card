<?php
include '../connector.php';

$id=$ini=$surname=$email=$stud_no=$p_pic=$campus=$user_type="";

if (isset($_GET['s'])) {
	# code...

}else{
	 //echo '<script> window.location = "../index.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>e&mdash;access Card</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<style>
		.error{
  color: red;
  text-align: center;
  align-content: center;
  justify-content: center;
  align-self: center;
}
	</style>
</head>
<body >
	
			
		<div class="main-panel" style="width:100%;margin: auto;">
			<div class="content">
				<br>
								<br>
								<br>
				
				<div class="page-inner mt--5" style="width:100%;margin: auto;">
					<div class="row mt--2" style="margin: auto;">
						<div class="col-md-12" style="margin: auto;">
							<?php
                    $DBE_num=0;
                    $todaysate=date("Y");
					          $date=date_create($todaysate);
					          $mindate=date_format($date,"Y");
					          $dddd2;
					          $dddd;
					          $today=date("Y-m-d"); 
					        $card_id=$_GET['s'];
                  $DBE=mysqli_query($conn,"SELECT `card_id`,`user_id`,`QR_code`, DATE_FORMAT(`issue_date`, '%Y') as date FROM `card` WHERE DATE_FORMAT(`issue_date`, '%Y')='$mindate' AND `card_id`='$card_id'");
                  if ($DBE) {
                    # code...
                    $DBE_num=mysqli_num_rows($DBE);
                    $dddd=mysqli_fetch_assoc($DBE);
                    //echo $dddd['QR_code'];
                    $getuser_id=$dddd['user_id'];

                     $DBE3=mysqli_query($conn,"SELECT * from `user` WHERE `user_id`='$getuser_id'");
                      if ($DBE3) {
                        # code...
                        $DBE_num3=mysqli_num_rows($DBE3);
                        $user_res=mysqli_fetch_assoc($DBE3);

                        //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                      }else{
                        echo "Error! ".mysqli_error($conn);
                      }
                    if ($user_res['user_type']=="Student") {
                    	// code...
                    	$DBE2=mysqli_query($conn,"SELECT * from `student_card` WHERE `card_id`='$card_id'");
	                    if ($DBE2) {
	                      # code...
	                      $DBE_num2=mysqli_num_rows($DBE2);
	                      $dddd2=mysqli_fetch_assoc($DBE2);

	                      //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
	                    }else{
	                      echo "Error! ".mysqli_error($conn);
	                    }

	                    $DBE4=mysqli_query($conn,"SELECT * from `student` WHERE `user_id`='$getuser_id'");
                      if ($DBE4) {
                        # code...
                        $DBE_num4=mysqli_num_rows($DBE4);
                        $stud_res=mysqli_fetch_assoc($DBE4);

                        //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                      }else{
                        echo "Error! ".mysqli_error($conn);
                      }
                    }else if($user_res['user_type']=="Staff"){
                    	$DBE2=mysqli_query($conn,"SELECT * from `staff_card` WHERE `card_id`='$card_id'");
	                    if ($DBE2) {
	                      # code...
	                      $DBE_num2=mysqli_num_rows($DBE2);
	                      $dddd2=mysqli_fetch_assoc($DBE2);

	                      //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
	                    }else{
	                      echo "Error! ".mysqli_error($conn);
	                    }

	                    $DBE4=mysqli_query($conn,"SELECT * from `staff` WHERE `user_id`='$getuser_id'");
                      if ($DBE4) {
                        # code...
                        $DBE_num4=mysqli_num_rows($DBE4);
                        $stud_res=mysqli_fetch_assoc($DBE4);

                        //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                      }else{
                        echo "Error! ".mysqli_error($conn);
                      }

                    }
                    
                    //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                  }else{
                    echo "Error! ".mysqli_error($conn);
                    //echo '<script>alert("User not found in our system"); window.location = "../index.php";</script>';
                  }

                  if ($DBE_num>0&&$user_res['user_type']=="Student") {
                  	// code...

                ?>

                <br>
								<br>
								<br>

							<div class="card card-white bg-white-gradient" style="background-color: white;">
								<div class="card-body skew-shadow">
									<div class="row">
												<div class="col-6">
													<img src="../tut.png" alt="tut Logo" style="width: 60%;">
												</div>
												<div class="col-6">
													<img src="../<?php echo $dddd['QR_code'];?>"  alt="Visa Logo" style="float: right;width: 60%;">
												</div>
												
											</div>
									<div class="row">
										<div class="col-6 pr-0">
											<p class="mb-0" >Student - <?php echo $todaysate;?></p>
											<p class="mb-0"><?php echo $user_res['initials'].' '.$user_res['lastname'];?></p>
											<p class="mb-0"><?php echo $stud_res['student_number'];?></p>
											<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_res['campus'];?></div>
											<?php 
												if ($dddd2['residence']==1) {
													// code...
													echo '<img src="student/res.png" alt="res Logo"style="padding-left: 20px;width: 30%;">';
												}

												if ($dddd2['bus']==1) {
													// code...
													echo '<img src="student/bus.png" alt="res Logo"style="padding-left: 20px;width: 30%;">';
												}
											?>
											
										</div>
										<br>
										<div class="col-6 pl-0 text-right">
													
													<br>
													<br>
											<div class="text-small text-uppercase fw-bold op-8">
												<div class="avatar-lm">
											     <img src="<?php echo "../".$user_res['photo'];?>" alt="..." class="avatar-img square" style="width: 100%;">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }else if($DBE_num>0&&$user_res['user_type']=="Staff"){

								?>
								<br>
								<br>
								<br>
								<div class="card card-white bg-white-gradient" style="background-color: white;margin: auto;">
										<div class="card-body skew-shadow" >
											<div class="row">
												<div class="col-6">
													<img src="../tut.png" alt="tut Logo" style="width: 60%;">
												</div>
												<div class="col-6">
													<img src="../<?php echo $dddd['QR_code'];?>"  alt="Visa Logo" style="float: right;width: 60%;">
												</div>
												
											</div>

											<div class="row">
												
												<div class="col-6 pr-0">
													<br>
														<small>
															
														<p class="mb-0">Staff - <?php echo $todaysate;?></p>
														<p class="mb-0"><?php echo $user_res['initials'].' '.$user_res['lastname'];?></p>
														<p class="mb-0"><?php echo $stud_res['staff_number'];?></p>
														<p class="mb-0" >Office: <?php echo $dddd2['office_number'];?></p>
														<div class="mb-0"><?php echo $user_res['campus'];?></div></small>
												
												</div>
												<div class="col-6">
													<br>	
													<br>
												
													<div class="avatar-lm" style="width: 100%;">
													     <img src="<?php echo "../".$user_res['photo'];?>" alt="..." class="avatar-img square" style="width: 100%;float: right;bottom: 0;margin-bottom: 0;">
														</div>
												</div>
												
											</div>
											
											
											
										</div>
									</div>
								<?php
							}else{
                                	?>
                                	<div class="card full-height">
								<div class="card-body">
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0">No card created this year </h1>
										</div>
										
									</div>
								</div>
							</div>
                                	<?php
                                }
                              ?>
						</div>
						
					</div>
					
				</div>
			
		
		
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<!-- <script src="../assets/js/setting-demo.js"></script>
	<script src="../assets/js/demo.js"></script> -->
	<script>
		Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>