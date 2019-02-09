<?php 
include("session.php");
include("backtohomepage.php");?>

<div align="center" style=" margin-top: 50px;">
<form action="" method="POST">
 <p>Student Id:&nbsp;
	<input type="text" name="id" required></br>
</p>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="submit" value="Apply">

</form>

</div>










<?php

include('DBcon.php');
include("session.php");
if(isset($_POST["submit"])){
$id=$_POST["id"];

$query="SELECT *  FROM studentinfo WHERE id ='$id'";

$execute=mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($execute);


				if($execute){
?>		<div align="center">
			<p><strong>ID:</strong><?php echo $row['id'];?></p>
			<p><strong>Name:</strong><?php echo $row['fname'].$row['mname'].$row['lname'];?></p>			
			<p><strong>Gender:</strong><?php echo $row['gender'];?></p>
			<p><strong>Religion:</strong><?php echo $row['religion'];?></p>
			<p><strong>Fathers name:</strong><?php echo $row['faname'];?></p>
			<p><strong>Mothers name:</strong><?php echo $row['moname'];?></p>
			<p><strong>Date Of Birth:</strong><?php echo $row['bdate'];?></p>
			<p><strong>Address:</strong><?php echo $row['address'];?></p>
			<p><strong>Contact Info:</strong><?php echo $row['contact'];?></p>


			
<?php				
				
				}
					else{
?>
				<script type="text/javascript">
					alert("Student Removal From Database Operation Failed.\n");window.location.href='canceladmisson.php';
				</script>

<?php
					}
			

	

}

?>	











