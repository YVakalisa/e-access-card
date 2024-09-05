<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php 

include 'includes/db.php';

if(isset($_POST['regBtn'])){

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $stmt= $conn->prepare("INSERT into users (name,email,password) values(?,?,?)");
    $stmt->bind_param('sss',$name,$email,$password);

    if($stmt->execute()){
        echo 
        '<script type="text/javascript">
        jQuery(function validation(){

            swal({
            title: "Great!",
            text: "Logged in successfully!",
            icon: "success",
            button: "Ok",
        });

        });
        </script>';
    }else{
        echo "failed to insert data:".$stmt->error;
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">

        <form action="index.php" method="post" > 
            <input type="text" name="username" placeholder="username" >
            <input type="email" name="email" placeholder="email" >
            <input type="password" name="password" placeholder="password" >

            <button class="regBtn" name="regBtn" type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login in</a></p>
        </form>
    </div>
    
</body>
</html>