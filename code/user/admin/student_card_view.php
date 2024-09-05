<?php include 'header.php';?>


		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-dark pb-2 fw-bold" >Student Card</h2>
								
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<a onclick="history.back();" class="btn btn-primary btn-round" style="color: white;"><< Back</a>
								<!-- <a href="#" class="btn btn-secondary btn-round">Add Card</a> -->
							</div> 
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-8"style="margin: auto;">
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
                      $card_id=$dddd['card_id'];
                      $user_id=$dddd['user_id'];
                      $DBE2=mysqli_query($conn,"SELECT * from `student_card` WHERE `card_id`='$card_id'");
                      if ($DBE2) {
                        # code...
                        $DBE_num2=mysqli_num_rows($DBE2);
                        $dddd2=mysqli_fetch_assoc($DBE2);

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

                        //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                      }else{
                        echo "Error! ".mysqli_error($conn);
                      }

                      //get student number

                      $DBE4=mysqli_query($conn,"SELECT * from `student` WHERE `user_id`='$user_id'");
                      if ($DBE4) {
                        # code...
                        $DBE_num4=mysqli_num_rows($DBE4);
                        $stud_res=mysqli_fetch_assoc($DBE4);

                        //echo $id_no." and ".$doha_num." and ".$dddd['citizen_id_number'];
                      }else{
                        echo "Error! ".mysqli_error($conn);
                      }
                    }else{
                      echo "Error! ".mysqli_error($conn);
                    }

                    if ($DBE_num>0) {
                    	// code...

                  ?>

							<div class="card card-white bg-white-gradient" style="background-color: white;margin: auto;">
								<div class="card-body skew-shadow">
									<img src="../../tut.png" height="150.5" alt="Visa Logo">
									<img src="../../<?php echo $dddd['QR_code'];?>" height="150.5" alt="Visa Logo" style="float: right;">
									<div class="row">
										<div class="col-8 pr-0">
											<h3 class="fw-bold mb-1">Student - <?php echo $todaysate;?></h3>
											<h3 class="fw-bold mb-1"><?php echo $user_res['initials'].' '.$user_res['lastname'];?></h3>
											<h3 class="fw-bold mb-1"><?php echo $stud_res['student_number'];?></h3>
											<div class="text-small text-uppercase fw-bold op-8"><?php echo $user_res['campus'];?></div>
											<?php 
												if ($dddd2['residence']==1) {
													// code...
													echo '<img src="res.png" height="80.5" alt="res Logo"style="padding-left: 20px;bottom:0;">';
												}

												if ($dddd2['bus']==1) {
													// code...
													echo '<img src="bus.png" height="70.5" alt="res Logo"style="padding-left: 20px;bottom:0;">';
												}
											?>
											
										</div>
										<br>
										<div class="col-4 pl-0 text-right">
											<br>
											<br>
											<div class="text-small text-uppercase fw-bold op-8">
												<div class="avatar-lm">
											     <img src="<?php echo "../../".$user_res['photo'];?>" alt="..." class="avatar-img square" style="width: 100%;">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }else{
                                	?>
                                	<div class="card full-height">
								<div class="card-body">
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0">No Student card created this year </h1>
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
<?php include 'footer.php';?>