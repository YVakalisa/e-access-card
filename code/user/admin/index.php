<?php include 'header.php';?>


		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								
							</div>
							<!-- <div class="ml-md-auto py-2 py-md-0">
								<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
								<a href="#" class="btn btn-secondary btn-round">Add Customer</a>
							</div> -->
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">All Users:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                          $doha_num=0;
                            $doha=mysqli_query($conn,"SELECT * FROM `user` where user_type<>'Admin'");
                            if ($doha) {
                              # code...
                              $doha_num=mysqli_num_rows($doha);
                              //$dddd=mysqli_fetch_assoc($doha);
                              echo $doha_num;
                            }else{
                              echo "Error! ".mysqli_error($conn);
                            }

                        ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body" style="background-color:black;color: white;">
									<div class="card-title" style="color: white;">Students:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                        $doha_num2=0;
                          $doha2=mysqli_query($conn,"SELECT * FROM `user` where user_type='Student'");
                          if ($doha2) {
                            # code...
                            $doha_num2=mysqli_num_rows($doha2);
                            //$dddd=mysqli_fetch_assoc($doha);
                            echo $doha_num2;
                          }else{
                            echo "Error! ".mysqli_error($conn);
                          }

                      ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body" style="background-color: blue;color: white;">
									<div class="card-title" style="color: white;">Staff:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                          $doha_num3=0;
                            $doha3=mysqli_query($conn,"SELECT * FROM `user` where user_type='Staff'");
                            if ($doha3) {
                              # code...
                              $doha_num3=mysqli_num_rows($doha3);
                              //$dddd=mysqli_fetch_assoc($doha);
                              echo $doha_num3;
                            }else{
                              echo "Error! ".mysqli_error($conn);
                            }

                        ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<hr>

						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title text-center" style="background-color:purple;color: white;border-radius: 25px;">Overall Cards applied for:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                            $doha_num=0;
                              $doha=mysqli_query($conn,"SELECT * FROM `card`");
                              if ($doha) {
                                # code...
                                $doha_num=mysqli_num_rows($doha);
                                //$dddd=mysqli_fetch_assoc($doha);
                                echo $doha_num;
                              }else{
                                echo "Error! ".mysqli_error($conn);
                              }

                          ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title text-center" style="background-color:red;color: white;border-radius: 25px;">Student Cards applied for:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                            $doha_num=0;
                              $doha=mysqli_query($conn,"SELECT c.user_id, u.user_id, c.card_id, u.user_type FROM `card` as c,`user` as u WHERE c.user_id = u.user_id and u.user_type='Student'");
                              if ($doha) {
                                # code...
                                $doha_num=mysqli_num_rows($doha);
                                //$dddd=mysqli_fetch_assoc($doha);
                                echo $doha_num;
                              }else{
                                echo "Error! ".mysqli_error($conn);
                              }

                          ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title text-center" style="background-color:orange;color: white;border-radius: 25px;">Staff Cards applied for:</div>
									
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											
											<h1 class="fw-bold mt-3 mb-0"> <?php
                            $doha_num=0;
                              $doha=mysqli_query($conn,"SELECT c.user_id, u.user_id, c.card_id, u.user_type FROM `card` as c,`user` as u WHERE c.user_id = u.user_id and u.user_type='Staff'");
                              if ($doha) {
                                # code...
                                $doha_num=mysqli_num_rows($doha);
                                //$dddd=mysqli_fetch_assoc($doha);
                                echo $doha_num;
                              }else{
                                echo "Error! ".mysqli_error($conn);
                              }

                          ?></h1>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
<?php include 'footer.php';?>