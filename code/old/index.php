<?php 

include 'includes/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    
 <?php

$name = "";

if(isset($_POST['regBtn'])){

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $studentNo = $_POST['studno'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confPassword = md5($_POST['confPassword']);
    $specialization = $_POST['specialization'];

    $stmt = $conn->prepare("SELECT count(*) FROM student where email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt->bind_result($num_rows);
    $stmt->store_result();
    $stmt->fetch();
    
    
    if($num_rows !=0){
        header("location: index.php?error=user email: ".$email." already exists");
    }else if($password == $confPassword){
        $stmt2= $conn->prepare("INSERT into student (firstName,lastName,studentNo,email,password,specialization) values(?,?,?,?,?,?)");
        $stmt2->bind_param('ssisss',$firstName,$lastName,$studentNo,$email,$password,$specialization);

        if($stmt2->execute()){
            
            echo 
            '<script type="text/javascript">
            jQuery(function validation(){
    
                swal({
                title: "Great!",
                text: "Registered successfully!",
                icon: "success",
                button: "Ok",
            });
    
            });
            </script>';
            //header("Location: login.php");
        }else{
            echo "failed to insert data:".$stmt2->error;
        }
    }else{
        header("Location: index.php?error=Passwords Do Not Match");
    }
}
?>


<?php if(isset($_GET['error'])){?>
            <div class="loginErr"><?php echo $_GET['error'];?></div>
        <?php }  ?>
    
        
    <div class="container">
        <form class="form" action="index.php?" method="post" > 


            <input type="text" name="firstname" value="<?php echo $name;?>" placeholder="First Name" required>
            <input type="text" name="lastname" value="<?php echo $name;?>" placeholder="Last Name" required>
            <input type="number" name="studno" value="<?php echo $name;?>" placeholder="Student Number" required>
            <input type="email" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="password" required >
            <input type="password" name="confPassword" placeholder=" confirm password" >
            <select style="width:300px; margin-left:405px;background-color: rgba(252, 252, 252, 0.2);" class="form-control" name="specialization" required>
                <option value="" disabled selected>Select A Specialization</option>
                <option value="Software Development">Software Development</option>
                <option value="IIS">IIS</option>
                <option value="Networking">Networking</option>
                <option value="Multimedia">Multimedia</option>
            </select>
            <button class="regBtn" name="regBtn" type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login in</a></p>
        </form>
    </div>
    
</body>
</html>