<?php
session_start();
include '../../connector.php';
$card_id=$_GET['c'];
$sql="DELETE FROM `card` WHERE  `card_id`='$card_id'";
  if (mysqli_query($conn,$sql)) {
       # code...
       

       $sql_card="DELETE FROM `staff_card` WHERE  `card_id`='$card_id'";
       $res=mysqli_query($conn,$sql_card);
       if ($res) {
            # code...
          //$card=mysqli_insert_id($res);
       echo '<script type="text/javascript">alert("User deleted successfully");</script>';
       echo '<script>window.location ="staff_card.php"</script>';
       }else{
            echo "Error!. ".mysqli_error($conn);
       }
  }else{
       echo "Error!. ".mysqli_error($conn);
  }

?>