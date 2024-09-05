<?php  
include '../connector.php';
 $student_card_id=$_GET['s'];
 $year=$res=$bus=$campus=$studno=$pic=$qr_code="";
$sql2="SELECT * from student_card where student_card_id='$student_card_id'";
$query=mysqli_query($conn,$sql2);
$rowsn=mysqli_num_rows($query);
if ($query) {
    # code...
    while ($fac_n=mysqli_fetch_assoc($query)) {
    	$qr_code=$fac_n['QR_code'];
    	$year=$fac_n['date'];
    	$res=$fac_n['residence'];
    	$bus=$fac_n['bus'];
    	$pic=$fac_n['photo'];


    	$stud_id=$fac_n['student_id'];
    	$sql27="SELECT * from student where student_id='$stud_id'";
	$query7=mysqli_query($conn,$sql27);
	$rowsn7=mysqli_num_rows($query7);
	if ($query7) {
	    # code...
	    $fac_n7=mysqli_fetch_assoc($query7); 
	    	$campus=$fac_n7['campus'];
	    	$studno=$fac_n7['student_no'];
	    	/*$res=$fac_n7['residence'];
	    	$bus=$fac_n7['bus'];
	    	$pic=$fac_n7['photo'];*/




	    	
	    
	 }
    }
 }


       ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="width:90%;margin: auto;">
	<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 50%;"><img src="../stud_img/tut.png" alt="" width="213" height="206" /></td>
<td style="width: 50%;"><img style="float: right;" src="<?php echo $qr_code;?>" alt="" width="230" height="230" /></td>
</tr>
<tr>
<td style="width: 50%;">
<p>Student - <?php echo $year;?></p>
<p><?php echo $studno;?></p>
<p><?php echo $campus;?></p>
<table style="border-collapse: collapse; width: 101.079%; height: 109px;" border="0">
<tbody>
<tr>
<td style="width: 50%;">
<?php 
 if($res==1)
 	echo '<img src="../stud_img/res.png" alt="" width="143" height="124" />';
?>
	
</td>
<td style="width: 50%;">
<?php 
 if($bus==1)
 	echo '<img src="../stud_img/bus.png" alt="" width="161" height="83" /></td>';
?>
</tr>
</tbody>
</table>
</td>
<td style="width: 50%;"><img style="float: right;" src="<?php echo '../'.$pic;?>" alt="" width="238" height="228" /></td>
</tr>
</tbody>
</table>
</div>

</body>
</html>