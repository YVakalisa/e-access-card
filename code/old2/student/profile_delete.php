<?php
include '../connector.php';
$myid=$_GET['myid'];

$sql="DELETE FROM `student` WHERE  `student_id`='$myid'";
if (mysqli_query($conn,$sql)) {
  # code...
echo '<script type="text/javascript">alert("Account deleted successfully");</script>';
echo '<script>window.location ="logout.php"</script>';
}else{
  echo "Error!. ".mysqli_error($conn);
}

?>