<html>
<head></head>
<body>

<?php

$con=mysqli_connect("localhost:3306","root","","users");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
error_reporting(0);

?>

	  
	 
	  <a href="index.php?student_add=new"><button>Add User</button></a>
	  <a href="index.php?show_list=all"><button>Show List</button></a>
	  <form action='index.php' method='get'>
	  <input type='text' name='searchid' onfocus="this.value=''" value='Type Students ID'>
	  <input type='submit' value='Edit Student'>
	  </form>

	  <?php 
	

    $result=mysqli_query($con,'SELECT * FROM student WHERE id='.$_GET['searchid']);
	$st=mysqli_fetch_array($result);
?>	
	<?php if($_GET['student_add']){ ?>
     <form action='index.php' method='post'><table>
     <tr><td> First Name:</td> <td><input type='text' name='name'/></td></tr>
	 <tr> <td>Last Name:</td><td> <input type='text' name='lastname'/></td></tr>
	 <tr><td> Gender:</td><td> <input type='radio' name='gender' value='M' />Male
	 <input type='radio' name='gender' value='F' />Female</td></tr>
	 <tr><td> Faculty:</td><td> <input type='text' name='faculty' /></td></tr>
	<tr><td>Phone Number: </td><td><input type='text' name='phone' /></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' name='submit' value='Add Student'></td></tr>
	 </table></form>
	 <?php  } ?>
	<?php if($_GET['searchid']){ ?>
    
    <form action='index.php' method='post'><table>
	  <tr><td> ID:</td> <td><input type='text' name='editid' readonly value=<?php print($st['id']);?> ></td></tr>
     <tr><td> First Name:</td> <td><input type='text' name='name' value=<?php print($st['name']);?> ></td></tr>
	 <tr> <td>Last Name:</td><td> <input type='text' name='lastname' value=<?php print($st['lastname']);?>  ></td></tr>
	 <tr><td> Gender:</td><td> <input type='radio' name='gender' value='M' checked=<?php if($st['gender']=='M'){echo 'checked';}?> >Male
	 <input type='radio' name='gender' value='F' <?php if($st['gender']=='F'){echo 'checked';}?> />Female</td></tr>
	 <tr><td> Faculty:</td><td> <input type='text' name='faculty'value=<?php print($st['faculty']);?> ></td></tr>
	 <tr><td>Phone Number: </td><td><input type='text' name='phone' value=<?php print($st['phone_num']);?>></td></tr>
	 <tr><td colspan='2' align='center'><input type='submit' name='editsubmit' value='Update Info'></td></tr>
	 </table></form>	
	<?php }
	if($_POST['editsubmit']){
	
	mysqli_query($con, "UPDATE student SET name='".$_POST['name']."', lastname='".$_POST['lastname']."', gender='".$_POST['gender']."', faculty='".$_POST['faculty']."', phone_num='".$_POST['phone']."'  WHERE id='".$_POST['editid']."'");
	
     }
	?>
	
	 
    
	
	 	


	  
	 
	  
<?php 
if($_POST['submit']){
$query="INSERT INTO student SET name='".$_POST['name']."', lastname='".$_POST['lastname']."', gender='".$_POST['gender']."', faculty='".$_POST['faculty']."', phone_num='".$_POST['phone']."'";

if(isset($_POST['name'], $_POST['lastname'], $_POST['phone'], $_POST['faculty']))
{
mysqli_query($con,"INSERT INTO student SET name='".$_POST['name']."', lastname='".$_POST['lastname']."', gender='".$_POST['gender']."', faculty='".$_POST['faculty']."', phone_num='".$_POST['phone']."'");
echo 'Student Was Succesfuly Added';

}
else
{
echo 'All Fields Are Required';
}
}
?>
<?php
if($_GET['show_list']){
$result=mysqli_query($con, 'select * from student');

echo "<table border='1'>
<tr><td>ID</td><td>Name</td><td>Lastname</td><td>Gender</td><td>Faculty</td><td>Phone Number</td></tr>";

while($row=mysqli_fetch_array($result)){ 
echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['name']."</td>";
echo "<td>".$row['lastname']."</td>";
echo "<td>".$row['gender']."</td>";
echo "<td>".$row['faculty']."</td>";
echo "<td>".$row['phone_num']."</td>";


echo "</tr>";
	
}
}
?>
</table>



	  
</body>
</html>
