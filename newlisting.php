<?php
require('./connect.inc.php');
session_start();
$error=0;
$message="";

if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
{
	header('Location: index.php');
}
else
{
	$user_id=$_SESSION['user_id'];
	
	if(isset($_POST["title"]) && isset($_POST["address"]) && isset($_POST["locality"]) && isset($_POST["city"]) && isset($_POST["price"]) && isset($_POST["list_type"]) && isset($_POST["description"]))
	{
		if(!empty($_POST["title"]) && !empty($_POST["address"]) && !empty($_POST["locality"]) && !empty($_POST["city"]) && !empty($_POST["price"]) && !empty($_POST["list_type"]) && !empty($_POST["description"]))
		{
			
			$title=mysql_real_escape_string($_POST['title']);
			$address=mysql_real_escape_string($_POST['address']);
			$locality=mysql_real_escape_string($_POST['locality']);
			$city=mysql_real_escape_string($_POST['city']);
			$price=mysql_real_escape_string($_POST['price']);
			$list_type=mysql_real_escape_string($_POST['list_type']);
			$desc=mysql_real_escape_string($_POST['description']);
			
			$time=time();
			
			$query="INSERT INTO `listing` VALUES('','$title','$list_type','$desc','$address','$locality','$city','$price','$time','$user_id')";
			$run=mysqli_query($con,$query);
			$last_id=mysqli_insert_id($con);
			
			$location = "uploads/";
			$pic_name=$_FILES["fileToUpload"]["tmp_name"];
			move_uploaded_file($pic_name,$location.$time.'.png');
			
			header('Location: index.php');
			
		}
		else
		{
			
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('./header.php')?>
 
    <body>        
    
        
       	<div id="part3" class="parts row sections"> 
			<?php include('./nav.php')?>
			<div id="center_div" class="other_panes col l8 offset-l2 s10 offset-s1">
				<div class="heading" class="col s12 m12 l12">
					<h2>Create Listing</h2>
				</div>
				<div class="row">
					<form method="post" id="signup_form" action="newlisting.php" enctype="multipart/form-data" >
						<input id="title" class="col s12 offset-m1 m4 block-inp" value="" name="title" type="text" placeholder="Title" required></input>
					
						<input id="address" class="col s12 offset-m2 m4 block-inp" value="" name="address" type="text" placeholder="Address" required></input>
				
						<input id="locality" class="col s12  offset-m1 m4 block-inp" value="" name="locality" type="text" placeholder="Locality" required></input>
			
						<input id="city" class="col s12  offset-m2 m4 block-inp" value=""	name="city" type="text" placeholder="City" required></input>
					
						<select id="list_type" class="col s12  offset-m1 m4 block-inp" name="list_type">
							<option value="" disabled selected>Type</option>
							<option value="rent">Rent</option>
							<option value="sell">Sell</option>
							<option value="pg">Paying Guest</option>
						</select>
						
						<input id="price" class="col s8  offset-m2 m2 block-inp" value="" name="price" type="number" min="0" placeholder="Price" required></input>
						
						<span class="pm col m2 s4">/month</span>
						
						<textarea name="description" placeholder="Description" rows="10" class="col s12 block-inp offset-m1 m4" required></textarea>
	
						<input type="file" name="fileToUpload" id="fileToUpload" required>
			
						<input type="submit" class="col offset-s1 s10 block-btn" value="Post Listing"></input>					
					</form>
				</div>
			</div>    
        </div>   
    </body>
</html>