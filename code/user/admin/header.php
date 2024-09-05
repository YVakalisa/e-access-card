<?php
SESSION_START();
include '../../connector.php';
//include '../../api_connecter.php';
$id=$ini=$surname=$email=$cell_no=$p_pic=$campus=$user_type="";

if (isset($_SESSION['id'])) {
	# code...

$email=$_SESSION['email'];
$id=$_SESSION['id'];
$ini=$_SESSION['ini'];
$surname=$_SESSION['surname'];
//$student_no=$_SESSION['student_no'];
$p_pic=$_SESSION['p_pic'];
$campus=$_SESSION['campus'];
$user_type=$_SESSION['user_type'];

	$query="SELECT * FROM admin WHERE user_id='$id'";
	$result=mysqli_query($conn,$query);

	if(!$result)
	{
	  $err="unable to connect to database";
	   mysqli_error($conn);
	}else{
		$rows=mysqli_fetch_assoc($result);
	   $cell_no=$_SESSION['cell_no']=$rows['phone_number'];
	   //echo '<script> alert("staff = '.$stud_no.'");</script>';
	   //echo '<script> alert("id= '.$id.'");</script>';
	}

	//update pic
	if (isset($_SESSION['photo']) && $_SESSION['photo']!=$_SESSION['p_pic']) {
		// code...
		$my_pic=$_SESSION['photo']; 
	    $sql_pic="UPDATE  user SET photo='$my_pic' WHERE user_id='$id'";
	    if (mysqli_query($conn,$sql_pic)) {
	        // code...
	       
	       $_SESSION['p_pic']=$_SESSION['photo']; 

	    }
	}

}else{
	 echo '<script> window.location = "login.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>e&mdash;access Card</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
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
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.php" class="logo" style="color: white;">
					<!-- <img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> -->
					e&mdash;access Card
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue" style="background-color:black;">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<!-- <form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form> -->
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?php echo "../../".$p_pic;?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?php echo "../../".$p_pic;?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $ini.' '.$surname;?></h4>
												<!-- <p class="text-muted"><?php echo $email;?></p> --><a href="profile.php" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="password.php">Change Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../logout.php">Sign Out</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo "../../".$p_pic;?>" alt="..." class="avatar-img rounded-circle">
						</div>
						

						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $ini.' '.$surname;?>
									<span class="user-level">Admin</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									
									<li>
										<a href="profile.php">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="password.php">
											<span class="link-collapse">Change Password</span>
										</a>
									</li>
									<li>
										<a href="../logout.php">
											<span class="link-collapse">Sign Out</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href=index.php>
								<i class="fas fa-home"></i>
								<p>Dashboard </p>
								
							</a>
						</li>
						
						<li class="nav-item">
							<a href=user_view.php>
								<i class="fas fa-users"></i>
								<p>Users </p>
								
							</a>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Access Card</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="student_card.php">
											<span class="sub-item">Student Card</span>
										</a>
									</li>
									<li>
										<a href="staff_card.php">
											<span class="sub-item">Staff Card</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#base2">
								<i class="fas fa-file"></i>
								<p>Reports</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base2">
								<ul class="nav nav-collapse">
									<li>
										<a href="user_report.php">
											<span class="sub-item">User report</span>
										</a>
									</li>
									<li>
										<a href="student_card_report.php">
											<span class="sub-item">Student Card report</span>
										</a>
									</li>
									<li>
										<a href="staff_card_report.php">
											<span class="sub-item">Staff Card report</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						
						<li class="mx-4 mt-2">
							<a href="../logout.php" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-sign-out"></i> </span>Sign Out</a> 
						</li>
					</ul>
				</div>
			</div>
		</div>