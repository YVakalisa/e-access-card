<?php 

    session_start();

    $verified = $_SESSION['loggedin'];

    if($verified == false){
        header("location: login.php");
    }

    $username = $_SESSION['name'];
    $email = $_SESSION['email'];
    $userid = $_SESSION['userid'];

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['userid']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container text-center" >
        <div class="row">
            <div class="col text-center">
            <h1 class="text-center">Welcome <?php echo $username;?></h1>
            <h1>Your email address is: <?php echo $email; ?> </h1>
            <h1>Your user id is: <?php echo $userid; ?></h1>
            </div>
        </div>

        
            <button class="btn btn-primary" ><a href="dashboard.php?logout"> Log out</a></button>
        
        
    </div>
    
</body>
</html>