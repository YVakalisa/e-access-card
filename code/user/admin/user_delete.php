<?php
session_start();
include '../../connector.php';
$user_id=$_GET['u'];
$sql="DELETE FROM `user` WHERE  `user_id`='$user_id'";
  if (mysqli_query($conn,$sql)) {
       # code...
       $sql_staff="DELETE FROM `staff` WHERE  `user_id`='$user_id'";
       mysqli_query($conn,$sql_staff);

       $sql_student="DELETE FROM `student` WHERE  `user_id`='$user_id'";
       mysqli_query($conn,$sql_student);
       
       $sql2="SELECT * FROM card WHERE `user_id`='$user_id'";
        $query=mysqli_query($conn,$sql2);
        $rowsn=mysqli_fetch_assoc($query);
        $card_id=$rowsn['card_id'];
       
        $sql_student_card="DELETE FROM `student_card` WHERE  `card_id`='$card_id'";
       mysqli_query($conn,$sql_student_card); 
       
       $sql_staff_card="DELETE FROM `staff_card` WHERE  `card_id`='$card_id'";
       mysqli_query($conn,$sql_staff_card);

       $sql_card="DELETE FROM `card` WHERE  `user_id`='$user_id'";
       $res=mysqli_query($conn,$sql_card);
       if ($res) {
            # code...
         // $card=mysqli_insert_id($res);
       echo '<script type="text/javascript">alert("User deleted successfully");</script>';
       echo '<script>window.location ="user_view.php"</script>';
       }else{
            echo "Error!. ".mysqli_error($conn);
       }
  }else{
       echo "Error!. ".mysqli_error($conn);
  }

?>