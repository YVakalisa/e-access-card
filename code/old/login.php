<?php
    include 'includes/db.php';
    session_start();

    if(isset($_POST['logBtn'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);


        $stmt = $conn->prepare("SELECT * from student WHERE email = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss",$email,$password);
        


        // Fetch a record. Bind the result to a variable called 'value' and fetch. 
        if($stmt->execute()){
            $stmt->bind_result($id,$firstName,$lastName,$studentNo,$email,$password,$specialization);
            $stmt->store_result();//
            /* store the result in an internal buffer */
            /* Store the result (to get properties) */

            if($stmt->num_rows() == 1){
                $stmt->fetch();//in general fetch function is for getting current row from result set you receive from database
                header('location:dashboard.php');
                $_SESSION['loggedin'] = true;
                $_SESSION['userid'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
            }else{
                echo $name;
                //echo $email;
                echo $password;
                echo "Incorrect Password".$stmt->error;
            }
            
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">

        <form action="login.php" method="post"> 
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="password" required>

            <button class="regBtn" name="logBtn" type="submit">Log in</button>
            <p>Are you new here? <a href="index.php">Register</a></p>
        </form>
    </div>
    
</body>
</html>