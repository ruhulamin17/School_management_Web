<!DOCTYPE html>
<html>
<head>
     <link href="stylelogin.css" rel="stylesheet">
     
</head>
<body>
<div class="wrapper">
<?php include 'include/header.php';
include "include/leftsidebar.php";
include ("include/config.php");
include ("include/Database.php");
 ?>
 <?php
	$id=$_GET['id'];
	$db= new Database();
	$query= "SELECT * FROM 9classes WHERE id=$id";
	$getData= $db->select($query)->fetch_assoc();
	
	if(isset($_POST['submit'])){
		$item = mysqli_real_escape_string($db->link, $_POST['item']);  
		$quantity = mysqli_real_escape_string($db->link, $_POST['quantity']);  
        
		if($item==''|| $quantity==''){
			$error="Field must not be Empty !!";
		}else{
			$query = " UPDATE 9classes
			SET
			item='$item',
            quantity='$quantity'
			WHERE id= $id";
			$update = $db->update($query);
		}
	}
 ?>
 
 <?php
	if(isset($_POST['delete'])){
		$query="DELETE FROM 9classes WHERE id=$id";
		$deleteData = $db->delete($query);
	}
 ?>
 
 
 <?php
	if(isset($error)){
		echo "<span style='color:red'>".$error."</span>";
	}
 ?>
 
 <form action="9classesupdate.php?id=<?php echo $id;?>" method="post">
	 <table><br>
        <tr>
            <td><br>Item</td>
			<td><br><input type="text" name="item" value="<?php echo $getData['item']?>"/><td> 

         </tr>
         <tr>
            <td><br>quantity</td>
            <td><br><input type="text" name="quantity" value="<?php echo $getData['quantity']?>"/><td>
         </tr>
		 <tr>
			<td>
			<br>
			<input type="submit" name="submit" value="Update" />
			<input type="reset" value="cancel" />
			<input  type="submit" name="delete" value="Delete" />
			</td> 
		 </tr>
	 </table>
 </form>
 <br>
 <button style="margin-left:20px;background-color:white;"> <a style="text-decoration:none;color:blue;font-size:20px;" href="9classes.php">Go back</a></button>
 

 
 
  
<?php include 'include/footer.php'; ?> 
</div>
</body>
</html>