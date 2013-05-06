<html>
<head></head>
<body>

<?php

$con=mysqli_connect("localhost:3306","root","","users");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>

	  
	 
	  <a href="index.php?student_add=new"><button>Add User</button></a>
	  <a href="index.php?show_list=all"><button>Show List</button></a>
	  <a href="index.php?Delete=all"><button>Delete All Students</button></a>
	  <form action='index.php' method='get'>
	  <input type='text' name='searchid' value='Type Students ID'>
	  <input type='submit' value='Edit Student'>
	  </form>

	  <?php 
	
	
	$result=mysqli_query($con,'SELECT * FROM student WHERE id='.$_GET['searchid']);
	
	$fin=mysqli_fetch_array($result);

?>	
	<?php if($_GET['student_add']){ ?>
     <form action='index.php' method='post'><table>
     <tr><td> First Name:</td> <td><input type='text' name='name'/></td></tr>
	 <tr> <td>Last Name:</td><td> <input type='text' name='lastname'/></td></tr>
	 <tr><td> Gender:</td><td> <input type='radio' name='gender' value='M' />Male
	 <input type='radio' name='gender' value='F' />Female</td></tr>
	 <tr><td> Faculty:</td><td> <input type='text' name='faculty' /></td></tr>
	<tr><td>Phone Number: </td><td><input type='text' name='phone' c/></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' name='submit' value='Add Student'></td></tr>
	 </table></form>
	 <?php  } ?>
	<?php if($_GET['searchid']){ ?>
    <form action='index.php' method='post'><table>
	<tr><td>ID:</td> <td><input type='text' name='editid' value=<?php echo $fin['id'];?> ></td></tr>
   <tr><td> First Name:</td> <td><input type='text' name='editname' value=<?php echo $fin['name'];?> ></td></tr>
	<tr> <td>Last Name:</td><td> <input type='text' name='editlastname' value=<?php echo $fin['lastname'];?>  ></td></tr>
	<tr><td> Gender:</td><td> <input type='radio' name='editgender' value='m' checked=<?php if($fin['gender']=="M") print('checked'); ?>  >Male
	                          <input type='radio' name='editgender' value='f'  checked=<?php if($fin['gender']=="F") print('checked'); ?> >Female</td></tr>
	 <tr><td> Faculty:</td><td> <input type='text' name='editfaculty' value=<?php echo $fin['faculty'];?> 	></td></tr>
	 <tr><td>Phone Number: </td><td><input type='text' name='editphone' value=<?php echo $fin['phone_num'];?>  ></td></tr>
	 <tr><td colspan='2' align='center'><input type='submit' name='editsubmit' value='Edit Student'></td></tr>
	</table></form>
	<?php }
	print_r($_POST['editgender']);
	mysqli_query($con, "UPDATE student SET name='".$_POST['name']."', lastname='".$_POST['lastname']."', gender='".$_POST['gender']."', faculty='".$_POST['faculty']."', phone_num='".$_POST['phone']."'  WHERE id='".$_POST['editid']."'");
	$update="UPDATE student SET name='".$_POST['name']."', lastname='".$_POST['lastname']."', gender='".$_POST['gender']."', faculty='".$_POST['faculty']."', phone_num='".$_POST['phone']."'  WHERE id='".$_POST['editid']."'";

	?>
	
	 
    
	
	 	


	  
<?php
if($_GET['delete']='all')
{
mysqli_query($con,'DELETE FROM users WHERE id=* ');


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